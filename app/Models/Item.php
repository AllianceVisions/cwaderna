<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;
use Carbon\Carbon;

class Item extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'items';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'photo', 
    ];

    protected $fillable = [
        'title',
        'description',
        'price',
        'provider_man_id',
        'category_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    //times pivot
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

    //pivots
    public function pivot_start_attendance()
    { 
        return $this->pivot->start_attendance ? Carbon::createFromFormat('Y-m-d H:i:s', $this->pivot->start_attendance)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }
    public function pivot_end_attendance()
    { 
        return $this->pivot->end_attendance ? Carbon::createFromFormat('Y-m-d H:i:s', $this->pivot->end_attendance)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
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

    public function provider_man(){
        return $this->belongsTo(ProviderMan::class,'provider_man_id');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class,'events_items_pivot','item_id','event_id')
                    ->withpivot(['status','price','profit','start_attendance','end_attendance'])
                    ->withTimestamps();
    }
}
