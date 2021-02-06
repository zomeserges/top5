<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class LoginIndicateur extends Model
{
  protected $table = "loginindicateur";
  protected $fillable = ["idloginindicateur","gid","Indicateur"];
  protected $primaryKey = "idloginindicateur";
}
