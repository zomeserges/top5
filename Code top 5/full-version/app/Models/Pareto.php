<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Pareto extends Model
{
    protected $table = "pareto";
    protected $fillable = ["idpareto", "idcausepareto","idindicateur", "pareto","valeur", "description", "direction", "origine", "sqdip"];
    protected $primaryKey = "idpareto";

    public function causepareto(){
        return $this->belongsTo(CausePareto::class,"iddcausepareto");
    }
    public function indicateur(){
      return $this->belongsTo(Indicateur::class,"idindicateur");
    }
}
