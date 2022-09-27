<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AjaxUserController extends Controller
{
    public function index(){
        return view('pages.users-ajax.index');
    }

    public function show(){
        $users = User::all();
        if(!empty($users) && $users->count()){
            return response()->json([
                'status' => 200,
                'users'=>$users,
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                'message'=> 'Not data found.',
            ]);
        }  
    }

    public function search(Request $requset){
        if($requset->ajax()){
            $users = User::where('name','like','%'.$requset->search.'%')
                ->orWhere('last_name','like','%'.$requset->search.'%')
                ->orWhere('email','like','%'.$requset->search.'%')->get();
            if(!empty($users) && $users->count()){
                return response()->json([
                    'status' => 200,
                    'users'=>$users,
                ]);
            }
            else{
                return response()->json([
                    'status' => 404,
                    'message'=> 'Not data found.',
                ]);
            }    
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|digits:10|unique:users',
            'password' => 'required|min:6',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        } 
        else
        {
            $validatedData = $validator->validated();
            $validatedData['password'] = bcrypt($validatedData['password']);
            
            $user =  User::create($validatedData);
            $user->save();

            return response()->json([
                'status'=>200,
                'message'=>'User Added Successfully.'
            ]);
        }
    }

    public function update(Request $request, $id){
        // Validate data
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'phone' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else{
            $validatedData = $validator->validated();

            $user = User::findOrFail($id);
            if(empty($validatedData['password'])){
                $validatedData['password'] = $user->password;
            }else{
                $validatedData['password'] = bcrypt($validatedData['password']);
            }
            
            $user->update($validatedData);

            return response()->json([
                'status'=>200,
                'message'=>'User Updated Successfully.'
            ]);
        }
    }

    public function destroy($id){
        $user = User::find($id);
        if($user)
        {
            $user->delete();
            return response()->json([
                'status'=>200,
                'message'=>'User Deleted Successfully.'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No User Found.'
            ]);
        }
    }
}
