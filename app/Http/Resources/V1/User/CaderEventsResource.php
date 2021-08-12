<?php

namespace App\Http\Resources\V1\User;

use Illuminate\Http\Resources\Json\JsonResource;

class CaderEventsResource extends JsonResource
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
        return [
            'id' => $this->id,
            'title' => $this->title,
            'address' => $this->address ?? '' ,
            'city' => $this->city->$name ?? '' ,
            'description' => $this->description,
            'conditions' => $this->conditions,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'start_attendance' => $this->start_attendance,
            'end_attendance' => $this->end_attendance,
            'cader_start_attendance' => $this->pivot->start_attendance ,
            'cader_end_attendance' => $this->pivot->end_attendance,
            'cader_price' => $this->pivot->profit,
            'photo' => $this->photo ? asset($this->photo->getUrl()) : null,
            'cader_status' => trans('global.cader_status.'.$this->pivot->status),
            'cader_status2' => $this->pivot->status,
            'event_request_by' => trans('global.event_request_by.'.$this->pivot->request_type),
            'event_status' => $this->status,
            'specializations' => EventSpecializationResource::collection($this->specializations),
        ];
    }
}
