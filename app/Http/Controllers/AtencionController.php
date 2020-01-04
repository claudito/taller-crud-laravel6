<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Atencion;
use Auth;

class AtencionController extends Controller
{
    //

function index(Request $request){

$user = Auth::user();

//dd($user->id);

if($request->ajax())
{

 $result = Atencion::all();

 return array('data'=>$result);

}


return view('atencion.index');


}


function store(Request $request){


Atencion::updateOrCreate(['id'=>$request->id],
[

'motivo'=>$request->motivo

]
);

$text =  ($request->id) ? 'Registro Actualizado' : 'Registro Agregado' ;

return array(

'title'=>'Buen Trabajo',
'text' =>$text,
'icon' =>'success'

);



}



function edit($id){

$result = Atencion::find($id);

 return $result;

}



function destroy($id){

$result = Atencion::find($id)->delete();

return array(

'title'=>'Buen Trabajo',
'text' =>'Registro Eliminado',
'icon' =>'success'

);


}





}
