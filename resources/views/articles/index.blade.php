<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Articles</h1>
            <a class="btn btn-primary" href="{{ route('articles.create') }}" role="button">Create new article</a>
        </div>
        <form method="GET" action="{{ route('articles.index') }}" class="mb-4">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <input type="text" name="author" placeholder="Author" class="form-control"
                        value="{{ request('author') }}">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" name="topic" placeholder="Topic" class="form-control"
                        value="{{ request('topic') }}">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" name="keyword" placeholder="Keyword" class="form-control"
                        value="{{ request('keyword') }}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <ul class="list-unstyled">
            @foreach ($articles as $article)
                <li class="media mb-4 p-3 border rounded">
                    <div class="media-body">
                        <h2 class="mt-0 mb-2">{{ $article->title }}</h2>
                        <p>{{ $article->body }}</p>
                        <p><strong>By {{ $article->user->name }}</strong></p>
                        <div class="d-flex justify-content-start">
                            <a href="{{ route('articles.edit', $article) }}" class="btn btn-success mr-2">Edit</a>
                            <form action="{{ route('articles.destroy', $article) }}" method="POST" class="mr-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <form action="{{ route('articles.deactivate', $article) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-warning">Deactivate</button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</body>

</html>
