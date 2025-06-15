@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Konfirmasi Pembayaran</h3>
    <p>Total Pembayaran: Rp {{ number_format($totalPrice, 0, ',', '.') }}</p>

    <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>

    <form id="payment-form" method="post" action="{{ route('payment.callback') }}">
        @csrf
        <input type="hidden" name="json" id="json_callback">
    </form>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
    document.getElementById('pay-button').addEventListener('click', function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function (result) {
                alert('Pembayaran berhasil');
                sendResponse(result);
            },
            onPending: function (result) {
                alert('Menunggu pembayaran Anda');
                sendResponse(result);
            },
            onError: function (result) {
                alert('Pembayaran gagal');
                console.error(result);
            },
            onClose: function () {
                alert('Anda menutup halaman pembayaran tanpa menyelesaikannya');
            }
        });
    });

    function sendResponse(result) {
    console.log("Hasil Snap:", result); // Tambahkan ini
    document.getElementById('json_callback').value = JSON.stringify(result);
    document.getElementById('payment-form').submit();
    }

</script>
@endsection
