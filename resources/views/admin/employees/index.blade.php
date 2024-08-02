@extends('layouts.admin')
@section('content')
    <div class="form-group">
        <a href="{{ route('admin.employees.create') }}" class="btn btn-primary">Create Employee</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h5>Employees List</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover zero-configuration">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Salary</th>
                            <th>Department</th>
                            <th>Manager</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $key => $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td>
                                    <a href="{{ $employee->image ? $employee->image->getUrl() : asset('images/logo.png') }}" target="_blank" rel="noopener noreferrer">
                                        <img class="rounded-circle" src="{{ $employee->image ? $employee->image->getUrl() : asset('images/logo.png') }}" alt="" width="50" height="50" >
                                    </a>
                                </td>
                                <td>{{ $employee->full_name ?? ' - ' }}</td>
                                <td>{{ $employee->user->email ?? ' - ' }}</td>
                                <td>{{ $employee->user->phone ?? ' - ' }}</td>
                                <td>{{ $employee->user->role ?? ' - ' }}</td>
                                <td>{{ number_format($employee->salary) ?? '-' }}</td>
                                <td>{{ $employee->department->name ?? '-' }}</td>
                                <td>{{ $employee->manager->name ?? '-' }}</td>
                                <td>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.employees.edit', $employee->id) }}">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?');"
                                        style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger"
                                            value="Delete">
                                    </form>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection