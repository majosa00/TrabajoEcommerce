<div class="container mt-5"> 
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Algunos productos</h2>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="{{ asset($product->image_path) }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text">Precio: ${{ $product->price }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <a href="" class="btn btn-primary">Ver todos los productos</a>
            </div>
        </div>
    </div>
</div>
