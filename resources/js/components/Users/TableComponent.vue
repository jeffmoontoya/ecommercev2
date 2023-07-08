<template>
    <table class="table" id="usersTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Username</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(user, index) in users" :key="index">
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ user.name }}</td>
                <td>{{ user.lastname }}</td>
                <td>{{ user.username }}</td>
                <td>{{ user.email }}</td>
                <td>
                    <button class="btn btn-sm btn-primary" @click="getUser(user.id)">Editar</button>
                    <button class="btn btn-sm btn-danger"  @click="deleteUser(user.id)">Eliminar</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: ["users_data"],
    data() {
        return {
            users: [],
        };
    },

    mounted(){
        $('#usersTable').DataTable();
    },

    created() {
        console.log(this.users_data);
        this.index();
    },
    methods: {
        index() {
            this.users = [...this.users_data]
        },

        async getUser(user_id) {
            try {
                const { data } = await axios.get(`/api/Users/GetAnUser/${user_id}`);
                this.$parent.editUser(data.user);
            } catch (error) {
                console.log(error);
            }
        },

        async deleteUser(user_id) {
            try {
                const result = await swal.fire({
                    icon: 'info',
                    title: 'Quieres eliminar el Usuario?',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar'
                })

                if (!result.isConfirmed) return

                await axios.delete(`/api/Users/DeleteUser/${user_id}`)
                this.$parent.getUsers();
                swal.fire({
                    icon: 'success',
                    title: 'Felicidades!',
                    text: 'Usuario Eliminado satisfactoriamente!'
                })
            } catch (error) {
                console.error(error)
            }
        },
    },
};
</script>

