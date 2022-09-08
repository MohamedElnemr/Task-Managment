<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponse;
use App\Models\Manager;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Resources\OrganizationResource;

class OrganizationController extends Controller
{
    //
    use ApiResponse;
    


    public function getAllOrganization(){

        $organizations = Organization::with('manager')->get();
        
        dd($organizations);


        if($organizations)
        {
            return $this->sendJson(new OrganizationResource($organizations));
        }
        throw new \App\Exceptions\NotFoundException;
    }
}
