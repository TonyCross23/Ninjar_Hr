@extends('layouts.app')
@section('title','Permission')

@section('content')

@can('Create_Permission')
    <div class=" my-3">
        <a href="{{ route('permission.create') }}" class="btn btn-theme btn-sm"><i class="fas fa-plus-circle"></i> Create Permission</a>
    </div>
@endcan

    <div class="row">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <table class="table table-bordered Datatable table-responsive" style="width:100%;">
                    <thead>
                        <th class="text-center no-sort no-search"></th>
                        <th class="text-center ">Name</th>
                        <th class="text-center no-sort">Action</th>
                        <th class="text-center hidden">Updated at</th>
    
                    </thead>
                </table>
            </div>
        </div>
    </div>
  
@endsection

@section('script')
    <script>
    $(document).ready(function(){
var table =  $('.Datatable').DataTable({
                "responsive":true,
                "processing": true,
                paginate:true,
                "serverSide": true,
                "mark": true,
                ajax: '/permission/datatable/ssd',
        columns: [
            { data: 'plus-icon', name: 'plus-icon' , class:'text-center' },
            { data: 'name', name: 'name' , class:'text-center' },
            { data: 'action', name: 'action' , class:'text-center pe' },
            { data: 'updated_at', name: 'updated_at' , class:'text-center' },
        ],
   
        order : [[3 , "desc"]],
        columnDefs: [
            {
                "targets": 3,
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
                            url: `/permission/${id}`,
                        }).done(function( res ) {
                           table.ajax.reload();
                    });
                }
            });
        });
 });
    </script>
@endsection
