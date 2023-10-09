<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    public function rests()
    {
        return $this->hasMany(Rest::class);
    }
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
