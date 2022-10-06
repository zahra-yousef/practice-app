<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
            return view('pages.users-ajax.show',['users'=>$users]);
        }
        else{
            return response()->json([
                'status' => 404,
                'message'=> 'Not data found.',
            ]);
        }  
    }

    public function showSingleUser($id){
        $user = User::find($id);
        if(!empty($user) && $user->count()){
            return response()->json([
                'status' => 200,
                'user'=>$user,
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
            'name' => 'required|regex:/^[a-zA-Z\s]*$/|min:3|max:191',
            'last_name' => 'required|regex:/^[a-zA-Z\s]*$/|min:3|max:191',
            'phone' => 'required|numeric|digits:10|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role_as' => 'required|integer|digits_between:0,1'
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
                'message'=>'User Added Successfully.'
            ]);
        }
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);

        // Validate data
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z\s]*$/|min:3|max:191',
            'last_name' => 'required|regex:/^[a-zA-Z\s]*$/|min:3|max:191',
            'phone' => 'required|numeric|digits:10|unique:users,phone,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id, 
            'password' => 'nullable|min:8',
            'role_as' => 'required|integer|digits_between:0,1'
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
                'message'=>'User Updated Successfully.'
            ]);
        }
    }

    public function destroy($id){
        $user = User::findOrFail($id);
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

    public function paginationFetch(Request $request)
    {
        $users = User::paginate(5);
        // $articles=User::when($request->has("title"),function($q)use($request){
        //     return $q->where("title","like","%".$request->get("title")."%");
        // })->paginate(5);

        if($request->ajax()){
            return view('pages.users-ajax.pagination',['users'=>$users]); 
        } 
        return view('pages.users-ajax.show',['users'=>$users]);
    }
}
