<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class EmployeeController extends Controller
{
    public function index() {
        $employees = Employee::orderBy('id', 'DESC')->get();
        return view('index', ['employees'=>$employees]);
    }

    public function dataValidate($request){
        $request->validate([
            'name'=>'required|string|max:30',
            'email'=>'required|email',
            'address'=>'required|string',
            'phone'=>'required|numeric',
        ]);
    }

    public function saveData($employee, $request){
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->phone = $request->phone;
        $employee->save();
    }

    public function addEmployee(Request $request){
        $employee = new Employee();
        $this->dataValidate($request);
        $this->saveData($employee, $request);
        return response()->json($employee);
    }

    public function getEmployeeById($id){
        $employee = Employee::find($id);
        return response()->json($employee);
    }

    public function editEmployee(Request $request){
        $employee = Employee::find($request->id);
        $this->dataValidate($request);
        $this->saveData($employee, $request);
        return response()->json($employee);

    }

    public function deleteEmployee($id){
        $employee = Employee::find($id);
        $employee->delete();
        return response()->json(['success'=>'Record has been deleted']);
    }

    public function deleteAllChecked(Request $request){
        $ids = $request->ids;
        Employee::whereIn('id', $ids)->delete();
        return response()->json(['success'=>'Employees have been deleted!']);
    }
}
