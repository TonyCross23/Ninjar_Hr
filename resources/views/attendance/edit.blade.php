@extends('layouts.app')

@section('title','Edit Attendance')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('attendance.update',$attendance->id) }}" method="post" id="edit-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
              
                <div class="form-group">
                    <label for="">Employee</label>
                    <select name="user_id" class="form-control select-ninja">
                        <option value="">-- Please Choose --</option>
                        @foreach ($employees as $employee)
                        <option value="{{$employee->id}}" @if(old('user_id', $attendance->user_id) == $employee->id) selected @endif>{{$employee->employee_id}} ({{$employee->name}})</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="md-form">
                    <label for="">Date</label>
                    <input type="text" name="date" class="form-control date" value="{{old('date', $attendance->date)}}">
                </div>
    
                <div class="md-form">
                    <label for="">Chackin Time</label>
                    <input type="text" name="chackin_time" class="form-control timepicker" value="{{old('chackin_time', Carbon\Carbon::parse($attendance->chackin_time)->format('H:i:s'))}}">
                </div>
    
                <div class="md-form">
                    <label for="">Chackout Time</label>
                    <input type="text" name="chackout_time" class="form-control timepicker" value="{{old('chackin_time', Carbon\Carbon::parse($attendance->chackout_time)->format('H:i:s'))}}">
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
    {!!JsValidator::formRequest('App\Http\Requests\UpdateAttendance', '#edit-form');!!}
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
