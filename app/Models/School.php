<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    
    /*protected $primarykey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';*/

    protected $fillable = [
        'schoolName',
        'district',
        'schoolRegNo',
        'repName',
        'repEmail',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*protected static function boot() {
        parent::boot();
        static::creating(function ($model) {
            $mostRecentSchool = School::orderBy('created_at', 'desc')->first();
            $number=1;

            if ($mostRecentSchool) {
                $mostRecentNumber = intval(substr($mostRecentSchool->id, 2));
                $number = $mostRecentNumber + 1;
            }
            $model->{$model->getKeyName()} = 'PS'.str_pad($number, 2, '0', STR_PAD_LEFT);
        });
    }*/

}
