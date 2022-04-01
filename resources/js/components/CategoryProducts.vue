<template>
    <div class="row" v-if="category">

        <h3 class="text-success">Category: ( {{ category.attributes.name }} ) Products</h3>
        <h3> <router-link :to="`/cart`"> Cart </router-link> </h3>
        <h3> <router-link :to="`/products`"> All Products </router-link> </h3>
        <div v-for="product in category.relations.products" class="col-md-4" :key="product.id">
            <div class="card mb-2">
                <div class="card-header">
                    <h5>Product: {{ product.attributes.name }}</h5>
                </div>

                <div class="x_panel text-center">
                    <img :src="product.attributes.image" :alt="product.attributes.name" style="width:180px;height:180px">                    <p>SKU: {{ product.attributes.sku }} </p>
                    <p>
                        Categories:
                        <span v-for="(category, key) in product.relations.categories" :key="'prod-' + category.id">
                            <router-link :to="`/category/${category.id}/products`">{{ category.attributes.name }} </router-link>
                            <span v-if="key+1 < product.relations.categories.length">, </span>
                        </span>
                        <hr>
                        Brands:
                        <template v-for="category in product.relations.categories">
                            <template v-for="(brand, index) in category.relations.brands">
                                {{ brand.attributes.name }}
                                <template v-if="index+1 < category.relations.brands.length">, </template>
                            </template>
                        </template>
                        <hr>
                        <button @click="cartHandling(product)" class="btn btn-xs btn-primary">
                           <template v-if="product.attributes.in_cart">
                                Remove From Cart
                            </template>
                            <template v-else>
                                Add To Cart
                            </template>
                        </button>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        data () {
            return {
                userData: null,
                category: null,
            }
        },

        mounted() {
            this.userData = this.user;
            if(this.userData.type == 'admin') {
                this.$router.push({ path: '/admin' })
            }
            this.getProducts()
        },

        methods: {
            getProducts () {
                const categoryId = this.$route.params.id;

                axios({
                    url: `/api/category/${categoryId}/products`,
                    headers: { 'user_id': this.userData.id },
                })
                .then(({data}) => this.category = data)
                .catch(err => alert('error'));
            },

            cartHandling(product) {
                axios({
                    url: '/api/add/cart',
                    method: 'post',
                    headers: { 'user_id': this.userData.id },
                    data: {
                        product_id: product.id,
                        user_id: this.userData.id
                    },
                })
                .then(() => {
                    product.attributes.in_cart > 0 ? alert('Removed Successfully') : alert('Saved Successfully');
                    this.getProducts();
                })
                .catch(err => {
                    console.log(err);
                });
            }
        }
    }
</script>
