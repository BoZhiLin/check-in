import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const RouterView = { template: "<router-view></router-view>" };

const routes = [
  { path: "/admin", component: RouterView, redirect: { name: "admin.login" } },
  { path: "/admin/login", name: "admin.login", component: require("../views/Login.vue").default },
  { path: "/admin/dashboard", name: "admin.dashboard", component: require("../views/Dashboard.vue").default },

  { path: "/admin/users", name: "admin.users", component: require("../views/user/Index.vue").default },

  { path: "/admin/supers", name: "admin.supers", component: require("../views/super/Index.vue").default },
];

export default new VueRouter({
  mode: "history",
  routes,
});
