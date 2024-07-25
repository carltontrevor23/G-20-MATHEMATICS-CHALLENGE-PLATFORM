<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scores extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id',
        'challenge_id',
        'score',
    ];

    public function participant(){
        return $this->belongsTo(Participants::class);
    }

    public function challenge(){
        return $this->belongsTo(Challenges::class);
    }
}
