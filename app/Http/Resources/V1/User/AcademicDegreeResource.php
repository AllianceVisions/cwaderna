<?php

namespace App\Http\Resources\V1\User;

use Illuminate\Http\Resources\Json\JsonResource;

class AcademicDegreeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'university_name' => $this->university_name,
            'degree' => $this->degree,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
    }
}
