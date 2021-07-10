<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class ProviderMan extends Model
{
    use SoftDeletes;

    public $table = 'provider_man';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'company_name',
        'commerical_reg_num',
        'working_field',
        'website', 
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

    public function items()
    {
        return $this->hasMany(Item::class);
    }
    
}
