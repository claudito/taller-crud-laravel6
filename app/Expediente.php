<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    //
  
  protected $table = 'expediente';

  protected $fillable = [

	'expediente',
	'responsable',
	'fechaatencion',
	'id_atencion',
	'fechadocumento',
	'fecha1atencion',
	'cumpleatencion1',
	'fecha2atencion',
	'cumpleatencion2',
	'id_trabajador'

  ];


}
