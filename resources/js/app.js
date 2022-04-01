/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router'

Vue.use(VueRouter)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('products', require('./components/Products.vue').default);
Vue.component('category-products', require('./components/CategoryProducts.vue').default);

const routes = [
    { path: '/products', component: require('./components/Products.vue').default },
    { path: '/category/:id/products', component: require('./components/CategoryProducts.vue').default },
    { path: '/cart', component: require('./components/Cart.vue').default },
    { path: '/admin', component: require('./components/Dashboard.vue').default },
    { path: '/categories', component: require('./components/Categories/CategoryList').default },
    { path: '/create/category', component: require('./components/Categories/AddCategory').default },
    { path: '/category/:id/edit', component: require('./components/Categories/EditCategory').default },
    { path: '/brands', component: require('./components/Brands/BrandList').default },
    { path: '/create/brand', component: require('./components/Brands/AddBrand').default },
    { path: '/brand/:id/edit', component: require('./components/Brands/EditBrand').default },
    { path: '/product-list', component: require('./components/Products/ProductList').default },
    { path: '/create/product', component: require('./components/Products/AddProduct').default },
    { path: '/product/:id/edit', component: require('./components/Products/EditProduct').default },
]

const router = new VueRouter({
    mode: 'history',
    routes
})


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 const app = new Vue({
    router
  }).$mount('#app')
