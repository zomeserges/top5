<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Escalade extends Model
{
    protected $table = "escalade";
    protected $fillable = ["idescalade","escalade"];
    protected $primaryKey = "idescalade";
}
