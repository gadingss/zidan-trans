<?php

if (!function_exists('getFriendlyStatus')) {
    function getFriendlyStatus($status)
    {
        $statusLabels = [
            'pending' => 'Menunggu Pembayaran',
            'active' => 'Aktif',
            'paid' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];

        return $statusLabels[$status] ?? ucfirst($status);
    }
}
