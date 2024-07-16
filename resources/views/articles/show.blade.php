<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <div class="container mt-5">
        <a class="btn btn-primary mb-4" href="{{ route('articles.index') }}" role="button">Back to Articles</a>
        <div class="article-content p-4 border rounded bg-white shadow">
            <h1 class="mb-3">{{ $article->title }}</h1>
            <p class="text-muted mb-4">By {{ $article->user->name }} | Published on
                {{ $article->created_at->format('M d, Y') }}</p>
            <div class="article-body">
                <p>{{ $article->body }}</p>
            </div>
        </div>
    </div>
</body>

</html>
