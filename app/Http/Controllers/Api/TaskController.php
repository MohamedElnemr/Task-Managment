<?php

namespace App\Http\Controllers\API;

use App\Models\Organization;
use App\Models\Task;
use App\Models\Manager;
use App\Models\Membership;
use App\Models\Employee;
use App\Models\User;
use App\Models\UserType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\ApiDesignTrait;
use App\Http\Traits\ApiResponse;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use ApiDesignTrait;
    use ApiResponse;

    public function index()
    {
        $task = Task::get();
        if(count($task) > 0){
            return $this->ApiResponse(200, 'Get all Tasks', null, $task);
        }
        throw new \App\Exceptions\NotFoundException();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function test($id)
    {
        // $test = User::where('id',$id)->with('User_type')->first();
        // dd($test) ;

        // $test = User::where('id',$id)->with('employee')->first();
        // dd($test) ;

        // $test= Organization::where('id',$id)->with('Manager')->first();
        // dd($test);

        // $test= Organization::where('id',$id)->with('Employees')->first();
        // dd($test);


        // $test= Task::where('id',$id)->with('Manager')->first();
        // dd($test);

        // $test= Task::where('id',$id)->with('employee')->first();
        // dd($test);

        // $test= User::where('id',$id)->with('Manager')->first();
        // dd($test);

        // $test= UserType::where('id',$id)->with('Users')->first();
        // dd($test);

        // $test= Employee::where('id',$id)->with('User')->first();
        // dd($test);

        // $test= Employee::where('id',$id)->with('Organization')->first();
        // dd($test);

        // $test= Employee::where('id',$id)->with('Tasks')->first();
        // dd($test);

        // $test= Manager::where('id',$id)->with('User')->first();
        // dd($test);

        // $test= Manager::where('id',$id)->with('membership')->first();
        // dd($test);

        // $test= Manager::where('id',$id)->with('Organizations')->first();
        // dd($test);

        // $test= Manager::where('id',$id)->with('Tasks')->first();
        // dd($test);

        // $test= Task::where('id',$id)->with('Employee')->first();
        // dd($test);

        // $test= Task::where('id',$id)->with('Manager')->first();
        // dd($test);

        // $test= Task::where('id',$id)->with('Organization')->first();
        // dd($test);














    }
}
