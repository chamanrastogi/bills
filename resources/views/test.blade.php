<?php
use Illuminate\Support\Facades\Schema;

$columns = Schema::getColumnListing('billing');

dd($columns);
