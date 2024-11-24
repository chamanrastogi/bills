<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;


class IndexController extends Controller
{
    // Define the number of items to paginate per page


    /**
     * Constructor to initialize pagination setting from site settings
     */

    /**
     * Display the home page view
     *
     * @return \Illuminate\View\View
     */
    public function Home()
    {
        $template= SiteSetting::find(1);
        return view('welcome',compact('template'));
    }


}
