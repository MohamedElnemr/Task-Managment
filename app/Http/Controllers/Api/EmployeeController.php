<?php

namespace App\Http\Controllers\API;

use App\Models\Task;
use App\Models\User;
use App\Models\Manager;
use App\Models\Employee;
use App\Models\UserType;
use App\Models\Membership;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use App\Http\Resources\EmployeeResource;
use App\Http\Controllers\Controller;
use Dotenv\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class EmployeeController extends Controller
{
    use ApiResponse ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test()
    {
        return 'test';
    }


    public function allEmployees(Request $request)
    {

        // $user =User::find($request->id);
        $user =auth()->user();

        if ($user->can('list_employees'))
        {
            $emp = Employee::all();
            $empResource = EmployeeResource::collection($emp);
            if(count($emp) > 0){
                return $this->sendJson($empResource);
            }else{
                throw new \App\Exceptions\NotFoundException;
        }

             }

             throw new \App\Exceptions\NotAuthorizeException;
    }

    public function addEmployee(Request $request)
    {

        // $user =User::find($request->id);
        $user =auth()->user();

        if ($user->can('Add_employee'))
        {

            $organization_id = Organization::find($request->organization);
            if ($organization_id) {
                $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'gender' => $request->gender,
                ]);

                $emp = Employee::create([
                'address' => $request->address,
                'education' => $request->education,
                'phone_no' => $request->phone_no,
                'user_id' => $user->id,
                // 'organization_id' => $organization_id->id,
                'organization_id' => $request->organization,
            ]);
            $user->assignRole('Employee');

                $empResource = new EmployeeResource($emp);

                if ($emp) {
                    return $this->sendJson($empResource);
                }
            }else{
                throw new \App\Exceptions\NotFoundOrganization;
            }
            throw new \App\Exceptions\FaildCreateException;
        }else{
            throw new \App\Exceptions\NotAuthorizeException;

             }

    }



    public function show(Request $request)
    {
        $user =auth()->user();
        if ($user->can('show_employee_id'))
        {
            $emp = Employee::find($request->user_id);
            if($emp){
                return $this->sendJson(new EmployeeResource($emp));
               }
                throw new \App\Exceptions\NotFoundException;
        }else{
            throw new \App\Exceptions\NotAuthorizeException;

             }
    }




    public function destroy(Request $request)
    {
        // $user =User::find($request->id);
        $user =auth()->user();

        if ($user->can('delete_employee'))
        {
            Employee::destroy($request->user_id);
            User::destroy($request->id);
        }else{
            throw new \App\Exceptions\NotAuthorizeException;

             }
    }



    public function update(Request $request)
    {

        // $user =User::find($request->id);
        $user =auth()->user();
        dd($user);
        if ($user->can('list_employees'))
        {
            $request->validate([
                'address' => 'required',
                'education' => 'required',
                'phone_no' => 'required',
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'gender' => 'required',
            ]);

            $emp = Employee::find($request->user_id);
            $user = User::find($emp->user_id);
            $emp->update($request->all());

            $user->update($request->all());

            $user_new = new EmployeeResource ($emp);
            return $user_new;
        }else{
            throw new \App\Exceptions\NotAuthorizeException;

             }

    }


    public function Upload(Request $request)
    {

        if ($file = $request->file('file')) {

            $destinationPath = 'uploads';
            $file->move($destinationPath, $file->getClientOriginalName());
            return response()->json([
                "success" => true,
                "message" => "File Successfully Uploaded",
                "file" => $file,
            ]);
        }

    }


    public function assign_employee_to_organization(Request $request)
    {

                // $user =User::find($request->id);
                $user =auth()->user();


                if ($user->can('Add_employee')) {
                    $organization_id = Organization::find($request->organization);
                    if ($organization_id) {



                        $employee_id = Employee::find($request->eployee);
                        $employee_id->organization_id= $request->organization;
                        $employee_id->save();

                    //dd($organization_id);


                        return True;
                    } else {
                        throw new \App\Exceptions\NotFoundOrganization;

                    }
                }else{
                    throw new \App\Exceptions\NotAuthorizeException;

                     }

    }







    // public function index($id)
    // {

    //     // $test = User::where('id',$id)->with('User_type')->first();
    //     // dd($test) ;

    //     // $test = User::where('id',$id)->with('employee')->first();
    //     // dd($test) ;

    //     // $test= Organization::where('id',$id)->with('Manager')->first();
    //     // dd($test);

    //     // $test= Organization::where('id',$id)->with('Employees')->first();
    //     // dd($test);


    //     // $test= Task::where('id',$id)->with('Manager')->first();
    //     // dd($test);

    //     // $test= Task::where('id',$id)->with('employee')->first();
    //     // dd($test);

    //     // $test= User::where('id',$id)->with('Manager')->first();
    //     // dd($test);

    //     // $test= UserType::where('id',$id)->with('Users')->first();
    //     // dd($test);

    //     // $test= Employee::where('id',$id)->with('User')->first();
    //     // dd($test);

    //     // $test= Employee::where('id',$id)->with('Organization')->first();
    //     // dd($test);

    //     // $test= Employee::where('id',$id)->with('Tasks')->first();
    //     // dd($test);

    //     // $test= Manager::where('id',$id)->with('User')->first();
    //     // dd($test);

    //     // $test= Manager::where('id',$id)->with('membership')->first();
    //     // dd($test);

    //     // $test= Manager::where('id',$id)->with('Organizations')->first();
    //     // dd($test);

    //     // $test= Manager::where('id',$id)->with('Tasks')->first();
    //     // dd($test);

    //     // $test= Task::where('id',$id)->with('Employee')->first();
    //     // dd($test);

    //     // $test= Task::where('id',$id)->with('Manager')->first();
    //     // dd($test);

    //     // $test= Task::where('id',$id)->with('Organization')->first();
    //     // dd($test);

    // }


    // public function get_first()
    // {
    //     $emp=Employee::first();
    //    if($emp){
    //     return $this->sendJson(new EmployeeResource($emp));
    //    }
    //    throw new \App\Exceptions\NotFoundException;
    // }
}
