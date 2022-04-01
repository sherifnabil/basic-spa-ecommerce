<template>
    <div class="row">
        <h3> <router-link :to="`/categories`"> Categories </router-link> </h3>

        <div class="form-group">
            <label>Name</label>
            <input @input="errMsg = ''" class="form-control" type="text" v-model="fData.name">
            <p class="text-danger" v-text="errMsg"></p>
        </div>
        <div class="form-group">
            <button @click="saveCategory" class="btn btn-xs btn-primary">Edit</button>
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
            this.getCategory();
        },

        methods: {
            saveCategory () {
                axios
                .put(`/api/categories/${this.category.id}/update`, this.fData)
                .then(({data}) => {
                    alert('Saved Successfully')
                    this.$router.push({ path: '/categories' })
                })
                .catch(err => this.errMsg = err.response.data.message);

            },

            async getCategory () {
                const categoryId = this.$route.params.id;

                await axios
                .get(`/api/categories/${categoryId}`)
                .then(({data}) => {
                    this.category = data
                    this.fData.name = this.category.attributes.name
                })
                .catch(err => alert('error'));
            },

        }
    }
</script>
