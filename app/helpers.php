<?php

use App\Http\Middleware\Role;
use App\Models\Customer;
use App\Models\Menu;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


const MONEY = 'Rs.';
const MODE = 'Cash,Upi,Check';
const BADGE = ['success', 'secondary', 'warning', 'primary'];
const MENUTYPE = ['Page', 'Url', 'External Page', 'Category'];
const LOADER = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin ms-2">
                                        <line x1="12" y1="2" x2="12" y2="6"></line>
                                        <line x1="12" y1="18" x2="12" y2="22"></line>
                                        <line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line>
                                        <line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
                                        <line x1="2" y1="12" x2="6" y2="12"></line>
                                        <line x1="18" y1="12" x2="22" y2="12"></line>
                                        <line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line>
                                        <line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
                                    </svg>';
const LOCATION = [
  1 => 'Africa',
  2 => 'Asia',
  3 => 'Asia Pacific',
  4 => 'Caribbean',
  5 => 'Central America',
  6 => 'Europe',
  7 => 'Middle East/ North Africa',
  8 => 'North America',
  9 => 'Other',
  10 => 'South America',
];
const CATEGORY = [
  0 => 'Portfolio',
  1 => 'Service',
  2 => 'Products',
  3 => 'Category'
];
const PERMISSIONS = [
  "enquiry" => "Contact Enquiry",
  "careerenquiry" => "Career Enquiry",
  "menus" => "Menu",
  "menugroup" => "Menu Group",
  "serviecs" => "Serviecs",
  "category" => "Category",
  "portfolio" => "Portfolio",
  "product" => "product",
  "skill" => "Skill",
  "whychoose" => "Whychoose",
  "job_positions" => "Job Postions", // Corrected from duplicate
  "pages" => "Pages",
  "pagebanner" => "Page Banner",
  "module" => "Module",
  "testimonial" => "Testimonials",
  "blogcategory" => "Blog Category",
  "blog" => "Blog Post",
  "tag" => "Blog Tag",
  "admin" => "Admin",
  "image_preset" => "Image Preset",
  "smtp" => "SMTP Setting",
  "site" => "Site Setting",
  "role" => "Role & Permission"
];
const GENDER = [
  1 => 'Male',
  2 => 'Female'
];
const STYLES = [
  'main',
  'alabama',
  'imperial-blue',
  'university',
  'cerulean',
  'bronze',
  'viridian-green',
  'amaranth',
  'yellow',
  'coquelicot',
  'viridian-green',
  'dark-cyan',
  'azure',
  'blue-green',
  'crimson',
  'cerulean',
  'blueberry',
  'burnt-orange',
  'lilac',
  'amber',
  'cg-blue',
  'ball-blue',
  'american-rose',
  'alizarin',
  'dark-pink',
  'lime-green',
  'cyan-cornflower',
  'blue-munsell',
  'violet',
  'orange-pantone',
  'magenta-violet',
  'forest-green',
  'debian-red',
  'go-green',
  'rich-carmine',
  'university',
  'charcoal',
  'cadmium',
  'fuchsia',
  'green-pantone',
  'amaranth',
];
function active_class($path)
{
  $currentRoute = Route::getCurrentRoute();

  if ($currentRoute) {
    return ($currentRoute->uri == $path) ? 'active' : '';
  } else {
  }
}
function active_class_menu($path)
{
  $currentRoute = Route::getCurrentRoute();

  if ($currentRoute) {
    return ($currentRoute->uri == $path) ? 'mm-selected' : '';
  } else {
  }
}

function is_active_route($path)
{
  #dd(Route::getCurrentRoute()->uri);
  return (Str::contains(Route::getCurrentRoute()->uri, $path)) ? 'true' : 'false';
}

function show_class($path)
{
  return (Str::contains(Route::getCurrentRoute()->uri, $path)) ? 'show' : '';
}
function rolecheck($id)
{
  $i = 0;
  $result = DB::table('roles')
    ->selectRaw('ROW_NUMBER() OVER (ORDER BY id) AS rid,id')
    ->get();
  #dd($result);
  while ($i != count($result)) {
    if ($result[$i]->id == $id) {
      $re = $result[$i]->rid;
    }
    $i++;
  }
  #dd($result[0]->rid);
  $roles = ['bg-info', 'bg-danger', 'bg-warning', 'bg-info', 'bg-primary'];
  //echo $id;
  return $roles[$re];
}
function breadcrumb()
{

  if (Route::getCurrentRoute()->uri == 'admin/dashboard') {
    $url = 'Home';
  } else {
    $n = explode('/', Route::getCurrentRoute()->uri);
    //dd($n);
    if (count($n) == 2) {
      
      $url = "Show " . ucfirst(Str::headline(ucfirst($n[1])));
    } elseif (count($n) == 3 || count($n) == 5) {

      if ($n[2] == '{id}') {
        $url = ucfirst(Str::headline(ucfirst($n[1])));
      }elseif ($n[2] == '{customer}') {
        $url =  "Customer / Ledger" ;
      }  else {
        $url = ucfirst($n[2]) . " " . ucfirst(Str::headline(ucfirst($n[1])));
      }
    } else {

      if ($n[2] === 'admin') {
        $url = ucfirst($n[1]) . " " . ucfirst(Str::headline(ucfirst($n[2])));
      }elseif ($n[3] == '{customer}') {
        $url =  "Payment / Customer" ;
      } else {
        $url = ucfirst($n[3]) . " " . ucfirst(Str::headline(ucfirst($n[1])));
      }
    }
  }

  return  $url;
}

function urlgen($id)
{
  $x = Menu::select('id', 'type', 'url')->find($id);
  return  $x->url;
}

function checkarr($id, $array)
{
  return in_array($id, $array) ? 'checked' : '';
}

function pagebanner($image)
{

  echo  "<style>
   .bannerimg {
    float: left;
    width: 100%;
    height: 400px;
    background: url(" . $image . ") no-repeat center 0;
    background-size: cover;
    display: flex; /* Enables flexbox */
    justify-content: center; /* Centers horizontally */
    align-items: center; /* Centers vertically */
}
    .bannerimg h3 {
    color: white; /* Change to any color that suits the image */
    font-size: 36px; /* Adjust as needed */
    text-align: center; /* Centers the text inside the h2 */
    background: rgba(0, 0, 0, 0.5); /* Optional: Adds a semi-transparent background to make the text more readable */
    padding: 10px 20px; /* Adds some padding around the text */
    border-radius: 10px; /* Optional: Rounds the corners of the background */
}
</style>
";
}
