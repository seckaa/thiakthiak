<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreProductRequest;
// use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function index()
    {
        $categoryId = request('category_id');
        $categoryName = null;

        if ($categoryId) {
            $category = Category::find($categoryId);
            $categoryName = ucfirst($category->name);

            // $products = $category->products;
            $products = $category->allProducts();
            // $products = $category->children;

        } else {
            $products = Product::take(30)->get();
        }
        $categories = Category::whereNull('parent_id')->get();

        // dd($products);
        // return view('product.index', compact('products', 'categoryName'));
        return view('product.index', ['products' => $products, 'categoryName' => $categoryName, 'categories' => $categories]);
    }

    public function search(Request $request)
    {

        $query = $request->input('query');


        $products = Product::where('name', 'LIKE', "%$query%")->paginate(25);
        // $categories = Category::whereNull('parent_id')->get();
        // dd($products);
        // return view('product.catalog', compact('products', 'categories'));
        return view('product.catalog', compact('products'));
    }

    public function show(Product $product)
    {

        return view('product.show', compact('product'));
    }

    // /**
    //  * Display a listing of the resource.
    //  */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(StoreProductRequest $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Product $product)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Product $product)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(UpdateProductRequest $request, Product $product)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Product $product)
    // {
    //     //
    // }
}
