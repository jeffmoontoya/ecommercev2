<x-app>
    <div class="card mx-3 my-3 px-3 py-3">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ $product->product_image }}" alt="Producto" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h1>{{ $product->product_name }}</h1>
                <p>{{ $product->product_description }}</p>
                <p> Categoria: {{ $product->category->category_name }}</p>
                <p> Stock: {{ $product->product_stock}}</p>
                <h3>Precio: {{ $product->product_price }}</h3>
                <button href="" class="btn btn-primary">Agregar al Carrito</button>
            </div>
        </div>
    </div>
</x-app>
