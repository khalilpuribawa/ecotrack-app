@extends('layouts.app')

@section('title', 'Edukasi & Artikel')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edukasi & Artikel Hijau</h1>
        @auth
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">Tulis Artikel Baru</a>
            @endif
        @endauth
    </div>
    <p>Temukan tips, berita, dan wawasan tentang gaya hidup ramah lingkungan.</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse ($articles as $article)
        <div class="card mb-3">
            <div class="card-body">
                <h3 class="card-title">{{ $article->title }}</h3>
                <p class="card-text text-muted">
                    Ditulis oleh {{ $article->author->name }} pada {{ $article->created_at->format('d M Y') }}
                </p>
                <p>{{ Str::limit($article->content, 200) }}</p>
                <a href="{{ route('articles.show', $article) }}" class="btn btn-outline-success">Baca Selengkapnya</a>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Belum ada artikel yang dipublikasikan.</div>
    @endforelse

    <div class="d-flex justify-content-center">
        {{ $articles->links() }}
    </div>
@endsection