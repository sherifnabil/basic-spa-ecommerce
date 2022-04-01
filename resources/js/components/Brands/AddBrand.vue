<template>
    <div class="row">
        <h3> <router-link :to="`/brands`"> Brands </router-link> </h3>

        <div class="form-group">
            <label>Name</label>
            <input @input="errMsg = ''" class="form-control" type="text" v-model="fData.name">
            <p class="text-danger" v-text="errMsg"></p>
        </div>
        <div class="form-group">
            <button @click="saveBrand" class="btn btn-xs btn-primary">Add</button>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                errMsg: '',
                fData: {
                    name: ''
                },
            }
        },

        mounted() {
        },

        methods: {
            saveBrand () {
                axios
                .post('/api/brands', this.fData)
                .then(({data}) => {
                    alert('Saved Successfully')
                    this.$router.push({ path: '/brands' })

                })
                .catch(err => this.errMsg = err.response.data.message);
            }
        }
    }
</script>
