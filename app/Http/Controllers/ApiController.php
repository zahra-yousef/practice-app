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
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:employees',
            'phone' => 'required|numeric',
            'designation' => 'required|string',
        ],
        [
            'name.required'=> 'Your Name is Required', 
            'name.string'=> 'Name Should be Only Characters',
            'name.min'=> 'Name Should be Minimum of 3 Characters',
            
            'email.required'=> 'Your Email is Required', 
            'email.email'=> 'Your Email has Wrong Syntax', 
            'email.unique'=> 'Your Email Should be Unique', 

            'phone.required'=> 'Your Phone is Required', 
            'phone.numeric'=> 'Your Phone Should Only Contain Integers',

            'designation.required'=> 'Your designation is Required', 
            'designation.string'=> 'Your designation Should be Only Characters',
        ]
        );
   
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'designation' => 'required|string',
            'status' => 'nullable|integer|min:0|max:1'
        ],
        [
            'name.required'=> 'Your Name is Required', 
            'name.string'=> 'Name Should be Only Characters',
            'name.min'=> 'Name Should be Minimum of 3 Characters',
            
            'email.required'=> 'Your Email is Required', 
            'email.email'=> 'Your Email has Wrong Syntax',  

            'phone.required'=> 'Your Phone is Required', 
            'phone.numeric'=> 'Your Phone Should Only Contain Integers',
           
            'designation.required'=> 'Your Designation is Required', 
            'designation.string'=> 'Your Designation Should be Only Characters',

            'status.integer'=> 'Your Status Should Only Contain Integers',
            'status.min'=> 'Your Status Should be Only between 0 and 1',
            'status.max'=> 'Your Status Should be Only between 0 and 1',
        ]
        );
   
        if($validator->fails()){
            return response(['msg'=>$validator->errors()]);
        }

        // Retrieve the validated input...
        $validatedData = $validator->validated();
    
        // Create instance of user model
        $employee = Employee::findOrFail($id);

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
            'status' => 'nullable|integer|min:0|max:1'
        ],
        [
            'name.required'=> 'Post Title is Required', 
            'name.string'=> 'Post Title Should be Only Characters',
            'name.min'=> 'Post Title Should be Minimum of 3 Characters',
           
            'description.required'=> 'Post Description is Required', 
            'description.string'=> 'Post Description Should be Only Characters',

            'status.integer'=> 'Post Status Should Only Contain Integers',
            'status.min'=> 'Post Status Should be Only between 0 and 1',
            'status.max'=> 'Post Status Should be Only between 0 and 1',
        ]
        );
   
        if($validator->fails()){
            return response(['msg'=>$validator->errors()]);
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
            'status' => 'nullable|integer|min:0|max:1'
        ],
        [
            'name.required'=> 'Post Title is Required', 
            'name.string'=> 'Post Title Should be Only Characters',
            'name.min'=> 'Post Title Should be Minimum of 3 Characters',
           
            'description.required'=> 'Post Description is Required', 
            'description.string'=> 'Post Description Should be Only Characters',

            'status.integer'=> 'Post Status Should Only Contain Integers',
            'status.min'=> 'Post Status Should be Only between 0 and 1',
            'status.max'=> 'Post Status Should be Only between 0 and 1',
        ]
        );
   
        if($validator->fails()){
            return response(['msg'=>$validator->errors()]);
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
