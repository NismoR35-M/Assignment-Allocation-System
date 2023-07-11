<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company_name',
        'request_type',
        'description',
        'start_date',
        'status',
        'response',
        'is_active',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'junctions', 'assignments_id', 'users_id');
    }
    
    // public function assignmentuser()
    // {
    //     return $this->hasMany(Junction::class, 'assignments_id');
    // }
}
