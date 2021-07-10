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
        return [
            'id' => $this->id,
            'title' => $this->title,
            'address' => $this->city->$name . "-" . $this->address ?? '' ,
            'description' => $this->description,
            'conditions' => $this->conditions,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'start_attendance' => $this->start_attendance,
            'end_attendance' => $this->end_attendance,
            'photo' => $this->photo ? asset($this->photo->getUrl()) : null,
            'specializations' => EventSpecializationResource::collection($this->specializations),
        ];
    }
}
