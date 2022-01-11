<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface; 
use Carbon\Carbon;  

class EventBreak extends Model
{ 

    public $table = 'event_break';

    protected $dates = [ 
        'created_at',
        'updated_at', 
    ];

    protected $fillable = [
        'event_id',
        'cader_id',
        'break',
        'reason',
        'time',
        'status',
    ];
    
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    } 
    
    public function cader()
    {
        return $this->belongsTo(Cader::class);
    }
    
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
