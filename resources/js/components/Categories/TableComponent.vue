<template>
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Categoria: </th>
        <th>Acciones: </th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(category, index) in categories" :key="index">
        <th scope="row">{{ index + 1 }}</th>
        <td>{{ category.category_name }}</td>
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
  props: ["categories_data"],
  data() {
    return {
      categories: [],
    };
  },

  created() {
    console.log(this.categories_data);
    this.index();
  },
  methods: {
    index() {
      this.categories = [...this.categories_data]
    },
  },
};
</script>

