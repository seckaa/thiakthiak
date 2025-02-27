<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Mail\ShopActivationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class ShopController extends Controller
// class ShopController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shops.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //add validation
        $request->validate([
            'name' => 'required'
        ]);

        //save db
        $shop = auth()->user()->shop()->create([
            'name'        => $request->input('name'),
            'description' => $request->input('description'),
        ]);


        //send mail to admin

        $admins = User::whereHas('role', function ($q) {
            $q->where('name', 'admin');
        })->get();

        Mail::to($admins)->send(new ShopActivationRequest($shop));

        return redirect()->route('home')->withMessage('Create shop request sent');
    }


    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        // $user = User::find($shop->user_id);
        // dd($shop);
        dd($shop->owner->name . ', welcome to your shop named: ', $shop->name);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShopRequest $request, Shop $shop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
