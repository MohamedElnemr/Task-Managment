<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ManagerResource;
use App\Models\Manager;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use GuzzleHttp\Client;
use Infobip\Api\SendSmsApi;
use Infobip\Configuration;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;


class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use ApiResponse ;


    public function all_manager_permission(Request $request)
    {
        // $user =User::find($request->id);
        $user =auth()->user();
        if ($user->can('list_managers'))
        {
            $manager = Manager::get();
            $empResource = ManagerResource::collection($manager);
            if(count($manager) > 0){
                return $this->sendJson($empResource);
            }
            throw new \App\Exceptions\NotFoundException;
        }else{
            throw new \App\Exceptions\NotAuthorizeException;
             }

    }



    public function addManager_permission(Request $request)
    {

        // $user =User::find($request->id);

        $user =auth()->user();

        if ($user->can('Add_manager'))
        {
            $request->validate([
                'section' => 'required',
                'join_date' => 'required',
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'gender' => 'required',
            ]);



                        $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => $request->password,
                        'gender' => $request->gender,
                        ]);

                        $manager = Manager::create([
                        'section' => $request->section,
                        'join_date' => $request->join_date,
                        'user_id' => $user->id,
                        ]);

                        $user->assignRole('Manager');

                        $managerResource = new ManagerResource($manager);

                        if ($manager) {
                            return $this->sendJson($managerResource);
                        }
                        throw new \App\Exceptions\NotFoundException;
        }else{
            throw new \App\Exceptions\NotAuthorizeException;
             }

    }


    public function assign_manager_to_organization(Request $request)
    {

                // $user =User::find($request->id);
                $user =auth()->user();


                if ($user->can('Add_manager')) {
                    $organization_id = Organization::find($request->organization);
                    if ($organization_id) {




                        $organization_id->manager_id= $request->managerId;
                        $organization_id->save();

                    //dd($organization_id);


                        return True;
                    } else {
                        throw new \App\Exceptions\NotFoundOrganization;

                    }
                }else{
                    throw new \App\Exceptions\NotAuthorizeException;

                     }

    }


    // public function get_user_from_another_project_blog(Request $request)
    // {

    //     // $client = new Client(['base_url' =>'http://127.0.0.1:8080']);
    //     // $responce = $client->request('GET', '/api/users');


    //     $client = new Client();
    //     $responce = $client->request('GET', 'http://127.0.0.1:8080/api/users');
    //     return $responce->getBody();

    // }




    // public function allManager()
    // {
    //     $manager = Manager::get();
    //     $empResource = ManagerResource::collection($manager);
    //     if(count($manager) > 0){
    //         return $this->sendJson($empResource);
    //     }
    //     throw new \App\Exceptions\NotFoundException;
    // }



    // public function addManager(Request $request)
    // {

    //     $request->validate([
    //         'section' => 'required',
    //         'join_date' => 'required',
    //         'name' => 'required',
    //         'email' => 'required',
    //         'password' => 'required',
    //         'gender' => 'required',
    //     ]);



    //                 $user = User::create([
    //                 'name' => $request->name,
    //                 'email' => $request->email,
    //                 'password' => $request->password,
    //                 'gender' => $request->gender,
    //                 ]);

    //                 $manager = Manager::create([
    //                 'section' => $request->section,
    //                 'join_date' => $request->join_date,
    //                 'user_id' => $user->id,
    //                 ]);

    //                 $managerResource = new ManagerResource($manager);

    //                 if ($manager) {
    //                     return $this->sendJson($managerResource);
    //                 }
    //                 throw new \App\Exceptions\NotFoundException;
    // }





    // public function permission_name(Request $request)
    // {

    //     // $manager = Manager::find($request->manager_id);
    //     // $user = User::find($manager->user_id);
    //     // $user =User::find($request->id);
    //     $user =User::first();
    //     $role1 = Role::where('name','Manager')->first();
    //     dd($role1->getPermissionNames());

    // }



    // public function all_managers()
    // {
    //     $users_has_role_manager = User::role('Manager')->get();
    //     return $users_has_role_manager;
    // }

    // public function add_role_to_user(Request $request)
    // {
    //     $manager = Manager::find($request->manager_id);
    //     $user = User::find($manager->user_id);

    //     $role1 = Role::where('name','Manager')->first();
    //     $user->assignRole($role1);

    //     if ($user->hasRole('Manager'))
    //     {
    //         return $user;
    //     }
    //     throw new \App\Exceptions\NotFoundException;

    // }


    // public function check_manager_has_role(Request $request)
    // {
    //     $manager = Manager::find($request->manager_id);
    //     $user = User::find($manager->user_id);

    //     if ($user->hasRole('Manager'))
    //     {
    //         // $managers = Manager::get();
    //         // return $managers;
    //         return $user;
    //     }

    //     throw new \App\Exceptions\NotFoundException;
    // }


    // public function check_user_has_role(Request $request)
    // {
    //     $user =User::find($request->id);
    //     // $user =User::first();
    //     // $user =User::find(3);
    //     if ($user->hasRole('Manager'))
    //     {
    //         dd('Yes');
    //     }else{
    //         dd('No');

    //          }


    // }

    // public function check_user_has_permission(Request $request)
    // {
    //     $user =User::find($request->id);
    //     // $user =User::first();
    //     // $user =User::find(3);
    //     if ($user->can('delete_employee'))
    //     {
    //         dd('Yes');
    //     }else{
    //         dd('No');

    //          }


    // }


    // public function remove_role_manager(Request $request)
    // {
    //     $manager = Manager::find($request->manager_id);
    //     $user = User::find($manager->user_id);
    //     $user->removeRole('Manager');

    //     if ($user->hasRole('Manager'))
    //     {
    //         return 'Not Deleted'. $user;
    //     }else{
    //         $user_has_role_manager = User::role('Manager')->get();
    //         return $user_has_role_manager;
    //     }

    //     throw new \App\Exceptions\NotFoundException;
    // }





}
