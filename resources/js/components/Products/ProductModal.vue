
<template>
    <div class="modal fade" id="product_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ `${is_create ? "Crear" : "Actualizar"} Producto` }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="storeProduct">
                        <div class="form-group">
                            <label for="category">Categoría:</label>
                            <v-select :options="categories" v-model="product.category_id" :reduce="category => category.id"
                                label="category_name" clearable="false" id="category"> <v-select />
                                <!-- Opciones de categorías aquí -->
                            </v-select>
                        </div>

                        <!-- <div class="form-group">
                            <label for="product_image">Imagen:</label>
                            <input type="file" class="form-control" id="product_image" name="product_image" required>
                        </div> -->

                        <div class="form-group">
                            <label for="product_name">Nombre:</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" required
                                v-model="product.product_name">
                        </div>

                        <div class="form-group">
                            <label for="product_description">Descripción:</label>
                            <textarea class="form-control" id="product_description" name="product_description" required
                                v-model="product.product_description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="product_price">Precio:</label>
                            <input type="number" class="form-control" id="product_price" name="product_price" required
                                v-model="product.product_price">
                        </div>

                        <div class="form-group">
                            <label for="product_stock">Stock:</label>
                            <input type="number" class="form-control" id="product_stock" name="product_stock" required
                                v-model="product.product_stock">
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mx-3 my-3">{{ `${is_create ? "Crear" :
                                "Actualizar"} Producto` }}</button>
                            <button type="submit" class="btn btn-primary mx-3 my-3">Cancelar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            is_create: true,
            product: [],
            categories: [],
        };
    },

    created() {
        this.index();
    },

    methods: {
        index() {
            this.getCategories();
        },

        async getCategories() {
            const { data } = await axios.get("/api/Categories/GetAllCategories");
            this.categories = data.categories;
        },

        async storeProduct() {
            try {
                if (this.is_create) {
                    await axios.post("api/Products/SaveProduct", this.product);
                } else {
                    //await axios.put('api/Products/UpdateProduct/${this.product.id}', this.product);
                }
                swal.fire({
                    icon: 'success',
                    title: 'Éxito!',
                    text: 'Producto guardado correctamente!',
                });

                $this.$parent.CLoseModal();
            } catch (error) {
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
</script>

