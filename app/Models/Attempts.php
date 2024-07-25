<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attempts extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'participant_id',
        'challenge_id',
        'questions_attempted',
        'score',
    ];


    protected $casts = [
        'questions_attempted'=> 'array',
    ];


    public function participants(){
        return $this->hasMany(Participants::class);
    }


}
