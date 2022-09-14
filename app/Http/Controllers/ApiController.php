<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ApiController extends Controller
{
    public function createEmp(Request $request){
        $employee = new Employee;
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->designation = $request->input('designation');
        $employee->save();
        return response()->json($employee);
    }

    public function showEmp(){
        $employee = Employee::all();     
        return response()->json($employee);
    }
    
    public function showEmpById($id){
        $employee = Employee::find($id);     
        return response()->json($employee);
    }

    public function updateEmp(Request $request, $id){
        $employee = Employee::find($id);
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->designation = $request->input('designation');
        $employee->status = $request->input('status') == true ? '1':'0';
        $employee->update();  
        return response()->json($request);
    }

    public function destroyEmp($id){
        $employee = Employee::find($id);
        $employee->delete();
        return response()->json($employee);
    }

    public function createPost(Request $request){
        $post = new Post;
        $post->user_id = 1;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        if($request->hasFile('image')){
            $file = $request->file('image') ;
            $extention = $file->getClientoriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/blog/',$filename);
            $post->image = $filename;
        }
        $post->status = $request->input('status');
        $post->save();
        return response()->json($post);
    }

    public function showPost(){
        $post = Post::all();     
        return response()->json($post);
    }
    
    public function showPostById($id){
        $post = Post::find($id);     
        return response()->json($post);
    }

    public function updatePost(Request $request, $id){
        $post = Post::find($id);
        $post->user_id = 2; //Auth::id();
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        // if($request->hasFile('image')){
        //     $destination_path = 'uploads/blog/'.$post->image;
        //     if(File::exists($destination_path)){
        //         File::delete($destination_path);
        //     }
        //     $file = $request->file('image') ;
        //     $extention = $file->getClientoriginalExtension();
        //     $filename = time().'.'.$extention;
        //     $file->move('uploads/blog/',$filename);
        //     $post->image = $filename;
        // }
        $post->status = $request->input('status') == true ? '1':'0';
        $post->update();
        return response()->json($request);
    }

    public function destroyPost($id){
        $post = Post::find($id);
        $post->delete();
        return response()->json($post);
    }
}
