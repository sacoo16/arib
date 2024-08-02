<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TasksController extends Controller
{
    public function index()
    {
        $auth = auth()->user();

        if ($auth->role == 'employee')
        {
            $tasks = Task::with(['assigned_to','created_by'])->whereAssignedToId($auth->employee->id)->latest()->get();
        }else{
            $tasks = Task::with(['assigned_to','created_by'])->latest()->get();
        }

        return view('admin.tasks.index',compact('tasks'));
    }

    public function create()
    {
        if(auth()->user()->role == 'admin')
        {
            $employees = Employee::whereHas('user',fn($q) => $q->whereRole('employee'))
                                    ->orderBy('first_name')->get(['first_name','last_name','id']);

        }elseif(auth()->user()->role == 'manager'){

            $employees = Employee::whereDepartmentId(auth()->user()->employee->department_id)
                                    ->orderBy('first_name')
                                    ->get(['first_name','last_name','id']);
        }else{
            return back();
        }

        return view('admin.tasks.create',compact('employees'));
    }

    public function store(StoreTaskRequest $request)
    {
        $data = $request->all();

        $data['created_by_id']  = auth()->id();

        Task::create($data);

        return redirect()->route('admin.tasks.index');
    }

    public function show(Task $task)
    {
        return view('admin.tasks.show',compact('task'));
    }

    public function edit(Task $task)
    {
        return view('admin.tasks.edit',compact('task'));
    }

    public function update(UpdateTaskRequest $request,Task $task)
    {
        $task->update($request->all());

        return redirect()->route('admin.tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return back();
    }
}
