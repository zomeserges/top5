<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CausePareto extends Model
{
    protected $table = "causepareto";
    protected $fillable = ["idcausepareto", "cause", "description", "pareto"];
    protected $primaryKey = "idcausepareto";
}
