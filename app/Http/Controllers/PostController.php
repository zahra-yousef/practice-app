<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::paginate(5);
        return view('pages.blog.index',compact('post')); 
    }

    public function create()
    {
        return view('pages.blog.create');
    }

    public function store(Request $request)
    {
        // Validate data
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|unique:posts',
            'description' => 'required|string',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
        ]);

        // If validation fails go back to pre page 
        if ($validator->fails()) {
            return redirect('posts/create')
                        ->withErrors($validator)
                        ->withInput();
        }

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

        return redirect('posts')->with('status','Post Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('pages.blog.edit',compact('post'));
    }

    public function update(Request $request, $id)
    {
        // Validate data
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'description' => 'required|string',
            'image' => 'mimes:jpeg,jpg,png,gif|max:10000',
        ]);

        // If validation fails go back to pre page 
        if ($validator->fails()) {
            return redirect('posts/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $post = Post::findOrFail($id);
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

        return redirect('posts')->with('status','Post Updated Successfully');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $destination_path = 'uploads/blog/'.$post->image;
        if(File::exists($destination_path)){
            File::delete($destination_path);
        }
        $post->delete();
        return redirect('posts')->with('status','Post Deleted Successfully');
    }
}
