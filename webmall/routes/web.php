<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Seller\OrderController as SellerOrderController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SubOrderController;
use App\Http\Controllers\Web\UserController;
use App\Models\Order;
use App\Models\PushSubscription;
use Illuminate\Http\Response;
use Illuminate\Http\Testing\File;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Facades\Voyager;
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\WebPush;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });





Route::redirect('/', '/home');

Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/shopping', [HomeController::class, 'index'])->name('shopping');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    // Route::get('/order/pay/{suborder}', 'SubOrderController@pay')->name('order.pay');
    Route::get('/order/pay/{suborder}', [SubOrderController::class, 'pay'])->name('order.pay');
});

//web front end user
Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {

    // main user page
    // Route::get('/', [FoodController::class, 'index']);

    // Show Register/Create Form
    Route::get('/register', [UserController::class, 'create'])->middleware('guest');

    // Create New User
    Route::post('/users', [UserController::class, 'store']);

    // Log User Out
    Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

    // Show Login Form
    Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

    // Log In User
    Route::post('/users/authenticate', [UserController::class, 'authenticate']);

    // Show n Update profile
    Route::get('/showprofile', [UserController::class, 'showprofile'])->middleware('auth');
    Route::post('/{user}/update', [UserController::class, 'update'])->middleware('auth');

    // manage orders
    Route::get('/order', [UserController::class, 'order'])->middleware('auth');

    // //show food details
    // Route::get('/foods/{food}', [FoodController::class, 'show']);
});

//send mail
Route::get('/sendmail', [MailController::class, 'sendMail'])->name('send.email');

// reservations
Route::get('/books/store', [BookController::class, 'store'])->name('books.store');
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/event', [BookController::class, 'event'])->name('books.event');
Route::get('/gift', [BookController::class, 'gift'])->name('books.gift');
// Route::apiResource('/books', '\App\Http\Controllers\BookController');

// notification
Route::get("/admin/notify", function () {
    return view('notification.notify', [
        'subscriptions' => PushSubscription::all()
    ]);
});

Route::post("admin/sendNotif/{sub}", function (PushSubscription $sub, Request $request) {

    $webPush = new WebPush([
        "VAPID" => [
            "publicKey" => "BBTwqFTkHLQDAiZjs7nsRRurjvDWjeMHA8voM4l_PACH8lPuXr_oEry6gV3uIsXyARKyyioDeFlVOeYyOkUS0NA",
            "privateKey" => "1mROAj03vF8a-sVdBbk7CbouMELAdtuxo1JKsg2QYB8",
            "subject" => "https://127.0.0.1",
            // 'pemFile' => 'path/to/pem', // if you have a PEM file and can link to it on your filesystem
            // 'pem' => 'pemFileContent', // if you have a PEM file and want to hardcode its content
        ]
    ]);

    // optional

    // $defaultOptions = [
    //     'TTL' => 300, // defaults to 4 weeks
    //     'urgency' => 'normal', // protocol defaults to "normal". (very-low, low, normal, or high)
    //     'topic' => 'newEvent', // not defined by default. Max. 32 characters from the URL or filename-safe Base64 characters sets
    //     'batchSize' => 200, // defaults to 1000
    // ];

    // // for every notifications
    // $webPush = new WebPush([], $defaultOptions);
    // $webPush->setDefaultOptions($defaultOptions);

    // // or for one notification
    // $webPush->sendOneNotification($subscription, $payload, ['TTL' => 5000]);

    // end optional

    //multiple notif
    // foreach ($notifications as $notification) {
    //     $webPush->queueNotification(
    //         $notification['subscription'],
    //         $notification['payload'] // optional (defaults null)
    //     );
    // }
    // end multiple

    $result = $webPush->sendOneNotification(
        Subscription::create(json_decode($sub->data, true)),
        // { "title":"Hi" , "body":"check this out" , "url":"/?message1"}
        // json_encode(["title" => "Hi", "body" => "check this out", "url" => "http://www.mopointofsales.com"])
        json_encode($request->input())
    );
    dd($result);
});


//shops
// Route::controller('/shops', '\App\Http\Controllers\ShopController')->middleware('auth');
Route::group(['prefix' => 'shops'], function () {
    Route::get('/', [ShopController::class, 'create'])->name('shops.create')->middleware('auth');
    Route::post('/', [ShopController::class, 'store'])->name('shops.store')->middleware('auth');
    Route::get('/{shop}', [ShopController::class, 'show'])->name('shops.show')->middleware('auth');
});


// Route::group(['prefix' => 'products'], function () {
//     Route::get('/{category_id}', [ProductController::class, 'index'])->name('products.index');
//     Route::get('/', [ProductController::class, 'create'])->name('products.create')->middleware('auth');
//     Route::post('/', [ProductController::class, 'store'])->name('products.store')->middleware('auth');
//     Route::get('/{product}', [ProductController::class, 'show'])->name('products.show')->middleware('auth');
// });
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
// Route::resource('products', 'ProductController');
Route::apiResource('/products', '\App\Http\Controllers\ProductController');


Route::get('/add-to-cart/{product}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth');
Route::get('/cart/destroy/{itemId}', [CartController::class, 'destroy'])->name('cart.destroy')->middleware('auth');
Route::get('/cart/update/{itemId}', [CartController::class, 'update'])->name('cart.update')->middleware('auth');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');
Route::get('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.coupon')->middleware('auth');

// Route::get('/cart/apply-coupon', 'CartController@applyCoupon')->name('cart.coupon')->middleware('auth');

// Route::resource('orders', 'OrderController')->middleware('auth');

// Route::apiResource('/orders', '\App\Http\Controllers\OrderController');
Route::group(['prefix' => 'orders'], function () {
    Route::put('/',  [OrderController::class, 'store'])->name('orders.store')->middleware('auth');
});




// Route::resource('shops', 'ShopController')->middleware('auth');

Route::get('/paypal/checkout/{order}', [PayPalController::class, 'getExpressCheckout'])->name('paypal.checkout')->middleware('auth');
Route::get('/paypal/checkout-success/{order}', [PayPalController::class, 'getExpressCheckoutSuccess'])->name('paypal.success')->middleware('auth');
// Route::get('/paypal/checkout-cancel/{order}', [PayPalController::class, 'cancelPage'])->name('paypal.cancel')->middleware('auth');
Route::get('/paypal/checkout-cancel', [PayPalController::class, 'cancelPage'])->name('paypal.cancel')->middleware('auth');




Route::group(['prefix' => 'seller', 'middleware' => 'auth', 'as' => 'seller.', 'namespace' => 'Seller'], function () {

    Route::redirect('/', 'seller/orders');

    // Route::resource('/orders', '\App\Http\Controllers\Seller\OrderController');
    Route::apiResource('/orders', '\App\Http\Controllers\Seller\OrderController');

    // Route::get('/orders/delivered/{order}', [SellerOrderController::class, 'markDelivered'])->name('order.delivered');
    Route::get('/orders/delivered/{suborder}',  [SellerOrderController::class, 'markDelivered'])->name('order.delivered');
});


Route::get('/test', function () {
    // $o = Order::find(30);
    // $o->generateSubOrders();
    // dd($o->items->groupBy('shop_id'));

    return view('test');
});

// Route::group(['prefix' => 'cart'], function () {
//     Route::get('/{product}', 'CartController@add')->name('cart.add')->middleware('auth');
// Route::get('set-payment-method/{name}', 'PaymentController@set_payment_method')->name('set-payment-method');
// });
