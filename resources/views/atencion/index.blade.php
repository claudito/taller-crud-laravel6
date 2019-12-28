<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Atención</title>

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
Listado de Atenciones  

<div class="float-right">
<button class="btn btn-primary btn-sm btn-agregar"><i class="fa fa-plus"></i> Agregar</button>
</div>

</div>


<div class="card-body">
	
<div class="table-responsive">
	<table id="consulta" class="table table-hover" style="font-size: 12px">
		<thead>
			<tr>
				<th>Id</th>
				<th>motivo</th>
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



<form id="registro" autocomplete="off">
	
<!-- Modal Registro (Agregar/Actualizar) -->
<div class="modal fade" id="modal-registro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

       @csrf

      <input type="hidden" name="id" class="id">
         
      <div class="form-group">
      <label>Motivo</label>
      <input type="text" name="motivo" class="motivo form-control" required>
      </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submmit" class="btn btn-primary btn-submit">Save changes</button>
      </div>
    </div>
  </div>
</div>



</form>


<script>

//Cargar Data
function loadData(){

$(document).ready(function(){


$('#consulta').DataTable({

destroy:true,
bAutoWidth:false,
deferRender:true,
bProcessing:true,
language:{

"url":"{{ asset('js/spanish.json') }}"

},
ajax:{

url:'{{ route('atencion.index') }}',
type:'GET'

},
columns:[

{data:'id'},
{data:'motivo'},
{data:null,render:function(data){

return `

<a 
href="#" class="btn btn-primary btn-sm btn-edit"
data-id="${data.id}"
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

loadData();


//Cargar Modal Agregar
$(document).on('click','.btn-agregar',function(e){

 $('#registro')[0].reset();
 $('.id').val('');

 $('.modal-title').html('Agregar');
 $('.btn-submit').html('Agregar');
 $('#modal-registro').modal('show');

});

//Cargar Modal Actualizar
$(document).on('click','.btn-edit',function(e){

  $('#registro')[0].reset();
   $('.id').val('');

  id = $(this).data('id');
  
  $('.id').val(id);

  $.ajax({
  
   url:'{{ route('atencion.store') }}'+'/'+id+'/edit',
   type:'GET',
   dataType:'JSON',
   success:function(data){

   $('.motivo').val(data.motivo);
  
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
   
    url:'{{ route('atencion.store') }}'+'/'+id,
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



//Agregar/Actualizar
$(document).on('submit','#registro',function(e){

   paramentros = $(this).serialize();
 

 	$.ajax({

      url  :'{{ route('atencion.store') }}',
      type :'POST',
      data :paramentros,
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

      $('#modal-registro').modal('hide');
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


 

   e.preventDefault();
});




</script>
</body>
</html>