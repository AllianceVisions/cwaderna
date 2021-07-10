<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Specialization extends Model
{
    use SoftDeletes;

    public $table = 'specializations';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name_en',
        'name_ar',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    //pivots
    public function pivot_budget()
    { 
        return $this->pivot->budget ? $this->pivot->budget . " ريال" : null;
    }
    public function pivot_start_attendance()
    { 
        return $this->pivot->start_attendance ? Carbon::createFromFormat('Y-m-d H:i:s', $this->pivot->start_attendance)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }
    public function pivot_end_attendance()
    { 
        return $this->pivot->end_attendance ? Carbon::createFromFormat('Y-m-d H:i:s', $this->pivot->end_attendance)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function caders()
    {
        return $this->belongsToMany(Cader::class,'cader_specialization_pivot','specialization_id','cader_id');
    }
}