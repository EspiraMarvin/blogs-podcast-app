<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class PagesController extends Controller
{
    public function index()
    {

        $title = 'Welcome to this Tech Blog';

        return view('pages.index')->with('title',$title);
    }

    public function categories()
    {
        $title = 'Categories';

        $categories = Category::orderBy('created_at','desc')->get();

        return view('pages.categories',compact('title',$title,'categories',$categories));

    }

    public function about()
    {
        $title = 'About Me';

//        $categories = Category::orderBy('created_at','desc')->get();

        return view('pages.about')->with('title',$title);
//
//        return view('pages.about',compact('title',$title,'categories',$categories));
    }

    public function catlist()
    {
        $data = array(
            'title'  => 'Categories List',
            'catlists' => ['IT and This','IT and That','IT and Those']
        );
        return view('pages.catlist')->with($data);

    }
}
