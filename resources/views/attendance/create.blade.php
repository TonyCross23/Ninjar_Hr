@extends('layouts.app')

@section('title','Create Attendance')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('attendance.store') }}" method="post" id="create-form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-3">
                            <lable class="mb-3">Employee</lable>
                            <select name="user_id" class="form-control form-select">
                                <option value="">Please Choice</option>
                                @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" @if (old('user_id') == $employee->id) selected @endif>{{ $employee->name }}({{ $employee->employee_id}})</option>
                                @endforeach
                            </select>
                        </div>    

                        <div class="md-form mb-3">
                            <label for="">Date</label>
                            <input type="text" name="date" class="form-control date" value="{{old('date')}}">
                        </div>
            
                        <div class="md-form mb-3">
                            <label for="">Checkin Time</label>
                            <input type="text" name="chackin_time" class="form-control timepicker" value="{{old('chackin_time')}}">
                        </div>
            
                        <div class="md-form mb-3">
                            <label for="">Checkout Time</label>
                            <input type="text" name="chackout_time" class="form-control timepicker" value="{{old('chackout_time')}}">
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
    {!!JsValidator::formRequest('App\Http\Requests\StoreAttendance', '#create-form');!!}
    <script>
        $(document).ready(function(){
            $('.date').daterangepicker({
            "singleDatePicker": true,
            "autoApply": true,
            "showDropdowns": true,
            "locale": {
                "format": "YYYY-MM-DD",
            }
        });

        $('.timepicker').daterangepicker({
            "singleDatePicker": true,
            "timePicker": true,
            "timePicker24Hour": true,
            "timePickerSeconds": true,
            "autoApply": true,
            "locale": {
                "format": "HH:mm:ss",
            }
        }).on('show.daterangepicker', function(ev, picker) {
            picker.container.find('.calendar-table').hide();
        });
        });
    </script>
@endsection
