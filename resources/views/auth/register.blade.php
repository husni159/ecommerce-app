<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<title>Login</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Arial', sans-serif;
        /* Change the font family to your desired font */
    }

    .login-container {
        max-width: 400px;
        margin: 0 auto;
        margin-top: 100px;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .login-container h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .login-container form .form-group {
        margin-bottom: 20px;
    }

    .login-container form label {
        font-weight: bold;
    }

    .login-container form button {
        width: 100%;
    }

    .login-container p {
        text-align: center;
    }

    .logo {
        text-align: center;
        margin-bottom: 30px;
    }

    .logo img {
        width: 150px;
        height: 120px;
    }
</style>
</head>

<body>


    <div class="container" style=" margin-top: 100px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="logo">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Company Logo">
                    </div>
                    <div class="card-header">
                        <h2 class="text-center font-weight-bold mb-4">Register</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <label for="user_type">User Type</label>
                                <select id="type" name="type" class="form-control" required>
                                    <option value="employee">Employee</option>
                                    <option value="customer" selected>Customer</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                        </form>
                        <p class="text-center">Already have an account? <a href="{{ route('login') }}">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>