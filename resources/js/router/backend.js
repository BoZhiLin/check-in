const RouterView = { template: "<router-view></router-view>" };

export default [
  { path: "/admin", component: RouterView, redirect: { name: "admin.login" } },
  { path: "/admin/login", name: "admin.login", component: require("../views/backend/Login.vue").default },
  { path: "/admin/dashboard", name: "admin.dashboard", component: require("../views/backend/Dashboard.vue").default },

  { path: "/admin/users", name: "admin.users", component: require("../views/backend/user/Index.vue").default },

  { path: "/admin/supers", name: "admin.supers", component: require("../views/backend/super/Index.vue").default },
];
