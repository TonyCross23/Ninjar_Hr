<?php

namespace Database\Seeders;

use App\Models\CompanySetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // company setting seeder
        if(!CompanySetting::exists()){
            $company_setting = new CompanySetting();
            $company_setting -> company_name = 'Ninjar Company';
            $company_setting -> company_email = 'ninjar@gmail.com';
            $company_setting -> company_phone = '09751900301';
            $company_setting -> company_address = 'No.123 , Pyin Oo Lwin Tsh, Mandalay ';
            $company_setting -> office_start_time = '09:00:00';
            $company_setting -> office_end_time = '18:00:00';
            $company_setting -> break_start_time = '12:00:00';
            $company_setting -> break_end_time = '13:00:00';
            $company_setting -> save();
        }
    }
}
