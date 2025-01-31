<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignUp;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.book',);
    }

    public function event()
    {
        dd("events");
    }

    public function gift()
    {
        dd("gift");
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    // StoreBookRequest $request
    {




        $isOnline = $this->isOnline();

        if ($isOnline) {

            $request->validate([
                'name' => 'required',
                'email' => ['required', 'email'],
                'phone' => ['required', 'min:10', 'max:10'],
                'date' => 'required',
                'time' => 'required',
                'guest' => 'required',
                'note' => 'required',
            ]);

            $data = [
                // 'user_id' => 13,
                // 'user_id' => auth()->id(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'date' => $request->date,
                'time' => $request->time,
                'guest' => $request->guest,
                'note' => $request->note,
            ];

            // dd($data);
            //find a resrvation in db
            $dbBook = Book::where('email', $request->email)->first();
            // dd($dbBook);
            if ($dbBook) {
                $dbBook->time = $request->time;
                $dbBook->guest = $request->guest;
                $dbBook->note = $request->note;

                // dd($dbBook);
                $dbBook->save();
            } else {

                $book = Book::create($data);
                // dd($book);
            }

            // dd($dbBook);

            // return "connection ok";
            //send email
            $mail_data = [
                'recipient' => 'mopointofsales@gmail.com',
                'fromEmail' => $request->email,
                'fromName' => $request->name,
                'subject' => 'Booked a table',
                'body' => json_decode(json_encode($data)),
                // 'body' => $data,
                'phone' => $request->phone,
            ];

            // dd($mail_data);

            // to admin
            Mail::send('mail.email-template', $mail_data, function ($message) use ($mail_data) {
                $message->to($mail_data['recipient'])
                    ->from($mail_data['fromEmail'], $mail_data['fromName'])
                    ->subject($mail_data['subject']);
            });

            //confirmation email to sub
            $email = $request->email;
            $name = $request->name;
            Mail::to($email)->send(new SignUp($name));

            //save  user to database
            $userExit = User::where('email', $request->email)->first();
            if (!$userExit) {
                try {
                    User::insert([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'avatar' => null,
                        'password' => bcrypt($request->phone),
                    ]);
                } catch (\Throwable $th) {
                    return response()->json([
                        'status' => false,
                        'message' => $th->getMessage()
                    ], 500);
                }
            } else {
                // dd("user exit");
            }

            return redirect()->back()->with('success', 'Email sent');
        } else {
            // return "no connection";
            return redirect()->back()->withInput()->with('error', 'Check your internet connection');
        }
        // return redirect("/menu");
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        // dd('test');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }

    public  function isOnline($site = "https://youtube.com")
    {
        if (@fopen($site, "r")) {
            return true;
        } else {
            return false;
        }
    }
}
