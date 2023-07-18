<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table='users';

    protected $fillable = [
        'first_name',
        'last_name',
        'staff_number',
        'email',
        'password',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    // public function setPasswordAttribute($password)
    // {
    //     //$this->attributes['password'] = bcrypt($password);
    //     $this->attributes['password'] = Hash::make($password);

    // }

    public function assignments()
    {
        return $this->belongsToMany(Assignment::class, 'junctions', 'users_id', 'assignments_id');
    }

    // public function userassignments()
    // {
    //     return $this->hasMany(Junction::class, 'users_id');
    // } 

}
