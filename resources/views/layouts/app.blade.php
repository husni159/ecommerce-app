<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eCommerce App</title>
    <!-- Include your CSS stylesheets and JavaScript files here -->
</head>
<body>
    <header>
        <!-- Add your header content here -->
        <nav>
            <ul>
                <li><a href="{{ route('products.index') }}">Products</a></li>
                <li><a href="{{ route('cart.store') }}">Cart</a></li>
                @if(Auth::check())
                    <li><a href="{{ route('orders.store') }}">My Orders</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endif
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Add your footer content here -->
    </footer>
</body>
</html>
