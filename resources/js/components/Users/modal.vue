
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
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" class="form-control" id="name" name="name" required  v-model="user.name">
                        </div>

                        <div class="form-group">
                            <label for="lastname">Apellido:</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required v-model="user.last_name">
                        </div>

                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required v-model="user.username">
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required v-model="user.email">
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required v-model="user.password">
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mx-3 my-3">{{ `${is_create ? "Crear" :
                                "Actualizar"} Usuario` }}</button>
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
            user: [],
        };
    },

    created() {
        this.index();
    },

    methods: {
        index() {

        },

        async storeUser() {
            try {
                if (this.is_create) {
                    await axios.post("http://127.0.0.1:8000/api/Users/CreateUser", this.user);
                } else {
                    await axios.put('api/Users/UpdateUser/${this.user.id}', this.user);
                }
                swal.fire({
                    icon: 'success',
                    title: 'Éxito!',
                    text: 'Usuario guardado correctamente!',
                })

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
