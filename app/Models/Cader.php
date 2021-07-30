<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;
use Carbon\Carbon;

class Cader extends Model
{
    use SoftDeletes;

    public $table = 'caders';


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'rating',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //pivots
    public function pivot_start_attendance()
    { 
        return $this->pivot->start_attendance ? Carbon::createFromFormat('Y-m-d H:i:s', $this->pivot->start_attendance)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }
    public function pivot_end_attendance()
    { 
        return $this->pivot->end_attendance ? Carbon::createFromFormat('Y-m-d H:i:s', $this->pivot->end_attendance)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }
    
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->BelongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'caders_reviews_pivot','cader_id','user_id')
                    ->withpivot(['rating','comment','status','viewed'])
                    ->withTimestamps();;
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class,'caders_skills_pivot','cader_id','skill_id')
                    ->withpivot('progress')
                    ->withTimestamps();
    }

    public function events()
    {
        return $this->belongsToMany(Event::class,'events_caders_pivot','cader_id','event_id')
                    ->withpivot(['specialization_id','status','request_type','price','profit','start_attendance','end_attendance'])
                    ->withTimestamps();
    }

    public function attendance()
    {
        return $this->belongsToMany(Cader::class,'event_attendance_pivot','cader_id','event_id')
                    ->withpivot(['type','out_of_zone','attendance1','attendance2','longitude','latitude','distance'])
                    ->withTimestamps();
    }

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class,'cader_specialization_pivot','cader_id','specialization_id')
                    ->withTimestamps();
    }
}
