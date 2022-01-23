<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon as CarbonCarbon;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth',['except'=>['index','show']]);
    }
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();


        return view('Posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('Posts.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $post->title = ucwords($request->input('title'));
        $post->body = $request->input('body');
        $post->category_id = 1;
        $post->magnet_link= $request->input('magnet_link');
        $post->user_id = Auth::id();

        //sub file upload

        $file = $request->file('subfile');
        $filename = $file->getClientOriginalName();
        $post->filename = $filename;
        $post->path = $request->subfile->store('/','subtitles');
       


        // torrent file upload

        $tfile = $request->torrent_file;
        $torrentfilename = $tfile->getClientOriginalName();
        $post->torrent_file = $torrentfilename;
        $post->torrent_file_path = $request->torrent_file->store('/','torrents');
        

        //file save
        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Post::find($id);
        return view('Posts.show')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $post = Post::find($id);


        return view('Posts.edit',compact('categories','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(Auth::user()->id == $post->user_id){
           
            $post->delete();
    
            return redirect()->route('posts.index');
        }
        else{
            return redirect('/');
        }
       
    }


    public function fileDownload($id){

        $post = Post::find($id);
        // return response()->download(storage_path('app/'.$post->path,$post->filename));


        // this method allso works storage::download didn't worked
        return Storage::disk('subtitles')->download($post->path,$post->filename);

    }
}
