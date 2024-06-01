<!-- resources/views/products/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Ajoutez le lien vers le CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">{{ $product->description }}</p>
                <p class="card-text"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                <p class="card-text"><strong>Quantity disponible:</strong> {{ $product->quantite }}</p>
                <p class="card-text"><strong>Category:</strong> {{ $product->category->name }}</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Retour à la liste</a>
                <a href="{{ route('products.index') }}" class="btn btn-success">Make a request</a>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-danger">Edit an item</a>
            </div>
        </div>

        <div class="mt-5">
            <h3>Produits similaires</h3>
            <div class="row">
                @foreach ($similarProducts as $similarProduct)
                    <div class="col-md-3">
                        <div class="card mb-4">
                            <img src="{{ $similarProduct->image_url }}" class="card-img-top" alt="{{ $similarProduct->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $similarProduct->name }}</h5>
                                <p class="card-text">{{ $similarProduct->description }}</p>
                                <p class="card-text"><strong>Price:</strong> ${{ number_format($similarProduct->price, 2) }}</p>
                                <a href="{{ route('products.show', $similarProduct->id) }}" class="btn btn-primary">Voir les détails</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
<style>
    h3 {
        text-align: center;
        margin-bottom: 30px;
    }
</style>
<!-- Ajoutez le script JS de Bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>
