<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class LoginAdmin extends Model
{
    protected $table = "loginadmin";
    protected $fillable = ["idloginadmin","gid","role"];
    protected $primaryKey = "idloginadmin";
}
