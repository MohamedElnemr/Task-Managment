<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable = [
        'title',
        'description',
        'image',
        'employee_id',
        'manager_id',
        'organization_id',
        'status_id',
        'parent_id',

    ];


    public function Employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function Manager()
    {
        return $this->belongsTo(Manager::class, 'manager_id', 'id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }


}
