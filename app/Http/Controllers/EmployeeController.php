<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreEmployee;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateEmployee;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index (){

        if(!auth()->user()->can('View_Employee')){
            abort(404);
        }
        return view('employee.index');
    }

    public function ssd (Request $request){

        if(!auth()->user()->can('View_Employee')){
            abort(404);
        }

        $employees = User::with('department');
        return Datatables::of($employees)
        ->filterColumn('department_name',function($query , $keyword){
                $query->whereHas('department',function($q1) use($keyword) {
                    $q1->where('title', 'like' , '%' .$keyword. '%');
                });
        })
        ->editColumn('profile_img',function($each){
            return '<img src=" ' .$each->profile_img_path(). ' " class="profile-thumbnail"/><p class="my-1">' .$each->name. '</p>';
        })
        ->addColumn('department_name',function($each){
            return $each->department ? $each->department->title : '-';
        })
        ->editColumn('is_present',function($each){
            if($each->is_present == 1){
                return '<span class="badge badge-pill badge-success">Present</span>';
            }else{
                return '<span class="badge badge-pill badge-danger">Leave</span>';
            }
        })
        ->editColumn('updated_at',function($each){
            return Carbon::parse($each->updated_at)->format('Y-m-d H:i:s');
        })
        ->editColumn('role_name',function($each){
            $output = '';
            foreach ($each->roles as $role) {
                $output .= '<span class="badge badge-pill bg-primary">'.$role->name.'</span>';
            }
            return $output;
        })
        ->addColumn('action',function($each){

            $edit_icon = '';
            $info_icon = '';
            $delete_icon = '';


            if(auth()->user()->can('Edit_Employee')){
                $edit_icon = '<a href=" '. route('employee.edit',$each->id) .'  " class="text-warning"><i class="fas fa-edit"></i></a>';
            }

            if(auth()->user()->can('View_Employee')){
                $info_icon = '<a href=" '. route('employee.show',$each->id) .'  " class="text-info"><i class="fas fa-info-circle"></i></a>';               
            }

            if(auth()->user()->can('Edit_Employee')){
                $delete_icon = '<a href="#" class="text-danger delete-btn" data-id=" '.$each->id.' " ><i class="fas fa-trash-alt"></i></a>';    
            }
         

            
            return '<span class="action-icon">'. $edit_icon .  $info_icon . $delete_icon .'</span>';
        })
        ->addColumn('plus-icon',function($each){
            return null;
        })
        ->rawColumns(['department_name','profile_img','role_name','is_present','action'])
        ->make(true);
    }

    // create Employee page
    public function create () {

        if(!auth()->user()->can('Create_Employee')){
            abort(404);
        }
        $roles = Role::all();
        $departments = Department::orderBy('title')->get();
        return view ('employee.create',compact('roles','departments'));
    }

    public function store (StoreEmployee $request){

        if(!auth()->user()->can('Create_Employee')){
            abort(404);
        }

        $profile_img_name = null;

        if($request->hasFile('profile_img')){
            $profile_img_file = $request->file('profile_img');
            $profile_img_name = uniqid() . '-' .time() . '.' .$profile_img_file->getClientOriginalExtension();
             
            Storage::disk('public')->put('employee/' . $profile_img_name, file_get_contents($profile_img_file));
        }

        $employee = new User();
        $employee->employee_id = $request->employee_id;
        $employee->name = $request->name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->nrc_number = $request->nrc_number;
        $employee->gender = $request->gender;
        $employee->birthday = $request->birthday;
        $employee->address = $request->address;
        $employee->department_id = $request->department_id;
        $employee->date_of_join = $request->date_of_join;
        $employee->is_present = $request->is_present;
        $employee->profile_img = $profile_img_name;
        $employee->password = Hash::make($request->password);
        $employee->save();

        $employee->syncRoles($request->roles)->toArray();

        return redirect()->route('employee.index')->with('create','Employee is Successfully Create');
    }

    // edit page 
    public function edit ($id) {

        if(!auth()->user()->can('Edit_Employee')){
            abort(404);
        }
        $employee = User::findOrFail($id);
        $departments = Department::orderBy('title')->get();
        $roles = Role::all();
        $old_role = $employee->roles->pluck('id')->toArray();
        return view('employee.edit',compact('employee','departments','roles','old_role'));
    }

    // update 
    public function update ($id, UpdateEmployee $request){

        if(!auth()->user()->can('Edit_Employee')){
            abort(404);
        }
            $employee = User::findOrFail($id);

            $profile_img_name = $employee->profile_img;
            if($request->hasFile('profile_img')){
                Storage::disk('public')->delete('employee/' . $employee->profile_img);

                $profile_img_file = $request->file('profile_img');
                $profile_img_name = uniqid() . '-' .time() . '.' .$profile_img_file->getClientOriginalExtension();
                Storage::disk('public')->put('employee/' . $profile_img_name, file_get_contents($profile_img_file));
            }

            $employee->employee_id = $request->employee_id;
            $employee->name = $request->name;
            $employee->phone = $request->phone;
            $employee->email = $request->email;
            $employee->nrc_number = $request->nrc_number;
            $employee->gender = $request->gender;
            $employee->birthday = $request->birthday;
            $employee->address = $request->address;
            $employee->department_id = $request->department_id;
            $employee->date_of_join = $request->date_of_join;
            $employee->is_present = $request->is_present;
            $employee->profile_img = $profile_img_name;
            $employee->password = $request->password ? Hash::make($request->password) : $employee->password;
            $employee->update();

            $old_role = $employee->roles->pluck('id')->toArray();
            $employee->syncRoles($request->roles);
            return redirect()->route('employee.index')->with('update','Employee is Successfully Updated');
    }

    // employee info show page
    public function show ($id) {
        $employee = User::findOrFail($id);
        return view('employee.info',compact('employee'));
    }

    // employee delete
    public function destroy ($id){

        if(!auth()->user()->can('Delete_Employee')){
            abort(404);
        }
        $employee = User::findOrFail($id);
        $employee->delete();

        return 'Success';
    }
}
