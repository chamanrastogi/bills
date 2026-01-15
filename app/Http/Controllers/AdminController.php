<?php
namespace App\Http\Controllers;

use App\Models\BillingItem;
use App\Models\Category;
use App\Models\ImagePresets;
use App\Models\Purity;
use App\Models\SiteSetting;
use App\Models\SupplierBillingItem;
use App\Models\User;
use App\Traits\ImageGenTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public $path = 'upload/user/thumbnail/';

    public $image_preset;

    public $image_preset_main;

    use ImageGenTrait;

    public function __construct()
    {
        $this->image_preset      = ImagePresets::whereIn('id', [3, 4])->get();
        $this->image_preset_main = ImagePresets::find(14);
    }

    public function AdminDashboard()
{
    $template = SiteSetting::find(1);

    /*
    |--------------------------------------------------------------------------
    | PURCHASED WEIGHT
    |--------------------------------------------------------------------------
    */
    $purchased = SupplierBillingItem::query()
        ->select(
            'category_id',
            'purity_id',
            DB::raw('SUM(total_weight) as purchased_weight')
        )
        ->groupBy('category_id', 'purity_id')
        ->get()
        ->keyBy(fn ($row) => $row->category_id.'-'.$row->purity_id);

    /*
    |--------------------------------------------------------------------------
    | SOLD WEIGHT
    |--------------------------------------------------------------------------
    */
    $sold = BillingItem::query()
        ->select(
            DB::raw('p.type_id as category_id'),
            DB::raw('p.purity_id as purity_id'),
            DB::raw('SUM(bi.quantity) as sold_weight')
        )
        ->from('billing_items as bi')
        ->join('products as p', 'bi.product_id', '=', 'p.id')
        ->groupBy('p.type_id', 'p.purity_id')
        ->get()
        ->keyBy(fn ($row) => $row->category_id.'-'.$row->purity_id);

    /*
    |--------------------------------------------------------------------------
    | MAP NAMES
    |--------------------------------------------------------------------------
    */
    $categoryMap = Category::pluck('name', 'id')->toArray();
    $purityMap   = Purity::pluck('name', 'id')->toArray();

    /*
    |--------------------------------------------------------------------------
    | BUILD STOCK SUMMARY
    |--------------------------------------------------------------------------
    */
    $stock = [];
    $summary = [];

    $keys = $purchased->keys()->merge($sold->keys())->unique();

    foreach ($keys as $key) {
        [$categoryId, $purityId] = explode('-', $key);

        // Skip invalid category (fixes N/A issue)
        if (!isset($categoryMap[$categoryId])) {
            continue;
        }

        $purchase = $purchased[$key]->purchased_weight ?? 0;
        $soldWt   = $sold[$key]->sold_weight ?? 0;
        $balance  = $purchase - $soldWt;

        $categoryName = $categoryMap[$categoryId];
        $purityName   = $purityMap[$purityId] ?? 'N/A';

        // Table rows
        $stock[] = [
            'category_name' => $categoryName,
            'purity_name'   => $purityName,
            'purchased'     => $purchase,
            'sold'          => $soldWt,
            'balance'       => $balance,
        ];

        // Summary totals
        $summary[$categoryName]['total'] =
            ($summary[$categoryName]['total'] ?? 0) + $balance;

        $summary[$categoryName]['purities'][$purityName] =
            ($summary[$categoryName]['purities'][$purityName] ?? 0) + $balance;
    }

    return view('admin.index', compact(
        'template',
        'stock',
        'summary'
    ));
}

    public function AdminLogin()
    {
        return view('admin.login');
    }

    public function AdminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = [
            'message'    => 'Admin Logout Successfully',
            'alert-type' => 'success',
        ];

        return redirect('/admin/login')->with($notification);
    }

    public function AllAdmin()
    {
        $alladmin = User::where('role', 'admin')->get();

        return view('backend.other.admin.all_admin', compact('alladmin'));
    }

    // End Method
    public function AllUsers()
    {
        $users = User::where('role', 'user')->get();

        return view('backend.other.admin.all_users', compact('users'));
    }

    // End Method
    public function AddAdmin()
    {

        return view('backend.other.admin.add_admin');
    } // End Method

    public function StoreAdmin(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'regex:/^([a-z])+?([a-z])+$/i', 'unique:' . User::class],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($request->roles == 4) {
            $role = 'user';
        } else {
            $role = 'admin';
        }
        if ($request->file('image') != null) {
            $image    = $request->file('image');
            $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
        } else {
            $save_url = '';
        }
        $user           = new User;
        $user->username = $request->username;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->photo    = $save_url;
        $user->phone    = $request->phone;
        $user->about    = $request->about;
        $user->password = Hash::make($request->password);
        $user->role     = $role;
        $user->status   = 0;
        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $notification = [
            'message'    => 'New User Inserted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.admin')->with($notification);
    }

    // End Method
    public function EditAdmin($id)
    {

        $user = User::findOrFail($id);

        return view('backend.other.admin.edit_admin', compact('user'));
    } // End Method

    public function UpdateAdmin(Request $request, $id)
    {
        $role = 'user';
        if ($request->roles == 4) {
            $role = 'user';
        } else {
            $role = 'admin';
        }

        $user = User::findOrFail($id);
        if ($request->file('image') != null) {
            if (file_exists($user->photo)) {
                $img       = explode('.', $user->photo);
                $small_img = $img[0] . '_' . $this->image_preset[0]->name . '.' . $img[1];
                unlink($small_img);
                unlink($user->photo);
            }
            $image    = $request->file('image');
            $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
        } else {
            if ($user->photo != '') {
                $save_url = $user->photo;
            } else {
                $save_url = '';
            }
        }
        $user->username = $request->username;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->phone    = $request->phone;
        $user->photo    = $save_url;
        $user->about    = $request->about;
        if (! empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->top    = ($request->top == null) ? 0 : 1;
        $user->role   = $role;
        $user->status = 0;
        $user->save();

        if ($user->id != 1) {

            $notification = [
                'message'    => 'Admin User Updated Successfully',
                'alert-type' => 'success',
            ];
        } else {
            $notification = [
                'message'    => 'You can not change superadmin role',
                'alert-type' => 'warning',
            ];

        }

        return redirect()->route('all.admin')->with($notification);
    } // End Method

    public function DeleteAdmin(Request $request)
    {

        $user = User::findOrFail($request->id);
        if (! is_null($user)) {
            $user->delete();
        }

        $notification = [
            'message'    => 'Staff Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    // End Method
    public function Ajax_Load(Request $request, User $user)
    {
        $query = User::select('id', 'photo', 'name', 'email', 'phone', 'top', 'role')->where('role', 'user')->get();

        return DataTables::of($query)
            ->setRowClass(function (User $user) {
                return 'admin-' . $user->id;
            })
            ->addColumn('image', function (User $user) {
                $img = ! empty($user->photo) || file_exists(asset($user->photo)) ? asset($user->photo) : url('upload/no_image.jpg');

                return '<img class="wd-100 rounded-circle"
                                                    src="' . $img . '"
                                                    alt="profile">';
            })

            ->addColumn('name', function (User $user) {
                return $user->name;
            })
            ->addColumn('email', function (User $user) {
                return $user->email;
            })

            ->addColumn('phone', function (User $user) {
                return $user->phone;
            })
            ->addColumn('role', function (User $user) {
                return '<span class="badge badge-pill ' . rolecheck(3) . '">' . ucfirst($user->role) . '</span>';
            })
            ->addColumn('action', function (User $user) {

                $show = route('coaches.show', $user->id);
                $x    = '<a href="' . route('edit.admin', $user->id) . '"
    class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip"
    data-placement="top" title="Edit" data-bs-original-title="Edit">
    <i data-feather="edit"></i>
</a>';

                $x .= '<a href="javascript:void(0)" onClick="deleteFunction(' . $user->id . ')"
    class="action-btn btn-edit bs-tooltip me-2 delete' . $user->id . '"
    data-toggle="tooltip" data-placement="top" title="Delete"
    data-bs-original-title="Delete">
    <i data-feather="trash-2"></i>
</a>';

                return $x;
            })

            ->rawColumns(['image', 'top', 'name', 'email', 'phone', 'role', 'action'])
            ->make(true);
    }
}
