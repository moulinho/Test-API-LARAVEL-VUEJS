<template>
  <q-layout view="lHh Lpr lFf">
    <q-header style="background-color: #d21d3a">
      <q-toolbar>
        <q-toolbar-title> Weblogy </q-toolbar-title>

        <div>
          <span v-if="dataUser !== null && dataUser !== undefined">
            <q-avatar color="teal" text-color="white" icon="font_download" />
            {{ dataUser.name }}

            <q-btn no-caps flat size="lg" label="logout" @click="logout" />
          </span>
          <span v-else>
            <q-btn no-caps flat size="lg" label="Se connecté" to="/login" />
            <q-btn
              no-caps
              flat
              size="lg"
              label="S'inscrire"
              to="/inscription"
            />
          </span>
        </div>
      </q-toolbar>
    </q-header>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script setup>
import { LocalStorage } from "quasar";
import { api } from "src/boot/axios";
import VerifToken from "src/pages/auth/VerifAuth";
import { onBeforeMount, onMounted, ref } from "vue";
import { useRouter } from "vue-router";

const route = useRouter();

let dataUser = ref();

onMounted(async () => {
  const token = VerifToken("/login");
  if (token) {
    try {
      let res = await api({
        url: "/api/user",
        method: "get",
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
          Authorization: `Bearer ${token}`,
        },
      });
      dataUser.value = res.data.data;
      // console.log("reeComme", res.data.data);
    } catch (error) {
      console.log(error);
    }
  }
});

let logout = async (params) => {
  LocalStorage.clear();
  window.location.reload();
  route.push("/login");
};
</script>
