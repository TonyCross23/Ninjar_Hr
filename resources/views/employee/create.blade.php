@extends('layouts.app')

@section('title','Create Employee')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('employee.store') }}" method="post" id="create-form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-outline mb-4">
                            <input type="text" id="employee_id" name="employee_id"  class="form-control">
                            <label for="employee_id" class="form-label">Employee ID</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="text" id="name" name="name"  class="form-control">
                            <label for="name" class="form-label">Name</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="number" id="phone" name="phone"  class="form-control">
                            <label for="phone" class="form-label">Phone</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="email" id="emial" name="email"  class="form-control">
                            <label for="emial" class="form-label">Email</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="text" id="nrc_number" name="nrc_number"  class="form-control">
                            <label for="nrc_number" class="form-label">NRC Number</label>
                        </div>

                        <div class="form-outline mb-4">
                            <textarea name="address" class="form-control" id="address" rows="2"></textarea>
                            <label for="address" class="form-label">Address</label>
                        </div>
                 
          
                    <div class="from-group mb-4">
                        <label for="">Role (or) Designation</label>
                        <select name="roles[]" class="form-select select-item" aria-label="Default select example" multiple>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                    <div class="col-md-6">


                <div class="form-outline mb-4">
                    <input type="text" id="birthday" name="birthday"  class="form-control birthday">
                    <label for="birthday" class="form-label">Birthday</label>
                </div>

                  <div class="from-group mb-4">
                            <select name="gender" class="form-select" aria-label="Default select example">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                <div class="from-group mb-4">
                    <select name="department_id" class="form-select" aria-label="Default select example">
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-outline mb-4">
                    <input type="text" id="date_of_join" name="date_of_join"  class="form-control date_of_join">
                    <label for="date_of_join" class="form-label">Date of Join</label>
                </div>

                <div class="from-group mb-4">
                    <select name="is_present" class="form-select" aria-label="Default select example">
                        <option value="">Is Present?</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                
                <div class=" mb-4">
                    <p class="mb-0">Profile Image</p>
                    <input type="file" id="profile_img" name="profile_img"  class="form-control" placeholder="Profile Image" >

                    <div class="preview_img mt-2">

                    </div>
                </div>

                <div class="form-outline mb-4">
                    <input type="number" id="pin_code" name="pin_code"  class="form-control pin_code">
                    <label for="pin_code" class="form-label">Pin Code</label>
                </div>

                
                <div class="form-outline mb-4">
                    <input type="password" id="password" name="password"  autocomplete="off" class="form-control">
                    <label for="password" class="form-label">Password</label>
                </div>
                </div>
            </div>



                <div class="d-flex justify-content-center my-3">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-theme btn-sm btn-block">Confirm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    {!!JsValidator::formRequest('App\Http\Requests\StoreEmployee', '#create-form');!!}
    <script>
        $(document).ready(function(){
            $('.birthday').daterangepicker({
                "singleDatePicker": true,
                "autoApply": true,
                "showDropdowns": true,

            });

            $('.date_of_join').daterangepicker({
                "singleDatePicker": true,
                "autoApply": true,
                "showDropdowns": true,
            
            });

            $('#profile_img').on('change', function (){
                var file_length = document.getElementById('profile_img').files.length;
                $('.preview_img').html('');
                for(var i = 0 ; i < file_length ; i++) {
                    $('.preview_img').append(`<img src="${URL.createObjectURL(event.target.files[i])}"/>`)
                }
            });

        });
    </script>
@endsection
