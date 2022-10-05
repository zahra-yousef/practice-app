<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class EmployeeController extends Controller
{
    public function index(){
        $employee = Employee::latest()->paginate(5);
        return view('pages.employee.index',[
            'employee' => $employee,
        ]);
    }

    public function create(){
        return view('pages.employee.create');
    }

    public function store(Request $requset){
        // Validate data
        $validator = Validator::make($requset->all(), [
            'name' => 'required|regex:/^[a-zA-Z\s]*$/|min:3',
            'email' => 'required|email|unique:employees',
            'phone' => 'required|numeric|digits:10|unique:employees',
            'designation' => 'required|string',
        ]);

        // If validation fails go back to pre page 
        if ($validator->fails()) {
            return redirect('add-employee')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        // Retrieve the validated input...
        $validatedData = $validator->validated();
        $validatedData['status'] = $requset->input('status') == true ? '1':'0';
      
        // Create instance of employee model
        $user =  Employee::create($validatedData);

        // Save data into db
        $user->save();

        return redirect('employees')->with('status','Employee Added Successfully');
    }

    public function edit($id){
        $employee = Employee::findOrFail($id);
        return view('pages.employee.edit',[
            'employee' => $employee,
        ]);
    }

    public function update(Request $requset, $id){
        // Create instance of employee model
        $employee = Employee::findOrFail($id);
        
        // Validate data
        $validator = Validator::make($requset->all(), [
            'name' => 'required|regex:/^[a-zA-Z\s]*$/|min:3',
            'email' => 'required|email|unique:employees,email,'.$employee->id, 
            'phone' => 'required|numeric|digits:10|unique:employees,phone,'.$employee->id,
            'designation' => 'required|string',
            'status' => 'nullable|integer|digits_between:0,1',
        ]);

        // If validation fails go back to pre page 
        if ($validator->fails()) {
            return redirect('edit-employee/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }
        
        // Retrieve the validated input...
        $validatedData = $validator->validated();
        $validatedData['status'] = $requset->input('status') == true ? '1':'0';

        // Update data into db
        $employee->update($validatedData);
        
        return redirect('employees')->with('status','Employee Data Updated Successfully');
    }

    public function destroy($id){
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect('employees')->with('status','Employee Data Deleted Successfully');
    } 

    public function search(Request $requset){
        $search = $requset->get('emp_search');
        $employee = Employee::where('name','like','%'.$search.'%')
                ->orWhere('email','like','%'.$search.'%')
                ->paginate(5);

        return view('pages.employee.index',[
            'employee' => $employee,
        ]);
    }
}