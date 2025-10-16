<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Slide;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{

    public function index()
    {

        $slides = Slide::where('status', 1)->get()->take(3);
        $categories = Category::orderBy('name',)->get();
        $saleProducts = Product::whereNotNull('sale_price')->where('sale_price', '<>', '')->inRandomOrder()->get()->take(8);
        $featureProducts = Product::where('featured', 1)->inRandomOrder()->get()->take(8);
        $feedbacks = Feedback::latest()->get();
        return view('index', [
            'slides' => $slides,
            'categories' => $categories,
            'saleProducts' => $saleProducts,
            'featureProducts' => $featureProducts,
            'feedbacks' => $feedbacks
        ]);
    }
    public function submitFeedback(Request $request)
    {
        // validation rules
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // প্রোফাইল ছবি আপলোড
            'comment' => 'required|string|max:1000',
        ]);

        // Image Upload

        $imageName = null;

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('uploads/feedback', $imageName, 'public');
        }


        // feedback create
        Feedback::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'profile_picture' => $imageName,
            'comment' => $request->input('comment'),
        ]);

        // Return success response in JSON format
        return response()->json([
            'status' => 'success',
            'message' => 'Your feedback has been submitted successfully!',
        ]);
    }
    public function contact()
    {
        return view('contact');
    }

    public function contact_submit(Request $request)
    {

        try {
            $data = [
                'name' => 'required|string|max:50',
                'email' => 'required|email|max:50',
                'phone' => 'required|digits:11',
                'comment' => 'required|'
            ];


            $validator = validator($request->all(), $data);

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->phone = $request->phone;
            $contact->comment = $request->comment;
            $contact->save();
            return redirect()->route('website.contact')->with('success', 'Your message sent successfully! We will contact you soon. Thank you.');
        } catch (Exception $e) {
            return redirect()->route('website.contact')->with('error', 'Something went wrong! Please try again later.');
        }
    }


    // public function search(Request $request)
    // {
    //     $query = $request->input('query');
    //     $products = Product::where('name', 'like', '%' . $query . '%')->get()->take(8);
    //     return response()->json($products);
    // }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // খালি কুয়েরি চেক করুন
        if (empty(trim($query))) {
            return response()->json([]);
        }

        // কেস-ইনসেনসিটিভ সার্চ এবং প্রয়োজনীয় ফিল্ডস সিলেক্ট করুন
        $products = Product::select('id', 'name', 'image', 'slug')
            ->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%'])
            ->limit(8)
            ->get();

        return response()->json($products);
    }

    public function about()
    {

        return view('Website.about');
    }

    public function privacy_policy()
    {

        return view('website.privacy-policy');
    }

    public function terms_and_conditions()
    {

        return view('website.terms-conditions');
    }
}
