
<template>
    <div class="modal fade" id="user_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ `${is_create ? "Crear" : "Actualizar"} Usuario` }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">


                    <form @submit.prevent="storeUser">

                        <div class="form-group ">
                            <label for="role">Rol:</label>
                            <select  id="role" name="role" class="form-select"  v-model="user.role">
                                <option value="admin">Administrador</option>
                                <option value="user">Usuario</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" class="form-control" id="name" name="name"  v-model="user.name">
                        </div>

                        <div class="form-group">
                            <label for="lastname">Apellido:</label>
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                v-model="user.lastname">
                        </div>

                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username"
                                v-model="user.username">
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email"  v-model="user.email">
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password"
                                v-model="user.password">
                        </div>
                        <!-- <div class="form-group">
                            <label for="password">Confirmar Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required
                                v-model="user.password_confirmation">
                        </div> -->

                        <div v-if="errorMessage" class="text-danger mt-3">{{ errorMessage }}</div>


                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mx-3 my-3">{{ `${is_create ? "Crear" :
                                "Actualizar"} Usuario` }}</button>
                            <button type="submit" class="btn btn-primary mx-3 my-3" @click="closeM"> Cancelar </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["user_data"],
    data() {
        return {
            is_create: true,
            user: {
                role: ''
            },
            errorMessage: ''
        };
    },

    created() {
        this.index();
    },

    methods: {
        index() {
            this.setUser();
        },

        setUser() {
            if (!this.user_data) return
            this.user = { ...this.user_data }
            this.is_create = false;
        },

        closeM() {
            this.$parent.closeModal();
        },

        async storeUser() {
            try {
                if (this.is_create) {
                    await axios.post('/api/Users/SaveUser', this.user);
                } else {
                    await axios.put(`/api/Users/UpdateUser/${this.user.id}`, this.user);
                }
                swal.fire({
                    icon: 'success',
                    title: 'Éxito!',
                    text: 'Usuario guardado correctamente!',
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
