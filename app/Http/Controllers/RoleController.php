<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRole;
use Yajra\Datatables\Datatables;
use App\Http\Requests\UpdateRole;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class RoleController extends Controller
{
    public function index (){

        if(!auth()->user()->can('View_Role')){
            abort(404);
        }
        return view('role.index');
    }

    public function ssd (Request $request){

        if(!auth()->user()->can('View_Role')){
            abort(404);
        }

        $departments = Role::query();
        return Datatables::of($departments)
    
        ->editColumn('permissions',function($each){
            $output = '';
            foreach ($each->permissions as $permission) {
                $output .= '<span class="badge badge-pill badge-success"> '.$permission->name.'</span>' ;
            };
            return $output;
        })
        ->addColumn('action',function($each){

            $edit_icon = '';
            $delete_icon = '';


            if(auth()->user()->can('Edit_Role')){
                $edit_icon = '<a href=" '. route('role.edit',$each->id) .'  " class="text-warning me-2"><i class="fas fa-edit"></i></a>';
            }

            if(auth()->user()->can('Delete_Role')){
                $delete_icon = '<a href="#" class="text-danger delete-btn ms-3" data-id=" '.$each->id.' " ><i class="fas fa-trash-alt"></i></a>';
            }
            
            return '<span class="action-icon">'. $edit_icon . $delete_icon .'</span>';
        })
        ->addColumn('plus-icon',function($each){
            return null;
        })
        ->rawColumns(['permissions','action'])
        ->make(true);
    }

    // create Department page
    public function create () {

        if(!auth()->user()->can('Create_Role')){
            abort(404);
        }
        $permissions = Permission::all();
        return view ('role.create',compact('permissions'));

 
    }

    public function store (StoreRole $request){

        if(!auth()->user()->can('Create_Role')){
            abort(404);
        }

        $role = new Role();
        $role->name = $request->name;
        $role->save();

        $role->givePermissionTo($request->permissions);

        return redirect()->route('role.index')->with('create','Role is Successfully Create');
    }

    // edit page 
    public function edit ($id) {

        if(!auth()->user()->can('Edit_Role')){
            abort(404);
        }
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $old_permission = $role->permissions->pluck('id')->toArray();
        return view('role.edit',compact('role','permissions','old_permission'));
    }

    // update 
    public function update ($id, UpdateRole $request){

        if(!auth()->user()->can('Edit_Role')){
            abort(404);
        }
            $role = Role::findOrFail($id);
            $role->name = $request->name;
            $role->update();

            $old_permission = $role->permissions->pluck('name')->toArray();
            $role->revokePermissionTo($old_permission);
            $role->givePermissionTo($request->permissions);

            return redirect()->route('role.index')->with('update','Role is Successfully Updated');
    }

    // department delete
    public function destroy ($id){

        if(!auth()->user()->can('Delete_Role')){
            abort(404);
        }
        $role = Role::findOrFail($id);
        $role->delete();

        return 'Success';
    }
}
