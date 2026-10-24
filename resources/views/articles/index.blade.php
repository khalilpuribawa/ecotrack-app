@extends('layouts.app')

@section('title', 'Education & Articles - EcoTrack.ID')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>🌱 Green Education & Articles</h1>
        @auth
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">Write New Article</a>
            @endif
        @endauth
    </div>
    <p class="text-muted">Discover practical tips, environmental insights, and news on sustainable living.</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse ($articles as $article)
        <div class="card mb-3 shadow-sm border-0">
            <div class="card-body p-4">
                <h3 class="card-title fw-bold">{{ $article->title }}</h3>
                <p class="card-text text-muted small">
                    Written by {{ $article->author->name }} on {{ $article->created_at->format('M d, Y') }}
                </p>
                <p>{{ Str::limit($article->content, 200) }}</p>
                <a href="{{ route('articles.show', $article) }}" class="btn btn-outline-success">Read Full Article →</a>
            </div>
        </div>
    @empty
        <div class="alert alert-info">No educational articles have been published yet.</div>
    @endforelse

    <div class="d-flex justify-content-center">
        {{ $articles->links() }}
    </div>
@endsection