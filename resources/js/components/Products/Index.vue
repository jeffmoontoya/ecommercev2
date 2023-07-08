<template>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3>Productos</h3>
            <button @click="openModal" class="btn btn-primary">
                Agregar Producto
            </button>
        </div>

        <div class="card-body">
            <section class="table-responsive" v-if="load">
                <TableComponent :products_data="products" />
            </section>
            <section v-else>
                <div class="d-flex justify-content-center align-items-center" style="height: 300px;">
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </section>
        </div>

        <section v-if="load_modal">
            <Modal :product_data="product" />
        </section>
    </div>
</template>


<script>
import TableComponent from "./TableComponent.vue";
import Modal from "./ProductModal.vue";


export default {

    components: {
        TableComponent,
        Modal,
    },

    data() {
        return {
            products: [],
            load: false,
            load_modal: false,
            modal: null,
            product: null,
        };
    },
    created() {
        this.index();
    },
    methods: {

        async index() {
            await this.getProducts();
        },
        // Obtener Productos
        async getProducts() {
            try {
                this.load = false;
                const { data } = await axios.get("/api/Products/GetAllProducts");
                this.products = data.products;
                this.load = true;
            } catch (error) {
                console.log(error);
            }
        },

        openModal() {
            this.load_modal = true;
            setTimeout(() => {
                this.modal = new bootstrap.Modal(
                    document.getElementById("product_modal"),
                    {
                        keyboard: false,
                    }
                );
                this.modal.show();

                const modal = document.getElementById("product_modal");
                modal.addEventListener("hidden.bs.modal", () => {
                    this.load_modal = false;
                    this.product = null;
                });
            }, 200);
        },
        CloseModal() {
            this.modal.hide();
            this.modal._element.addEventListener("hidden.bs.modal", () => {
                this.getProducts();
            });
        },

        editProduct(product) {
            this.product = product;
            this.openModal();
        },
    },
};
</script>
