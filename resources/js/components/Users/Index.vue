<template>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3>Usuarios</h3>
            <button @click="openModal" class="btn btn-primary">
                Agregar Usuario
            </button>
        </div>

        <div class="card-body">
            <section class="table-responsive" v-if="load">
                <TableComponent :users_data="users" />
            </section>
            <section v-else>
                <div class="d-flex justify-content-center align-items-center" style="height: 300px">
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </section>
        </div>

        <section v-if="load_modal">
            <Modal />
        </section>
    </div>
</template>


<script>
import TableComponent from "./TableComponent.vue";
import Modal from "./modal.vue";

export default {
    components: {
        TableComponent,
        Modal,
    },

    data() {
        return {
            users: [],
            load: false,
            load_modal: false,
            modal: null,
        };
    },
    created() {
        this.index();
    },
    methods: {
        async index() {
            await this.getUsers();
        },
        async getUsers() {
            try {
                this.load = false;
                const response = await axios.get(
                    "/api/Users/GetAllUsers/"
                );
                this.users = response.data.users;
                this.load = true;
            } catch (error) {
                console.log(error);
            }
        },

        openModal() {
            this.load_modal = true;
            setTimeout(() => {
                this.modal = new bootstrap.Modal(
                    document.getElementById("user_modal"),
                    {
                        keyboard: false,
                    }
                );
                this.modal.show();

                const modal = document.getElementById("user_modal");
                modal.addEventListener("hidden.bs.modal", () => {
                    this.load_modal = false;

                });
            }, 200);
        },
    },
};
</script>
