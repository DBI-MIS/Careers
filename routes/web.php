<?php

use App\Filament\Resources\ResponseResource\Pages\CreateResponse;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ResponseController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Livewire\CreateResponse as LivewireCreateResponse;
use App\Mail\EmailResponse;
use App\Models\Response;
use Illuminate\Support\Facades\Mail;
use MailerSend\Endpoints\Email;

Route::get('/', HomeController::class)->name('home');


Route::get('/job', [PostController::class, 'index'])->name('posts.index');

Route::get('/job/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::post('/job/{post:slug}/', [MailController::class, 'maildata'])->name('send_mail');

Route::get('/test_view', [ResponseController::class, 'test_view']);

Route::post('/post_job', [ResponseController::class, 'post_job']);

// Route::get('/create-application', [ResponseController::class, 'show'])->name('application');
// // Route::get('/job/create', CreateResponse::class);


// Route::get('/counter', Counter::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])
->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
});

// Route::get('/testroute', function() {
//     $response = Response::class;
//     $name = "this is the name";
//     $filePath = public_path('favicon.ico');
//     $post_title = 'this';
//     $date_response = 'this';
//     $full_name = 'this';    
//     $contact = 'this';
//     $email_address = 'this';
//     $attachment = 'this';

//     // The email sending is done using the to method on the Mail facade
//     // Mail::to('zhenin666@gmail.com')->send(new EmailResponse($name));
//     // Mail::to('zhenjin666@gmail.com')->send(new EmailResponse());
//     Mail::to('zhenjin666@gmail.com')->send(new EmailResponse($post_title, $date_response, $full_name, $contact, $email_address, $attachment));
// });
