<?php 

namespace App\Services;

use App\Models\Department;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class EmployeeService 
{
    public function create_user($request)
    {
        $data               = $request->all();

        $data['name']       = request('first_name').' '.request('last_name');

        $data['password']   = Hash::make('password');

        $user               = User::create($data);

        return $user->id;
    }

    public function create_employee($request)
    {
        $data = $request->all();
        
        $manager_id = Department::findOrFail($request['department_id'])->manager_id;

        $data['user_id']        = $this->create_user($request);

        $data['manager_id']     = $manager_id;

        $employee = Employee::create($data);

        return $employee;
    }

    public function upload_image($request)
    {
        $employee = $this->create_employee($request);
        
        if ($request->input('image', false)) {
            $employee->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $employee->id]);
        }

        return $employee;
    }

    public function update_user($user,$request)
    {
        $data               = $request->all();
        
        $data['name']       = request('first_name').' '.request('last_name');
        
        $data['password']   = Hash::make($request['password']);

        $user->update($data);

        return $user;
    }

    public function update_employee($user,$request)
    {
        $data = $request->all();
        
        $manager_id = Department::findOrFail($request['department_id'])->manager_id;

        $data['manager_id']     = $manager_id;

        $employee = $this->update_user($user,$request)->employee;

        return $employee;
    }

    public function edit_upload_image($user,$request)
    {
        $employee = $this->update_employee($user,$request);
        
        if ($request->input('image', false)) {
            if (!$employee->image || $request->input('image') !== $employee->image->file_name) {
                if ($employee->image) {
                    $employee->image->delete();
                }
                $employee->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');

                if ($media = $request->input('ck-media', false)) {
                    Media::whereIn('id', $media)->update(['model_id' => $employee->id]);
                }
            }
        }

        return $employee;
    }

}