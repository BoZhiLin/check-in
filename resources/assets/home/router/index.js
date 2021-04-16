import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "home",
    component: require("../views/Home.vue").default
  },
  {
    path: "/login",
    name: "login",
    component: require("../views/Login.vue").default
  },
  {
    path: "/profile",
    name: "profile",
    component: require("../views/Check.vue").default
  },
  {
    path: "/check",
    name: "check",
    component: require("../views/Check.vue").default
  },
  {
    path: "/leave",
    name: "leave",
    component: require("../views/Leave.vue").default
  },
];

export default new VueRouter({
  mode: "history",
  routes,
});
