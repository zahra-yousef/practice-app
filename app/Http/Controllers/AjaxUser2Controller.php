<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AjaxUser2Controller extends Controller
{
    public function index()
    {
        return view('pages.users-ajax.index2');
    }

    public function showAll()
    {
        $users = User::all();
        $output = '';
        if($users->count() > 0){
            $output .= '<div class="table-responsive"> 
            <table class="table table-striped table-hover table-sm text-center align-middle">
                <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Phone</th>
                    <th class="text-center">E-mail</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>';
            foreach ($users as $user) {
                $output .= '<tr>
                <td>' . $user->id . '</td>
                <td>' . $user->name . ' ' . $user->last_name . '</td>
                <td>' . $user->phone . '</td>
                <td>' . $user->email . '</td>
                <td>
                    <a href="#" id="' . $user->id . '" class="text-primary mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editUserModal"><i class="bi-pencil-square h4"></i></a>
                    <a href="#" id="' . $user->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
                </tr>';
            }
            $output .= '</tbody></table></div>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No data found in the database!</h1>';
        }
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
        $id = $request->id;
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

    public function delete(Request $request)
    {
        $id = $request->id;
        $user = User::findOrFail($id);
        User::destroy($id);
    }
}
