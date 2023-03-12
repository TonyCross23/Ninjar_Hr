@extends('layouts.app')

@section('title','Edit Company Setting')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('company-setting.update',$setting->id) }}" method="post" id="edit-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-outline mb-4">
                            <input type="text" id="company_name" name="company_name"  class="form-control" value="{{ $setting->company_name }}">
                            <label for="company_name" class="form-label">Company Name</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="text" id="company_email" name="company_email"  class="form-control" value="{{ $setting->company_email }}">
                            <label for="company_email" class="form-label">Company Email</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="text" id="company_phone" name="company_phone"  class="form-control" value="{{ $setting->company_phone }}">
                            <label for="company_phone" class="form-label">Company Phone</label>
                        </div>

                        <div class="form-outline mb-4">
                            <textarea name="company_address" id="company_address" class="form-control">{{ $setting->company_address }}</textarea>
                            <label for="company_address" class="form-label">Company Address</label>
                        </div>
                </div>
            </div>

            <div class="form-outline mb-4">
                <input type="text" id="office_start_time" name="office_start_time"  class="timepicker form-control" value="{{ $setting->office_start_time }}">
                <label for="office_start_time" class="form-label">Office Start Time</label>
            </div>

            <div class="form-outline mb-4">
                <input type="text" id="office_end_time" name="office_end_time"  class="timepicker form-control" value="{{ $setting->office_end_time }}">
                <label for="office_end_time" class="form-label">Office End Time</label>
            </div>

            <div class="form-outline mb-4">
                <input type="text" id="break_start_time" name="break_start_time"  class="timepicker form-control" value="{{ $setting->break_start_time }}">
                <label for="break_start_time" class="form-label">Break Start Time</label>
            </div>

            <div class="form-outline mb-4">
                <input type="text" id="break_end_time" name="break_end_time"  class="timepicker form-control" value="{{ $setting->break_end_time }}">
                <label for="break_end_time" class="form-label">Break End Time</label>
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
    {!!JsValidator::formRequest('App\Http\Requests\UpdateCompanySetting', '#edit-form');!!}
    <script>
        $(document).ready(function(){
            $('.timepicker').daterangepicker({
                "singleDatePicker": true,
                "timePicker": true,
                "timePicker24Hour": true,
                "timePickerSeconds": true,
                "autoApply": true,
                "showDropdowns": true,
                "locale" : {
                    "format" : "HH:mm:ss",
                }

            }).on('show.daterangepicker', function(ev, picker) {
                $('.calendar-table').hide();
            });;



        });
    </script>
@endsection
