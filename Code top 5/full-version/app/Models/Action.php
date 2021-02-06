<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Action extends Model
{

  protected $table = "action";
    protected $fillable = ["idaction", "idpdca", "idsqdip", "idescalade", "idlogin", "iddirection","idgid", "idorigine", "etat", "responsable", "data_prevu", "action", "direction", "origine", "sqdip", "escalade", "gestionnaire"];
    protected $primaryKey = "idaction";

    public function pdca(){
        return $this->belongsTo(Pdca::class,"idpdca");
    }
    public function escalade(){
        return $this->belongsTo(Escalade::class,"idescalade");
    }
    public function origine(){
        return $this->belongsTo(Origine::class,"idorigine");
    }
    public function sqdip(){
        return $this->belongsTo(Sqdip::class,"idsqdip");
    }
    public function direction(){
        return $this->belongsTo(Direction::class,"iddirection");
    }
    public function gid(){
        return $this->belongsTo(Gid::class,"idgid");
    }
    public function loginpareto(){
        return $this->belongsTo(Pareto::class,"idlogin");
    }

}
