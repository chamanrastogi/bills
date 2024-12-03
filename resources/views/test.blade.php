<?php
$startDate = '2024-01-01'; // Example start date
$endDate = '2024-12-31';   // Example end date

$results = DB::table('billing')
    ->join('payments', 'billing.customer_id', '=', 'payments.customer_id')    
    ->whereBetween('payments.created_at', [$startDate, $endDate]) // Date filter
    ->select('billing.*', 'payments.*')
    ->get();
dd($results);