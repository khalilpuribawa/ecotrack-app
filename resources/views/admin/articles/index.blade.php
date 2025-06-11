@extends('admin.layouts.app')

@section('title', 'Manajemen Artikel')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Manajemen Artikel</h1>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">Tulis Artikel Baru</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($articles as $article)
                        <tr>
                            <td>{{ $article->id }}</td>
                            <td>{{ Str::limit($article->title, 50) }}</td>
                            <td>{{ $article->author->name }}</td>
                            <td>{{ $article->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('articles.show', $article) }}" class="btn btn-sm btn-info"
                                    target="_blank">Lihat</a>
                                <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada artikel.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">{{ $articles->links() }}</div>
    </div>
@endsection