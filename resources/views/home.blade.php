@extends('layouts.app')
@section('title','Home')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <img src="{{$employee->profile_img_path()}}" alt="" class="profile-img">
                            <div class="mt-3 ms-2">
                                <span><strong>{{ $employee->name }}</strong></span>
                                <p class="text-muted mb-1"> <span class="text-muted">{{ $employee->employee_id }}</span> | <span class="text-theme">{{ $employee->phone }}</span> </p>
                                <p class="text-muted mb-1"><span class="badge badge-pill badge-dark">{{ $employee->department ? $employee->department->title : '-'}}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection