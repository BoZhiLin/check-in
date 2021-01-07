import VueRouter from 'vue-router';

const routes = [
  {
    path: '/',
    component: require('../components/App')
  }
];

export default new VueRouter({
  mode: 'history',
  routes
});