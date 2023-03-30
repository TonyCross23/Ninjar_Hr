<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\CompanySetting;
use App\Models\ChackinChackout;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class MyAttendanceController extends Controller
{
    //my attendance table
    public function ssd (Request $request){

        $attendances = ChackinChackout::with('employee')->where('user_id', auth()->user()->id);

        if($request->month){
            $attendances = $attendances->whereMonth('date', $request->month);
        }

        if($request->year){
            $attendances = $attendances->whereYear('date', $request->year);
        }
        return Datatables::of($attendances)

        ->filterColumn('employee_name', function ($query, $keyword) {
            $query->whereHas('employee', function ($q1) use ($keyword) {
                $q1->where('name', 'like', '%' . $keyword . '%');
            });
        })

        ->addColumn('employee_name',function($each){
            return $each->employee ? $each->employee->name : '-';
        })
    
      
        ->addColumn('plus-icon',function($each){
            return null;
        })
        ->rawColumns([])
        ->make(true);
    }

    public function overviewTable(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $startOfMonth = $year . '-' . $month . '-01';
        $endOfMonth = Carbon::parse($startOfMonth)->endOfMonth()->format('Y-m-d');

        $employees = User::orderBy('employee_id')->where('id', auth()->user()->id)->get();
        $company_setting = CompanySetting::findOrFail(1);
        $periods = new CarbonPeriod($startOfMonth, $endOfMonth);
        $attendances = ChackinChackout::whereMonth('date', $month)->whereYear('date', $year)->get();
        return view('components.attendances_overview_table', compact('employees', 'company_setting', 'periods', 'attendances'))->render();
    }
}
