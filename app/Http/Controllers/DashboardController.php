<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $categories = Category::orderBy('created_at','desc')->paginate(10);


        return view('dashboard',compact('posts',$user->posts,'categories',$categories));
    }
}
