<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des commandes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .navbar {
            height: 80px;
        }

        .navbar-brand {
            font-size: 2rem;
            font-weight: 700;
        }

        .collapse {
            justify-content: flex-end;
        }

        .nav-item {
            margin-right: 20px;
        }

        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <!-- Votre code de navigation ici -->
    </nav>

    <!-- Liste des commandes -->
    <div class="container mt-5">
        <h2>Liste des commandes</h2>
        <div class="row">
            @foreach($orders as $order)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Commande #{{ $order->id }}</h5>
                            <p class="card-text">Montant total: ${{ number_format($order->total_amount, 2) }}</p>
                            <p class="card-text">Adresse de livraison: {{ $order->shipping_address }}</p>
                            <p class="card-text">Statut: {{ $order->status }}</p>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">Voir la commande</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</ht
