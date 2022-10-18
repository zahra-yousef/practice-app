<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AjaxUser2Controller extends Controller
{
    public function index()
    {
        return view('pages.users-ajax.test');
    }

    public function store(Request $request)
    {
        $file = $request->file('avatar');
		$fileName = time() . '.' . $file->getClientOriginalExtension();
		$file->storeAs('public/images', $fileName);

		$empData = [
            'name' => $request->name,
            'last_name' => $request->lname, 
            'email' => $request->email, 
            'phone' => $request->phone, 
            'password' => $request->password,
            'role_as' => $request->role_as,  
            'image' => $fileName];
		User::create($empData);
		return response()->json([
			'status' => 200,
		]);
    }
}
