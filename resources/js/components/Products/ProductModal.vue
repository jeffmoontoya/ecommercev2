
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
                    <form @submit.prevent="storeProduct" enctype="nultipart/form-data">
                        <div class="form-group">
                            <label for="category">Categoría:</label>
                            <v-select :options="categories" v-model="product.category_id" :reduce="category => category.id"
                                label="category_name" id="category"> <v-select />
                                <!-- Opciones de categorías aquí -->
                            </v-select>
                        </div>

                        <div class="form-group">
                            <label for="product_image">Imagen:</label>
                            <input type="file" class="form-control" id="file" accept="image/*" @change="loadImage">
                        </div>

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
    props: ["product_data"],
    data() {
        return {
            is_create: true,
            categories: [],
            product: {},
            file: null
        };
    },

    created() {
        this.index();
    },

    methods: {
        index() {
            this.getCategories();
            this.setProduct();
        },

        setProduct() {
            if (!this.product_data) return
            this.product = { ...this.product_data };
            this.is_create = false;
        },

        loadImage(event) {
            this.file = event.target.files[0]
        },

        loadFormData() {
            const form_data = new FormData();
            if (this.file) form_data.append('product_image', this.file, this.file.name);
            form_data.append('category_id', this.product.category_id);
            form_data.append('product_name', this.product.product_name);
            form_data.append('product_description', this.product.product_description);
            form_data.append('product_price', this.product.product_price);
            form_data.append('product_stock', this.product.product_stock);
            return form_data;
        },

        async getCategories() {
            const { data } = await axios.get("/api/Categories/GetAllCategories");
            this.categories = data.categories;
        },

        async storeProduct() {
            const product = this.loadFormData();
            try {
                if (this.is_create) {
                    await axios.post("/api/Products/SaveProduct", product);
                } else {
                    await axios.post(`/api/Products/UpdateProduct/${this.product.id}`, product);
                }
                swal.fire({
                    icon: 'success',
                    title: 'Éxito!',
                    text: 'Producto guardado correctamente!',
                });

                this.$parent.CloseModal();
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

