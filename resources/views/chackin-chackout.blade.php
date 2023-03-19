
@extends('layouts.app_plain')
@section('title','Chack In - Chack Out')

@section('content')

        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="card col-md-6">
                <div class="card-body">

                    <div class="text-center">
                        <div class="visible-print text-center">
                            <div class="visible-print text-center">
                                <div class="my-5 text-center">
                                    <h5>QR Code</h5>
                                    <img
                                        src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(240)->generate($hash_value)) !!} ">
                                    <p class="text-muted">Please scan QR to chack in or chackout</p>
                                </div>
                            </div>
                        </div>
                    </div>

                  <div class="text-center">
                    <h5>Pin Code</h5>
                    <input type="text" name="mycode" id="pincode-input1">
                    <p class="text-muted">Enter Your Pin Code</p>
                  </div>
                </div>
            </div>
        </div>

@endsection
@section('extra_script')

<script>
    $(document).ready(function(){
        $('#pincode-input1').pincodeInput({inputs:6,complete:function(value, e, errorElement){
          console.log("code entered: " + value);

          $.ajax ({
            url : '/chackin-chackout/store',
            type : 'POST',
            data : { "pin_code" : value },
            success : function(res){

                            if(res.status == 'success'){
                            Toast.fire({
                            icon: 'success',
                            title: res.message,
                            })
                        }else{
                            Toast.fire({
                            icon: 'error',
                            title: res.message,
                            });
                  }
                  $('.pincode-input-container .pincode-input-text').val("");
            
               }
          });

        }});
              $('.pincode-input-text').first().select().focus();
    });
</script>

@endsection