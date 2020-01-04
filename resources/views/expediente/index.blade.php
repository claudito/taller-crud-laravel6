<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Expedientes</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha256-NuCn4IvuZXdBaFKJOAcsU2Q3ZpwbdFisd5dux4jkQ5w=" crossorigin="anonymous" />


<!-- Datatable -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">


<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


</head>
<body>


<div class="container-fluid">
	
<div class="row">
	
<div class="col-md-12">
	
<div class="card">
	
<div class="card-header">
Expedientes

<div class="float-right">
<button class="btn btn-primary  btn-sm btn-agregar"><i class="fa fa-plus"></i> Agregar</button>
</div>

</div>

<div class="card-body">

<div class="table-responsive">
	
<table id="consulta" class="table" style="font-size: 12px">
		<thead>
				<tr>
					<th>Id</th>
					<th>Expediente</th>
					<th>Responsable</th>
					<th>Fecha de Atención</th>
					<th>Atención</th>
					<th>Fecha del Documento</th>
					<th>Fecha 1era Atención</th>
					<th>Observación</th>
					<th>Fecha 2da Atención</th>
					<th>Estado</th>
					<th>Usuario</th>
					<th>Acciones</th>
				</tr>
		</thead>
</table>


</div>


</div>

</div>


</div>

</div>

</div>

<!-- Modal Registro Agregar/Actualizar  -->
<form id="registro" autocomplete="off">
	
<div class="modal fade" id="modal-registro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


      	 @csrf
       
      <div class="row">
      	
     	<div class="col-md-6">

         <input type="hidden" name="id" class="id">
 

        <div class="form-group">
        <label>Expediente</label>
        <input type="text" name="expediente" class="expediente form-control" required>
        </div>

        <div class="form-group">
        <label>Responsable</label>
        <input type="text" name="responsable" class="responsable form-control">
        </div>

        <div class="form-group">
        <label>Fecha de Atención</label>
        <input type="date" name="fechaatencion" class="fechaatencion form-control" required>
        </div>

        <div class="form-group">
        <label>Atención</label>
        <select name="atencion" class="atencion form-control" required></select>
        </div>


        <div class="form-group">
        <label>Fecha del Documento</label>
        <input type="date" name="fechadocumento" class="fechadocumento form-control">
        </div>

     	
     	</div>
     	<div class="col-md-6">


        <div class="form-group">
        <label>Fecha de 1era Atención</label>
        <input type="date" name="fecha1atencion" class="fecha1atencion form-control" >
        </div>

        <div class="form-group">
        <label>Observación</label>
        <textarea name="observacion"  rows="3" class="observacion form-control"></textarea>
        </div>

        <div class="form-group">
        <label>Fecha de 2da Atención</label>
        <input type="date" name="fecha2atencion" class="fecha2atencion form-control">
        </div>

        <div class="form-group">
        <label>Estado</label>
        <select name="estado" class="estado form-control" required>
        <option value="NO">NO</option>
        <option value="SI">SI</option>
        </select>
        </div>
     	
     	 <div class="form-group">
        <label>Trabajador</label>
        <select name="trabajador" class="trabajador form-control" required>
        </select>
        </div>
        

        </div>



      </div>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary btn-submit">Save changes</button>
      </div>
    </div>
  </div>
</div>



</form>



<script>
	
function loadData(){

$(document).ready(function(){

$('#consulta').DataTable({


destroy:true,
bAutoWidth:false,
deferRender:true,
bProcessing:true,
language:{

url:"{{ asset('js/spanish.json') }}"

},
ajax:{

url:'{{ route('expediente.index') }}',
type:'GET'

},
columns:[

{ data:'id'},
{ data:'expediente'},
{ data:'responsable'},
{ data:'fechaatencion'},
{ data:'atencion'},
{ data:'fechadocumento'},
{ data:'fecha1atencion'},
{ data:'cumpleatencion1'},
{ data:'fecha2atencion'},
{ data:'cumpleatencion2'},
{ data:'trabajador'},
{ data:null,render:function(data){


 return `
 
 <a 
href="#" class="btn btn-primary btn-sm btn-edit"
data-id="${data.id}"
data-id_atencion="${data.id_atencion}"
data-id_trabajador="${data.id_trabajador}"

><i class="fa fa-edit"></i></a> 

<a href="#" class="btn btn-danger btn-sm btn-delete"
data-id="${data.id}"
><i class="fa fa-trash"></i></a>
  

  `;


}}


]


});



});


}

//Cargar Data
loadData();


//Cargar Modal Agregar
$(document).on('click','.btn-agregar',function(){

 $('#registro')[0].reset();

 //Atención
 $.ajax({

 url:'{{ route('expediente.get_atencion') }}',
 type:'GET',
 data:{},
 dataType:'JSON',
 success:function(data){

  option = ``;

  data.forEach(function(row){

  option += `<option value="${row.id}">${row.motivo}</option>`;


  });

  $('.atencion').html(option);

 }



 });


 //Trabajadores
  $.ajax({

 url:'{{ route('expediente.get_trabajador') }}',
 type:'GET',
 data:{},
 dataType:'JSON',
 success:function(data){

  option = ``;

  data.forEach(function(row){

  option += `<option value="${row.id}">${row.nombres} ${row.apellidos}</option>`;


  });

  $('.trabajador').html(option);

 }



 });


 $('.modal-title').html('Agregar');
 $('.btn-submit').html('Agregar');
 $('#modal-registro').modal('show');


});


//Registro Agregar/Actualizar
$(document).on('submit','#registro',function(e){

 parametros = $(this).serialize();
 
 $.ajax({

  url:'{{ route('expediente.store') }}',
  type:'POST',
  data:parametros,
  dataType:'JSON',
  beforeSend:function(){


    Swal.fire({

       title:'Cargando',
       imageUrl:'{{ asset('img/loader2.gif') }}',
       text :'Espere un momento',
       showConfirmButton:false 


       });



  },
  success:function(data){


   loadData();
   $('#modal-registro').modal('hide');

   Swal.fire({

       title:data.title,
       text :data.text,
       icon :data.icon,
       timer:3000,
       showConfirmButton:false

      });



  }



 });


 e.preventDefault();
});


//Cargar Modal Actualizar
$(document).on('click','.btn-edit',function(e){

 $('#registro')[0].reset();

 id           = $(this).data('id');
 id_atencion  = $(this).data('id_atencion');
 id_trabajador= $(this).data('id_trabajador');

 $('.id').val(id);


 //Cargar Info
 $.ajax({
 
  url:'{{ route('expediente.store') }}'+'/'+id+'/edit',
  type:'GET',
  data:{},
  dataType:'JSON',
  success:function(data){

  $('.expediente').val(data.expediente);
  $('.responsable').val(data.responsable);
  $('.fechaatencion').val(data.fechaatencion);
  $('.fechadocumento').val(data.fechadocumento);
  $('.fecha1atencion').val(data.fecha1atencion);
  $('.observacion').val(data.cumpleatencion1);
  $('.fecha2atencion').val(data.fecha2atencion);
  $('.estado').val(data.cumpleatencion2);

  }



 });

 //Atención
 $.ajax({

 url:'{{ route('expediente.get_atencion') }}',
 type:'GET',
 data:{},
 dataType:'JSON',
 success:function(data){

  option = ``;

  data.forEach(function(row){

  option += `<option value="${row.id}">${row.motivo}</option>`;


  });

  $('.atencion').html(option);
  $('.atencion').val(id_atencion);

 }



 });

 //Trabajadores
  $.ajax({

 url:'{{ route('expediente.get_trabajador') }}',
 type:'GET',
 data:{},
 dataType:'JSON',
 success:function(data){

  option = ``;

  data.forEach(function(row){

  option += `<option value="${row.id}">${row.nombres} ${row.apellidos}</option>`;


  });

  $('.trabajador').html(option);
  $('.trabajador').val(id_trabajador);

 }



 });


 $('.modal-title').html('Actualizar');
 $('.btn-submit').html('Actualizar');
 $('#modal-registro').modal('show');


});


//Cargar Modal Eliminar
$(document).on('click','.btn-delete',function(){

 id = $(this).data('id');

Swal.fire({
  title: '¿Estás Seguro?',
  text: "El Registro Seleccionado se eliminará se forma permanente",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, estoy seguro.',
  cancelButtonText:'Cancelar',
}).then((result) => {
  if (result.value) {


   $.ajax({
   
    url:'{{ route('expediente.store') }}'+'/'+id,
    type:'DELETE',
    data:{'_token':'{{ csrf_token() }}'},
    dataType:'JSON',
    beforeSend:function(){

     Swal.fire({

       title:'Cargando',
       imageUrl:'{{ asset('img/loader2.gif') }}',
       text :'Espere un momento',
       showConfirmButton:false 


       });

    },
    success:function(data){

     loadData();

      Swal.fire({

       title:data.title,
       text :data.text,
       icon :data.icon,
       timer:3000,
       showConfirmButton:false

      });



    }
  




   });



  }
})





});


</script>
</body>
</html>