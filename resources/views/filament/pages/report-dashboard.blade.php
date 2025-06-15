<x-filament::page>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        {{-- Total Pendapatan --}}
        <x-filament::card>
            <h2 class="text-sm text-gray-500 mb-1">Total Pendapatan</h2>
            <p class="text-xl font-semibold">
                Rp{{ number_format($totalIncome, 0, ',', '.') }}
            </p>
        </x-filament::card>

        {{-- Total Pendapatan yang Sudah Dibayar --}}
        <x-filament::card>
            <h2 class="text-sm text-gray-500 mb-1">Pendapatan Terbayar</h2>
            <p class="text-xl font-semibold">
                Rp{{ number_format($paidIncome, 0, ',', '.') }}
            </p>
        </x-filament::card>

        {{-- Total Penyewaan Sepanjang Waktu --}}
        <x-filament::card>
            <h2 class="text-sm text-gray-500 mb-1">Total Penyewaan</h2>
            <p class="text-xl font-semibold">
                {{ $totalBookings }} penyewaan
            </p>
        </x-filament::card>

        {{-- Penyewaan Bulan Ini --}}
        <x-filament::card>
            <h2 class="text-sm text-gray-500 mb-1">Penyewaan Bulan Ini</h2>
            <p class="text-xl font-semibold">
                {{ $monthlyBookings }} penyewaan
            </p>
        </x-filament::card>

        {{-- Kendaraan Paling Sering Disewa --}}
        <x-filament::card>
            <h2 class="text-sm text-gray-500 mb-1">Kendaraan Paling Populer</h2>
            <p class="text-xl font-semibold">
                {{ $mostRentedVehicle->name ?? 'Tidak ada data' }} <br>
                <span class="text-sm text-gray-500">
                    ({{ $mostRentedVehicle->bookings_count ?? 0 }} penyewaan)
                </span>
            </p>
        </x-filament::card>
    </div>
</x-filament::page>
