<?php

namespace App\Http\Controllers;

use App\Mail\EmailResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMessageToEndUser;

class MailController extends Controller
{
    // public function mailform()
    // {
    // return view('mail');
    // }
    // public function maildata(Request $request)
    // {
    // $name = $request->name;
    // $email = $request->email;
    // $sub = $request->sub;
    // $mess = $request->mess;
    // $mailData = [
    // 'url' => '',
    // ];
    // $send_mail = "sahincseiu@gmail.com";
    // Mail::to($send_mail)->send(new EmailResponse($name, $email, $sub, $mess));
    // return;
    // }
}
