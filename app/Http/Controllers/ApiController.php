<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function create(Request $request){
        $employee = new Employee;
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->designation = $request->input('designation');
        $employee->save();
        return response()->json($employee);
    }

    public function show(){
        $employee = Employee::all();     
        return response()->json($employee);
    }
    
    public function showById($id){
        $employee = Employee::find($id);     
        return response()->json($employee);
    }

    public function update(Request $request, $id){
        $employee = Employee::find($id);
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->designation = $request->input('designation');
        $employee->status = $request->input('status') == true ? '1':'0';
        $employee->update();  
        return response()->json($request);
    }

    public function destroy($id){
        $employee = Employee::find($id);
        $employee->delete();
        return response()->json($employee);
    }
}
