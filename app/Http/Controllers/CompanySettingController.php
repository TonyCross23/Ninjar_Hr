<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCompanySetting;
use App\Models\CompanySetting;
use Illuminate\Http\Request;

class CompanySettingController extends Controller
{
    //company setting show
    public function show ($id){
        $setting = CompanySetting::findOrFail($id);

        return view('company-setting.show',compact('setting'));
    }

    // company setting edit
    public function edit ($id) {

        $setting = CompanySetting::findOrFail($id);

        return view('company-setting.edit',compact('setting')); 
    }

    // company setting update
    public function update ($id , UpdateCompanySetting $request) {

        $setting = CompanySetting::findOrFail($id);
        $setting->company_name = $request->company_name;
        $setting->company_email = $request->company_email;
        $setting->company_phone = $request->company_phone;
        $setting->company_address = $request->company_address;
        $setting->office_start_time = $request->office_start_time;
        $setting->office_end_time = $request->office_end_time;
        $setting->break_start_time = $request->break_start_time;
        $setting->break_end_time = $request->break_end_time;
        $setting->update();

        return redirect()->route('company-setting.show',$setting->id)->with('update','Company Setting is Successfully Updated');
    }
}
