<?php
$startDate = '2024-01-01'; // Example start date
$endDate = '2024-12-31';   // Example end date

$results = DB::table('billing')
    ->join('payments', 'billing.customer_id', '=', 'payments.customer_id')    
    ->whereBetween('payments.created_at', [$startDate, $endDate]) // Date filter
    ->orderBy('payments.created_at', 'asc')
    ->select(
        'billing.id as billing_id', 
        'billing.grand_total', 
        'billing.updated_at as billing_updated_at',
        'billing.created_at as billing_created_at',
        'payments.id as payment_id', 
        'payments.amount', 
        'payments.payment_mode', 
        'payments.updated_at as payment_updated_at', 
        'payments.created_at as payment_created_at'
    )
    ->get();
dd($results);