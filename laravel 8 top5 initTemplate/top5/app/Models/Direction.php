<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    protected $table = "direction";
    protected $fillable = ["iddirection","direction"];
    protected $primaryKey = "iddirection";
}
