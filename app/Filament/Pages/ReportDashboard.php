<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Vehicle;
use App\Filament\Widgets\ReportStats;

class ReportDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static string $view = 'filament.pages.report-dashboard';
    protected static ?string $navigationLabel = 'Laporan Bulanan';
    protected static ?string $title = 'Dashboard Laporan';



    public $totalIncome;
    public $paidIncome;
    public $totalBookings;
    public $monthlyBookings;
    public $mostRentedVehicle;

    public function mount()
    {
        // Total pendapatan semua
        $this->totalIncome = Payment::sum('amount');
        
        // Total pendapatan yang sudah dibayar
        $this->paidIncome = Payment::where('payment_status', 'settlement')
            ->sum('amount');
        
        // Total penyewaan sepanjang waktu
        $this->totalBookings = Booking::count();
        
        // Total penyewaan bulan ini
        $this->monthlyBookings = Booking::whereMonth('created_at', now()->month)
            ->count();
        
        // Kendaraan yang paling sering disewa
        $this->mostRentedVehicle = Vehicle::withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->first();
    }
}
