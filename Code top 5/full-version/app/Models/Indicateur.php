<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Indicateur extends Model
{
    protected $table = "indicateur";
    protected $fillable = ["idindicateur", "iddirection", "idorigine", "idsqdip", "indicateur", "responsable", "description", "direction", "origine", "sqdip", "mini","valeur", "maxi", "a1"];
    protected $primaryKey = "idindicateur";

    public function origine(){
        return $this->belongsTo(Origine::class,"idorigine");
    }
    public function sqdip(){
        return $this->belongsTo(Sqdip::class,"idsqdip");
    }
    public function direction(){
        return $this->belongsTo(Direction::class,"iddirection");
    }
}
