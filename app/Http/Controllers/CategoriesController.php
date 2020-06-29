<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use function foo\func;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show','about','catLists']]);
    }


    public function listCat(){
        $categories = Category::orderBy('created_at','desc')->paginate(10);

        return view('categories.listCat')->with('categories',$categories);
    }


    public function index()
    {

        $posts = Post::orderBy('created_at','desc')->paginate(10);
        $categories = Category::orderBy('created_at','desc')->paginate(10);

        return view('posts.Cat',compact('posts',$posts,'categories',$categories));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::orderBy('created_at','desc')->get();

        return view('categories.create',compact('categories',$categories));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request,[
            'category' => 'required',
        ]);

        //create Post
        $category = new Category();
        $category->category = $request->input('category');
        $category->save();

        return redirect('/categories/create')->with('success','Category Created');
    }

    public function catLists($id){

        $category = Category::find($id);

        $posts = Post::whereHas('category', function ($q) use ($id){
            $q->where('category_id', $id);
        })->paginate(10);

        return view('categories.categories_show',compact('posts',$posts,'category',$category));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view('categories.edit',compact('category',$category));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $category = Category::find($id);
        $category->category = $request->input('category');
        $category->save();

        return redirect('/listCat')->with('success','Category  Information Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function doDelete(Request $request)
    {
        $category = Category::findorFail($request->id);
        $category->delete();

        return redirect('/listCat')->with('success','Category Deleted');
    }
  /*  public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();
        return redirect('/listCat')->with('success','Category Deleted');
    }*/

}
