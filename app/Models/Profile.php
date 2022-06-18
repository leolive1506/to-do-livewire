<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    const ADM = 1;
    const USER = 2;

    protected $table = 'profiles';
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class, 'profile_id');
    }
}
