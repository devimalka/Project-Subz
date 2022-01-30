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
use Dotenv\Validator;

class PostController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(2);


        return view('Posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('Posts.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'subtitle' => 'required',
            'cover_image' => 'required',
            'torrent_file' => 'nullable',
        ]);

        $post = new Post;
        $post->title = ucwords($request->input('title'));
        $post->body = $request->input('body');
        $post->category_id = 1;
        if (!$request->input('magnet_link')) {
            $post->magnet_link = Null;
        } else {
            $post->magnet_link = $request->input('magnet_link');
        }
        $post->user_id = Auth::id();

        //cover image upload
        $post->cover_image = $request->cover_image->store('/', 'covers');


        //sub file upload

        $file = $request->file('subtitle');
        $filename = $file->getClientOriginalName();
        $post->filename = $filename;
        $post->path = $request->subtitle->store('/', 'subtitles');



        // torrent file upload
        if (!$request->torrent_file) {
            $post->torrent_file = Null;
            $post->torrent_file_path = Null;
        } else {
            $tfile = $request->torrent_file;
            $torrentfilename = $tfile->getClientOriginalName();
            $post->torrent_file = $torrentfilename;
            $post->torrent_file_path = $request->torrent_file->store('/', 'torrents');
        }



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
        $post = Post::find($id);
        return view('Posts.show', compact('post'));
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


        return view('Posts.edit', compact('categories', 'post'));
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
        if (Auth::user()->id == $post->user_id) {

            $post->delete();

            return redirect()->route('posts.index');
        } else {
            return redirect('/');
        }
    }


    public function fileDownload($id)
    {

        $post = Post::find($id);
        // return response()->download(storage_path('app/'.$post->path,$post->filename));


        // this method allso works storage::download didn't worked
        return Storage::disk('subtitles')->download($post->path, $post->filename);
    }

    public function torrentdownload($id)
    {
        $post = Post::find($id);
        return Storage::disk('torrents')->download($post->torrent_file_path, $post->torrent_file);
    }
}
