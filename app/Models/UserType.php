<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;
    protected $table = 'users_type';

    protected $fillable = [
        'type',
    ];


    public function Users()
    {
        return $this->hasMany(User::class,'user_type','id');
    }
}
