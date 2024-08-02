@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Create Department</h5>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.departments.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">Name</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                        id="name" value="{{ old('name', '') }}" required>
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="manager_id">Manager</label>
                    <select name="manager_id" id="manager_id" class="form-control">
                        <option value="{{ NULL }}">Please Select Manager</option>
                        @foreach ($managers as $manager_id => $manager_name)
                            <option value="{{ $manager_id }}" {{ $manager_id == old('manager_id') ? 'selected' : '' }}>{{ $manager_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
