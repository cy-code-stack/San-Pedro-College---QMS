<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'log_session',
        'status',
        'usertype_id',
        'designation_id',
        'role',
        'avatar_img'
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_type()
    {   
        //Model name tapos name sa column sa imong database
        return $this->belongsTo(UserType::class, 'usertype_id');
    }

    public function designation(){
        return $this->belongsTo(Designation::class, 'designation_id');
    } 
    public function que(){
        return $this->hasMany(QueueNumModel::class, 'user_id', 'id');
    }
}
