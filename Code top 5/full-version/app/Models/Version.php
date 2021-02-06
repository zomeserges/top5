<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $table = "version";
    protected $fillable = ["idversion","numversion"];
    protected $primaryKey = "idversion";
}
