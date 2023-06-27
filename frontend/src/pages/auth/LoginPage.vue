<template>
  <div class="q-pa-md absolute-center">
    <h3 class="text-center">connexion</h3>
    <q-form
      @submit.prevent="onSubmit"
      @reset="onReset"
      class="q-gutter-md classForm"
    >
      <q-input
        outlined
        v-model="form.email"
        name="email"
        label="Votre email"
        lazy-rules
        required
        :rules="[
          (val) => (val && val.length > 0) || 'Veuillez entrer votre email',
        ]"
      />

      <q-input
        outlined
        type="password"
        v-model="form.password"
        name="password"
        label="Votre mot de passe"
        lazy-rules
        :rules="[
          (val) => (val && val.length > 0) || 'Veuillez entrer votre nom',
        ]"
      />

      <div class="column q-gutter-y-md">
        <q-btn
          unelevated
          no-caps
          label="Se connecté"
          type="submit"
          color="negative"
        />
        <q-btn
          no-caps
          unelevated
          label="Annuler"
          type="reset"
          color="grey-4"
          text-color="back"
          class=""
        />
      </div>
    </q-form>
  </div>
</template>

<script setup>
import { LocalStorage, useQuasar } from "quasar";
import { useRouter } from "vue-router";

import { api } from "src/boot/axios";
import { ref } from "vue";

const $q = useQuasar();
const route = useRouter();
const form = ref({});

let onSubmit = async () => {
  try {
    let res = await api({
      url: "/api/login",
      method: "post",
      data: form.value,
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
    });
    LocalStorage.set("token", res.data.access_token);

    if (res.status === 200) {
      $q.notify({
        color: "positive",
        position: "top",
        textColor: "white",
        icon: "cloud_done",
        message: "Connexion reussi",
      });
      setTimeout(() => {
        route.push("/comments");
      }, 1500);
    }
  } catch (error) {
    $q.notify({
      color: "red-5",
      textColor: "white",
      position: "top",
      icon: "warning",
      message: "Email ou mot de passe incorrect",
    });
  }
};

let onReset = () => {
  form.value = null;
};
</script>

<style lang="scss">
.classForm {
  width: 400px;
}
</style>
