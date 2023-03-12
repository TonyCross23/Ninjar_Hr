@extends('layouts.app')
@section('title','Role')

@section('content')

@can('Create_Role')
    <div class=" my-2">
        <a href="{{ route('role.create') }}" class="btn btn-theme btn-sm"><i class="fas fa-plus-circle"></i> Create Role</a>
    </div>
@endcan

  
        <div class="card mb-3">
            <div class="card-body">
                <table class="table table-bordered Datatable table-responsive" style="width:100%;">
                    <thead>
                        <th class="text-center no-sort no-search"></th>
                        <th class="text-center ">Name</th>
                        <th class="text-center ">Permission</th>
                        <th class="text-center no-sort">Action</th>
                        <th class="text-center hidden">Updated at</th>
    
                    </thead>
                </table>
            </div>
        </div>

  
@endsection

@section('script')
    <script>
    $(document).ready(function(){
var table =  $('.Datatable').DataTable({
                responsive:true,
                paginate:true,
                "processing": true,
                "serverSide": true,
                "mark": true,
                ajax: '/role/datatable/ssd',
        columns: [
            { data: 'plus-icon', name: 'plus-icon' , class:'text-center' },
            { data: 'name', name: 'name' , class:'text-center' },
            { data: 'permissions', name: 'permission' , class:'text-center' },
            { data: 'action', name: 'action' , class:'text-center pe' },
            { data: 'updated_at', name: 'updated_at' , class:'text-center' },
        ],
   
        order : [[4 , "desc"]],
        columnDefs: [
            {
                "targets": 4,
                "visible": false,
              
            },
            {
                "targets": 0,
                "class" : "control",
                "orderable" :false
            },
            {
                "targets": 'no-sort',
                "orderable" : false
              
            },
            {
                "targets": 'no-search',
                "searchable" : false
              
            },
        ],
        "language": {
                    "paginate": {
                          "previous": "<i class='fas fa-arrow-left'></i>",
                          "next": "<i class='fas fa-arrow-right'></i>"
                    },
                    "processing": "<p class='my-2'>Loading...</p>",
                },
  
});

    $(document).on('click','.delete-btn',function(e){
        e.preventDefault();
        
        var id = $(this).data('id');

        swal({
                text: "Are you sure , you want to delete?",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) { 
                    $.ajax({
                            method: "DELETE",
                            url: `/role/${id}`,
                        }).done(function( res ) {
                           table.ajax.reload();
                    });
                }
            });
        });
 });
    </script>
@endsection
