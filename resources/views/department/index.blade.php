@extends('layouts.app')
@section('title','Department')

@section('content')

@can('Create_Department')    
    <div class=" my-3">
        <a href="{{ route('department.create') }}" class="btn btn-theme btn-sm"><i class="fas fa-plus-circle"></i> Create Department</a>
    </div>
@endcan

    <div class="row">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <table class="table table-bordered Datatable" style="width:100%;">
                    <thead>
                        <th class="text-center no-sort no-search"></th>
                        <th class="text-center ">Title</th>
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
                "serverSide": true,
                "mark": true,
                ajax: '/department/datatable/ssd',
        columns: [
            { data: 'plus-icon', name: 'plus-icon' , class:'text-center' },
            { data: 'title', name: 'title' , class:'text-center' },
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
                            url: `/department/${id}`,
                        }).done(function( res ) {
                           table.ajax.reload();
                    });
                }
            });
        });
 });
    </script>
@endsection
