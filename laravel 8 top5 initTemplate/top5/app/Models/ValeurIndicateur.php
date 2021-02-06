<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ValeurIndicateur extends Model
{
    protected $table = "valeurindicateur";
    protected $fillable = ["idvaleurindicateur", "idindicateur", "idlistepareto", "indicateur", "valeur", "qui", "date_saisie"];
    protected $primaryKey = "idvaleurindicateur";

    public function indicateur(){
        return $this->belongsTo(Indicateur::class,"idindicateur");
    }
    public function listepareto(){
        return $this->belongsTo(ListePareto::class,"idlistepareto");
    }
}
