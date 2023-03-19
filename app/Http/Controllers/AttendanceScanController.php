<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChackinChackout;
use Illuminate\Support\Facades\Hash;

class AttendanceScanController extends Controller
{
    //scan page
    public function scan () {
        return view('attendance-scan');
    }

    // scan store 
    public function scanstore (Request $request) {
        if(now()->format('D') == 'Sat' || now()->format('D') == 'Sun'){
            return [
                'status' => 'fail',
                'message' => 'Today is off day.',
            ];
        }
        
        if(!Hash::check(date('Y-m-d'), $request->hash_value)){
            return [
                'status' => 'fail',
                'message' => 'QR code is invalid.',
            ];
        }

        $user = auth()->user();

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

