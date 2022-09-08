<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\This;

class Organization extends Model
{
    use HasFactory, SoftDeletes;


    protected $table ='organizations';

    protected $fillable = ['name', 'description', 'status', 'manager_id'];



    public function manager()
    {
        return $this->belongsTo(Manager::class, 'manager_id', 'id');
    }

}
