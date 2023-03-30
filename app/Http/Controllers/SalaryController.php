<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\User;
use App\Models\Salary;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreSalary;
use App\Http\Requests\UpdateSalary;


class SalaryController extends Controller
{
    public function index (){

        if(!auth()->user()->can('View_Salary')){
            abort(404);
        }
        return view('salary.index');
    }

    public function ssd (Request $request){

        if(!auth()->user()->can('View_Salary')){
            abort(404);
        }

        $salarys = salary::query();
        return Datatables::of($salarys)
        ->filterColumn('employee_name',function($query,$keyword){
            $query->whereHas('employee',function($q1) use ($keyword) {
                $q1->where('name', 'like', '%' . $keyword . '%');
            });
        })
    
        ->addColumn('employee_name',function($each){
            return $each->employee ? $each->employee->name : '-';
        })
        ->editColumn('month', function ($each) {
            return Carbon::parse('2021-' . $each->month . '-01')->format('M');
        })
        ->editColumn('amount', function ($each) {
            return number_format($each->amount);
        })
        ->addColumn('action',function($each){

            $edit_icon = '';
            $delete_icon = '';


            if(auth()->user()->can('Edit_Salary')){
                $edit_icon = '<a href=" '. route('salary.edit',$each->id) .'  " class="text-warning me-2"><i class="fas fa-edit"></i></a>';    
            }

            if(auth()->user()->can('Delete_Salary')){
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

    // create salary page
    public function create () {

        if(!auth()->user()->can('Create_Salary')){
            abort(404);
        }

        $employees = User::orderBy("employee_id")->get();
        return view ('salary.create',compact('employees'));
    }

    public function store (StoreSalary $request){

        if(!auth()->user()->can('Create_Salary')){
            abort(404);
        }

        $salary = new Salary();
        $salary->user_id = $request->user_id;
        $salary->month = $request->month;
        $salary->year = $request->year;
        $salary->amount = $request->amount;
        $salary->save();

        return redirect()->route('salary.index')->with('create','Salary is Successfully Create');
    }

    // edit page 
    public function edit ($id) {

        if(!auth()->user()->can('Edit_Salary')){
            abort(404);
        }
        $salary = Salary::findOrFail($id);
        $employees = User::orderBy("employee_id")->get();
        return view('salary.edit',compact('salary','employees'));
    }

    // update 
    public function update ($id, UpdateSalary $request){

        if(!auth()->user()->can('Edit_Salary')){
            abort(404);
        }
            $salary = Salary::findOrFail($id);
            $salary->user_id = $request->user_id;
            $salary->month = $request->month;
            $salary->year = $request->year;
            $salary->amount = $request->amount;
            $salary->update();

            return redirect()->route('salary.index')->with('update','Salary is Successfully Updated');
    }

    // salary delete
    public function destroy ($id){

        if(!auth()->user()->can('Delete_Salary')){
            abort(404);
        }
        $salary = Salary::findOrFail($id);
        $salary->delete();

        return 'Success';
    }
}
