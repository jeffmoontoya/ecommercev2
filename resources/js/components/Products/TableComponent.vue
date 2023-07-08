<template>
    <table class="table" id="productTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Producto</th>
                <th>Descripcion</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones:</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(product, index) in products" :key="index">
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ product.product_name }}</td>
                <td>{{ product.product_description }}</td>
                <td>{{ product.category ? product.category.category_name : '' }}</td>
                <td>{{ product.product_price }}</td>
                <td>{{ product.product_stock }}</td>
                <td>
                    <button class="btn btn-sm btn-primary" @click="getProduct(product.id)">Editar</button>
                    <button class="btn btn-sm btn-danger" @click="deleteProduct(product.id)">Eliminar</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: ["products_data"],
    data() {
        return {
            products: [],
        };
    },

    mounted(){
        $('#productTable').DataTable();
    },
    
    created() {
        console.log(this.products_data);
        this.index();
    },

    methods: {
        index() {
            this.products = [...this.products_data]
        },

        async getProduct(product_id) {
            try {
                const { data } = await axios.get(`/api/Products/GetAProduct/${product_id}`);
                this.$parent.editProduct(data.product);
                console.log(data.product);
            } catch (error) {
                console.log(error);
            }
        },

        async deleteProduct(product_id) {
				try {
					const result = await swal.fire({
						icon: 'info',
						title: 'Quieres eliminar el Producto?',
						showCancelButton: true,
						confirmButtonText: 'Eliminar'
					})

					if (!result.isConfirmed) return

					await axios.delete(`/api/Products/DeleteProduct/${product_id}`)
					this.$parent.getProducts();
					swal.fire({
						icon: 'success',
						title: 'Felicidades!',
						text: 'Producto Eliminado!'
					})
				} catch (error) {
					console.error(error)
				}
			}

    },
};
</script>

