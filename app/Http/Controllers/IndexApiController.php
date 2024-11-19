<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class IndexApiController extends Controller
{
    //

    public function Menu()
    {
        
        try {
            $menus =Menu::select('url','title')->active(0)->get();

            // Return a success response with the updated post
            return response()->json([
                'success' => true,
                'message' => 'Post created successfully',
                'data' => $menus
            ], 200); // HTTP status code 200 for success
        } catch (\Exception $e) {
            // Return a failure response if an exception occurs
            return response()->json([
                'fail' => true,
                'message' => 'Failed to created post',
                'error' => $e->getMessage() // Include the exception message for debugging
            ], 500); // HTTP status code 500 for server error
        }

    }
}
