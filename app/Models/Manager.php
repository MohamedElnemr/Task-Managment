<?php

namespace App\Models;


use App\Models\Membership;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class Manager extends Model
{
    use HasFactory;

    protected $table = 'managers';
    protected $fillable = [
        'section',
        'join_date',
        'user_id',
        'membership_id',
    ];

    protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at'];


    public function User()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function Membership()
    {
        return $this->belongsTo(Membership::class ,'membership_id','id');
    }

    public function Organizations()
    {
        return $this->hasMany(Organization::class, 'manager_id','id');
    }

    public function Tasks()
    {
        return $this->hasMany(Task::class, 'manager_id', 'id');
    }
}





