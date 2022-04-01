<template>
    <div class="row">
        <h3> <router-link :to="`/categories`"> Categories </router-link> </h3>
        <h3> <router-link to="/brands"> Brands </router-link> </h3>
        <h3> <router-link to="/product-list"> Products </router-link> </h3>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        data () {
            return {
                products: [],
                userData: null
            }
        },

        mounted() {
            this.userData = this.user;
            if(this.userData.type == 'customer') {
                this.$router.push({ path: '/products' })
            }
            this.getProducts()
        },

        methods: {
            getProducts () {
                axios({
                    url: '/api/products',
                    headers: { 'user_id': this.userData.id }
                })
                .then(({data}) => this.products = data)
                .catch(err => alert('error'));
            }
        }
    }
</script>
