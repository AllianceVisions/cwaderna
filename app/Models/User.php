<?php

namespace App\Models;

use App\Notifications\VerifyUserNotification;
use App\Traits\Auditable;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements HasMedia
{
    use SoftDeletes, Notifiable, Auditable, HasMediaTrait,HasApiTokens;

    public const GENDER_SELECT = [
        'male'   => 'Male',
        'female' => 'Female',
    ]; 
    
    public $table = 'users';

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $appends = [
        'photo',
        'certificates',
        'cv',
    ];

    protected $dates = [
        'email_verified_at',
        'date_of_birth',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'fcm_token',
        'date_of_birth',
        'email',
        'gender',
        'user_type',
        'email_verified_at',
        'password',
        'approved',
        'city_id',
        'nationality_id',
        'identity_num',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getDateOfBirthAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
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

    public function getCertificatesAttribute()
    {
        $files = $this->getMedia('certificates');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function getCvAttribute()
    {
        $file = $this->getMedia('cv')->last();

        if ($file) {
            $file->url              = $file->getUrl();
            $file->thumbnail        = $file->getUrl('thumb');
            $file->preview          = $file->getUrl('preview');
            $file->new_preview      = $file->getUrl('new_preview');
        }
        return $file;
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (User $user) {
            $registrationRole = config('panel.registration_default_role');

            if (!$user->roles()->get()->contains($registrationRole)) {
                $user->roles()->attach($registrationRole);
            }
        });
    }

        

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function userUserAlerts()
    {
        return $this->belongsToMany(UserAlert::class,'user_user_alert_pivot')
                    ->withTimestamps();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_user_pivot')
                    ->withTimestamps();
    }

    public function cader()
    {
        return $this->hasOne(Cader::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function provider_man()
    {
        return $this->hasOne(ProviderMan::class);
    }

    public function events_organizer()
    {
        return $this->hasOne(EventOrganizer::class);
    }
    
    public function city(){
        return $this->belongsTo(City::class);
    }

    public function caders()
    {
        return $this->belongsToMany(Cader::class,'cader_reviews_pivot','user_id','cader_id')
                    ->withpivot(['rating','comment','status','viewed'])
                    ->withTimestamps();
    }

    public function academic_degree(){
        return $this->hasMany(AcademicDegree::class);
    }

    public function previous_experience(){
        return $this->hasMany(PreviousExperience::class);
    }

    // relationship for staff to manage many events
    public function events()
    {
        return $this->belongsToMany(Event::class,'events_supervisors_pivot','user_id','event_id')
                    ->withTimestamps();
    }
}
