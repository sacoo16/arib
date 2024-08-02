@extends('layouts.admin')
@section('content')
    @switch(auth()->user()->role)
        @case('admin')
            @include('admin.dashboard.super_admin')
            @break
        @case('manager')
            @include('admin.dashboard.manager')
            @break
        @case('employee')
            @include('admin.dashboard.employee')
            @break
        @default
            
    @endswitch
@endsection