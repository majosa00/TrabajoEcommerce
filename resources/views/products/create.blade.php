@extends('layaouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Añadir Nuevo Producto</h1>
        <form action="{{ route('products.create') }}" method="post" class="needs-validation" novalidate>
            @csrf

            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" name="name" id="name" required>
                <div class="invalid-feedback">
                    Por favor ingresa el nombre del producto.
                </div>
            </div>

            <div class="form-group">
                <label for="description">Descripción:</label>
                <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                <div class="invalid-feedback">
                    Por favor ingresa una descripción del producto.
                </div>
            </div>

            <div class="form-group">
                <label for="flavor">Sabor:</label>
                <input type="text" class="form-control" name="flavor" id="flavor" required>
                <div class="invalid-feedback">
                    Por favor ingresa el sabor del producto.
                </div>
            </div>

            <div class="form-group">
                <label for="brand">Marca:</label>
                <input type="text" class="form-control" name="brand" id="brand" required>
                <div class="invalid-feedback">
                    Por favor ingresa la marca del producto.
                </div>
            </div>

            <div class="form-group">
                <label for="price">Precio:</label>
                <input type="number" class="form-control" step="0.01" name="price" id="price" required>
                <div class="invalid-feedback">
                    Por favor ingresa el precio del producto.
                </div>
            </div>

            <div class="form-group">
                <label for="dimension">Dimensión:</label>
                <input type="number" class="form-control" step="0.01" name="dimension" id="dimension" required>
                <div class="invalid-feedback">
                    Por favor ingresa la dimensión del producto.
                </div>
            </div>

            <div class="form-group">
                <label for="udpack">Unidades por Paquete:</label>
                <input type="number" class="form-control" name="udpack" id="udpack" required>
                <div class="invalid-feedback">
                    Por favor ingresa las unidades por paquete.
                </div>
            </div>

            <div class="form-group">
                <label for="weight">Peso:</label>
                <input type="number" class="form-control" step="0.01" name="weight" id="weight" required>
                <div class="invalid-feedback">
                    Por favor ingresa el peso del producto.
                </div>
            </div>

            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" class="form-control" name="stock" id="stock" required>
                <div class="invalid-feedback">
                    Por favor ingresa el stock del producto.
                </div>
            </div>

            <div class="form-group">
                <label for="iva">IVA:</label>
                <input type="number" class="form-control" step="0.01" name="iva" id="iva" required>
                <div class="invalid-feedback">
                    Por favor ingresa el IVA aplicable.
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Agregar Producto</button>
        </form>
    </div>
@endsection
