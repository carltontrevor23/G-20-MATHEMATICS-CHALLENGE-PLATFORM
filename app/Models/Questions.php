<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    protected $table='questions';

    protected $fillable=[
        'challenge_id',
        'question',
        'answer',
        'marks',
    ];
    public function challenge ()
    {
        return $this->belongsTo(Challenge::class);
    }
    public function answers ()
    {
        return $this->hasMany(Answer::class);
    }
}
