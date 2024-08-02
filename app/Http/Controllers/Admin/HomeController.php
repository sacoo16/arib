<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        switch (auth()->user()->role) 
        {
            case 'admin':
                return $this->admin();
                break;
                
            case 'manager':
                return $this->manager();
                break;

            case 'employee':
                return $this->employee();
                break;
            
            default:
                return back();
                break;
        }
    }

    public function admin()
    {
        $departments    = Department::count();

        $employees      = Employee::count();

        return view('home',compact('departments','employees'));
    }

    public function manager()
    {
        $employees      = Employee::whereHas('department',fn($q) => $q->whereManagerId(auth()->id()))->get();

        $tasks          = Task::whereHas('assigned_to',fn($q) => $q->whereDepartmentId(auth()->user()->employee->department_id))
                                    ->count();

        return view('home',compact('employees','tasks'));
    }

    public function employee()
    {
        $tasks = Task::whereAssignedToId(auth()->user()->employee->id)->count();

        return view('home',compact('tasks'));
    }
}
