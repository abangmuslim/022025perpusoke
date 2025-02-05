@extends('layouts.app')

@section('title', 'Detail Peminjam')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail Peminjam</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Nama Peminjam</th>
                <td>{{ $peminjam->namapeminjam }}</td>
            </tr>
            <tr>
                <th>Username</th>
                <td>{{ $peminjam->username }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    @if($peminjam->status == 'pending')
                        <span class="badge badge-warning">Menunggu Persetujuan</span>
                    @elseif($peminjam->status == 'setujui')
                        <span class="badge badge-success">Disetujui</span>
                    @else
                        <span class="badge badge-danger">Ditolak</span>
                    @endif
                </td>
            </tr>
        </table>
        <a href="{{ route('peminjam.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection
