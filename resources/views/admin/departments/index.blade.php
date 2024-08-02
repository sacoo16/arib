@extends('layouts.admin')
@section('content')
    <div class="form-group">
        <a href="{{ route('admin.departments.create') }}" class="btn btn-primary">Create Department</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h5>Departments List</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover zero-configuration">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Department</th>
                            <th>Manager</th>
                            <th>Employees count</th>
                            <th>Salaries</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $key => $department)
                            <tr>
                                <td>{{ $department->id ?? '' }}</td>
                                <td>{{ $department->name ?? '' }}</td>
                                <td>{{ $department->manager->name ?? ' - ' }}</td>
                                <td>{{ number_format($department->employees_count ?? 0) }}</td>
                                <td>{{ number_format($department->employees_sum_salary ?? 0) }}</td>
                                <td>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.departments.edit', $department->id) }}">
                                        Edit
                                    </a>

                                    @if ($department->employees_count <= 0)
                                        <form action="{{ route('admin.departments.destroy', $department->id) }}" method="POST"
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