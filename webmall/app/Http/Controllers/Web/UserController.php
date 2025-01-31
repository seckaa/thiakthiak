<?php

namespace App\Http\Controllers\Web;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Order;
use App\Models\PushSubscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    // show all foods
    public function index()
    {
        // return view('users.index', [
        //     'foods' => Food::latest()->filter(request(['en_name', 'search']))->paginate(6)
        // ]);
    }


    // Show Register/Create Form
    public function create()
    {
        return view('users.register');
    }

    // Create New User
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'phone' => ['required', 'min:10', 'max:10', Rule::unique('users', 'phone')],
            'password' => 'required|confirmed|min:6'
        ]);

        // Create User
        try {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = bcrypt($request->password);

            // dd($user);
            $user->save();
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }

        // Login
        // $user = User::find(18);
        auth()->login($user);

        return redirect('/shopping')->with('message', 'User created and logged in');
    }

    // Logout User
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/shopping')->with('message', 'You have been logged out!');
    }

    // Show Login Form
    public function login()
    {
        return view('users.login');
    }

    // Authenticate User
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/shopping')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    public function push(Request $request, User $user)
    {

        $userId = $user->id;
        $isSubscribeUser = PushSubscription::where('user_id', $userId)->get();
        if ($isSubscribeUser->isEmpty()) {
            PushSubscription::create([
                'data' => $request->getContent(),
                'user_id' => $userId,
            ]);
        }
    }

    public function order()
    {
        $orders = Order::orderBy("id", "desc")->where('user_id', auth()->id())->paginate(5);

        return view('users.orders', compact('orders'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */


    public function showprofile()
    {
        //find user
        // $user = Auth()->user();
        // dd($user);
        return view('users.profile');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //find user
        $user = Auth()->user();
        // dd($user);

        // find in db
        $dbUser = User::find($user->id);
        // dd($dbUser);

        $request->validate([
            'name' => ['required', 'min:3'],
            'phone' => ['required', 'min:10', 'max:10'],
            // 'password' => 'required|confirmed|min:6'
        ]);

        $passfield = $request['password'];
        // dd($passfield);

        if (!is_null($passfield)) {
            // dd("is empty");
            // return;
            // } else {
            // dd("is not empty");
            $request->validate([
                'password' => 'required|confirmed|min:6'
            ]);
            // Hash Password
            $passfield = bcrypt($request['password']);

            // dd($passfield);
            $dbUser->password = $passfield;

            // dd($user);
        }
        // Update User
        try {
            // if($request->hasFile('logo')) {
            //     $formFields['logo'] = $request->file('logo')->store('logos', 'public');
            // }
            // dd($dbUser, $user);
            //update user in db
            $dbUser->name = $request->name;
            $dbUser->phone = $request->phone;

            // dd($dbUser);
            $dbUser->save();

            // dd($dbUser, $user);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
        return redirect('/user/showprofile')->with('message', 'Update was successfull');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
