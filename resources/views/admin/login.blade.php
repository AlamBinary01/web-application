<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Admin Login</title>
    <style>
        .card {
            border-radius: 10px;
        }
        .card-body {
            padding: 2rem;
        }
        .alert {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <section class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <a href="#!">
                                    <img src="{{asset('images/1.png')}}" alt="Logo" width="160" height="100">
                                </a>
                            </div>

                            <!-- Display Success or Error Messages -->
                            <div id="alerts">
                                @if ($errors->any())
                                    <div class="alert alert-danger mt-3">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <!-- Admin Login Form -->
                            <h2 class="fs-5 fw-bold text-center text-dark mb-4">Admin Login</h2>
                            <form id="login-form" method="POST" action="{{ url('/admin/login') }}">
                                @csrf
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg w-100">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
