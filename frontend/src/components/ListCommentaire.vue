<template>
  <div class="row justify-center">
    <h4>listes des commentaires</h4>
  </div>

  <div class="liste_date">
    <div v-for="(item, index) in props.comment" :key="item.id" class="">
      <q-form class="row q-gutter-md q-my-md">
        <div class="col">
          <q-input
            outlined
            v-model="item.comment"
            type="text"
            v-if="idx == index"
          />
          <span v-else> {{ item.comment }} | </span>
          <i>
            {{
              item.created_at !== null
                ? formattedString(item.created_at)
                : formattedString(item.updated_at)
            }}</i
          >
        </div>
        <div class="row">
          <q-btn
            v-if="idx == index"
            no-caps
            unelevated
            label="enregistrer"
            color="warning"
            class="q-ml-sm"
            @click="uploadComment(item.id, item)"
          />
          <q-btn
            v-else
            no-caps
            unelevated
            label="Modifier"
            color="warning"
            class="q-ml-sm"
            @click="onClick(index)"
          />

          <q-btn
            no-caps
            unelevated
            label="Supprimer"
            type="reset"
            color="negative"
            class="q-ml-sm"
            @click="deleteComment(item.id)"
          />
        </div>
      </q-form>
    </div>
  </div>
</template>

<script setup>
import { date } from "quasar";
import { api } from "src/boot/axios";
import { onBeforeMount, ref } from "vue";
const props = defineProps(["comment"]);
let idx = ref(null);

let formattedString = (params) => {
  return date.formatDate(params, "DD-MM-YYYY HH:mm");
};

let uploadComment = async (idComment, data) => {
  try {
    let res = await api({
      url: `/api/commentsupdate/${idComment}`,
      method: "put",
      data: data,
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
    });
    idx.value = null;
    // console.log("resres", res);
  } catch (error) {
    console.log(error);
  }
};

let deleteComment = async (idComment) => {
  try {
    let res = await api({
      url: `/api/commentsdelete/${idComment}`,
      method: "delete",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
    });
    // console.log("resres", res);

    window.location.reload();
  } catch (error) {
    console.log(error);
  }
};

let onClick = (params) => {
  console.log("params", params);
  idx.value = params;
};
</script>

<style lang="scss" scoped>
.liste_date {
  margin: 10px auto;
}
</style>
