<?php

namespace App\Traits;
use App\Models\UserAlert;

trait push_notification
{

    public function send_notification( $title , $body , $alert_text , $alert_link , $type , $user_id, $add_to_alerts = true)
    {
        return 1;
        $user = User::findOrFail($user_id);

        if($add_to_alerts){
            $userAlert = UserAlert::create([
                'alert_text' => $alert_text,
                'alert_link' => $alert_link,
                'type' => $type,
            ]); 
    
            $userAlert->users()->sync($user_id);
        }

        Http::withHeaders([
            'Authorization' => 'key=AAAAYds0g4k:APA91bHNwrz13JkjR-OiDxa7rWsYMl6yeTMvD8SOsI0kMT_BNFtyoPap9Are1afMWNnUtRu1g7Ipv-DnMDO8IUw6KIhaVupVCbOQJVt5Jm33xrCrQvVBKirIi7szUTHbYjlvh42xOgu5',
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