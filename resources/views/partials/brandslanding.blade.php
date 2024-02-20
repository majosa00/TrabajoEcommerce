<h2>Algunas marcas</h2>
<div class="row">
    @foreach ($brands as $brand)
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $brand->name }}</h5>
                  
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>
</div>
</div>
<div class="text-center">
    <a href="" class="btn btn-primary">Ver todas las Marcas</a>
</div>