<?php


use Laragear\WebAuthn\WebAuthn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MyPayrollController;
use App\Http\Controllers\MyProjectController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\MyAttendanceController;
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
        //  over view
        Route::get('attendance-overview', [AttendanceController::class,'overview'])->name('attendance.overview');
       Route::get('attendance-overview-table', [AttendanceController::class,'overviewTable']);
    
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
      Route::get('my-attendance/datatable/ssd',[MyAttendanceController::class,'ssd'])->name('ssd');
       Route::get('my-attendance-overview-table', [MyAttendanceController::class,'overviewTable']);

       // salary
       Route::resource('salary', SalaryController::class);
       //salary Datatable
       Route::get('salary/datatable/ssd',[SalaryController::class,'ssd'])->name('ssd');
 
      //  payroll
      Route::get('payroll',[PayrollController::class,'payroll'])->name('payroll');
      Route::get('payroll-table', [PayrollController::class,'payrollTable']);
      Route::get('my-payroll',[MyPayrollController::class,'ssd']);
      Route::get('my-payroll-table', [MyPayrollController::class,'payrollTable']);

        // project
        Route::resource('project', ProjectController::class);
        //project Datatable
        Route::get('project/datatable/ssd',[ProjectController::class,'ssd'])->name('ssd');
        Route::resource('my-project', MyProjectController::class)->only(['index','show']);
        Route::get('my-project/datatable/ssd', [MyProjectController::class,'ssd']);

});
