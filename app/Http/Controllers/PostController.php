<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    
    public function index()
    {

    }

    public function create()
    {
        return view('pages.post.create');
    }
    
    public function store(Request $request)
    {
      
        // dd($request->all());
        $request->validate([
            'title'=>'required',
            'body'=>'required'
        ]);

       
        $user = auth()->user();

        $user->posts()->create([
            'title'=>$request->title,
            'body'=>$request->body
        ]);

        Session::flash('status','Post successfully created!');

        return redirect()->route('home');
    }

    public function view($id)
    {
        $post = Post::findOrFail($id);
        return view('pages.post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update([
            'title'=>$request->title,
            'body'=>$request->body
        ]);
        Session::flash('status','Post successfully updated!');
        return redirect()->route('home');

    }

    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
        Session::flash('status','Post successfully deleted!');
        return redirect()->route('home');
    }
}
