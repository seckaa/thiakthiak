<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::with('shop.owner')->take(30)->get();

        // $products = Product::with('shop.owner')->take(30)->get();


        $categories = Category::whereNull('parent_id')->get();

        // $categories = Category::with('children.children')->whereNull('parent_id')->get();

        // dd($categories);
        return view('home', ['allProducts' => $products, 'categories' => $categories]);
    }

    public function home()
    {
        // $products = Product::with('shop.owner')->take(30)->get();
        $products = Product::all()->take(6);
        return view('welcome', ['allProducts' => $products]);
        // return view('countdown');
    }


    public function contact()
    {
        return view('contact');
    }
}
