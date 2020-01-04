<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    //

   protected $table    = 'auditoria';

   protected $fillable = ['usuario','ip','log','tipo'];


 



}
