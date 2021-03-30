export default [
  {
    path: "/",
    name: "home",
    component: require("../views/frontend/Home.vue").default
  },
  {
    path: "/login",
    name: "login",
    component: require("../views/frontend/Login.vue").default
  },
  {
    path: "/profile",
    name: "profile",
    component: require("../views/frontend/Check.vue").default
  },
  {
    path: "/check",
    name: "check",
    component: require("../views/frontend/Check.vue").default
  },
  {
    path: "/leave",
    name: "leave",
    component: require("../views/frontend/Leave.vue").default
  },
];
