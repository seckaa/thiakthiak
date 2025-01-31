<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SignUp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {



        // Mail::to('mopointofsales@gmail.com')->send(new SignUp($name));
        // return redirect('/');


        $data = [
            'name' => 'required',
            'email' => ['required', 'email'],
            'subject' => 'required',
            'message' => 'required',
            'phone' => ['required', 'min:10', 'max:10'],
        ];

        $validate = Validator::make($request->all(), $data);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }


        $formFields = $request->validate($data);
        // dd('passed validation');
        // dd($formFields);

        $isOnline = $this->isOnline();
        if ($isOnline) {
            // return "connection ok";
            $mail_data = [
                'recipient' => 'info@pbbrasserie.com',
                // 'fromEmail' => $request->email,
                'fromEmail' => 'info@pbbrasserie.com',
                'fromName' => $request->name,
                'subject' => $request->subject,
                'body' => $request->message,
                'phone' => $request->phone,
            ];


            // dd($mail_data);

            // // to admin
            // Mail::send('mail.email-template', $mail_data, function ($message) use ($mail_data) {
            //     $message->to($mail_data['recipient'])
            //         ->from($mail_data['fromEmail'], $mail_data['fromName'])
            //         ->subject($mail_data['subject']);
            // });

            // //confirmation email to sub
            // $name = $request['name'];
            // $email = $request['email'];
            // Mail::to($email)->send(new SignUp($name));


            $name = $request['name'];
            $email = $request['email'];

            try {
                // to admin
                Mail::send('mail.email-template', $mail_data, function ($message) use ($mail_data) {
                    $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'], $mail_data['fromName'])
                        ->subject($mail_data['subject']);
                });

                //confirmation email to sub
                Mail::to($email)->send(new SignUp($name));

                //send text to sub


                //save sub to database
                $userExit = User::where('email', $email)->first();
                if (!$userExit) {
                    User::insert([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'image' => null,
                        'login_medium' => null,
                        'social_id' => null,
                    ]);
                } else {
                    // dd("user exit");
                }
            } catch (\Exception $e) {
                // return $e;
                return response()->json([
                    'status' => false,
                    'message' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('success', 'Email sent');
        } else {
            // return "no connection";
            return redirect()->back()->withInput()->with('error', 'Check your internet connection');
        }
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
