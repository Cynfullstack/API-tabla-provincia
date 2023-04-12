<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use SoftDeletes;
    protected $table='personas';
    protected $primarykey= 'id';
    protected $connection='mysql';
    protected $fillable= ['nombre','apellido','provincia_id'];

public function provincia()

{

return $this->belongsTo(Provincia::class,'provincia_id','id');

}
}