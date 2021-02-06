<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $table ="info";
    protected $fillable = ["idinfo", "idorigine", "iddirection", "idgid", "info", "direction", "origine", "gestionnaire"];
    protected $primaryKey = "idinfo";

    public function origine(){
        return $this->belongsTo(Origine::class,"idorigine");
    }
    public function gid(){
        return $this->belongsTo(Gid::class,"idgid");
    }
    public function direction(){
        return $this->belongsTo(Direction::class,"iddirection");
    }
}
