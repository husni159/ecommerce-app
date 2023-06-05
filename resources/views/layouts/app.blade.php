<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eCommerce App</title>
    <!-- Include your CSS stylesheets and JavaScript files here -->
    <link href="{{ asset('css/menu.css') }}" rel="stylesheet">
    <link href="{{ asset('css/table.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">

</head>
<style>
    body {
        background-image: url('{{ asset("images/banner.jpg") }}');
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>

<body>
    <header style="margin-bottom: 50px;background-color:white;">
        <!-- Add your header content here -->
        <div style="margin-left:100px;">
            <img src="{{ asset('images/logo.jpg') }}" alt="Company Logo" style="width: 169px; height: 85px;">
            <h2>e-Commerce App</h2>
        </div>
        <nav>
            <ul class="menu">
                @if(Auth::check())
                @if(Auth::user()->getType() === 'admin')
                <li style="margin-left:50px;"><a href="{{ route('admin.dashboard') }}">Orders</a></li>
                @endif
                <li style="margin-left:50px;"><a href="{{ route('products.index') }}">Products</a></li>
                @if(Auth::user()->getType() === 'employee')
                <li><a href="{{ route('employee.products.create') }}">Add product</a></li>
                @endif
                @if(Auth::user()->getType() === 'customer')
                <li><a href="{{ route('cart.index') }}">Cart</a></li>
                <li><a href="{{ route('orders.store') }}">My Orders</a></li>
                @endif
                <li style="float:right;margin-right:130px;margin-top:2px;">
                    <span style="margin-right: 10px;font-size:18px;">{{ Auth::user()->email }}</span>

                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="background-color: #7ca08d;">Logout &#x1F464;</button>
                    </form>
                </li>
                @else
                <li><a href="{{ route('login') }}">Login </a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
                @endif
            </ul>
        </nav>
    </header>

    <main>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @yield('content')
    </main>


</body>

</html>