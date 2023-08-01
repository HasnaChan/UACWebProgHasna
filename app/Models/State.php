<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    public function User(){
        return $this->hasMany(User::class);
    }

    public function Interested(){
        return $this->hasMany(Matched::class);
    }
}
