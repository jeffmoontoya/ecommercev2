
<template>
    <div class="modal fade" id="category_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ `${is_create ? "Crear" : "Actualizar"} Categoria` }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('categories.store') }}">
                        <div class="form-group">
                            <label for="category_name">Nombre de categoría:</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" required>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mx-3 my-3">{{ `${is_create ? "Crear" :
                                "Actualizar"} Categoria` }}</button>
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
            category: [],
        };
    },
};
</script>
