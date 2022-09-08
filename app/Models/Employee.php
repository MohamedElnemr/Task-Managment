<?php

namespace App\Models;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $fillable = [
        'address',
        'education',
        'phone_no',
        'date_of_birth',
        'user_id',
        'organization_id',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function Organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    public function Tasks()
    {
        return $this->hasMany(Task::class, 'employee_id', 'id');
    }

}






















