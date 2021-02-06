<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //"first_name", "last_name", "email", "telephone", "password", "email_verified", "created_at", "updated_at", "type"
    protected $primaryKey="user_id";
    protected $fillable=["first_name", "last_name", "email", "telephone", "password", "type","status","is_verified","department"];
    protected $table='user';
}
