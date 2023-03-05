<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreDepartment;
use App\Http\Requests\UpdateDepartment;


class DepartmentController extends Controller
{
    public function index (){
        return view('department.index');
    }

    public function ssd (Request $request){
        $departments = Department::query();
        return Datatables::of($departments)
    
        ->addColumn('action',function($each){
            $edit_icon = '<a href=" '. route('department.edit',$each->id) .'  " class="text-warning me-2"><i class="fas fa-edit"></i></a>';
            $delete_icon = '<a href="#" class="text-danger delete-btn ms-3" data-id=" '.$each->id.' " ><i class="fas fa-trash-alt"></i></a>';
         

            
            return '<span class="action-icon">'. $edit_icon . $delete_icon .'</span>';
        })
        ->addColumn('plus-icon',function($each){
            return null;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    // create Department page
    public function create () {

        return view ('department.create');
    }

    public function store (StoreDepartment $request){

       

        $department = new Department();
        $department->title = $request->title;
        $department->save();

        return redirect()->route('department.index')->with('create','Department is Successfully Create');
    }

    // edit page 
    public function edit ($id) {
        $department = Department::findOrFail($id);
        return view('department.edit',compact('department'));
    }

    // update 
    public function update ($id, UpdateDepartment $request){
            $department = Department::findOrFail($id);
            $department->title = $request->title;
            $department->update();

            return redirect()->route('department.index')->with('update','Department is Successfully Updated');
    }

    // department delete
    public function destroy ($id){
        $department = Department::findOrFail($id);
        $department->delete();

        return 'Success';
    }
}
