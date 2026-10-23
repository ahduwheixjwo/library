<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="bg-body-secondary">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <nav class="navbar bg-white border-bottom">
        <div class="container">
            <a href="{{route('books.index')}}" class="navbar-brand">Test</a>
            <div class="d-flex gap-3">
                <a href="{{route('login')}}" class="nav-link">Login</a>
                <a href="{{route('register')}}" class="nav-link">Register</a>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        <div class="bg-white rounded shadow-sm p-4">
            @if(session('credentials'))
                <div class="alert alert-danger">{{session('credentials')}}</div>
            @endif
            @if(session('role'))
                <div class="alert alert-danger">{{session('role')}}</div>
            @endif
            <h1>Login</h1>
            <form action="{{route('login.store')}}" method="POST">
                @csrf
                <label for="email" class="form-label mt-3">Email</label>
                <input type="text" name="email" id="email" class="form-control" value="{{old('email')}}">
                @error('email')
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                @enderror

                <label for="password" class="form-label mt-3">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                @error('password')
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                @enderror
                
                <button type="submit" class="btn btn-primary mt-3">Login</button>
                <p><a href="{{route('register')}}" class="d-block mt-2 link-opacity-75">Don't have an account ?</a></p>
            </form>
        </div>
    </div>
</body>
<script>
    // Find all alert-danger elements
    const alerts = document.querySelectorAll('.alert-danger');
    
    alerts.forEach(alert => {
        // Set a timeout for 5000 milliseconds (5 seconds)
        setTimeout(() => {
            // Add a fade-out effect using Bootstrap's fade class or simple CSS
            alert.style.transition = "opacity 1s ease";
            alert.style.opacity = "0";
            
            // Remove from DOM after fade is done
            setTimeout(() => alert.remove(), 1000);
        }, 5000);
    });
</script>
</html>