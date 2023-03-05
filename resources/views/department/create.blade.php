@extends('layouts.app')

@section('title','Create Department')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('department.store') }}" method="post" id="create-form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-outline mb-4">
                            <input type="text" id="department_title" name="title"  class="form-control">
                            <label for="department_title" class="form-label">Title</label>
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
    {!!JsValidator::formRequest('App\Http\Requests\StoreDepartment', '#create-form');!!}
    <script>
        $(document).ready(function(){

        });
    </script>
@endsection
