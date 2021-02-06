<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Origine extends Model
{
  protected $table = "origine";
  protected $fillable = ["idorigine","origine"];
  protected $primaryKey = "idorigine";
}
