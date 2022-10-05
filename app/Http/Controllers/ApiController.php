<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Validator;

class ApiController extends Controller
{
    public function createEmp(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z\s]*$|min:3',
            'email' => 'required|email|unique:employees',
            'phone' => 'required|numeric|digits:10|unique:employees',
            'designation' => 'required|string',
        ]);
   
        if($validator->fails()){
            return response(['Validation Message'=>$validator->errors()]);
        }

        // Retrieve the validated input...
        $validatedData = $validator->validated();
    
        // Create instance of user model
        $employee =  Employee::create($validatedData);

        // Save data into db
        $employee->save();
      
        return response()->json($employee);
    }

    public function showEmp(){
        $employee = Employee::all();     
        return response()->json($employee);
    }
    
    public function showEmpById($id){
        $employee = Employee::findOrFail($id);     
        return response()->json($employee);
    }

    public function updateEmp(Request $request, $id){
       // Create instance of user model
        $employee = Employee::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z\s]*$|min:3',
            'email' => 'required|email|unique:employees,email,'.$employee->id, 
            'phone' => 'required|numeric|digits:10|unique:employees,phone,'.$employee->id,
            'designation' => 'required|string',
            'status' => 'nullable|integer|digits_between:0,1'
        ]);
   
        if($validator->fails()){
            return response(['Validation Message'=>$validator->errors()]);
        }

        // Retrieve the validated input...
        $validatedData = $validator->validated();

        // Save data into db
        $employee->update($validatedData);

        return response()->json($request);
    }

    public function destroyEmp($id){
        $employee = Employee::find($id);
        $employee->delete();
        return response()->json($employee);
    }

    public function createPost(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:3',
            'description' => 'required|string',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
            'status' => 'nullable|integer|digits_between:0,1'
        ]);
   
        if($validator->fails()){
            return response(['Validation Message'=>$validator->errors()]);
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
        $post->status = $request->input('status');
        $post->save();
        return response()->json($post);
    }

    public function showPost(){
        $post = Post::all();     
        return response()->json($post);
    }
    
    public function showPostById($id){
        $post = Post::findOrFail($id);     
        return response()->json($post);
    }

    public function updatePost(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:3',
            'description' => 'required|string',
            'image' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'status' => 'nullable|integer|digits_between:0,1'
        ]);
   
        if($validator->fails()){
            return response(['Validation Message'=>$validator->errors()]);
        }

        $post = Post::findOrFail($id);
        $post->user_id = Auth::id();
        $post->title = $request->input('title');
        $post->description = $request->input('description');

        $destination_path = public_path('uploads/blog/'.$post->image);
        if($request->hasFile('image')){
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
        return response()->json($request);
    }

    public function destroyPost($id){
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json($post);
    }
}
