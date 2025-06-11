@extends('layouts.app')

@section('title', $community->name)

@section('content')
    <div class="p-4 bg-light rounded-3 mb-4">
        <h1 class="display-5">{{ $community->name }}</h1>
        <p class="lead">{{ $community->description }}</p>
        <hr>
        <p>Dibuat oleh: {{ $community->creator->name }} | Total Anggota: {{ $community->members->count() }}</p>

        @if($isMember)
            <form action="{{ route('communities.leave', $community) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Keluar dari Komunitas</button>
            </form>
        @else
            <form action="{{ route('communities.join', $community) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Gabung Komunitas</button>
            </form>
        @endif
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div> @endif

    <div class="row">
        <div class="col-md-4">
            <h4>Daftar Anggota</h4>
            <ul class="list-group">
                @foreach ($community->members as $member)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $member->name }}
                        @if($member->pivot->role === 'admin')
                            <span class="badge bg-primary rounded-pill">Admin</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-8">
            <h4>Forum Diskusi</h4>
            <div class="card">
                <div class="card-body">
                    @if($isMember)
                        <form action="#" method="POST">
                            <div class="mb-3">
                                <textarea class="form-control" rows="3"
                                    placeholder="Tuliskan sesuatu untuk memulai diskusi..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" disabled>Kirim (Fitur Segera Hadir)</button>
                        </form>
                        <hr>
                        <p class="text-center text-muted">Belum ada diskusi.</p>
                    @else
                        <div class="alert alert-warning text-center">Anda harus bergabung dengan komunitas ini untuk melihat dan
                            berpartisipasi dalam diskusi.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
