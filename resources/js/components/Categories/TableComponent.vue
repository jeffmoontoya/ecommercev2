<template>
    <table class="table" id="categoriesTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Categoria: </th>
                <th>Acciones: </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(category, index) in categories" :key="index">
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ category.category_name }}</td>
                <td>
                    <button class="btn btn-sm btn-primary" @click="getCategory(category.id)">Editar</button>
                    <button class="btn btn-sm btn-danger" @click="deleteCategory(category.id)">Eliminar</button>
                </td>

            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: ["categories_data"],
    data() {
        return {
            categories: [],
        };
    },
    mounted(){
        $('#categoriesTable').DataTable();
    },
    created() {
        console.log(this.categories_data);
        this.index();
    },
    methods: {
        index() {
            this.categories = [...this.categories_data]
        },

        async getCategory(category_id) {
            try {
                const { data } = await axios.get(`/api/Categories/GetCategory/${category_id}`);
                this.$parent.editCategory(data.category);
            } catch (error) {
                console.log(error);
            }
        },

        async deleteCategory(category_id) {
            try {
                const result = await swal.fire({
                    icon: 'info',
                    title: 'Quieres eliminar la categoría?',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar'
                })

                if (!result.isConfirmed) return

                await axios.delete(`/api/Categories/DeleteCategory/${category_id}`)
                this.$parent.getCategories();
                swal.fire({
                    icon: 'success',
                    title: 'Felicidades!',
                    text: 'Categoría Eliminada con éxito!'
                })
            } catch (error) {
                console.error(error)
            }
        },
    },
};
</script>

