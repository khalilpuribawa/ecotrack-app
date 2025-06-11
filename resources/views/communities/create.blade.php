@extends('layouts.app')

@section('title', 'Buat Komunitas Baru')

@section('content')
    <h1>Buat Komunitas Baru</h1>
    <p>Ajak teman-temanmu dan mulailah beraksi bersama!</p>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('communities.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Komunitas</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi Singkat</label>
                    <textarea name="description" id="description" rows="5" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Buat Komunitas</button>
            </form>
        </div>
    </div>
@endsection