<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

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
        'specialization',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
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
        return $this->belongsToMany(User::class,'caders_reviews_pivot','cader_id','user_id')->withpivot(['rating','comment','status','viewed']);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class,'caders_skills_pivot','cader_id','skill_id')->withpivot('progress');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class,'events_caders_pivot','cader_id','event_id')->withpivot(['specialization_id','status','request_type','price','profit','start_attendance','end_attendance']);
    }

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class,'cader_specialization_pivot','cader_id','specialization_id');
    }
}
