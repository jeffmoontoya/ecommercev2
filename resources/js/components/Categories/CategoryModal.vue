
<template>
    <div class="modal fade" id="category_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ `${is_create ? "Crear" : "Actualizar"} Categoria` }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="storeCategory">
                        <div class="form-group">
                            <label for="category_name">Nombre de categoría:</label>
                            <input type="text" class="form-control" id="category_name" name='category_name' required
                                v-model="category.category_name">
                        </div>
                        <div v-if="errorMessage" class="text-danger mt-3">{{ errorMessage }}</div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mx-3 my-3">{{ `${is_create ? "Crear" :
                                "Actualizar"} Categoria` }}</button>
                            <button type="submit" class="btn btn-primary mx-3 my-3" @click="closeM">Cancelar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["category_data"],
    data() {
        return {
            is_create: true,
            category: {},
            errorMessage: '',
        };
    },
    created() {
        this.index();
    },

    methods: {
        index() {
            this.setCategory();
        },

        setCategory() {
            if (!this.category_data) return
            this.category = { ...this.category_data }
            this.is_create = false;
        },

        closeM() {
            this.$parent.closeModal();
        },

        async storeCategory() {
            try {
                if (this.is_create) {
                    await axios.post('/api/Categories/SaveCategory/', this.category);
                } else {
                    await axios.put(`/api/Categories/UpdateCategory/${this.category.id}`, this.category);
                }
                swal.fire({
                    icon: 'success',
                    title: 'Éxito!',
                    text: 'Categoria guardada correctamente!',
                })
                this.$parent.closeModal();
            } catch (error) {
                if (error.response && error.response.data && error.response.data.message) {
                    this.errorMessage = error.response.data.message;
                } else {
                    console.error(error);
                    swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Algo salió mal!',
                    });
                }
            }
        }
    }
}
</script>
