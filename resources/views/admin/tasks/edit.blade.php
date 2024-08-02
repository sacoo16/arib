@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Edit Task</h5>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.tasks.update',$task->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="required" for="title">Title</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                        id="title" name="title" value="{{ old('title',$task->title) }}" required placeholder="Title ..">
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="description .. ">{{ old('description',$task->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control select2">
                        <option value="{{ NULL }}">Please Select Employee</option>
                        @foreach (App\Models\Task::STATUS as $status_key => $status_value)
                            <option value="{{ $status_key }}" {{ $status_key == old('status',$task->status) ? 'selected' : '' }}>{{ $status_value }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
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