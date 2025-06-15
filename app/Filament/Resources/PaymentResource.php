<?php

namespace App\Filament\Resources;

use App\Models\Payment;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\PaymentResource\Pages;


class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';


    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('booking_id')
                ->relationship('booking', 'booking_id')
                ->label('Booking ID')
                ->required(),
            TextInput::make('amount')->numeric()->required(),
            TextInput::make('payment_status')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('booking.booking_id')->label('Booking ID'),
            TextColumn::make('booking.user.name')->label('Customer'),
            TextColumn::make('amount')->sortable(),
            TextColumn::make('payment_status')->label('Status')->sortable()->searchable(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
