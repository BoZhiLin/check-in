import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    component: require('../components/App').default
  }
];

export default new VueRouter({
  mode: 'history',
  routes
});