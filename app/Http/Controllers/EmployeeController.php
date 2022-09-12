<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        $employee = Employee::all();
        return view('pages.employee.index',compact('employee'));
    }

    public function create(){
        return view('pages.employee.create');
    }

    public function store(Request $requset){
        $employee = new Employee;
        $employee->name = $requset->input('name');
        $employee->email = $requset->input('email');
        $employee->phone = $requset->input('phone');
        $employee->designation = $requset->input('designation');
        $employee->save();

        return redirect('employee')->with('status','Employee Added Successfully');
    }

    public function edit($id){
        $employee = Employee::find($id);
        return view('pages.employee.edit',compact('employee'));
    }

    public function update(Request $requset, $id){
        $employee = Employee::find($id);
        $employee->name = $requset->input('name');
        $employee->email = $requset->input('email');
        $employee->phone = $requset->input('phone');
        $employee->designation = $requset->input('designation');
        $employee->status = $requset->input('status') == true ? '1':'0';
        $employee->update();

        return redirect('employee')->with('status','Employee Data Updated Successfully');
    }

    public function destroy($id){
        $employee = Employee::find($id);
        $employee->delete();
        return redirect('employee')->with('status','Employee Data Deleted Successfully');
    } 
}
