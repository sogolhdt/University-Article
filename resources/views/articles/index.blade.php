<div class="container">
    <h1>Articles</h1>
    <a class="btn btn-primary" href="{{ route('articles.create') }}" role="button">Create new article</a>
    <form method="GET" action="{{ route('articles.index') }}">
        <div class="form-group">
            <input type="text" name="author" placeholder="Author" class="form-control" value="{{ request('author') }}">
        </div>
        <div class="form-group">
            <input type="text" name="topic" placeholder="Topic" class="form-control"
                value="{{ request('topic') }}">
        </div>
        <div class="form-group">
            <input type="text" name="keyword" placeholder="Keyword" class="form-control"
                value="{{ request('keyword') }}">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <ul>
        @foreach ($articles as $article)
            <li>
                <h2>{{ $article->title }}</h2>
                <p>{{ $article->body }}</p>
                <p>By {{ $article->user->name }}</p>
            </li>
        @endforeach
    </ul>
</div>
