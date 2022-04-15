<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class GeneralSettings extends Model implements HasMedia
{
    use HasMediaTrait, SoftDeletes;

    protected $table = 'general_settings';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'logo',
    ];

    protected $fillable = [
        'site_name',
        'address',
        'phone',
        'email',
        'who_are_we',
        'our_goal',
        'our_vision',
        'our_message',
        'sign_up_status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
        $this->addMediaConversion('new_preview')->fit('crop', 300, 300);
    }

    public function getLogoAttribute()
    {
        $file = $this->getMedia('logo')->last();

        if ($file) {
            $file->url              = $file->getUrl();
            $file->thumbnail        = $file->getUrl('thumb');
            $file->preview          = $file->getUrl('preview');
            $file->new_preview      = $file->getUrl('new_preview');
        }

        return $file;
    }
}
