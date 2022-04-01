<template>
    <div class="row">
        <h3> <router-link :to="`/create/brand`"> Add </router-link> </h3>

        <h3>Brands</h3>
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(brand, index) in brands" :key="brand.id">
                    <th scope="row">{{ ++index }}</th>
                    <td class="text-center">{{ brand.attributes.name }}</td>
                    <td class="text-center">
                        <router-link class="btn btn-primary" :to="`/brand/${brand.id}/edit`"> Edit </router-link>
                        <button class="btn btn-danger" @click="deleteBrand(brand.id)"> Delete </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                brands: [],
            }
        },

        mounted() {
            this.getBrands();
        },

        methods: {
            deleteBrand (brandId) {
                if(! confirm('Are You Sure')) {
                    return
                }
                axios
                .delete(`/api/brands/${brandId}/destroy`)
                .then(({data}) => {
                    alert('Deleted Successfully')
                    this.getBrands();
                })
                .catch(err => {
                    console.log(err);
                });
            },

            getBrands () {
                axios
                .get(`/api/brands`)
                .then(({data}) => this.brands = data)
                .catch(err => alert('error'));
            },

        }
    }
</script>
