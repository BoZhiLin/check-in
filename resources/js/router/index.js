import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const routes = [
  {
    path: "/login",
    name: "login",
    component: require("../views/Login.vue").default
  },
  {
    path: "/",
    name: "home",
    component: require("../views/Check.vue").default
  }
];

export default new VueRouter({
  mode: "history",
  routes
});
