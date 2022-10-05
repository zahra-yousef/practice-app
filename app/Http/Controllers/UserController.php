<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $users= User::latest()->paginate(5);
        return view('pages.users.index',[
            'users' => $users,
        ]);
    }

    public function create(){
        return view('pages.users.create');
    }

    public function store(Request $requset){
        // Validate data
        $validator = Validator::make($requset->all(), [
            'name' => 'required|regex:/^[a-zA-Z\s]*$/|min:3|max:191',
            'last_name' => 'required|regex:/^[a-zA-Z\s]*$/|min:3|max:191',
            'phone' => 'required|numeric|digits:10|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8',
            'role_as' => 'required|integer|digits_between:0,1'
        ]);

        // If validation fails go back to pre page 
        if ($validator->fails()) {
            return redirect('add-user')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        // Retrieve the validated input...
        $validatedData = $validator->validated();
        $validatedData['password'] = Hash::make($requset->password);
        
        // Create instance of user model
        $user =  User::create($validatedData);

        // Save data into db
        $user->save();

        return redirect('users')->with('status','User Added Successfully');
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('pages.users.edit',[
            'user' => $user,
        ]);
    }

    public function update(Request $requset, $id){
        $user = User::findOrFail($id);
        // Validate data
        $validator = Validator::make($requset->all(), [
            'name' => 'required|regex:/^[a-zA-Z\s]*$/|min:3|max:191',
            'last_name' => 'required|regex:/^[a-zA-Z\s]*$/|min:3|max:191',
            'phone' => 'required|numeric|digits:10|unique:users,phone,'.$user->id,
            'email' => 'required|email|max:255|unique:users,email,'.$user->id, 
            'password' => 'nullable|min:8',
            'role_as' => 'required|integer|digits_between:0,1'
        ]);

        // If validation fails go back to pre page 
        if ($validator->fails()) {
            return redirect('edit-user/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }
        
        // Retrieve the validated input...
        $validatedData = $validator->validated();
        
        if(empty($validatedData['password'])){
            $user->update([
                'name' => $validatedData['name'],
                'last_name' => $validatedData['last_name'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'role_as' => $validatedData['role_as'],
            ]);
        }else{
            $validatedData['password'] = Hash::make($requset->password);
            $user->update($validatedData);
        }
        
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
        return view('pages.users.index',[
            'users' => $users,
        ]);
    }

    public function show($id){
        $user = User::findOrFail($id);
        return view('pages.users.show',[
            'user' => $user,
        ]);
    }
}