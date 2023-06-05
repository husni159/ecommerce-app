<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eCommerce App</title>
    <!-- Include your CSS stylesheets and JavaScript files here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    
</head>
<body>
    
    @if(Auth::check())
        <header class="custom-header">
            <!-- Add your header content here -->
            <nav>
                <ul>
                    @if(Auth::user()->getType() === 'admin') 
                        <li><a href="{{ route('admin.dashboard') }}">Orders</a></li>
                    @endif
                    <li><a href="{{ route('products.index') }}">Products</a></li>
                    @if(Auth::user()->getType() === 'employee') 
                        <li><a href="{{ route('employee.products.create') }}">Add product</a></li>
                    @endif
                    @if(Auth::user()->getType() === 'customer') 
                        <li><a href="{{ route('cart.index') }}">Cart</a></li>
                        <li><a href="{{ route('orders.store') }}">My Orders</a></li>
                    @endif
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </header>
    @endif
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
