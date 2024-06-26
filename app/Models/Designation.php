<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $table = 'designation';

    protected $fillable = [
        'id',
        'name',
        'usertype_id',
        'created_at',
        'updated_at'
    ];
    public function user_type()
    {   
        //Model name tapos name sa column sa imong database
        return $this->belongsTo(UserType::class, 'usertype_id');
    }
}
