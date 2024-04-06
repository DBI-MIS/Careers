<?php

use App\Filament\Resources\ResponseResource\Pages\CreateResponse;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Mail\EmailResponse;
use App\Models\Response;
use Illuminate\Support\Facades\Mail;

Route::get('/', HomeController::class)->name('home');


Route::get('/job', [PostController::class, 'index'])->name('posts.index');

Route::get('/job/{post:slug}', [PostController::class, 'show'])->name('posts.show');


Route::get('/counter', Counter::class);

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

Route::get('/testroute', function() {
    $response = Response::class;
    $name = 'this is the name';

    // The email sending is done using the to method on the Mail facade
    Mail::to('zhenin666@gmail.com')->send(new EmailResponse($name));
});
