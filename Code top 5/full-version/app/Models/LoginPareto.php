<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class LoginPareto extends Model
{
    protected $table = "loginpareto";
    protected $fillable = ["idlogin", "idpareto", "gid", "pareto"];
    protected $primaryKey ="idlogin";

    public function listepareto(){
        return $this->belongsTo(Pareto::class,"idpareto");
    }
}
