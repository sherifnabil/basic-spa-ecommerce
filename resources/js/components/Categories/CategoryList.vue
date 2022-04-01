<template>
    <div class="row">
        <h3> <router-link :to="`/create/category`"> Add </router-link> </h3>

        <h3>Categories</h3>
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(category, index) in categories" :key="category.id">
                    <th scope="row">{{ ++index }}</th>
                    <td class="text-center">{{ category.attributes.name }}</td>
                    <td class="text-center">
                        <router-link class="btn btn-primary" :to="`/category/${category.id}/edit`"> Edit </router-link>
                        <button class="btn btn-danger" @click="deleteCategory(category.id)"> Delete </button>
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
                categories: [],
            }
        },

        mounted() {
            this.getCategories();
        },

        methods: {
            deleteCategory (categoryId) {
                if(! confirm('Are You Sure')) {
                    return
                }
                axios
                .delete(`/api/categories/${categoryId}/destroy`)
                .then(({data}) => {
                    alert('Deleted Successfully')
                    this.getCategories();
                })
                .catch(err => {
                    console.log(err);
                });
            },

            getCategories () {
                axios
                .get(`/api/categories`)
                .then(({data}) => this.categories = data)
                .catch(err => alert('error'));
            },

        }
    }
</script>
