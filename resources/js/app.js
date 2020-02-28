/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment';
import { Form, HasError, AlertError } from 'vform';

import Gate from './Gate';
Vue.prototype.$gate=new Gate(window.user);

window.Form=Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import Swal from 'sweetalert2';
window.Swal=Swal;


const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 2000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
window.Toast=Toast;


window.Fire=new Vue();

import VueRouter from 'vue-router';
Vue.use(VueRouter)

Vue.component('profile', require('./components/Profile.vue').default);
Vue.component('products', require('./components/Products.vue').default);
Vue.component('users', require('./components/Users.vue').default);
Vue.component('orders', require('./components/Orders.vue').default);
Vue.component('supplier_products', require('./components/Supplier_products.vue').default);
Vue.component('Suppliers', require('./components/suppliers.vue').default);
Vue.component('order_details', require('./components/Order_details.vue').default);

import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
  color: 'green',
  failedColor: 'red',
  height: '2px'
})

  import Order_details from './components/Order_details.vue';
  import Orders from './components/Orders.vue';
  import Products from './components/Products.vue';
  import Users from './components/Users.vue';
  import Supplier_products from './components/Supplier_products.vue';
  import Suppliers from './components/Suppliers.vue';
  import Profile from './components/Profile.vue';

  export const routes = [{
  path: '/orders',
  component: Orders,
  name: 'orders'
},
{
  path: '/supplier_products',
  component: Supplier_products,
  name: 'supplier_products' 
},
{ path: '/suppliers',
component: Suppliers,
name: 'suppliers'
},
{ path: '/products',
component: Products,
name: 'products'
},
{ path: '/order_details',
component: Order_details,
name: 'order_details'}
];
   
  const router = new VueRouter({
    mode: 'history',
    routes 
  })
   Vue.filter('upText',function(text){
     return text.charAt(0).toUpperCase()+text.slice(1)

  });
  Vue.filter('myDate',function(created){
    return moment(created).format('MMMM Do YYYY');

  });

  //PASSPORT COMPONENT REGISTRATION        /** 
  /**Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);
Vue.component(
    'not-found',
    require('./components/NotFound.vue').default
);
**/


const app = new Vue({
    el: '#app',
    router,
     
}).$mount("#app");
