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
                @if (Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{route('books.create')}}" class="nav-link">Create</a>
                @endif
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Logout</button>
                    </form>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        <div class="rounded bg-white shadow-sm p-4">     
            <h1>Books</h1>
            <p class="text-secondary">Books listing</p>
            <form action="{{route('books.index')}}" method="GET">
                @csrf
                <div class="input-group">
                    <input name="search" type="text" class="form-control" placeholder="Search book's title">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary">Search</button>
                        <a href="{{route('books.index')}}" class="btn btn-outline-secondary">Clear</a>
                    </div>
                </div>
            </form>
            <div class="table-responsive mt-3">
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
                            <td class="d-flex gap-3">
                                @if (Auth::check() && Auth::user()->role === 'admin')
                                    <a href="{{route('books.edit', $book->id)}}" class="btn btn-warning">Edit</a>
                                    <form action="{{route('books.destroy', $book->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                @else
                                    <form action="{{route('books.borrow', $book->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        @if ($book->available_quantity === 0)
                                            <button type="submit" class="btn btn-primary btn-sm disabled">Borrow</button>
                                        @else
                                            <button type="submit" class="btn btn-primary btn-sm">Borrow</button>
                                        @endif
                                    </form>
                                @endif
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