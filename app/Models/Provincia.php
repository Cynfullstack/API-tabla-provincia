<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table='provincias';
    protected $primarykey= 'id';
    protected $connection='mysql';
    protected $fillable= ['indec_id','nombre']; 


public function personas()
{


    return $this->hasMany(Persona::class,'provincia_id','id');
}

}
