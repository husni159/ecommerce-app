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
                @if(Auth::check())
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
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
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

    <footer>
        <!-- Add your footer content here -->
    </footer>
</body>
</html>
