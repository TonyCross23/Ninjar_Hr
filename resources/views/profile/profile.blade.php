@extends('layouts.app')
@section('title','Profile')

@section('content')
    <div class="container">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-6">
                        <div class="text-center">
                            <img src="{{$employee->profile_img_path()}}" alt="" class="profile-img">
                            <div class="mt-3 ms-2">
                                <span><strong>{{ $employee->name }}</strong></span>
                                <p class="text-muted mb-1"> <span class="text-muted">{{ $employee->employee_id }}</span> | <span class="text-theme">{{ $employee->phone }}</span> </p>

                                <p class="text-muted mb-1">
                                    @foreach ($employee->roles as $role )
                                         <span class="badge badge-pill bg-primary">{{ $role->name }}</span>
                                    @endforeach
                                </p>
                                <p class="text-muted mb-1"><span class="badge badge-pill bg-dark">{{ $employee->department ? $employee->department->title : '-'}}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 dash-border">
                      
                        <div class="px-2">
                            <p class="mb-1"><strong>Phone</strong> : <span class="text-muted">{{ $employee->phone }}</span></p>
                            <p class="mb-1"><strong>Email</strong> : <span class="text-muted">{{ $employee->email }}</span></p>
                            <p class="mb-1"><strong>NRC</strong> : <span class="text-muted">{{ $employee->nrc_number }}</span></p>
                            <p class="mb-1"><strong>Birthday</strong> : <span class="text-muted">{{ $employee->birthday }}</span></p>
                            <p class="mb-1"><strong>Gender</strong> : <span class="text-muted">{{ $employee->gender }}</span></p>
                            <p class="mb-1"><strong>Address</strong> : <span class="text-muted">{{ $employee->address }}</span></p>
                            <p class="mb-1"><strong>Date of Join</strong> : <span class="text-muted">{{ $employee->date_of_join }}</span></p>
                            <p class="mb-1"><strong>Is Present</strong> : <span class="text-muted">
                                @if ( $employee->is_present == 1)
                                   <span class="badge badge-pill badge-success">Present</span>
                               @else
                                 <span class="badge badge-pill badge-danger">Leave</span>
                               @endif    
                            </span>
                        </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3 ">
            <div class="card-body">
                <h5>Biometric Authentication</h5>

                {{-- <form id="biometric_auth_form"> --}}
                    <a href="#"  class="btn biometric_auth_btn">
                        <i class="fa-solid fa-fingerprint"></i>
                        <i class="fa-solid fa-circle-plus"></i>
                    </a>
                {{-- </form> --}}
            </div>
        </div>


        <div class="card mb-3 ">
            <div class="card-body">
       
             <form action="{{ route('logout') }}" method="POST">
                <button class="btn btn-theme btn-block">
                    <i class="fa fa-sign-out " aria-hidden="true"></i> Logout
                </button>
            </form>
        
            </div>
        </div>

    </div>
@endsection
@section('script')

<script>

           $(document).ready(function(){
            const register = event => {
                    event.preventDefault();
                    
                    new WebAuthn().register()
                    .then(response => alert('Registration successful!'))
                }

                // document.getElementById('biometric_auth_form').addEventListener('submit', register)

                $('.biometric_auth_btn').on('click',function(event){
                    register(event)->HTML();
                })
           })

</script>

@endsection