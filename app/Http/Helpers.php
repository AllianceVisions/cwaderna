<?php 

if(! function_exists('authorize_to_access_event')){
    function authorize_to_access_event($comapny_id){
        $authorized_events = \Auth::user()->events()->get()->pluck('id')->toArray();
        if(!in_array($comapny_id,$authorized_events)){
            return 0;
        }
        return 1;
    }
} 

?>