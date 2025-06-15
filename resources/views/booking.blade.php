@extends('layouts.guest')
@section('content')

@section('content')
<div class="booking-instruction-container" style="display: flex; justify-content: center; padding: 40px 20px; background-color: #f5f6fa;">
  <div class="booking-card" style="max-width: 900px; background-color: white; border-radius: 12px; padding: 30px 40px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); color: #1c1c1e;">
    <h2 style="font-size: 24px; font-weight: bold; text-align: center;">CARA MELAKUKAN BOOKING</h2>
    <p style="font-size: 16px; margin-bottom: 20px; text-align: center;">Ikuti langkah-langkah berikut untuk melakukan pemesanan layanan dari <strong>Zidan Transport</strong>:</p>

    @php
      $steps = [
        ['icon' => 'ri-user-line', 'judul' => '1. Isi Data Pemesan', 'isi' => ['Masukkan <strong>nama lengkap</strong> Anda', 'Tulis <strong>alamat</strong> penjemputan', 'Isi <strong>nomor HP aktif</strong>']],
        ['icon' => 'ri-map-pin-line', 'judul' => '2. Pilih Tujuan', 'isi' => ['Pilih layanan: Carter ELF, Mobil, Bandara, Wisata Religi, dll']],
        ['icon' => 'ri-road-map-line', 'judul' => '3. Isi Detail Tujuan', 'isi' => ['Contoh: Semarang – Ziarah Wali 5']],
        ['icon' => 'ri-calendar-line', 'judul' => '4. Pilih Tanggal dan Jam', 'isi' => ['Pilih tanggal penjemputan dan selesai', 'Pilih jam keberangkatan']],
        ['icon' => 'ri-car-line', 'judul' => '5. Pilih Kendaraan', 'isi' => ['Pilih kendaraan: ELF Long, Hiace, Avanza, dll']],
        ['icon' => 'ri-send-plane-line', 'judul' => '6. Kirim Pesanan', 'isi' => ['Klik tombol <strong>"Pesan Sekarang"</strong>', 'Tunggu konfirmasi dari admin']],
      ];
    @endphp

    @foreach ($steps as $step)
      <div class="step" style="display: flex; gap: 15px; align-items: flex-start; margin-bottom: 25px;">
        <i class="{{ $step['icon'] }}" style="font-size: 26px; color: #F77D0A; flex-shrink: 0;"></i>
        <div style="flex: 1;">
          <h3 style="font-size: 17px; margin-bottom: 6px; color: #2B2E4A;">{{ $step['judul'] }}</h3>
          <ul style="padding-left: 20px; list-style: disc;">
            @foreach ($step['isi'] as $item)
              <li>{!! $item !!}</li>
            @endforeach
          </ul>
        </div>
      </div>
    @endforeach

    <div class="note" style="background-color: #eef2ff; border-left: 4px solid #4f46e5; padding: 15px; margin-top: 30px; font-size: 14px;">
      <strong>Catatan Tambahan:</strong><br>
      Pastikan data Anda lengkap dan benar untuk mempercepat proses konfirmasi.<br>
      Admin Zidan Transport akan menghubungi Anda melalui WhatsApp atau telepon.
    </div>

    <a href="{{ route('booking.form') }}" class="booking-button" style="display: block; margin: 30px auto 0; background-color: #F77D0A; color: white; padding: 12px 24px; border-radius: 8px; font-size: 16px; font-weight: bold; text-align: center; text-decoration: none;">Pesan Sekarang</a>
  </div>
</div>

<!-- Remix Icon CDN -->
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
@endsection