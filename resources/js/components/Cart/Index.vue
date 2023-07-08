<template>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3>Carrito de compras</h3>
        </div>

        <div class="card-body">
            <div class="position-relative">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in userCart" :key="item.id">
                            <td>
                                <img class="card-img-top"
                                    :src="item.product.product_image ? '/storage/images/' + item.product.product_image : 'https://codigogenesis.com/genesis/2022/04/imagen-placeholder-por-defecto-WooCommerce.png'"
                                    :alt="item.product.product_name" style="width: 100px; height: auto;">
                            </td>
                            <td>{{ item.product.product_name }}</td>
                            <td>{{ item.product.category.category_name }}</td>
                            <td>{{ item.quantity }}</td>
                            <td>{{ item.total_price }}</td>
                            <td>
                                <button class="btn btn-sm btn-danger" @click="deleteCartProduct(item.id)">Eliminar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="py-3" style="margin-left: 950px;">
                <h3>Total: $ {{ calculateTotal() }} USD</h3>
            </div>
        </div>
    </div>
</template>


<script>

export default {

    data() {
        return {
            userCart: [],
        };
    },
    created() {
        this.index();
    },
    methods: {
        async index() {
            await this.getUserCart();

        },
        async getUserCart() {
            try {
                const { data } = await axios.get("/Cart/GetUserCart");
                this.userCart = data.userCart;
                console.log(this.userCart);
            } catch (error) {
                console.log(error);
            }
        },


        async deleteCartProduct(cart_id) {
            try {
                const result = await swal.fire({
                    icon: 'info',
                    title: 'Quieres eliminar el producto del carrito?',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar'
                })

                if (!result.isConfirmed) return

                await axios.delete(`/Cart/DeleteCart/${cart_id}`)
                await this.getUserCart()
                swal.fire({
                    icon: 'success',
                    title: 'Felicidades!',
                    text: 'Producto eliminado correctamente'
                })
            } catch (error) {
                console.error(error)
            }
        },

        calculateTotal() {
            let total = 0;
            for (const item of this.userCart ?? []) {
                total += parseFloat(item.total_price);
            }
            return total.toFixed(2);
        },
    },
};


</script>
