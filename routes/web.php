<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::redirect('/', '/login');

Route::group(
    ['middleware'  => 'auth', 'prefix'  => 'admin', 'as' => 'admin.', 'namespace' => 'App\Http\Controllers\Admin'],
    function () {

        Route::get('/',                     'HomeController@index')->name('home');

        Route::resource('users',            'UsersController');
        Route::resource('departments',      'DepartmentsController');
        Route::resource('tasks',            'TasksController');
        
        Route::resource('employees',        'EmployeesController');
        Route::post('employees/media',      'EmployeesController@storeMedia')->name('employees.storeMedia');
    }
);
