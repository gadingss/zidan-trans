@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detail Pemesanan</h2>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        <!-- Informasi Booking -->
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Informasi Booking</h5>
                </div>
                <div class="card-body">
                    <p><strong>Nama:</strong> {{ $name ?? '-' }}</p>
                    <p><strong>Alamat:</strong> {{ $address ?? '-' }}</p>
                    <p><strong>No. HP:</strong> {{ $phone ?? '-' }}</p>
                    <p><strong>Tujuan:</strong> {{ $booking->service->service_name }}</p>
                    <p><strong>Detail Tujuan:</strong> {{ $destinationDetail ?? '-' }}</p>
                    <p><strong>Kendaraan:</strong> {{ $booking->vehicle->name }}</p>
                    <p><strong>Tanggal Penjemputan:</strong> {{ $booking->pickup_date ?? '-' }}</p>
                    <p><strong>Tanggal Selesai:</strong> {{ $booking->end_date ?? '-' }}</p>
                    <p><strong>Waktu Penjemputan:</strong> {{ $booking->pickup_time ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Informasi Pembayaran -->
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Informasi Pembayaran</h5>
                </div>
                <div class="card-body">
                    <p><strong>Order ID:</strong> {{ $payment->order_id }}</p>
                    <p><strong>Total:</strong> Rp{{ number_format($payment->amount, 0, ',', '.') }}</p>
                    <p><strong>Status Pembayaran:</strong> {{ $payment->payment_status }}</p>

                    @if ($payment->payment_status === 'pending' && $snapToken)
                        <button id="pay-button" class="btn btn-primary mt-3">Bayar Sekarang</button>
                    @elseif ($payment->payment_status === 'paid')
                        <div class="alert alert-success mt-3">Pembayaran berhasil!</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Button Lihat Riwayat -->
    <div class="text-center">
        <a href="{{ route('history') }}" class="btn btn-secondary mt-4">Lihat Riwayat Pemesanan</a>
    </div>
</div>
@endsection

@if ($snapToken)
    @section('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').addEventListener('click', function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    alert("Pembayaran berhasil!");
                    location.reload();
                },
                onPending: function(result){
                    alert("Pembayaran sedang diproses.");
                },
                onError: function(result){
                    alert("Pembayaran gagal.");
                }
            });
        });
    </script>
    @endsection
@endif
