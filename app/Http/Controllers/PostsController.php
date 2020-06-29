<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;

class PostsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show','about','showLoop']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::orderBy('created_at','desc')->get();
        $posts = Post::orderBy('created_at','desc')->paginate(10);

        return view('posts.index',compact('posts',$posts,'categories',$categories));
    }


    public function showLoop()
    {
        $categories = Category::orderBy('created_at','desc')->get();
        $posts = Post::orderBy('created_at','desc')->paginate(10);

        return view('dashboard',compact('categories',$categories,'posts',$posts));
    }

    public function showLoopp()
    {
        $categories = Category::orderBy('created_at','desc')->get();
        $posts = Post::orderBy('created_at','desc')->paginate(10);

        return view('inc.navbar',compact('categories',$categories,'posts',$posts));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('posts.create',compact('categories',$categories));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {

//        dd($post);

        $this->validate($request,[
            'category_id' => 'required',
            'title' => 'required',
            'body' => 'required',
            'podcast' => 'nullable|audio|mimes:mpeg,mpga,mp3,wav,ogv|max:2000000',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1999'
        ]);

            // handle audio upload
            if($request->hasFile('audio')){
                $filenameWithExt=$request->file('audio')->getClientOriginalName();
                $size=$request->file('audio')->getSize();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('audio')->getClientOriginalExtension();
                $audioNameToStore = $filename.'_'.time().'.'.$extension;
                $path = $request->file('audio')->storeAs('public/audio_files',$audioNameToStore);
            }else{
                $audioNameToStore = '';
            }

                //handle file upload
        if($request->hasFile('cover_image')){
            //get filename with the extension
            $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
            //get filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //filename to store , gets original filename with the timestamp so it becomes unique when someone uploads file with same filename with another file
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }else{
//            $fileNameToStore = '';
            $fileNameToStore = 'noimage.jpg';
        }
        //create Post
        $post = new Post;
        $post->category_id = $request->input('category_id');
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->audio= $audioNameToStore;
        $post->cover_image= $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success','Post Created');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::all();
        $post = Post::find($id);
        return view('posts.show',compact('post',$post,'categories',$categories));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();

        //check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','Unauthorised Page!');
        }

        return view('posts.edit',compact('post',$post,'categories',$categories));
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
       $this->validate($request,[

             'podcast' => 'nullable|audio|mimes:mpeg,mpga,mp3,wav,ogv|max:2000000',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1999'
        ]);


        if($request->hasFile('audio')){
            $filenameWithExt=$request->file('audio')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('audio')->getClientOriginalExtension();
            $audioNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('audio')->storeAs('public/audio_files',$audioNameToStore);
        }

        if($request->hasFile('cover_image')){
            //get filename with the extension
            $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //filename to store , gets original filename with the timestamp so it becomes unique when someone uploads file with same filename with another file
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }
        //find Post
        $post = Post::find($id);
        $post->category_id = $request->input('category_id');
        $post->title = $request->input('title');
        $post->body = $request->input('body');

        if ($request->hasFile('audio')){
            $post->audio = $audioNameToStore;
        }
        if($request->hasFile('cover_image')) {
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function doDelete(Request $request)
    {
        //find post
        $post = Post::findorFail($request->id);

        //check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','Unauthorised Page!');
        }

        //deleting image from the public/cover_images folder after deleting from the view
        if ($post->cover_image != 'noimage.jpg'){
            //delete image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        // deleting audio from public/audio_files folder after deleting the post
        if ($post->audio != ""){
            Storage::delete('public/audio_files/'.$post->audio);
        }

        $post->delete();
        return redirect('/dashboard')->with('success','Post Deleted');
    }
/*
 *  public function destroy($id)
    {
        //find post
        $post = Post::find($id);

        //check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','Unauthorised Page!');
        }

        //deleting image from the public/cover_images folder after deleting from the view
        if ($post->cover_image != 'noimage.jpg'){
            //delete image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        // deleting audio from public/audio_files folder after deleting the post
        if ($post->audio != ""){
            Storage::delete('public/audio_files/'.$post->audio);
        }

        $post->delete();
        return redirect('/dashboard')->with('success','Post Deleted');
    }*/


}
