<template>
    <div class="row">
        <h3> <router-link :to="`/create/product`"> Add </router-link> </h3>

        <h3>Products</h3>
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">SKU</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product, index) in products" :key="product.id">
                    <th scope="row">{{ ++index }}</th>
                    <td class="text-center">{{ product.attributes.name }}</td>
                    <td class="text-center">{{ product.attributes.sku }}</td>
                    <td class="text-center">
                        <img :src="product.attributes.image" :alt="product.attributes.name" style="width:100px;height:100px">
                    </td>
                    <td class="text-center">
                        <router-link class="btn btn-primary" :to="`/product/${product.id}/edit`"> Edit </router-link>
                        <button class="btn btn-danger" @click="deleteProduct(product.id)"> Delete </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        data () {
            return {
                userData: null,
                products: [],
            }
        },

        mounted() {
            this.userData = this.user;

            if(this.userData.type == 'customer') {
                this.$router.push({ path: '/products' })
            }
            this.getProducts();
        },

        methods: {
            deleteProduct (productId) {
                if(! confirm('Are You Sure')) {
                    return
                }
                axios
                .delete(`/api/products/${productId}/destroy`)
                .then(({data}) => {
                    alert('Deleted Successfully')
                    this.getProducts();
                })
                .catch(err => {
                    console.log(err);
                });
            },

            getProducts () {
                axios
                .get(`/api/products`)
                .then(({data}) => this.products = data)
                .catch(err => alert('error'));
            },

        }
    }
</script>
