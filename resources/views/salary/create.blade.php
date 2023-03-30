@extends('layouts.app')

@section('title','Create Salary')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('salary.store') }}" method="post" id="create-form" enctype="multipart/form-data">
                @csrf
                        
                            <div class="form-group">
                                <label for="">Employee</label>
                                <select name="user_id" class="form-control select-ninja">
                                    <option value="">-- Please Choose --</option>
                                    @foreach ($employees as $employee)
                                    <option value="{{$employee->id}}" @if(old('user_id') == $employee->id) selected @endif>{{$employee->employee_id}} ({{$employee->name}})</option>
                                    @endforeach
                                </select>
                            </div>
               
                            <div class="form-group">
                                <label for="">Month</label>
                                <select name="month" class="form-control select-month">
                                    <option value="">-- Please Choose (Month) --</option>
                                    <option value="01" @if(now()->format('m') == '01') selected @endif>Jan</option>
                                    <option value="02" @if(now()->format('m') == '02') selected @endif>Feb</option>
                                    <option value="03" @if(now()->format('m') == '03') selected @endif>Mar</option>
                                    <option value="04" @if(now()->format('m') == '04') selected @endif>Apr</option>
                                    <option value="05" @if(now()->format('m') == '05') selected @endif>May</option>
                                    <option value="06" @if(now()->format('m') == '06') selected @endif>Jun</option>
                                    <option value="07" @if(now()->format('m') == '07') selected @endif>Jul</option>
                                    <option value="08" @if(now()->format('m') == '08') selected @endif>Aug</option>
                                    <option value="09" @if(now()->format('m') == '09') selected @endif>Sep</option>
                                    <option value="10" @if(now()->format('m') == '10') selected @endif>Oct</option>
                                    <option value="11" @if(now()->format('m') == '11') selected @endif>Nov</option>
                                    <option value="12" @if(now()->format('m') == '12') selected @endif>Dec</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Year</label>
                                <select name="year" class="form-control select-year">
                                    <option value="">-- Please Choose (Year) --</option>
                                    @for ($i = 0; $i < 10; $i++)
                                    <option value="{{now()->addYears(5)->subYears($i)->format('Y')}}" @if(now()->format('Y') == now()->subYears($i)->format('Y')) selected @endif>
                                        {{now()->addYears(5)->subYears($i)->format('Y')}}
                                    </option>
                                    @endfor
                                </select>
                            </div>

                         <div class="md-form">
                            <label for="">Amount (MMK)</label>
                            <input type="text" name="amount" class="form-control" value="{{ old('amount') }}">
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
    {!!JsValidator::formRequest('App\Http\Requests\StoreDepartment', '#create-form');!!}
    <script>
        $(document).ready(function(){
                $('.select-month').select2({
                placeholder: '-- Please Choose (Month) --',
                allowClear: true,
            
            });

            $('.select-year').select2({
                placeholder: '-- Please Choose (Year) --',
                allowClear: true,
            
            });
        });
    </script>
@endsection
