<x-app>
    @foreach ($categories as $category)
        <div class="">
            <a style="color: inherit; display: inline-block;" href="{{ route('category.show', ['category' => $category]) }}">
                <h1 class="px-3 py-3">{{ $category->category_name }}</h1>
            </a>


            <div class="d-flex justify-content-center flex-wrap">
                @foreach ($category->products()->take(5)->get() as $product)
                    <div class="card mx-3 my-3 px-3 py-3" style="width: 220px;">
                        <img class="card-img-top" src="{{ $product->product_image }}" alt="{{ $product->product_name }}">
                        <h3 class="card-title">{{ $product->product_price }}</h3>
                        {{-- <p class="card-text">{{ $product->product_description }}</p> --}}
                        <p class="card-text"> {{ $product->product_name }}</p>
                        <p class="card-text"> Categoria: {{ $product->category->category_name }}</p>
                        <a href="{{ route('product.show', ['product' => $product]) }}" class="btn btn-primary">Ver </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</x-app>
