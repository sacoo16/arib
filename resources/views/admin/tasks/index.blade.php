@extends('layouts.admin')
@section('content')
    @if (auth()->user()->role != 'employee')
        <div class="form-group">
            <a href="{{ route('admin.tasks.create') }}" class="btn btn-primary">Create Task</a>
        </div>   
    @endif
    <div class="card">
        <div class="card-header">
            <h5>Tasks List</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover zero-configuration">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Assigned to</th>
                            <th>Created By</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $key => $task)
                            <tr>
                                <td>{{ $task->id ?? '' }}</td>
                                <td>{{ $task->title ?? '' }}</td>
                                <td>{{ $task->description ?? ' - ' }}</td>
                                <td>{{ App\Models\Task::STATUS[$task->status] }}</td>
                                <td>{{ $task->assigned_to->full_name ?? '-' }}</td>
                                <td>{{ $task->created_by->name ?? '-' }}</td>
                                <td>
                                    @if (auth()->user()->employee->id == $task->assigned_to_id)
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.tasks.edit',$task->id) }}">Edit</a>
                                    @endif

                                    @if (auth()->user()->role != 'employee')
                                        <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure?');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger"
                                                value="Delete">
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection