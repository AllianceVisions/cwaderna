<?php

namespace App\Http\Resources\V1\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'phone' => $this->phone,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'description' => $this->cader->description,
            'identity_num' => $this->identity_num,
            'description' => $this->cader ? $this->cader->description : '',
            'city'=> $this->city->$name,
            'nationality'=> $this->nationality->$name,
            'photo' => $image,
            'previous_experience' => PreviousExperienceResource::collection($this->previous_experience),
            'academic_degree' => AcademicDegreeResource::collection($this->academic_degree),
            'specializations' => SpecializationResource::collection($this->cader->specializations),
            'skills' => UserSkillsResource::collection($this->cader->skills),
        ];
    }
}
