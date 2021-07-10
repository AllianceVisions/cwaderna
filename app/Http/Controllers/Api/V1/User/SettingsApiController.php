<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nationality;
use App\Models\City;
use App\Traits\api_return;
use App\Http\Resources\V1\User\NationalityResource;
use App\Http\Resources\V1\User\CityResource;


class SettingsApiController extends Controller
{
    use api_return;

    public function nationality(){
        $nationalities = Nationality::all(); 
        return $this->returnData(NationalityResource::collection($nationalities));
    }

    public function cities(){
        $cities = City::all(); 
        return $this->returnData(CityResource::collection($cities));
    }
}
