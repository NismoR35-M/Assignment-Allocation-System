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
        'members_assigned',
        'new_attachment',
        'latest_message_id',
        'is_read',
        'is_admin_reply',
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
