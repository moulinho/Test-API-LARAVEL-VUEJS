<template>
  <div class="q-pa-lg column">
    <div class="row justify-center">
      <q-form
        @submit.prevent="onSubmit"
        @reset="onReset"
        class="q-gutter-md myForm"
      >
        <q-input
          v-model="form.comment"
          type="textarea"
          placeholder="Votre message"
          outlined
          class=""
          :input-style="{ width: '100%', height: '20vh', resize: 'none' }"
        />
        <div>
          <q-btn
            size="lg"
            unelevated
            no-caps
            label="Ajouter"
            type="submit"
            color="info"
          />
        </div>
      </q-form>
    </div>

    <!-- Listing Comment -->
    <list-commentaire :comment="dataComment" />
  </div>
</template>

<script setup>
import { onBeforeMount, onMounted, ref } from "vue";
import ListCommentaire from "src/components/ListCommentaire.vue";
import { api } from "src/boot/axios";
import VerifAuth from "src/pages/auth/VerifAuth";
const form = ref({});

let dataComment = ref();

let getComment = async () => {
  try {
    let res = await api({
      url: "/api/comments",
      method: "get",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
    });

    // console.log("reeComme", res);
    dataComment.value = res.data.comments;
  } catch (error) {
    console.log(error);
  }
};

let onSubmit = async () => {
  try {
    let res = await api({
      url: "/api/comments",
      method: "post",
      data: form.value,
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
    });
    getComment();
    // console.log("resres", res);
  } catch (error) {
    console.log(error);
  }
};

onBeforeMount(() => {
  VerifAuth("/login");
});

//----------------\\
onMounted(async () => {
  getComment();
});
//----------------\\

let onReset = () => {
  form.value = null;
};
</script>

<style lang="scss" scoped>
.myForm {
  width: 500px;
}
</style>
