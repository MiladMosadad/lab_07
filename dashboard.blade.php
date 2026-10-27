
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Book Registration and Viewing</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            IT Student Portal
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-light">
                Logout
            </button>
        </form>
    </div>
</nav>

<div class="container py-5">

    <div class="mb-4">
        <h1 class="h3">Book Registration and Viewing</h1>

        <p class="text-muted">
            Welcome, {{ auth()->user()->name }}.
        </p>

        <p>
            Register your books and manage your personal reading list.
        </p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white">
            <h2 class="h5 mb-0">Register a Book</h2>
        </div>

        <div class="card-body">
            <form
                method="POST"
                action="{{ route('books.store') }}"
            >
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">
                        Book Title
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control"
                        maxlength="150"
                        value="{{ old('title') }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">
                        Author
                    </label>

                    <input
                        type="text"
                        id="author"
                        name="author"
                        class="form-control"
                        maxlength="100"
                        value="{{ old('author') }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="pages" class="form-label">
                        Number of Pages
                    </label>

                    <input
                        type="number"
                        id="pages"
                        name="pages"
                        class="form-control"
                        min="1"
                        max="10000"
                        value="{{ old('pages') }}"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary">
                    Register Book
                </button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h2 class="h5 mb-0">My Books</h2>
        </div>

        <div class="card-body">

            @if ($books->isEmpty())
                <p class="text-muted mb-0">
                    No books registered yet.
                </p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped
                                  align-middle mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Pages</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ $book->pages }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>

</div>

</body>
</html>
