<template>
    <div class="row">
        <h3> <router-link :to="`/brands`"> Brands </router-link> </h3>

        <div class="form-group">
            <label>Name</label>
            <input @input="errMsg = ''" class="form-control" type="text" v-model="fData.name">
            <p class="text-danger" v-text="errMsg"></p>
        </div>
        <div class="form-group">
            <button @click="saveBrand" class="btn btn-xs btn-primary">Edit</button>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                errMsg: '',
                category: null,
                fData: {
                    name: ''
                },
            }
        },

        mounted() {
            this.getBrand();
        },

        methods: {
            saveBrand () {
                axios
                .put(`/api/brands/${this.brand.id}/update`, this.fData)
                .then(({data}) => {
                    alert('Saved Successfully')
                    this.$router.push({ path: '/brands' })
                })
                .catch(err => this.errMsg = err.response.data.message);

            },

            async getBrand () {
                const brandId = this.$route.params.id;

                await axios
                .get(`/api/brands/${brandId}`)
                .then(({data}) => {
                    this.brand = data
                    this.fData.name = this.brand.attributes.name
                })
                .catch(err => alert('error'));
            },

        }
    }
</script>
