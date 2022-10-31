<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AjaxUserController extends Controller
{
    public function index()
    {
        return view('pages.users-ajax.index');
    }

    public function showAll()
    {
        $users = User::all();
        return response()->json([
            'users'=>$users,
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), 
        [
            'name' => 'required|regex:/^[a-zA-Z\s]*$/|min:3|max:191',
            'last_name' => 'required|regex:/^[a-zA-Z\s]*$/|min:3|max:191',
            'phone' => 'required|numeric|digits:10|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role_as' => 'required|integer|digits_between:0,1'
        ],
        [
            'role_as.digits_between' => 'The role field is required.'
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
            $validatedData['password'] = Hash::make($request->password);
            
            $user =  User::create($validatedData);
            $user->save();

            return response()->json([
                'status'=>200,
            ]);
        }
	}

    public function edit(Request $request)
    {
        $id = $request->input('id');
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        $validator = Validator::make($request->all(), 
        [
            'name' => 'required|regex:/^[a-zA-Z\s]*$/|min:3|max:191',
            'last_name' => 'required|regex:/^[a-zA-Z\s]*$/|min:3|max:191',
            'phone' => 'required|numeric|digits:10|unique:users,phone,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id, 
            'password' => 'nullable|min:8',
            'role_as' => 'required|integer|digits_between:0,1'
        ],
        [
            'role_as.digits_between' => 'The role field is required.'
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

            if(empty($validatedData['password'])){
                $user->update([
                    'name' => $validatedData['name'],
                    'last_name' => $validatedData['last_name'],
                    'phone' => $validatedData['phone'],
                    'email' => $validatedData['email'],
                    'role_as' => $validatedData['role_as'],
                ]);
            }else{
                $validatedData['password'] = Hash::make($request->password);
                $user->update($validatedData);
            }

            return response()->json([
                'status'=>200,
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'status'=>200,
        ]);
    }
}