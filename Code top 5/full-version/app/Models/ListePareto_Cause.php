<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ListePareto_Cause extends Model
{
    public function listepareto_cause(){
        return $this->belongsToMany(Pareto::class,CausePareto::class);
    }
}
