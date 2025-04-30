<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index(){
        $posts = Post::where('status',true)->get();
        return response()->json($posts,200);
    }

    public function show($post_id){
        $post = Post::find($post_id);
        return response()->json($post,200);
    }

    public function like($post_id){
        $post = Post::find($post_id);
        $post->likes++;
        $post->save();
        return response()->json($post,200);
    }

    

    

}
