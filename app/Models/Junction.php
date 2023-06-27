<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Junction extends Model
{
    use HasFactory;

    protected $table = 'junctions';
    protected $fillable = ['users_id', 'assignments_id'];

    public function user()
    {
        return $this ->belongsTo(User::class,'users_id');
    }

    public function assignment()
    {
        return $this ->belongsTo(Assignment::class,'assignments_id');
    } 
}
