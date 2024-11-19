<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\CareerApplicationMail;
use App\Models\Blog;
use App\Models\Menu;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Models\Careerenquiry;
use App\Models\Category;
use App\Models\ContactEnquiry;
use App\Models\Portfolio;
use App\Models\Products;
use App\Models\Service;


class IndexController extends Controller
{
    // Define the number of items to paginate per page
    public $paginate = 6;

    /**
     * Constructor to initialize pagination setting from site settings
     */
    public function __construct()
    {
        // Retrieve the pagination value from the site settings and set it
        $this->paginate = SiteSetting::find(1)->paginate;
    }

    /**
     * Display the home page view
     *
     * @return \Illuminate\View\View
     */
    public function Home()
    {
        return view('welcome');
    }

    /**
     * Display the about us page view with site settings
     *
     * @return \Illuminate\View\View
     */
    public function About()
    {
        // Get the site settings and the menu item with id 1
        $template = SiteSetting::find(1);
        $m = Menu::where('id', 1)->first();
        // Return the view with the site settings
        return view('about-us', compact('template'));
    }

    /**
     * Display the services page view
     *
     * @return \Illuminate\View\View
     */
    public function Services()
    {
        return view('services');
    }

    /**
     * Display the portfolio page view with categories and portfolio items
     *
     * @return \Illuminate\View\View
     */
    public function Portfolio()
    {
        // Get active categories and portfolio items
        $categories = Category::type(0)->active(0)->get();

        $portfolio = Portfolio::active(0)->get();
        // Return the view with the categories and portfolio items
        return view('portfolio', compact('portfolio', 'categories'));
    }

    /**
     * Display the products page view
     *
     * @return \Illuminate\View\View
     */
    public function Products()
    {
        $categories = Category::type(2)->active(0)->get();

        $products = Products::active(0)->get();
        return view('products', compact('products', 'categories'));
    }

    /**
     * Display the contact us page view with site settings
     *
     * @return \Illuminate\View\View
     */
    public function Contact()
    {
        // Get the site settings and the menu item with id 4
        $template = SiteSetting::find(1);
        $m = Menu::where('id', 4)->first();
        // Return the view with the site settings
        return view('contact-us', compact('template'));
    }



    /**
     * Display the blog listing page view with pagination
     *
     * @return \Illuminate\View\View
     */
    public function Blogs()
    {
        // Get the site settings
        $template = SiteSetting::find(1);

        // Retrieve the blog posts with pagination
        $blogs = Blog::select('id', 'post_title', 'post_slug', 'post_image', 'short_descp', 'user_id', 'created_at')
            ->where('status', 0)
            ->paginate(10, ['*'], 'page');

        // Return the view with the blogs and site settings
        return view('blogs', compact('blogs', 'template'));
    }

    /**
     * Display the details of a specific blog post
     *
     * @param \Illuminate\Http\Request $request
     * @param string $blog_slug
     * @return \Illuminate\View\View
     */
    public function BlogDetails(Request $request, string $blog_slug)
    {
        // Retrieve the specific blog post by its slug
        $blog = Blog::where('post_slug', $blog_slug)->where('status', 0)->first();

        // Return the view with the blog post details
        return view('blogdetails', compact('blog'));
    }
    public function ServiceDetails(Request $request, int $id)
    {

        // Retrieve the specific blog post by its slug
        $service = Service::where('id',  $id)
            ->where('status', 0)
            ->first();
        #dd($service);
        // Return the view with the blog post details
        return view('servicedetails', compact('service'));
    }
    public function Career()
    {

        return view('career');
    }

    public function CareersubmitApplication(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'job_position' => 'required|max:100',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email|max:100',
            'phone_number' => 'required|max:15',
            'date_of_birth' => 'required|date',
            'current_employer' => 'required|max:100',
            'it_experience' => 'required',
            'educational_qualification' => 'required|max:100',
            'significant_roles' => 'required',
            'present_salary' => 'required|max:20',
            'expected_salary' => 'required',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048', // Adjust file validation as needed
        ]);

        $request->validate([
            'job_position' => 'required|max:100',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email|max:100',
            'phone_number' => 'required|max:15',
            'date_of_birth' => 'required|date',
            'current_employer' => 'required|max:100',
            'it_experience' => 'required',
            'educational_qualification' => 'required|max:100',
            'significant_roles' => 'required',
            'present_salary' => 'required|max:20',
            'expected_salary' => 'required',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('resume')) {
            $filePath = $request->file('resume')->store('resumes', 'public');
            $data['resume'] = $filePath; // Store the file path in the database
        }
        Careerenquiry::create($data);
        // Prepare the data to be sent in the email
        $data = [
            'job_position' => $request->job_position,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'date_of_birth' => $request->date_of_birth,
            'current_employer' => $request->current_employer,
            'it_experience' => $request->it_experience,
            'educational_qualification' => $request->educational_qualification,
            'significant_roles' => $request->significant_roles,
            'present_salary' => $request->present_salary,
            'expected_salary' => $request->expected_salary,
        ];



        // Get the email address from site settings
        $email = SiteSetting::value('email'); // Adjust according to your actual site settings retrieval

        // Send the application email
        #Mail::to($email)->send(new CareerApplicationMail($data));

        // Prepare a notification message
        $notification = array(
            'message' => 'Thank you for applying. We will get back to you soon.',
            'alert-type' => 'success'
        );

        // Return to a specific view with the notification
        return redirect()->back()->with($notification);
    }
    /**
     * Display the contact us page view
     *
     * @return \Illuminate\View\View
     */
    public function Contactview()
    {
        return view('contact-us');
    }

    /**
     * Handle the contact form submission
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function ContactSend(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|unique:contact_enquiries,email|max:50',
            'message' => 'required',
        ]);
        $temp=SiteSetting::select('site_title','email')->find(1);
        $subject ='Enquriy Form '.$temp->site_title;
        // Prepare the data to be sent in the email
        $data = [
            'name' => $request->name,
            'subject'=> $subject ,
            'email' => $request->email,
            'message' => $request->message
        ];


        ContactEnquiry::insert([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);


        // Send the contact email
        #Mail::to($temp->email)->send(new ContactMail($data));

        // Prepare a notification message
        $notification = array(
            'message' => 'Thank You for contacting us',
            'alert-type' => 'success'
        );

        // Return the contact us view with the notification
        return view('thankyou')->with($notification);
    }
    public function Thankyou()
    {
        return view('thankyou');
    }
}
