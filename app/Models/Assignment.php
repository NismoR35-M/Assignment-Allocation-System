<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'request_type',
        'company_name',
        'email',
        'phone_number',
        'status',
        'is_active',
    ];

    protected $attribute = ['is_active' => true,];
  
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'junctions', 'assignments_id', 'users_id');
    }
    
    public function assignmentuser()
    {
        return $this->hasMany(Junction::class, 'assignments_id');
    }
}
