<template>
      <div class="card mx-3 my-3 px-3 py-3">
        <div class="row">
            <div class="col-md-6">
                @if ($product->product_image)
                    <img class="card-img-top" src="/storage/images/{{ $product->product_image }}"
                        alt="{{ $product->product_name }}">
                @else
                    <img class="card-img-top"
                        src="https://codigogenesis.com/genesis/2022/04/imagen-placeholder-por-defecto-WooCommerce.png"
                        alt="{{ $product->product_name }}">
                @endif
            </div>
            <div class="col-md-6">
                <h1>{{ $product->product_name }}</h1>
                <p> Categoria: {{ $product->category->category_name }}</p>
                <p>{{ $product->product_description }}</p>

                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <label for="quantity"> Cantidad: </label>
                    <select class="form-select" aria-label="Default select example" name="quantity">
                        @for ($i = 1; $i <= $product->product_stock; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <p> {{ $product->product_stock }} Unidades Disponibles </p>

                    <h3>Precio: $ {{ $product->product_price }} USD </h3>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="submit" value="Agregar al Carrito" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['product']
    }
</script>

