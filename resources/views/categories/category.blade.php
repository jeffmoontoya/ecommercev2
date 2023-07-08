<x-app>
    <div class="container my-4">
        <h2> {{ $category->category_name }} </h2>
        <div class="d-flex justify-content-center flex-wrap">
            @foreach ($category->products as $product)
                <div class="card mx-3 my-3 px-3 py-3" style="width: 220px;">
                    @if ($product->product_image)
                        <img class="card-img-top" src="/storage/images/{{ $product->product_image }}"
                            alt="{{ $product->product_name }}">
                    @else
                        <img class="card-img-top"
                            src="https://codigogenesis.com/genesis/2022/04/imagen-placeholder-por-defecto-WooCommerce.png"
                            alt="{{ $product->product_name }}">
                    @endif
                    <h3 class="card-title"> $ {{ $product->product_price }} USD </h3>
                    {{-- <p class="card-text">{{ $product->product_description }}</p> --}}
                    <p class="card-text"> {{ $product->product_name }}</p>
                    <p class="card-text"> Categoria: {{ $product->category->category_name }}</p>
                    <p class="card-text"> Stock: {{ $product->product_stock }}</p>
                    <a href="{{ route('product.show', ['product' => $product]) }}" class="btn btn-primary">Ver </a>
                </div>
            @endforeach

        </div>
    </div>
</x-app>
