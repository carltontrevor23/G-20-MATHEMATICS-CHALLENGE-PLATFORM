<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participants extends Model
{
    use HasFactory;
    protected $fillable = ['username','firstname','lastname','email','date_of_birth','school_id'] ;
    public function school()
    {
        return $this->belongsTo(School::class);
    
}
public function results()
{
    return $this->hasMany(Results::class);
}

}
