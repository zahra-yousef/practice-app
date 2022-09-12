<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::all();
        return view('blog.index',compact('post'));
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        $post = new Post;
        $post->user_id = Auth::id();
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        if($request->hasFile('image')){
            $file = $request->file('image') ;
            $extention = $file->getClientoriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/blog/',$filename);
            $post->image = $filename;
        }
        $post->status = $request->input('status') == true ? '1':'0';
        $post->save();

        return redirect()->back()->with('status','Post Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('blog.edit',compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->user_id = Auth::id();
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        if($request->hasFile('image')){
            $destination_path = 'uploads/blog/'.$post->image;
            if(File::exists($destination_path)){
                File::delete($destination_path);
            }
            $file = $request->file('image') ;
            $extention = $file->getClientoriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/blog/',$filename);
            $post->image = $filename;
        }
        $post->status = $request->input('status') == true ? '1':'0';
        $post->update();

        return redirect()->back()->with('status','Post Updated Successfully');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $destination_path = 'uploads/blog/'.$post->image;
        if(File::exists($destination_path)){
            File::delete($destination_path);
        }
        $post->delete();
        return redirect()->back()->with('status','Post Deleted Successfully');
    }
}
