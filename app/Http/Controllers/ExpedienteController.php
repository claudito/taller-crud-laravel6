<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expediente;
use App\Atencion;
use App\Trabajador;
use App\Auditoria;
use DB;
use Auth;

class ExpedienteController extends Controller
{
    //

  function index(Request $request){


   if($request->ajax())
   {

    $result = DB::select(DB::raw("

     SELECT  
    
     e.id,
     e.expediente,
     e.responsable,
     e.fechaatencion,
     e.id_atencion,
     a.motivo atencion,
     DATE_FORMAT(e.fechadocumento,'%d/%m/%Y')fechadocumento,
     DATE_FORMAT(e.fecha1atencion,'%d/%m/%Y')fecha1atencion,
     e.cumpleatencion1,
     DATE_FORMAT(e.fecha2atencion,'%d/%m/%Y')fecha2atencion,
     e.cumpleatencion2,
     e.id_trabajador,
     CONCAT(t.nombres,' ',t.apellidos)trabajador

     FROM  expediente e

     INNER JOIN atencion a ON e.id_atencion=a.id

     INNER JOIN trabajador t ON e.id_trabajador=t.id



     "));

     return array('data'=>$result);



   }


   
   return view('expediente.index');
   

  }


  function store(Request $request){


  	Expediente::updateOrCreate(
  		['id'=>$request->id],
  		[
        
		'expediente'     =>$request->expediente,
		'responsable'    =>$request->responsable,
		'fechaatencion'  =>$request->fechaatencion,
		'id_atencion'    =>$request->atencion,
		'fechadocumento' =>$request->fechadocumento,
		'fecha1atencion' =>$request->fecha1atencion,
		'cumpleatencion1'=>$request->observacion,
		'fecha2atencion' =>$request->fecha2atencion,
		'cumpleatencion2'=>$request->estado, 
		'id_trabajador'  =>$request->trabajador

  		]


  	  );



     
	$text =  ($request->id) ? 'Registro Actualizado' : 'Registro Agregado' ;

  
  //Auditoria

  $user = Auth::user();
  $usuario = $user->name;

  $tipo = ($request->id) ? 'A' : 'R' ;

  $ip   = $_SERVER['SERVER_ADDR'];
  $log  = $_SERVER['HTTP_USER_AGENT'];


  Auditoria::create([

  'usuario'=> $usuario,
  'ip'     => $ip,
  'log'    => $log,
  'tipo'   => $tipo

  ]);


	return array(

	'title'=>'Buen Trabajo',
	'text' =>$text,
	'icon' =>'success'

	);


  }


function edit($id){

  
  $expediente = Expediente::find($id);

  return $expediente;

}


function destroy($id){

 Expediente::find($id)->delete();


   //Auditoria
  $user = Auth::user();
  $usuario = $user->name;

  $tipo = 'E';

  $ip   = $_SERVER['SERVER_ADDR'];
  $log  = $_SERVER['HTTP_USER_AGENT'];


  Auditoria::create([

  'usuario'=> $usuario,
  'ip'     => $ip,
  'log'    => $log,
  'tipo'   => $tipo

  ]);



return array(

'title'=>'Buen Trabajo',
'text' =>'Registro Eliminado',
'icon' =>'success'

);


}



function  get_atencion(){

 
 $atencion =  Atencion::all();

 return $atencion;


}


function  get_trabajador(){

 
 $trabajador =  Trabajador::all();

 return $trabajador;


}




}
