<x-filament::page>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <x-filament::card>
            <x-slot name="header">Total Pendapatan</x-slot>
            <div class="text-2xl font-bold text-success">
                Rp{{ number_format($totalIncome, 0, ',', '.') }}
            </div>
        </x-filament::card>

        <x-filament::card>
            <x-slot name="header">Penyewaan Bulan Ini</x-slot>
            <div class="text-2xl font-bold text-primary">
                {{ $monthlyBookings }} penyewaan
            </div>
        </x-filament::card>

        <x-filament::card>
            <x-slot name="header">Kendaraan Paling Populer</x-slot>
            <div class="text-xl">
                {{ $mostRentedVehicle->name ?? 'Tidak ada data' }}
                <br>
                <span class="text-sm text-gray-500">
                    ({{ $mostRentedVehicle->bookings_count ?? 0 }} penyewaan)
                </span>
            </div>
        </x-filament::card>
    </div>
</x-filament::page>
