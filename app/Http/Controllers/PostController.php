<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
    	$posts = Post::all();
        return view('index', compact('posts'));
    }
    
    public function store(Request $request)
    {
    	$this->validate($request, [
            'label' => 'required',
            'content' => 'required',
            'tags' => 'required',
        ]);
    	$input = $request->all();
    	$tags = explode(",", $request->tags);
    	$post = Post::create($input);
    	$post->tag($tags);
        return back()->with('success','Post added to database.');
    }
}
