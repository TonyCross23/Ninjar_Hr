@extends('layouts.app')
@section('title','Attendance')

@section('content')

@can('Create_Department')    
    <div class=" my-3">
        <a href="{{ route('attendance.create') }}" class="btn btn-theme btn-sm"><i class="fas fa-plus-circle"></i> Create Attendance</a>
    </div>
@endcan

    <div class="row">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <table class="table table-bordered Datatable table-responsive" style="width:100%;">
                    <thead>
                        <th class="text-center no-sort no-search"></th>
                        <th class="text-center ">Employee</th>
                        <th class="text-center ">Date</th>
                        <th class="text-center ">Chackin Time</th>
                        <th class="text-center ">Chackout Time</th>
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
                ajax: '/attendance/datatable/ssd',
        columns: [
            { data: 'plus-icon', name: 'plus-icon' , class:'text-center' },
            { data: 'employee_name', name: 'employee_name' , class:'text-center' },
            { data: 'date', name: 'date' , class:'text-center' },
            { data: 'chackin_time', name: 'chackin_time' , class:'text-center' },
            { data: 'chackout_time', name: 'chackout_time' , class:'text-center' },
            { data: 'action', name: 'action' , class:'text-center pe' },
            { data: 'updated_at', name: 'updated_at' , class:'text-center' },
        ],
   
        order : [[6 , "desc"]],
        columnDefs: [
            {
                "targets": 6,
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
                            url: `/attendence/${id}`,
                        }).done(function( res ) {
                           table.ajax.reload();
                    });
                }
            });
        });
 });
    </script>
@endsection
