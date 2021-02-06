<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Gid extends Model
{
    protected $table = "gid";
    protected  $fillable = ["idgid", "gid", "pass", "nom", "prenom", "email", "origine", "direction"];
    protected $primaryKey ="idgid";
}
