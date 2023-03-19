
@extends('layouts.app')
@section('title','Attendance Scan')

@section('content')

         <div class="container">
            <div class="card">
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

    });
</script>

@endsection