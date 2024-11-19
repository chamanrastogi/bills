<?php

namespace App\Pagination;

use Illuminate\Pagination\LengthAwarePaginator;

class CustomPaginator extends LengthAwarePaginator
{
    public function url($page)
    {

        return url('find-a-coach/page/' . $page); // Customize the URL format
    }
}
