<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participants extends Model
{
    use HasFactory;

    protected $table='participants';
    
    protected $fillable = [
        'school_id',
        'username',
        'firstname',
        'lastname',
        'email',
        'date_of_birth',
    ];

    public function school()
    {
        return $this->belongsTo(Schools::class);
    }
    public function scores(){
        return $this->hasMany(Scores::class);
    }


    public function attempts(){
        return $this->hasMany(Attempts::class);
    }

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
