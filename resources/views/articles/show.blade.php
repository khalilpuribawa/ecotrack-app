@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <div class="col-lg-10 mx-auto">
        <h1>{{ $article->title }}</h1>
        <p class="text-muted">
            Oleh: {{ $article->author->name }} | Dipublikasikan pada: {{ $article->created_at->format('d F Y') }}
        </p>
        <hr>

        @if($article->type === 'video' && $article->url_media)
            <div class="ratio ratio-16x9 mb-4">
                <iframe src="{{ str_replace('watch?v=', 'embed/', $article->url_media) }}" title="YouTube video"
                    allowfullscreen></iframe>
            </div>
        @elseif($article->type === 'infographic' && $article->url_media)
            <img src="{{ $article->url_media }}" class="img-fluid rounded mb-4" alt="Infografis {{ $article->title }}">
        @endif

        <div class="fs-5 article-content">
            {!! nl2br(e($article->content)) !!}
        </div>

        <a href="{{ route('articles.index') }}" class="btn btn-secondary mt-4">Kembali ke Daftar Artikel</a>
    </div>
@endsection