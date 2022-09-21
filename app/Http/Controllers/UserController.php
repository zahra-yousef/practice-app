<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    public function index(){
        $users= User::paginate(5);
        return view('pages.users.index',compact('users'));
    }

    public function create(){
        return view('pages.users.create');
    }

    public function store(Request $requset){
        // Validate data
        $validator = Validator::make($requset->all(), [
            'name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|digits:10|unique:users',
            'password' => 'required|min:6',
        ]);

        // If validation fails go back to pre page 
        if ($validator->fails()) {
            return redirect('add-user')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        // Retrieve the validated input...
        $validatedData = $validator->validated();
        $validatedData['password'] = bcrypt($validatedData['password']);
        
        // Create instance of user model
        $user =  User::create($validatedData);

        // Save data into db
        $user->save();

        return redirect('users')->with('status','User Added Successfully');
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('pages.users.edit',compact('user'));
    }

    public function update(Request $requset, $id){
        // Validate data
        $validator = Validator::make($requset->all(), [
            'name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'phone' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
        ]);

        // If validation fails go back to pre page 
        if ($validator->fails()) {
            return redirect('edit-user/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }
        
        // Retrieve the validated input...
        $validatedData = $validator->validated();

        // Create instance of user model
        $user = User::findOrFail($id);
        if(empty($validatedData['password'])){
            $validatedData['password'] = $user->password;
        }else{
            $validatedData['password'] = bcrypt($validatedData['password']);
        }
        
        // Update data into db
        $user->update($validatedData);
        
        return redirect('users')->with('status','User Data Updated Successfully');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('users')->with('status','User Data Deleted Successfully');
    } 

    public function search(Request $requset){
        $search = $requset->get('user_search');
        $users = User::where('name','like','%'.$search.'%')
                ->orWhere('last_name','like','%'.$search.'%')
                ->orWhere('email','like','%'.$search.'%')
                ->paginate(5);
        return view('pages.users.index',compact('users'));
    }

    public function show($id){
        $user = User::findOrFail($id);
        return view('pages.users.show',compact('user'));
    }
}