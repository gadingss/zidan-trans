@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Riwayat Pemesanan</h2>

    @if ($bookings->isEmpty())
        <div class="alert alert-warning">Tidak ada riwayat pemesanan.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Tujuan</th>
                        <th>Kendaraan</th>
                        <th>Tanggal Penjemputan</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ $booking->service->service_name }}</td>
                            <td>{{ $booking->vehicle->name }}</td>
                            <td>{{ $booking->pickup_date }}</td>
                            <td>{{ getFriendlyStatus($booking->status) }}</td>
                            <td>
                                <a href="{{ route('booking.show', $booking->booking_id) }}" class="btn btn-info btn-sm">Lihat</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
