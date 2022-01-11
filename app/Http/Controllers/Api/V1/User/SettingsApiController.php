<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nationality;
use App\Models\City;
use App\Models\BreakType;
use App\Traits\api_return;
use App\Http\Resources\V1\User\NationalityResource;
use App\Http\Resources\V1\User\CityResource;
use App\Http\Resources\V1\User\BreakTypesResource;


class SettingsApiController extends Controller
{
    use api_return;

    public function breaks_type(){ 
        $breaks = BreakType::get();
        return $this->returnData(BreakTypesResource::collection($breaks),"success");
    }

    public function nationality(){
        $nationalities = Nationality::all(); 
        return $this->returnData(NationalityResource::collection($nationalities));
    }

    public function cities(){
        $cities = City::all(); 
        return $this->returnData(CityResource::collection($cities));
    }
}
