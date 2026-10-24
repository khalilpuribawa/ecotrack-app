@extends('admin.layouts.app')

@section('title', 'Article Management')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Article Management</h1>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-success rounded-pill px-4">
            <i class="fas fa-plus me-1"></i>Write New Article
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($articles as $article)
                            <tr>
                                <td><strong>#{{ $article->id }}</strong></td>
                                <td class="fw-semibold">{{ Str::limit($article->title, 50) }}</td>
                                <td>{{ $article->author->name }}</td>
                                <td>{{ $article->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('articles.show', $article) }}" class="btn btn-sm btn-outline-info rounded-pill px-3 me-1"
                                        target="_blank">
                                        <i class="fas fa-eye me-1"></i>View
                                    </a>
                                    <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3 me-1">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this article?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                            <i class="fas fa-trash me-1"></i>Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">No articles found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($articles->hasPages())
        <div class="card-footer bg-white border-0">{{ $articles->links() }}</div>
        @endif
    </div>
@endsection
