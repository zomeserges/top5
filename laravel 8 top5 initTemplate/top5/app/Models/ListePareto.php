<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ListePareto extends Model
{
    protected $table = "listepareto";
    protected $fillable = ["idlistepareto", "iddirection", "pareto", "description", "direction", "origine", "sqdip"];
    protected $primaryKey = "idlistepareto";

    public function direction(){
        return $this->belongsTo(Direction::class,"iddirection");
    }
}
