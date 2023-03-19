<?php


use Laragear\WebAuthn\WebAuthn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AttendanceScanController;
use App\Http\Controllers\CompanySettingController;
use App\Http\Controllers\ChackinChackoutController;

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

    // chackin-chackout
    Route::get('chackin-chackout',[ChackinChackoutController::class,'chackinChackout']);
    Route::post('chackin-chackout/store',[ChackinChackoutController::class,'chackinchatoutstore']);

    // qrcode
    Route::get('/qrcode', [QrCodeController::class, 'index']);


      // department
      Route::resource('department', DepartmentController::class);

      //Department Datatable
      Route::get('department/datatable/ssd',[DepartmentController::class,'ssd'])->name('ssd');

         // attendance
         Route::resource('attendance', AttendanceController::class);

         //attendance Datatable
         Route::get('attendance/datatable/ssd',[AttendanceController::class,'ssd'])->name('ssd');

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

      // attendance-scan 
      Route::get('attendance-scan',[AttendanceScanController::class,'scan'])->name('attendance.scan');
      Route::post('attendance-scan/store',[AttendanceScanController::class,'scanstore']);
});
