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
        <div class="rounded bg-white shadow-sm p-4">     
            <h1>Books</h1>
            <p class="text-secondary">Books listing</p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Available Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                        <tr>
                            <td>{{$book->id}}</td>
                            <td>{{$book->title}}</td>
                            <td>{{$book->author}}</td>
                            <td>{{$book->category}}</td>
                            <td>{{$book->quantity}}</td>
                            <td>{{$book->available_quantity}}</td>
                            <td>
                                <a href="/books/{{$book->id}}" class="btn btn-warning">Edit</a>
                                <a href="" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>