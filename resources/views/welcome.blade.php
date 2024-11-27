<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page with Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Custom styling */
        .hero-section {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-color: #f8f9fa;
        }

        .login-form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
        }
    </style>
</head>

<body>

    <!-- Navbar with Logo -->


    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>Welcome to {{ $template->site_title }}</h1>
            <p>Experience the best features and seamless login experience.</p>
            <!-- Login Form -->
            <div class="login-form">
                <h2 class="mb-4">Login</h2>


                <a href="{{ route('admin.login') }}" class="btn btn-primary w-100">Login</a>               
                {{-- {{ dd( App\models\Customer::find(1)->bills->sum('grand_total') - App\models\Customer::find(1)->payments->sum('amount')  ) }} --}}
                {{ dd( $customer = App\models\Customer::with(['bills', 'payments'])->find(1)->balance() ) }}
              </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
