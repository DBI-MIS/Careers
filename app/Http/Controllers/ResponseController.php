<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ResponseController extends Controller
{
    // public function index() {
    //     $posts = Post::all('title')->last();
    //     $post = $posts->last();
    //     return view('posts.create-response');
    // }

    public function show(Post $post)
    {
        return view(
            'posts.create-response',
            [
                'post' => $post,
                'post_title' => $post->title,
                
            ]
        );
    }

    // public function index()
    // {
    //     $email = 'test@gmail.com';
    //     $subject = 'This is the subject';
    //     $body = '<h1>This is the body of the email...</h1>';

    //     # EXAMPLE 3) Send the HTML email using a View
    //     $body = view('demo')->render();
    //     Mail::html($body, function ($message) use ($email, $subject) {
    //         $message->to($email)
    //                 ->subject($subject . ' html from a View');
    //     });
    // }

    public function test_view()
    {
            return view('mail.mail');
    }

    public function post_job(Request $request)
    {
        return $request->all();
    }
}
