<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\User;

class DepartmentsController extends Controller
{
    public function index()
    {
        $departments = Department::withCount('employees')
                                    ->withSum('employees','salary')
                                    ->latest()
                                    ->get();

        return view('admin.departments.index',compact('departments'));
    }

    public function create()
    {
        $managers = User::whereRole('manager')->orderBy('name')->pluck('name','id');

        return view('admin.departments.create',compact('managers'));
    }

    public function store(StoreDepartmentRequest $request)
    {
        Department::create($request->all());

        return redirect()->route('admin.departments.index');
    }

    public function show(Department $department)
    {
        return view('admin.departments.show',compact('department'));
    }

    public function edit(Department $department)
    {
        $managers = User::whereRole('manager')->orderBy('name')->pluck('name','id');

        return view('admin.departments.edit',compact('department','managers'));
    }

    public function update(UpdateDepartmentRequest $request,Department $department)
    {
        $department->update($request->all());

        return redirect()->route('admin.departments.index');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return back();
    }
}
