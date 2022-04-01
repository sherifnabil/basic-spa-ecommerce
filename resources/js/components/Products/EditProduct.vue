<template>
    <div class="row">
        <h3> <router-link :to="`/product-list`"> Products </router-link> </h3>

        <div class="form-group">
            <label>Name</label>
            <input @input="nameErrMsg = ''" class="form-control" type="text" v-model="fData.name">
            <p class="text-danger" v-text="nameErrMsg"></p>
        </div>
        <div class="form-group">
            <label>SKU</label>
            <input @input="skuErrMsg = ''" class="form-control" type="text" v-model="fData.sku">
            <p class="text-danger" v-text="skuErrMsg"></p>
        </div>

        <div class="form-group">
            <label>SKU</label>
            <input class="form-control" type="file" ref="file" accept="image/png, image/jpeg, image/jpg">
            <p class="text-danger" v-text="imageErrMsg"></p>
        </div>
        <div class="form-group">
            <button @click="saveProduct" class="btn btn-xs btn-primary">Update</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],

         data () {
            return {
                product: null,
                userData: null,
                nameErrMsg: '',
                skuErrMsg: '',
                imageErrMsg: '',
                fData: {
                    name: '',
                    sku: '',
                    image: null,
                },
            }
        },

        mounted() {
            this.userData = this.user;

            if(this.userData.type == 'customer') {
                this.$router.push({ path: '/products' })
            }
            this.getProduct();
        },

        methods: {
            saveProduct () {
                let formData = new FormData();

                if(this.$refs.file.files.length) {
                    formData.append('image', this.$refs.file.files[0]);
                }
                formData.append('name', this.fData.name);
                formData.append('sku', this.fData.sku);
                formData.append('_method', 'put');

                axios
                .post(`/api/products/${this.product.id}/update`, formData)
                .then(({data}) => {
                    alert('Saved Successfully')
                    this.$router.push({ path: '/product-list' })
                })
                .catch(err => {
                    this.nameErrMsg = err.response.data.errors.name[0]
                    this.skuErrMsg = err.response.data.errors.sku[0]
                    this.imageErrMsg = err.response.data.errors.image[0]
                });
            },

            async getProduct () {
                const productId = this.$route.params.id;

                await axios
                .get(`/api/products/${productId}`)
                .then(({data}) => {
                    this.product = data
                    this.fData.name = data.attributes.name
                    this.fData.sku = data.attributes.sku
                })
                .catch(err => alert('error'));
            },

        }
    }
</script>
