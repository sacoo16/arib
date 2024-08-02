<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Services\EmployeeService;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class EmployeesController extends Controller
{
    use MediaUploadingTrait;
    
    public function index()
    {
        if (auth()->user()->role == 'admin') 
        {
            $employees = Employee::orderBy('first_name')->get();    
        }elseif(auth()->user()->role == 'manager'){
            $employees = Employee::whereDepartmentId(auth()->user()->employee->department_id)
                                    ->orderBy('first_name')
                                    ->get();
        }


        return view('admin.employees.index',compact('employees'));
    }

    public function create()
    {
        $departments = Department::latest()->pluck('name','id');

        return view('admin.employees.create',compact('departments'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        $employee_service = new EmployeeService();

        $employee_service->upload_image($request);

        return redirect()->route('admin.employees.index');
    }

    public function show(Employee $employee)
    {
        return view('admin.employees.show',compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $departments = Department::orderBy('name')->pluck('name','id');

        return view('admin.employees.edit',compact('employee','departments'));
    }

    public function update(UpdateEmployeeRequest $request,Employee $employee)
    {
        $employee_service = new EmployeeService();

        $employee_service->edit_upload_image($employee->user,$request);

        return redirect()->route('admin.employees.index');
    }

    public function destroy(Employee $employee)
    {
        $employee->load(['user','tasks']);

        $employee->tasks->toQuery()->delete();

        $employee->user->delete();
        
        $employee->delete();

        return back();
    }
}
