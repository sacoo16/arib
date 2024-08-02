@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Create Task</h5>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.tasks.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="title">Title</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"
                        id="title" value="{{ old('title', '') }}" required placeholder="Title ..">
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="description .. ">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="assigned_to_id">Assign to</label>
                    <select name="assigned_to_id" id="assigned_to_id" class="form-control select2">
                        <option value="{{ NULL }}">Please Select Employee</option>
                        @foreach ($employees as $assigned_to)
                            <option value="{{ $assigned_to->id }}" {{ $assigned_to->id == old('assigned_to_id') ? 'selected' : '' }}>{{ $assigned_to->full_name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('assigned_to_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('assigned_to_id') }}
                        </div>
                    @endif
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