<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class school extends Model
{
    use HasFactory;
    protected $fillable = ['name','district','registration_number','email','representative_name'];

    public function representatives()
    {
        return $this->hasMany(Representative::class);
    }
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
