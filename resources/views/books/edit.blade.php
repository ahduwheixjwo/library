<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Document</title>
</head>
<body class="bg-body-secondary">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <nav class="navbar bg-white border-bottom">
        <div class="container">
            <a href="{{route('books.index')}}" class="navbar-brand">Test</a>
            <div class="d-flex gap-3">
                <a href="{{route('books.index')}}" class="nav-link">Books</a>
                <a href="{{route('books.create')}}" class="nav-link">Create</a>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        <div class="bg-white p-4 rounded shadow-sm">
            <h1>Edit</h1>
            <p class="text-secondary">Edit book details`</p>
            <form action="/books" method="POST">
                @csrf
                <label for="name" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" value="{{old('title')}}">
                @error('title')
                    <div class="alet alert-danger">{{$message}}</div>
                @enderror
            
                <label for="author" class="form-label mt-3">Author</label>
                <input type="text" class="form-control" name="author" value="{{old('author')}}">
                @error('author')
                    <div class="alet alert-danger">{{$message}}</div>
                @enderror
                
                <label for="category" class="form-label mt-3">Category</label>
                <input type="text" class="form-control" name="category" value="{{old('category')}}">
                @error('category')
                    <div class="alet alert-danger">{{$message}}</div>
                @enderror

                <label for="quantity" class="form-label mt-3">Quantity</label>
                <input type="number" class="form-control" name="quantity" value="{{old('quantity')}}">
                @error('quantity')
                    <div class="alet alert-danger">{{$message}}</div>
                @enderror

                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>