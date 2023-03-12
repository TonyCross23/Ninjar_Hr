@extends('layouts.app')
@section('title','Company Setting')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">     

                    <div class="col-md-6">
                        <div class="md-form">
                            <label for="">Company Name</label>
                            <p class="text-muted">{{ $setting->company_name}}</p>
                        </div>
                    </div>

                        <div class="col-md-6">
                            <div class="md-form">
                                <label for="">Company Email</label>
                                <p class="text-muted">{{ $setting->company_email}}</p>
                        </div>
                    </div>
                        <div class="col-md-6">
                              <div class="md-form">
                                    <label for="">Company Phone</label>
                                    <p class="text-muted">{{ $setting->company_phone}}</p>
                        </div>
                    </div>
                        <div class="col-md-6">
                             <div class="md-form">
                                 <label for="">Company Address</label>
                                  <p class="text-muted">{{ $setting->company_address}}</p>
                          </div>
                        </div>
                          <div class="col-md-6">
                            <div class="md-form">
                                  <label for="">Office Start Time</label>
                                  <p class="text-muted">{{ $setting->office_start_time}}</p>
                      </div>  
                    </div>
                      <div class="col-md-6">
                        <div class="md-form">
                              <label for="">Office End Time</label>
                              <p class="text-muted">{{ $setting->office_end_time}}</p>
                   </div>
                </div>
                   <div class="col-md-6">
                    <div class="md-form">
                          <label for="">Break Start Time</label>
                          <p class="text-muted">{{ $setting->break_start_time}}</p>
                    </div>
                </div>
                    <div class="col-md-6">
                        <div class="md-form">
                            <label for="">Break End Time</label>
                            <p class="text-muted">{{ $setting->break_end_time}}</p>
                     </div>
                    </div>

                    <div class="text-center mt-3">
                        <div class="md-form">
                            <a href="{{ route('company-setting.edit',1) }}" class="btn btn-theme btn-sm"><i class="fas fa-edit"></i>Edit Company Setting</a>
                     </div>
                    </div>
    
                    </div>
                </div>
            </div>
        </div>

@endsection