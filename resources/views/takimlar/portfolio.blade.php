<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ürün Portfolyosu - Bir Buçuk Adana</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        rel="stylesheet"
    />
    <style>
        body {
            background-color: #0d1117;
            color: #c9d1d9;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        .navbar {
            background-color: #161b22;
        }
        .navbar-brand,
        .nav-link {
            color: #c9d1d9 !important;
        }
        .navbar-brand img {
            height: 40px;
            width: auto;
        }
        .nav-link:hover {
            color: #58a6ff !important;
            transition: color 0.3s ease;
        }
        .main-content {
            padding: 50px 15px;
            flex: 1;
        }
        .portfolio-section {
            margin-bottom: 30px;
        }
        .portfolio-section h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        .portfolio-item {
            text-align: center;
            margin-bottom: 30px;
        }
        .portfolio-item img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            margin-bottom: 10px;
        }
        .portfolio-item ul {
            list-style-type: disc;
            padding-left: 20px;
            text-align: center;
            display: block;
            margin: 0 auto;
            max-width: 200px;
        }
        footer {
            background-color: #161b22;
            padding: 10px 0;
            text-align: center;
            color: #8b949e;
            width: 100%;
            margin-top: auto;
        }
        @media (max-width: 768px) {
            .portfolio-item img {
                max-width: 100%;
                height: auto;
            }
        }
    </style>
</head>
<body>
<!-- Navbar -->
@include('layouts.tnavbar')

<!-- Main Content -->
<div class="main-content container">
    <!-- Portfolio Sections -->
    <div class="portfolio-section">
        <h3>Ürünlerimiz</h3>
        <div class="row">
            @foreach($products as $product)
                <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" />
                    <p>{{ $product->name }}</p>
                    <ul>
                        @if(!empty($product->feature1)) <li>{{ $product->feature1 }}</li> @endif
                        @if(!empty($product->feature2)) <li>{{ $product->feature2 }}</li> @endif
                        @if(!empty($product->feature3)) <li>{{ $product->feature3 }}</li> @endif
                        @if(!empty($product->feature4)) <li>{{ $product->feature4 }}</li> @endif
                        @if(!empty($product->feature5)) <li>{{ $product->feature5 }}</li> @endif
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Footer -->
@include('layouts.footer')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
