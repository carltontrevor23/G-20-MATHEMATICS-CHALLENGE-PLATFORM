<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LDAP\Result;

class Challenges extends Model
{
    use HasFactory;
    protected $fillable = ['name','start_date','end_date','duration','num_questions'];
    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
