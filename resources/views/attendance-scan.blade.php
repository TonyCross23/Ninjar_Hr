@extends('layouts.app')
@section('title','Attendance Scan')

@section('content')

         <div class="container">
            <div class="card mb-0">
                <div class="card-body text-center">
                        <img src="{{ asset('image/scan.png') }}" class="mt-0" width="240px">
                        <p class="text-muted">Employee Attendance Qr Scan</p>
                        {{-- <a href="" class="btn btn-theme btn-sm">Scan</a> --}}

                        <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#exampleModal">
                        Scan
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Qr Scan</h5>
                            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <video id="evideo" width="100%" height="250px"></video>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>

                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3 mt-2">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="" class="form-control select-month">
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
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="" class="form-control select-year">
                                    <option value="">-- Please Choose (Year) --</option>
                                    @for ($i = 0; $i < 5; $i++) <option value="{{now()->subYears($i)->format('Y')}}" @if(now()->
                                        format('Y') == now()->subYears($i)->format('Y')) selected @endif>
                                        {{now()->subYears($i)->format('Y')}}
                                        </option>
                                        @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-theme btn-sm btn-block search-btn"><i class="fas fa-search"></i> Search</button>
                        </div>
                    </div>
        
                    <h5>Payroll</h5>
                    <div class="payroll_table mb-4"></div>
            
                    <h5>Attendance Overview</h5>
                    <div class="attendance_overview_table mb-4"></div>
            
                    <h5>Attendance Records</h5>
                    <table class="table table-bordered Datatable mb-4" style="width:100%;">
                        <thead>
                            <th class="text-center no-sort no-search hidden"></th>
                            <th class="text-center">Employee</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Checkin Time</th>
                            <th class="text-center">Checkout Time</th>
                        </thead>
                    </table>
                </div>
            </div>

         </div>


@endsection
@section('script')
<script src="{{ asset('js/qr-scanner.umd.min.js') }}"></script>
<script>
  $(document).ready(function(){
            var videoElem = document.getElementById('evideo');
            const qrScanner = new QrScanner(videoElem, function(result){
                if(result){
                    $('#exampleModal').modal('hide');
                    qrScanner.stop();

                    $.ajax({
                        url: '/attendance-scan/store',
                        type: 'POST',
                        data: {"hash_value" : result},
                        success: function(res){
                            if(res.status == 'success'){
                                Toast.fire({
                                    icon: 'success',
                                    title: res.message
                                });
                            }else{
                                Toast.fire({
                                    icon: 'error',
                                    title: res.message
                                });
                            }
                        }
                    });
                }
            });
            
            $('#exampleModal').on('shown.bs.modal', function (event) {
                qrScanner.start();
            });

            $('#exampleModal').on('hidden.bs.modal', function (event) {
                qrScanner.stop();
            });

            var table = $('.Datatable').DataTable({
                ajax: '/my-attendance/datatable/ssd',
                columns: [
                    { data: 'plus-icon', name: 'plus-icon', class: 'text-center' },
                    { data: 'employee_name', name: 'employee_name', class: 'text-center' },
                    { data: 'date', name: 'date', class: 'text-center' },
                    { data: 'chackin_time', name: 'chackin_time', class: 'text-center' },
                    { data: 'chackout_time', name: 'chackout_time', class: 'text-center' },
                ],
                order: [[ 2, "desc" ]],
            });

            $('.select-month').select2({
                placeholder: '-- Please Choose (Month) --',
                allowClear: true,
             
            });

            $('.select-year').select2({
                placeholder: '-- Please Choose (Year) --',
                allowClear: true,
             
            });

            attendanceOverviewTable();

            function attendanceOverviewTable(){
                var month = $('.select-month').val();
                var year = $('.select-year').val();

                $.ajax({
                    url: `/my-attendance-overview-table?month=${month}&year=${year}`,
                    type: 'GET',
                    success: function(res){
                        $('.attendance_overview_table').html(res);
                    }
                });

                table.ajax.url(`/my-attendance/datatable/ssd?month=${month}&year=${year}`).load();
            }

            payrollTable();

                function payrollTable(){
                    var employee_name = $('.employee_name').val();
                    var month = $('.select-month').val();
                    var year = $('.select-year').val();

                    $.ajax({
                        url: `/my-payroll-table?month=${month}&year=${year}`,
                        type: 'GET',
                        success: function(res){
                            $('.payroll_table').html(res);
                        }
                    });
                }

            $('.search-btn').on('click', function(event){
            event.preventDefault();
            attendanceOverviewTable();
            payrollTable();
        });
    });
</script>

@endsection