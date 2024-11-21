<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SmtpSetting;
use App\Models\SiteSetting;
use App\Models\ImagePresets;
use App\Traits\ImageGenTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SettingController extends Controller
{
    //
    public $path = "upload/template/thumbnail/";
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
    } // End Method
    public function UpdateSiteSetting(Request $request, $id)
    {

        $site_id = $id;

        $validated = $request->validate([
            'site_title' => 'required',
            'app_name' => 'required'
        ]);
        if ($request->file('logo')) {
            $image = $request->file('logo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image = $request->file('logo');
            $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
        } else {
            $save_url = SiteSetting::find($site_id)->logo;
        }

        if ($request->file('favicon')) {
            $image = $request->file('favicon');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image = $request->file('favicon');
            $save_url2 = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
        } else {
            $save_url2 = SiteSetting::find($site_id)->favicon;
        }


        if ($request->file('map')) {
            $image = $request->file('map');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image = $request->file('map');
            $save_url_map = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
        } else {
            $save_url_map = SiteSetting::find($site_id)->map;
        }
        SiteSetting::findOrFail($site_id)->update([
            'site_title' => $request->site_title,
            'support_phone' => $request->support_phone,
            'app_name' => $request->app_name,
            'address' => $request->address,
            'email' => $request->email,
            'tax' => $request->tax,
            'logo' => $save_url,
            'favicon' => $save_url2,
            'gst' => $request->gst,
            'bank_name' => $request->bank_name,
            'bank_account' => $request->bank_account,
            'bank_branch' => $request->bank_branch,
            'pan_no' => $request->pan_no,
            'other' => $request->other
        ]);

        $notification = array(
            'message' => 'SiteSetting Updated  Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method
	
	 public function myshow($table)
    {
        // Check if the table exists
        if (!Schema::hasTable($table)) {
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
