<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    
    {

        // $featuredPosts = Cache::remember('featuredPosts', now()->addDay(), function () {
        //     return Post::where('status', true)->where('featured',true)->latest('date_posted')->take(6)->get();
        // });
        return view('home', [
            // 'featuredPosts' => $featuredPosts,
            'featuredPosts' => Post::where('status', true)->where('featured',true)->latest('date_posted')->take(6)->get(),

        ]);
    }
}
