<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use App\Traits\Auditable;
use Carbon\Carbon;
use \DateTimeInterface;

class Event extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait, Auditable;

    public $table = 'events';

    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'photo',
    ];

    public const ITEM_STATUS_SELECT = [
        'pending' => 'Pending', 
        'ordered' => 'Ordered',
    ];

    public const CADER_STATUS_SELECT = [
        'pending' => 'Pending',
        'refused' => 'Refused',
        'accepted' => 'Accepted',
    ];

    public const EVENT_STATUS_SELECT = [
        'pending' => 'Pending',
        'request_to_pricing' => 'Request To Pricing',
        'pending_owner_accept' => 'Pending Owner Accept',
        'accept' => 'Accept',
        'refused' => 'Refused',
    ];

    public const REQUEST_TYPE_SELECT = [
        'by_cader' => 'By Cader',
        'by_event_organizer' => 'By Event Organizer',
        'by_admin' => 'By Admin'
    ];

    protected $fillable = [
        'event_organizer_id',
        'city_id',
        'title',
        'start_date',
        'end_date',
        'address',
        'status',
        'longitude',
        'latitude',
        'description',
        'conditions',
        'start_attendance',
        'end_attendance',
        'created_at',
        'updated_at',
        'deleted_at',
    ]; 
    
    
    
    
    //times
    public function getStartAttendanceAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.time_format')) : null;
    }

    public function setStartAttendanceAttribute($value)
    {
        $this->attributes['start_attendance'] = $value ? Carbon::createFromFormat(config('panel.time_format'), $value)->format('H:i:s') : null;
    }

    public function getEndAttendanceAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.time_format')) : null;
    }

    public function setEndAttendanceAttribute($value)
    {
        $this->attributes['end_attendance'] = $value ? Carbon::createFromFormat(config('panel.time_format'), $value)->format('H:i:s') : null;
    }

    //dates
    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
    
    public function getEndDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }



    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
        $this->addMediaConversion('new_preview')->fit('crop', 300, 300);
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();

        if ($file) {
            $file->url              = $file->getUrl();
            $file->thumbnail        = $file->getUrl('thumb');
            $file->preview          = $file->getUrl('preview');
            $file->new_preview      = $file->getUrl('new_preview');
        }

        return $file;
    }

    public function caders()
    {
        return $this->belongsToMany(Cader::class,'events_caders_pivot','event_id','cader_id')->withpivot(['specialization_id','status','request_type','price','profit','start_attendance','end_attendance']);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class,'events_items_pivot','event_id','item_id')->withpivot(['status','price','profit','start_attendance','end_attendance']);
    }

    public function event_organizer(){
        return $this->belongsTo(EventOrganizer::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class,'event_specialization_pivot','event_id','specialization_id')->withpivot(['budget','num_of_caders','start_attendance','end_attendance']);
    }

    // relationship for staff to manage many events
    public function users()
    {
        return $this->belongsToMany(User::class,'events_supervisors','event_id','user_id');
    }
}
