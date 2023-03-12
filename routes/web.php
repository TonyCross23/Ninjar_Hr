<?php

use Laragear\WebAuthn\WebAuthn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CompanySettingController;




Auth::routes(['register' => true]);

// WebAuthn Routes
WebAuthn::routes();

Route::middleware('auth')->group(function(){
    Route::get('/',[PageController::class,'home'])->name('home');

    // employee
    Route::resource('employee', EmployeeController::class);

    // Datatable
    Route::get('employee/datatable/ssd',[EmployeeController::class,'ssd'])->name('ssd');

    // profile
    Route::get('profile',[ProfileController::class,'index'])->name('profile.prfile');

      // department
      Route::resource('department', DepartmentController::class);

      //Department Datatable
      Route::get('department/datatable/ssd',[DepartmentController::class,'ssd'])->name('ssd');

       // role
       Route::resource('role', RoleController::class);

       //Role Datatable
       Route::get('role/datatable/ssd',[RoleController::class,'ssd'])->name('ssd');

           // permission
           Route::resource('permission', PermissionController::class);

           //permission Datatable
           Route::get('permission/datatable/ssd',[PermissionController::class,'ssd'])->name('ssd');

              // Company Setting 
      Route::resource('company-setting', CompanySettingController::class)->only(['edit','update','show']);
});
