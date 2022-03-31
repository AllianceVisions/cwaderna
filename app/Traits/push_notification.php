<?php

namespace App\Traits;
use App\Models\UserAlert;
use App\Models\User;
use Illuminate\Support\Facades\Http;

trait push_notification
{

    public function send_notification( $title , $body , $alert_text , $alert_link , $type , $user_id, $add_to_alerts = true, $data = null)
    {
        $user = User::findOrFail($user_id);

        $key = 'key=AAAAYds0g4k:APA91bHNwrz13JkjR-OiDxa7rWsYMl6yeTMvD8SOsI0kMT_BNFtyoPap9Are1afMWNnUtRu1g7Ipv-DnMDO8IUw6KIhaVupVCbOQJVt5Jm33xrCrQvVBKirIi7szUTHbYjlvh42xOgu5';

        if($add_to_alerts){
            $userAlert = UserAlert::create([
                'alert_text' => $alert_text,
                'alert_link' => $alert_link,
                'type' => $type,
            ]);

            $userAlert->users()->sync($user_id);
        }
        if($type == 'event'){

            Http::withHeaders([
                'Authorization' => $key,
                'Content-Type' =>   'application/json',
            ])->post('https://fcm.googleapis.com/fcm/send', [
                "to" => $user->fcm_token,
                "collapse_key" => "type_a",
                "data" => [
                    "type" => $type,
                    "route" => $data,
                ],
                "notification" => [
                    "title"=> $title,
                    "body" => $body
                ]
            ]);
        }elseif($type == 'break'){
            Http::withHeaders([
                'Authorization' => $key,
                'Content-Type' =>   'application/json',
            ])->post('https://fcm.googleapis.com/fcm/send', [
                "to" => $user->fcm_token,
                "collapse_key" => "type_a",
                "data" => [
                    "type" => $type,
                    "status" => $data,
                ],
                "notification" => [
                    "title"=> $title,
                    "body" => $body
                ]
            ]);
        }else{

            Http::withHeaders([
                'Authorization' => $key,
                'Content-Type' =>   'application/json',
            ])->post('https://fcm.googleapis.com/fcm/send', [
                "to" => $user->fcm_token,
                "collapse_key" => "type_a",
                "notification" => [
                    "title"=> $title,
                    "body" => $body
                ]
            ]);
        }
    }
}
