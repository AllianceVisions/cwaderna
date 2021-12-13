<?php

namespace App\Http\Resources\V1\User;

use Illuminate\Http\Resources\Json\JsonResource;

class EventsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $name = 'name_' . app()->getLocale();
        $image = $this->photo ? asset($this->photo->getUrl()) : null;
        $image = str_replace('public/public','public',$image);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'address' => $this->address ?? '' ,
            'city' => $this->city->$name ?? '' ,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'area' => $this->area,
            'description' => $this->description,
            'conditions' => $this->conditions,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'start_attendance' => $this->start_attendance,
            'end_attendance' => $this->end_attendance,
            'cader_start_attendance' => '0',
            'cader_end_attendance' => '0',
            'cader_price' => '0',
            'photo' => $image,
            'cader_status' => '0',
            'cader_status2' => '0',
            'event_request_by' => '0',
            'event_status' => '0',
            'specializations' => EventSpecializationResource::collection($this->specializations),
        ];
    }
}
