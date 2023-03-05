<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StorePermission;
use App\Http\Requests\UpdatePermission;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    public function index (){
        return view('permission.index');
    }

    public function ssd (Request $request){
        $permissions = Permission::query();
        return Datatables::of($permissions)
    
        ->addColumn('action',function($each){
            $edit_icon = '<a href=" '. route('permission.edit',$each->id) .'  " class="text-warning me-2"><i class="fas fa-edit"></i></a>';
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

        return view ('permission.create');
    }

    public function store (StorePermission $request){

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();

        return redirect()->route('permission.index')->with('create','Permission is Successfully Create');
    }

    // edit page 
    public function edit ($id) {
        $permissions = Permission::findOrFail($id);
        return view('permission.edit',compact('permissions'));
    }

    // update 
    public function update ($id, UpdatePermission $request){
            $permission = Permission::findOrFail($id);
            $permission->name = $request->name;
            $permission->update();

            return redirect()->route('permission.index')->with('update','Permission is Successfully Updated');
    }

    // department delete
    public function destroy ($id){
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return 'Success';
    }
}
