<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard';

    public $totalIncome;
    public $monthlyBookings;
    public $mostRentedVehicle;

    public function mount()
    {
        $this->totalIncome = \App\Models\Payment::sum('amount');

        $this->monthlyBookings = \App\Models\Booking::whereMonth('created_at', now()->month)->count();

        $this->mostRentedVehicle = \App\Models\Vehicle::withCount('bookings')
            ->orderByDesc('bookings_count')
            ->first();
    }

}
