<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return responseOK($post);
    }

    public function store(CreatePostRequest $request)
    {
        $data = $request->all();
        $post = Post::create($data);
        return responseOK($post);
    }

    public function update(Request $request)
    {
        return responseOK($request->all());
    }

    public function index()
    {
        $posts = Post::latest()->paginate(2);
        return responseOK($posts);
    }

    public function create()
    {

    }

    public function edit($id)
    {

    }
}
