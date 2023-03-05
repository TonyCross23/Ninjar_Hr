@extends('layouts.app')

@section('title','Edit Role')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('role.update',$role->id) }}" method="post" id="edit-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-outline mb-4">
                            <input type="text" id="role_name" name="name"  class="form-control" value="{{ $role->name }}">
                            <label for="role_name" class="form-label">Name</label>
                        </div>
                </div>
            </div>

            <label for="">Permission</label>
            <div class="row">                
                @foreach ($permissions as $permission)
                        <div class="col-md-3 col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="chatbox_{{ $permission->id }}" @if (in_array($permission->id , $old_permission))  checked  @endif>
                                <label class="form-check-label " for="chatbox_{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>
                        </div>
                @endforeach
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
    {!!JsValidator::formRequest('App\Http\Requests\UpdateRole', '#edit-form');!!}
    <script>
        $(document).ready(function(){
            
        });
    </script>
@endsection
