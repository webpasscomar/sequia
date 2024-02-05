<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = "roles";

    protected $fillable = [
        'id',
        'name',
        'description'
    ];

    public function users(){
        return $this->belongsToMany(User::class,'users_roles','rol_id','user_id');
    }
}
