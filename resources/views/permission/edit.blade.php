@extends('layouts.app')

@section('title','Edit Permission')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('permission.update',$permissions->id) }}" method="post" id="edit-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-outline mb-4">
                            <input type="text" id="permission_name" name="name"  class="form-control" value="{{ $permissions->name }}">
                            <label for="permission_name" class="form-label">Name</label>
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
    {!!JsValidator::formRequest('App\Http\Requests\UpdatePermission', '#edit-form');!!}
    <script>
        $(document).ready(function(){
            
        });
    </script>
@endsection
