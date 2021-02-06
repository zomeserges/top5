<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Pdca extends Model
{
    protected $table = "pdca";
    protected $fillable = ["idpdca","etat"];
    protected $primaryKey = "idpdca";

}
