const RouterView = { template: "<router-view></router-view>" };

export default [
  {
    path: "/admin",
    component: RouterView,
    redirect: { name: "admin.login" }
  },
  {
    path: "/admin/login",
    name: "admin.login",
    component: require("../views/backend/Login.vue").default
  },
  {
    path: "/admin/dashboard",
    name: "admin.login",
    component: require("../views/backend/Home.vue").default
  },
];
