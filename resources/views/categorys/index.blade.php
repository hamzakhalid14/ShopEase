<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .category-card {
            background-size: cover;
            background-position: center;
            height: 200px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
        }
        .category-card a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
<section id="categories" class="categories">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Categories</h2>
        <div class="row">
            @foreach($categories as $category)
            <div class="col-md-4 mb-4">
                <div class="card category-card" style="background-image: url('{{ $category->image_url }}');">
                    <div class="card-body text-center">
                        <a href="{{route('categories.show',['category' =>$category['id']])}}">{{ $category->name }}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
