const routes = [
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      { path: "", component: () => import("pages/IndexPage.vue") },
      {
        path: "/inscription",
        component: () => import("pages/auth/InscriptionPage.vue"),
      },
      {
        path: "/login",
        component: () => import("pages/auth/LoginPage.vue"),
      },
      {
        path: "/comments",
        component: () => import("pages/CommentPage.vue"),
      },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
];

export default routes;
