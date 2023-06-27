<template>
  <table class="table">
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
        <td>{{ product.category.category_name }}</td>
        <td>{{ product.product_price }}</td>
        <td>{{ product.product_stock }}</td>
        <td>
          <button class="btn btn-sm btn-primary">Editar</button>
          <button class="btn btn-sm btn-danger">Eliminar</button>
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

  created() {
    console.log(this.products_data);
    this.index();
  },
  methods: {
    index() {
      this.products = [...this.products_data]
    },
  },
};
</script>

