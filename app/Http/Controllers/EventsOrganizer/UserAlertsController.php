<?php

namespace App\Http\Controllers\EventsOrganizer;

use App\Http\Controllers\Controller; 
use App\Http\Requests\StoreUserAlertRequest;
use App\Models\User;
use App\Models\UserAlert;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Alert;

class UserAlertsController extends Controller
{ 
    public function read(Request $request)
    {
        $alert = \Auth::user()->userUserAlerts()->where('user_alert_id', $request->id)->first();
        
        $pivot       = $alert->pivot;
        $pivot->read = true;
        $pivot->save();
            
        return 'success';
    }
}