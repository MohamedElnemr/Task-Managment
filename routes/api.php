<?php

use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\API\ManagerController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\AddPermissionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\GoogleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test/{id}',[TaskController::class,'test']);
Route::get('/allTasks',[TaskController::class,'index']);

Route::middleware('auth:sanctum')->group(function () {


    // Employee Routes
    Route::post('/all-employees',[EmployeeController::class,'allEmployees']);
    Route::post('add_employee',  [EmployeeController::class, 'addEmployee']);
    Route::post('/employee',[EmployeeController::class,'show']);
    Route::post('/update',[EmployeeController::class,'update']);
    Route::post('/delete-employee',[EmployeeController::class,'destroy']);
    Route::post('/assign-employee-to-organization',[EmployeeController::class,'assign_employee_to_organization']);



    // Manager Routes
    Route::post('/all-manager-permission',[ManagerController::class,'all_manager_permission']);
    Route::post('/add-manager-permission',[ManagerController::class,'addManager_permission']);
    Route::post('/assign-manager-to-organization',[ManagerController::class,'assign_manager_to_organization']);




});


// Auth Routes
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login'])->name('login');


// Google Routes
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);







// Route::post('/uploud-image-file',[EmployeeController::class,'Upload']);
// Route::get('/test',[EmployeeController::class,'test']);
// Route::get('organizations',  [OrganizationController::class, 'getAllOrganization']);
// Route::get('get_first',  [EmployeeController::class, 'get_first']);
// Route::post('/all-managers',[ManagerController::class,'allManager']);
// Route::post('/add-manager',[ManagerController::class,'addManager']);
// Route::post('/assign-manager',[ManagerController::class,'assign_manager']);
// Route::post('/check-manager-has-role',[ManagerController::class,'check_manager_has_role']);
// Route::post('/add-Permission',[AddPermissionController::class,'add_permission']);
// Route::post('/remove-role-manager',[ManagerController::class,'remove_role_manager']);
// Route::post('/all-manager',[ManagerController::class,'all_managers']);
// Route::post('/add-role',[ManagerController::class,'add_role_to_user']);
// Route::post('/Check-user-has-role',[ManagerController::class,'check_user_has_role']);
// Route::post('/Check-user-has-permission',[ManagerController::class,'check_user_has_permission']);
// Route::post('/permission-name',[ManagerController::class,'permission_name']);
// Route::get('/get-user-from-another-project-blog',[ManagerController::class,'get_user_from_another_project_blog']);
// Route::post('/test-Helper',[AuthController::class,'test']);
// Route::post('/test2',[AuthController::class,'test2']);
// Route::post('/send-sms',[SMSController::class,'send_sms']);
