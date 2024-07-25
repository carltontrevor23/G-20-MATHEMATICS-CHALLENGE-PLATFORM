<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'district',
        'registration_number',
        'representative_name',
        'email',
        'representative_password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function representatives()
    {
        return $this->hasMany(Representatives::class);
    }
}
