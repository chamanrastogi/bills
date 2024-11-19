<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ImagePresets;
use App\Traits\ImageGenTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $path = "upload/user_images/";
    public $path_user = "upload/user_images/";
    public $image_preset;
    public $image_preset_main;
    use ImageGenTrait;
    public function __construct()
    {
        $this->image_preset = ImagePresets::whereIn('id', [2])->get();
        $this->image_preset_main = ImagePresets::find(3);
    }
    public function Index()
    {
        return view('frontend.index');
    }
    public function UserProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('frontend.dashboard_edit_profile', compact('profileData'));
    }
    public function UserProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->about = $request->about;


        if ($image = $request->file('photo')) {

            $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
            $this->imageRemove(Auth::user()->photo, $this->image_preset);
            $data->photo = $save_url;
        }
        $data->save();
        $notification = array(
            'message' =>  'User Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function UserChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('frontend.dashboard_change_profile_password', compact('profileData'));
    }
    public function UserPasswordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'

        ]);
        if (Hash::check($request->old_password, Auth::user()->password)) {
            $id = Auth::user()->id;
            $data = User::find($id);
            $data->password = Hash::make($request->new_password);
            $pp = $data->save();
            $notification = array(
                'message' =>  'User Password Updated Successfully',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' =>  'Old Password does not Matched',
                'alert-type' => 'error'
            );
        }
        return back()->with($notification);
    }
    public function UserLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = array(
            'message' =>  'User Logout Successfully',
            'alert-type' => 'success'
        );
        return redirect('/login')->with($notification);
    }

    public function AllUsers()
    {
        $users = User::where('role', 'user')->get();
        return view('backend.users.all_user', compact('users'));
    }

    public function UserDelete($id)
    {
        $user = User::find($id);
        $user->delete();
        $notification = array(
            'message' => 'User Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('admin.users')->with($notification);
    }
    public function UserAdd()
    {
        return view('backend.users.add_user');
    }
    public function UserStore(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'about' => $request->about,
            'top' => $request->top,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'status' => '1'
        ]);

        Auth::login($user);

        event(new Registered($user));

        $notification = array(
            'message' => 'New Agent Added Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.users')->with($notification);
    }
    public function UserEdit($id)
    {
        $user = User::find($id);
        return view('backend.users.edit_user', compact('user'));
    }
    public function UserUpdate(Request $request)
    {
        $agent = User::find($request->agent_id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        if ($image = $request->file('photo')) {
            // dd($request->file('photo'));
            $this->imageRemove($agent->photo, $this->image_preset);
            $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path_user);
        } else {
            $save_url = $agent->photo;
        }

        $agent->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'about' => $request->about,
            'top' =>  0,
            'password' => (empty($request->password)) ? $agent->password : Hash::make($request->password),
            'photo' => $save_url,
            'status' => $request->status,
        ]);


        $notification = array(
            'message' => 'User Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.user_edit', $request->user_id)->with($notification);
    }


}
