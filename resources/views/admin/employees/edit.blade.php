@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Edit Employee | {{ $employee->full_name }}</h5>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.employees.update',$employee->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="image">Image</label>
                    <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}"
                         id="image-dropzone">
                    </div>
                    @if ($errors->has('image'))
                        <div class="invalid-feedback">
                            {{ $errors->first('image') }}
                        </div>
                    @endif
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="required" for="first_name">First Name</label>
                        <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name"
                            id="first_name" value="{{ old('first_name', $employee->first_name) }}" required placeholder="First Name ..">
                        @if ($errors->has('first_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('first_name') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="required" for="last_name">Last Name</label>
                        <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name"
                            id="last_name" value="{{ old('last_name', $employee->last_name) }}" required placeholder="Last Name ..">
                        @if ($errors->has('last_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('last_name') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="required" for="email">Email</label>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                            id="email" value="{{ old('email', $employee->user->email) }}" required placeholder="email ..">
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label class="required" for="phone">Phone</label>
                        <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="number" name="phone"
                            id="phone" value="{{ old('phone', $employee->user->phone) }}" required placeholder="Phone ..">
                        @if ($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label class="required" for="salary">Salary</label>
                        <input class="form-control {{ $errors->has('salary') ? 'is-invalid' : '' }}" type="number" name="salary"
                            id="salary" value="{{ old('salary', $employee->salary) }}" required placeholder="Salary ..">
                        @if ($errors->has('salary'))
                            <div class="invalid-feedback">
                                {{ $errors->first('salary') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control">
                            <option value="{{ NULL }}">Please Select Role</option>
                            @foreach (App\Models\User::ROLES as $role_key => $role_value)
                                <option value="{{ $role_key }}" {{ $role_key == old('role',$employee->user->role) ? 'selected' : '' }}>{{ $role_value }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('role'))
                            <div class="invalid-feedback">
                                {{ $errors->first('role') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="department_id">Department</label>
                        <select name="department_id" id="department_id" class="form-control">
                            <option value="{{ NULL }}">Please Select Department</option>
                            @foreach ($departments as $department_id => $department_name)
                                <option value="{{ $department_id }}" {{ $department_id == old('department_id',$employee->department_id) ? 'selected' : '' }}>{{ $department_name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('department_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('department_id') }}
                            </div>
                        @endif
                    </div>
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
@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
        url: '{{ route('admin.employees.storeMedia') }}',
        maxFilesize: 5, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
            size: 5,
            width: 4096,
            height: 4096
        },
        success: function(file, response) {
            $('form').find('input[name="image"]').remove()
            $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
        },
        removedfile: function(file) {
            file.previewElement.remove()
            if (file.status !== 'error') {
                $('form').find('input[name="image"]').remove()
                this.options.maxFiles = this.options.maxFiles + 1
            }
        },
        init: function() {
            @if (isset($employee) && $employee->image)
                var file = {!! json_encode($employee->image) !!}
                this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
            @endif
        },
        error: function(file, response) {
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error')
            _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _results = []
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i]
                _results.push(node.textContent = message)
            }

            return _results
        }
    }
</script>
@endsection