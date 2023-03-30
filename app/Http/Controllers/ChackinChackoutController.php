<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ChackinChackout;
use Illuminate\Support\Facades\Hash;

class ChackinChackoutController extends Controller
{
    //chakin-out
    public function chackinChackout () {

        $hash_value = Hash::make(date('Y-m-d'));
        return view('chackin-chackout',compact('hash_value'));
    }

    // chackin 
    public function chackinchatoutstore (Request $request) {
        
        if(now()->format('D')  == "Sat"  ||  now()->format('D') == "Sun"){
            return [
                'status' => 'fail',
                'message' => 'Today is off day.'
         ];
        }
       
        $user = User::where('pin_code',$request->pin_code)->first();

        if(!$user){
            return [
                'status' => 'fail',
                'message' => 'Pin Code is wrong'
         ];
        }

            $chackin_chackout_data = ChackinChackout::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'date' => now()->format('Y-m-d')
                ]
            );

            if(!is_null($chackin_chackout_data->chackin_time) && !is_null($chackin_chackout_data->chackout_time) ){
                return [
                    'status' => 'fail',
                    'message' => 'Already Chack in and Chack out today .'
             ];
            }

            if(is_null($chackin_chackout_data->chackin_time)){
                $chackin_chackout_data->chackin_time = now();
                $message = 'Successfully Chack In ' . now();
            }else{
                if(is_null($chackin_chackout_data->chackout_time)){
                    $chackin_chackout_data->chackout_time = now();
                    $message = 'Successfully Chack Out ' . now();
                }
            }


        $chackin_chackout_data->update();
        return [
            'status' => 'success',
            'message' => $message,
     ];
     }

}
