<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TypeSeuil extends Model
{
    protected $table = "typeseuil";
    protected $fillable = ["idtypeseuil","type"];
    protected $primaryKey = "idtypeseuil";
}
