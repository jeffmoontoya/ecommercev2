<template>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3>Categorias</h3>
            <button @click="openModal" class="btn btn-primary">
                Agregar Categoría
            </button>
        </div>

        <div class="card-body">
            <section class="table-responsive" v-if="load">
                <TableComponent :categories_data="categories" />
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
            <Modal :category_data="category"/>
        </section>
    </div>
</template>


<script>
import TableComponent from "./TableComponent.vue";
import Modal from "./CategoryModal.vue";

export default {
    components: {
        TableComponent,
        Modal,
    },

    data() {
        return {
            categories: [],
            load: false,
            load_modal: false,
            modal: null,
            category: null,
        };
    },
    created() {
        this.index();
    },
    methods: {
        async index() {
            await this.getCategories();
        },
        async getCategories() {
            try {
                this.load = false;
                const response = await axios.get("/api/Categories/GetAllCategories");
                this.categories = response.data.categories;
                this.load = true;
            } catch (error) {
                console.log(error);
            }
        },
        // Abrir Modal
        openModal() {
            this.load_modal = true;
            setTimeout(() => {
                this.modal = new bootstrap.Modal(
                    document.getElementById("category_modal"),
                    {
                        keyboard: false,
                    }
                );
                this.modal.show();

                const modal = document.getElementById("category_modal");
                modal.addEventListener("hidden.bs.modal", () => {
                    this.load_modal = false;
                    this.category = null;
                });
            }, 200);
        },
        closeModal() {
            this.modal.hide();
            this.getCategories();
        },

        editCategory(category) {
            this.category = category;
            console.log(this.category);
            this.openModal();
        },
    },
};
</script>
