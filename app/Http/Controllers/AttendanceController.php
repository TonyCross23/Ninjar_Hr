<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\CheckinCheckout;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\CompanySetting;
use App\Models\ChackinChackout;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreAttendance;
use App\Http\Requests\UpdateAttendance;

class AttendanceController extends Controller
{
    public function index (){

        if(!auth()->user()->can('View_Attendance')){
            abort(404);
        }

        return view('attendance.index');
    }

    public function ssd (Request $request){

        if(!auth()->user()->can('View_Attendance')){
            abort(404);
        }

        $attendances = ChackinChackout::query();
        return Datatables::of($attendances)

        ->filterColumn('employee_name', function ($query, $keyword) {
            $query->whereHas('employee', function ($q1) use ($keyword) {
                $q1->where('name', 'like', '%' . $keyword . '%');
            });
        })

        ->addColumn('employee_name',function($each){
            return $each->employee ? $each->employee->name : '-';
        })
    
        ->addColumn('action',function($each){

            $edit_icon = '';
            $delete_icon = '';


            if(auth()->user()->can('Edit_Attendance')){
                $edit_icon = '<a href=" '. route('attendance.edit',$each->id) .'  " class="text-warning me-2"><i class="fas fa-edit"></i></a>';    
            }

            if(auth()->user()->can('Delete_Attendance')){
                $delete_icon = '<a href="#" class="text-danger delete-btn ms-3" data-id=" '.$each->id.' " ><i class="fas fa-trash-alt"></i></a>';
            }
         

            
            return '<span class="action-icon">'. $edit_icon . $delete_icon .'</span>';
        })
        ->addColumn('plus-icon',function($each){
            return null;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    // create Attendance page
    public function create () {

        if(!auth()->user()->can('Create_Attendance')){
            abort(404);
        }
        $employees = User::orderBy("employee_id")->get();
        return view ('attendance.create',compact('employees'));
    }

    public function store (StoreAttendance $request){

        if(!auth()->user()->can('Create_Attendance')){
            abort(404);
        }

        $attendance = new ChackinChackout();
        $attendance->user_id = $request->user_id;
        $attendance->date = $request->date;
        $attendance->chackin_time = $request->date . ' ' . $request->chackin_time;
        $attendance->chackout_time = $request->date . ' ' . $request->chackout_time;
        $attendance->save();

        return redirect()->route('attendance.index')->with('create','Attendance is Successfully Create');
    }

    // edit page 
    public function edit ($id) {

        if(!auth()->user()->can('Edit_Attendance')){
            abort(404);
        }
        $attendance = ChackinChackout::findOrFail($id);
        $employees = User::orderBy("employee_id")->get();
        return view('attendance.edit',compact('attendance','employees'));
    }

    // update 
    public function update ($id, UpdateAttendance $request){

        $attendance = ChackinChackout::findOrFail($id);

        if(!auth()->user()->can('Edit_Attendance')){
            abort(404);
        }
        $attendance->user_id = $request->user_id;
        $attendance->date = $request->date;
        $attendance->chackin_time = $request->date . ' ' . $request->chackin_time;
        $attendance->chackout_time = $request->date . ' ' . $request->chackout_time;
        $attendance->update();

        return redirect()->route('attendance.index')->with('update', 'Attendance is successfully updated.');
    }

    // attendance delete
    public function destroy ($id){

        if(!auth()->user()->can('Delete_Attendance')){
            abort(404);
        }
        $attendance = ChackinChackout::findOrFail($id);
        $attendance->delete();

        return 'Success';
    }

    // attendance over view
    public function overview (Request $request) {

        if(!auth()->user()->can('View_Attendance_Over')){
            abort(404);
        }

        return view('attendance.over-view');
    }

    public function overviewTable(Request $request)
    {
        if(!auth()->user()->can('View_Attendance_Over')){
            abort(404);
        }

        $month = $request->month;
        $year = $request->year;
        $startOfMonth = $year . '-' . $month . '-01';
        $endOfMonth = Carbon::parse($startOfMonth)->endOfMonth()->format('Y-m-d');

        $employees = User::orderBy('employee_id')->where('name', 'like', '%' . $request->employee_name . '%')->get();
        $company_setting = CompanySetting::findOrFail(1);
        $periods = new CarbonPeriod($startOfMonth, $endOfMonth);
        $attendances = ChackinChackout::whereMonth('date', $month)->whereYear('date', $year)->get();
             return view('components.attendances_overview_table', compact('employees', 'company_setting', 'periods', 'attendances'))->render();
    }
}
