@extends('layouts.app')

@section('content')
<div class="flex justify-center mt-10">
    <div class="w-full max-w-xl bg-indigo-900 text-white p-8 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Form Booking Carter ELF / Mobil</h2>

        @if (session('success'))
            <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white px-4 py-2 rounded mb-4">
                <strong>Terjadi kesalahan:</strong>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('booking.store') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block font-semibold mb-1">Nama</label>
                <input type="text" name="name" id="name" class="w-full rounded-lg bg-orange-500 text-white px-4 py-2 placeholder-white placeholder-opacity-70 focus:outline-none" placeholder="Nama" value="{{ old('name') }}" required>
            </div>

            <div>
                <label for="address" class="block font-semibold mb-1">Alamat</label>
                <textarea name="address" id="address" rows="3" class="w-full rounded-lg bg-orange-500 text-white px-4 py-2 placeholder-white placeholder-opacity-70 focus:outline-none" placeholder="Alamat" required>{{ old('address') }}</textarea>
            </div>

            <div>
                <label for="phone" class="block font-semibold mb-1">Nomor HP</label>
                <input type="text" name="phone" id="phone" class="w-full rounded-lg bg-orange-500 text-white px-4 py-2 placeholder-white placeholder-opacity-70 focus:outline-none" placeholder="No. HP" value="{{ old('phone') }}">
            </div>

            <div>
                <label for="service_id" class="block font-semibold mb-1">Pilih Tujuan</label>
                <select name="service_id" id="service_id" class="w-full rounded-lg bg-orange-500 text-white px-4 py-2 focus:outline-none" required>
                    <option value="">-- Pilih --</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->service_id }}" {{ old('service_id') == $service->service_id ? 'selected' : '' }}>
                            {{ $service->service_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="destination_detail" class="block font-semibold mb-1">Detail Tujuan</label>
                <textarea name="destination_detail" id="destination_detail" rows="3" class="w-full rounded-lg bg-orange-500 text-white px-4 py-2 placeholder-white placeholder-opacity-70 focus:outline-none" placeholder="Pilih Kota">{{ old('destination_detail') }}</textarea>
            </div>

            <div>
                <label for="pickup_date" class="block font-semibold mb-1">Tanggal Penjemputan</label>
                <input type="date" name="pickup_date" id="pickup_date" class="w-full rounded-lg bg-orange-500 text-white px-4 py-2 focus:outline-none" value="{{ old('pickup_date') }}" required>
            </div>

            <div>
                <label for="end_date" class="block font-semibold mb-1">Tanggal Selesai</label>
                <input type="date" name="end_date" id="end_date" class="w-full rounded-lg bg-orange-500 text-white px-4 py-2 focus:outline-none" value="{{ old('end_date') }}" required>
            </div>

            <div>
                <label for="pickup_time" class="block font-semibold mb-1">Jam Penjemputan</label>
                <input type="time" name="pickup_time" id="pickup_time" class="w-full rounded-lg bg-orange-500 text-white px-4 py-2 focus:outline-none" value="{{ old('pickup_time') }}" required>
            </div>

            <div>
                <label for="vehicle_id" class="block font-semibold mb-1">Pilih Kendaraan</label>
                <select name="vehicle_id" id="vehicle_id" class="w-full rounded-lg bg-orange-500 text-white px-4 py-2 focus:outline-none" required>
                    <option value="">-- Pilih --</option>
                    {{-- Diisi oleh AJAX --}}
                </select>
            </div>

  {{-- 
          <div>
                <label for="package_id" class="block font-semibold mb-1">Pilih Paket</label>
                <select name="package_id" id="package_id" class="w-full rounded-lg bg-orange-500 text-white px-4 py-2 focus:outline-none" required>
                    <option value="">-- Pilih Paket --</option>
                    @foreach ($packages as $package)
                        <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
                            {{ $package->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-1">Pembayaran</label>
                <div class="flex gap-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="payment_status" value="lunas" class="form-radio text-orange-500" {{ old('payment_status') == 'lunas' ? 'checked' : '' }}>
                        <span class="ml-2">Lunas</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="payment_status" value="dp" class="form-radio text-orange-500" {{ old('payment_status') == 'dp' ? 'checked' : '' }}>
                        <span class="ml-2">DP</span>
                    </label>
                </div>
            </div>--}}

            <div>
                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg">
                    Pesan Sekarang
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    function fetchAvailableVehicles() {
        const pickup_date = $('#pickup_date').val();
        const end_date = $('#end_date').val();

        if (pickup_date && end_date) {
            $.ajax({
                url: "{{ route('vehicles.availability') }}",
                type: 'GET',
                data: { pickup_date, end_date },
                success: function(data) {
                    const $vehicleSelect = $('#vehicle_id');
                    $vehicleSelect.empty().append('<option value="">-- Pilih --</option>');

                    $.each(data, function(_, vehicle) {
                        const option = $('<option></option>').val(vehicle.id).text(vehicle.name);
                        if (!vehicle.is_available) option.attr('disabled', true).text(vehicle.name + ' (Tidak tersedia)');
                        if (vehicle.id == "{{ old('vehicle_id') }}") option.prop('selected', true);
                        $vehicleSelect.append(option);
                    });
                },
                error: function(xhr) {
                    alert('Gagal mengambil kendaraan: ' + (xhr.responseJSON?.error || 'Terjadi kesalahan.'));
                }
            });
        }
    }

    $('#pickup_date, #end_date').on('change', fetchAvailableVehicles);

    if ($('#pickup_date').val() && $('#end_date').val()) {
        fetchAvailableVehicles();
    }
});
</script>
@endsection