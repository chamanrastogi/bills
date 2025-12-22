<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ImagePresets;
use App\Models\SiteSetting;
use App\Traits\ImageGenTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SettingController extends Controller
{
    //
    public $path = 'upload/template/thumbnail/';

    public $image_preset;

    public $image_preset_main;

    use ImageGenTrait;

    public function __construct()
    {
        $this->image_preset = ImagePresets::whereIn('id', [1])->get();
        $this->image_preset_main = ImagePresets::find(14);
    }

    public function SiteSetting()
    {

        $sitesetting = SiteSetting::find(1);

        return view('backend.setting.site_update', compact('sitesetting'));
    }

    // End Method
    public function UpdateSiteSetting(Request $request, $id)
    {
        $site = SiteSetting::findOrFail($id);

        // Validate
        $validated = $request->validate([
            'site_title' => 'required|string|max:255',
            'app_name' => 'required|string|max:255',

            'email' => 'nullable|email|max:100',
            'support_phone' => 'nullable|string|max:50',

            'tax' => 'nullable|numeric|min:0|max:50',

            'gst' => 'nullable|string|max:255',
            'address' => 'nullable|string',

            // Bank info
            'bank_name' => 'nullable|string|max:150',
            'bank_holder_name' => 'nullable|string|max:150',
            'bank_ifsc' => 'nullable|string|max:50',
            'bank_account' => 'nullable|string|max:100',
            'bank_branch' => 'nullable|string|max:150',
            'pan_no' => 'nullable|string|max:50',

            // Declaration & message
            'declaration' => 'required|string',
            'message' => 'required|string|max:255',

            // Upload validations
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png,webp,ico|max:2048',
            'bank_qr_code' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Handle image uploads with fallback
        $save_logo = $request->file('logo')
            ? $this->imageGenrator($request->file('logo'), $this->image_preset_main, $this->image_preset, $this->path)
            : $site->logo;

        $save_favicon = $request->file('favicon')
            ? $this->imageGenrator($request->file('favicon'), $this->image_preset_main, $this->image_preset, $this->path)
            : $site->favicon;

        $save_bank_qr = $request->file('bank_qr_code')
            ? $this->imageGenrator($request->file('bank_qr_code'), $this->image_preset_main, $this->image_preset, $this->path)
            : $site->bank_qr_code;

        // Update database
        $site->update([
            'site_title' => $request->site_title,
            'support_phone' => $request->support_phone,
            'app_name' => $request->app_name,
            'address' => $request->address,
            'email' => $request->email,
            'tax' => $request->tax,
            'logo' => $save_logo,
            'favicon' => $save_favicon,
            'gst' => $request->gst,
            'bank_name' => $request->bank_name,
            'bank_account' => $request->bank_account,
            'bank_ifsc' => $request->bank_ifsc,
            'bank_holder_name' => $request->bank_holder_name,
            'bank_branch' => $request->bank_branch,
            'pan_no' => $request->pan_no,
            'declaration' => $request->declaration,
            'message' => $request->message,
            'bank_qr_code' => $save_bank_qr,
        ]);

        return redirect()->back()->with([
            'message' => 'SiteSetting Updated Successfully',
            'alert-type' => 'success',
        ]);
    } // End Method

    public function myshow($table)
    {
        // Check if the table exists
        if (! Schema::hasTable($table)) {
            return response()->json(['error' => 'Table does not exist'], 404);
        }

        // Get the column names of the table
        $columns = DB::getSchemaBuilder()->getColumnListing($table);

        // Get detailed column data
        $tableStructure = [];

        foreach ($columns as $column) {
            // Check if the column is nullable
            $nullable = Schema::getConnection()->getDoctrineColumn($table, $column)->getNotnull() ? false : true;

            $tableStructure[] = [
                'column' => $column,
                'nullable' => $nullable,
            ];
        }

        return response()->json($tableStructure);
    }
}
