import Vue from "vue";
import VueRouter from "vue-router";
import backend from "./backend.js";
import frontend from "./frontend.js";

Vue.use(VueRouter);

const routes = [frontend, backend].flat(1);

export default new VueRouter({
  mode: "history",
  routes,
});
