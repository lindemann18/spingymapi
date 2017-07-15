<style type="text/css">
	.ListaInstructores {margin-left: 4%; margin-top: 0%; visibility:hidden}
	.Arriba{margin-top: 1%;}
	.Izquierda{margin-left: 3%;}
	.BotonActualizar {float: left; margin-left: 45%;}
	.Derecha {margin-right: 6%;}
</style>
<?php
	
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
		$consultar=new Consultar();
		//La diferencia entre id_Rutina y Rutina, es que id_Rutina es para ver la información de la rutina
		//creada por el instructor que está en sg_rutinas y Rutina es para ver la rutina ya asginada
		//a la tabla sg_rutinasClientes.
		
		if(isset($_GET['id_Rutina']))
		{
			$id_Rutina 		= $_GET['id_Rutina'];	
			$result	   		= $consultar->_ConsultarInformacionRutinaPreFinalPorId($id_Rutina);
			$num_ejercicios = $result->num_rows;
			$Rutina			= array();
			
			//Obtener los datos de la rutina
			for($i=0; $i<$num_ejercicios; $i++)
			{
				$fila = $result->fetch_assoc();
				
				//Obtener los datos y meterlos a un array.
				$Ejercicio = array("id_rutina"=>$fila["id_rutina"], "nb_ejercicio"=>$fila['nb_ejercicio'], 
				"id_ejercicio"=>$fila['id_ejercicio'], "nb_TipoRutina"=>$fila['nb_TipoRutina'], "nb_dia"=>$fila['nb_dia'],
				"id_dia"=>$fila['id_dia'],"nb_musculo"=>$fila['nb_musculo'],"id_PosicionEjercicio"=>$fila['id_PosicionEjercicio']);
				
				//Meter los datos en el array de la rutina
				array_push($Rutina, $Ejercicio);
				
			}//for
			$rutinaSize = sizeof($Rutina);
		}
		else
		{
			$idRutina=$_GET['Rutina'];
			$result=$consultar->_ConsultarInformacionRutinaPreFinalPorId($idRutina);
			$num_ejercicios=$result->num_rows;
		}
		
?>

			
			<!--DAtos escondidos -->
            <input type="hidden" value="<?php echo $id_Rutina?>" id="id_Rutina">
            
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Rutinas
                        <small>Finalizar Rutina</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="">Rutinas</li>
                    </ol>
                </section>
                <!--Modal de enviando -->
            
            <div class="modal fade" id="pleaseWaitDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1>Enviando...</h1>
                        </div>
                    <div class="modal-body">
                        <div class="progress progress-striped active">
                        <div class="progress-bar progress-striped active"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        
                        </div>
                        </div>
                    </div><!-- modal body-->
                    <div class="modal-footer">
                    </div>
                    </div>
                </div>
            </div><!-- pleaseWaitDialog-->
                
                <!-- Main content -->
                <section class="content">
                	<!-- HEADER DEL CONTENIDO-->
                    <h4 class="page-header">
                        Listado de Actividades
                        <small>
                        	En este apartado encontrará todas las actividades de la rutina creada en <span class="text-red">spin gym</span>,
                            para un cliente en específico o una rutina fabricada por el instructor. <br>
 							Seleccione las actividades y colóquelas en el orden que desee que estas sean mostradas.
                        </small>
                    </h4>
                    <!-- HEADER DEL CONTENIDO-->
                    <div class="alert alert-success alert-dismissible" role="alert" style="display:none;" id="UsuarioEliminadoNotificacion">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Bien Hecho!</strong> Cliente Eliminado.</div>
					<div class="row">
                    	<div class="col-xs-12">
							<div class="box">
                                <div class="box-header">
                                    <div class="col-sm-12">
                                    	<h4 class="text-center">
                                            Para relizar alg&uacute;n cambio de click, sin soltar en la actividad deseada, arrástrela hacía 
                                            el lugar deseado y suelte.
                                        </h4>
                                    </div>
                                </div><!-- /.box-header -->
                                
                                <div class="col-xs-12">
                                	<div class="row">
                                       <div class="col-xs-3 Lunes ">
                                        <table id="table-1"  class="table table-striped">
                                            <thead>
                                                <h3 class="text-center">Lunes</h3>
                                                <tr>
                                                    <th class="sorting_asc">CODIGO</th>
                                                    <th>EJERCICIO</th>
                                                    <th>MUSCULO</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            //Tomando los valores acorde al día para poder hacer el cambio
                                            for($i=0; $i<$rutinaSize; $i++) {
                                            if($Rutina[$i]['id_dia']==1)
                                            {
                                        ?>
                                                
                                                <tr id="<?php echo $Rutina[$i]['id_PosicionEjercicio']?>">
                                                <td class="text-center"><?php echo $Rutina[$i]['id_PosicionEjercicio']?></td>
                                                <td><?php echo $Rutina[$i]['nb_ejercicio']?></td>
                                                <td><?php echo $Rutina[$i]['nb_musculo']?></td>
                                                <?php }} ?>
                                                 </tr>
                                            </tbody>
                                        </table>
                                        
                                        </div><!-- Lunes-->
                                        
                                        <div class="col-xs-3 Martes ">
                                            <table id="table-2"  class="table table-striped">
                                            <thead>
                                                <h3 class="text-center">Martes</h3>
                                                <tr>
                                                    <th class="sorting_asc">CODIGO</th>
                                                    <th>EJERCICIO</th>
                                                    <th>MUSCULO</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            //Tomando los valores acorde al día para poder hacer el cambio
                                            for($i=0; $i<$rutinaSize; $i++) {
                                            if($Rutina[$i]['id_dia']==2)
                                            {
                                        ?>
                                                
                                                <tr id="<?php echo $Rutina[$i]['id_PosicionEjercicio']?>">
                                                <td class="text-center"><?php echo $Rutina[$i]['id_PosicionEjercicio']?></td>
                                                <td><?php echo $Rutina[$i]['nb_ejercicio']?></td>
                                                <td><?php echo $Rutina[$i]['nb_musculo']?></td>
                                                <?php }} ?>
                                                 </tr>
                                            </tbody>
                                        </table>
                                        
                                        </div><!-- Martes-->
                                        <div class="col-xs-3 Miercoles ">
                                        	<table id="table-3"  class="table table-striped">
                                            <thead>
                                                <h3 class="text-center">Miercoles</h3>
                                                <tr>
                                                    <th class="sorting_asc">CODIGO</th>
                                                    <th>EJERCICIO</th>
                                                    <th>MUSCULO</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            //Tomando los valores acorde al día para poder hacer el cambio
                                            for($i=0; $i<$rutinaSize; $i++) {
                                            if($Rutina[$i]['id_dia']==3)
                                            {
                                        ?>
                                                
                                                <tr id="<?php echo $Rutina[$i]['id_PosicionEjercicio']?>">
                                                <td class="text-center"><?php echo $Rutina[$i]['id_PosicionEjercicio']?></td>
                                                <td><?php echo $Rutina[$i]['nb_ejercicio']?></td>
                                                <td><?php echo $Rutina[$i]['nb_musculo']?></td>
                                                <?php }} ?>
                                                 </tr>
                                            </tbody>
                                        </table>
                                        
                                        </div><!-- MIercoles-->
                                        <div class="col-xs-3 Jueves ">
                                        		<table id="table-4"  class="table table-striped">
                                            <thead>
                                                <h3 class="text-center">Jueves</h3>
                                                <tr>
                                                    <th class="sorting_asc">CODIGO</th>
                                                    <th>EJERCICIO</th>
                                                    <th>MUSCULO</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            //Tomando los valores acorde al día para poder hacer el cambio
                                            for($i=0; $i<$rutinaSize; $i++) {
                                            if($Rutina[$i]['id_dia']==4)
                                            {
                                        ?>
                                                
                                                <tr id="<?php echo $Rutina[$i]['id_PosicionEjercicio']?>">
                                                <td class="text-center"><?php echo $Rutina[$i]['id_PosicionEjercicio']?></td>
                                                <td><?php echo $Rutina[$i]['nb_ejercicio']?></td>
                                                <td><?php echo $Rutina[$i]['nb_musculo']?></td>
                                                <?php }} ?>
                                                 </tr>
                                            </tbody>
                                        </table>
                                        
                                        </div><!-- Jueves-->
                                        
                                        </div><!--row -->
                                        </div><!--col-xs-12 -->
                                        <div class="col-xs-12">
                                        	<div class="row">
                                        <div class="col-xs-3 Viernes ">
                                        		<table id="table-5"  class="table table-striped">
                                            <thead>
                                                <h3 class="text-center">Viernes</h3>
                                                <tr>
                                                    <th class="sorting_asc">CODIGO</th>
                                                    <th>EJERCICIO</th>
                                                    <th>MUSCULO</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            //Tomando los valores acorde al día para poder hacer el cambio
                                            for($i=0; $i<$rutinaSize; $i++) {
                                            if($Rutina[$i]['id_dia']==5)
                                            {
                                        ?>
                                                
                                                <tr id="<?php echo $Rutina[$i]['id_PosicionEjercicio']?>">
                                                <td class="text-center"><?php echo $Rutina[$i]['id_PosicionEjercicio']?></td>
                                                <td><?php echo $Rutina[$i]['nb_ejercicio']?></td>
                                                <td><?php echo $Rutina[$i]['nb_musculo']?></td>
                                                <?php }} ?>
                                                 </tr>
                                            </tbody>
                                        </table>
                                        </div><!-- Viernes-->
                                        <div class="col-xs-3 Sabado">
                                        	<table id="table-6"  class="table table-striped">
                                            <thead>
                                                <h3 class="text-center">Sabado</h3>
                                                <tr>
                                                    <th class="sorting_asc">CODIGO</th>
                                                    <th>EJERCICIO</th>
                                                    <th>MUSCULO</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            //Tomando los valores acorde al día para poder hacer el cambio
                                            for($i=0; $i<$rutinaSize; $i++) {
                                            if($Rutina[$i]['id_dia']==6)
                                            {
                                        ?>
                                                
                                                <tr id="<?php echo $Rutina[$i]['id_PosicionEjercicio']?>">
                                                <td class="text-center"><?php echo $Rutina[$i]['id_PosicionEjercicio']?></td>
                                                <td><?php echo $Rutina[$i]['nb_ejercicio']?></td>
                                                <td><?php echo $Rutina[$i]['nb_musculo']?></td>
                                                <?php }} ?>
                                                 </tr>
                                            </tbody>
                                        </table>
                                        </div><!-- Sabado -->
                                        <div class="col-xs-3">
                                        	<table id="table-7"  class="table table-striped">
                                            <thead>
                                                <h3 class="text-center">Domingo</h3>
                                                <tr>
                                                    <th class="sorting_asc">CODIGO</th>
                                                    <th>EJERCICIO</th>
                                                    <th>MUSCULO</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            //Tomando los valores acorde al día para poder hacer el cambio
                                            for($i=0; $i<$rutinaSize; $i++) {
                                            if($Rutina[$i]['id_dia']==7)
                                            {
                                        ?>
                                                
                                                <tr id="<?php echo $Rutina[$i]['id_PosicionEjercicio']?>">
                                                <td class="text-center"><?php echo $Rutina[$i]['id_PosicionEjercicio']?></td>
                                                <td><?php echo $Rutina[$i]['nb_ejercicio']?></td>
                                                <td><?php echo $Rutina[$i]['nb_musculo']?></td>
                                                <?php }} ?>
                                                 </tr>
                                            </tbody>
                                        </table>
                                        </div><!-- Domingo-->
                                    </div><!-- /.row -->
                                </div><!-- /.col-xs-12 -->
								
                                <div class="col-xs-12">
                                	<div class="row">
                                    	<h4 class="text-center">De click al botón para continuar con la rutina</h4>
                                    	<div class="col-xs-6 pull-right Derecha">
                                        	<input type="button" class="btn btn-success" value="Siguiente" id="Continuar_Rutina">
                                        </div>
                                    </div><!-- row-->
                                </div><!-- col-xs-12-->
                                
                            </div><!--box  -->
                        </div><!-- col-xs.12-->
                    </div><!-- row-->
                </section>
            </aside>

</div>


        
      
<?php include('includes/footer.php');?>


<?php } else {header("Location: Login.php");}?>

<script>
	 $('#listados').editableTableWidget().numericInputExample();
    $('#textAreaEditor').editableTableWidget({editor: $('<textarea>')});
    window.prettyPrint && prettyPrint();		
</script>

<script>
$(document).ready(function(){
	
	InicializarTablas(); //Método para inicializar los métodos de las tablas
	
	//AÑADIMOS LA CLASE ACTIVE, AL <LI> DEL MENU LATERAL, ESTO CON LA
	//FINALIDAD DE QUE SE SEPA EN QUE SECCIÓN SE ENCUENTRA EL USUARIO
	$('#m-rutinas').addClass('active');
	
	
	//Mandando a la siguiente fase de la rutina
	$("#Continuar_Rutina").click(function(){
		var confirmacion = confirm('¿Está seguro desea pasar a la siguiente etapa de la rutina?');
		if(confirmacion == true)
		{
			id_Rutina = $("#id_Rutina").val(); //Id  de l arutina
			window.location='index.php?nav=Rutinas_Prefinal&Rutina='+id_Rutina; //Elegir rutinas porm día
		}
	});//Continuar_Rutina

//Elimando todas las cookies
var cookies = $.cookie();
for(var cookie in cookies) {
   $.removeCookie(cookie);
}
	
});//document ready

function InicializarTablas()
{
	//Drag and drop table
	$("#table-1").tableDnD();
	$("#table-2").tableDnD();
	$("#table-3").tableDnD();
	$("#table-4").tableDnD();
	$("#table-5").tableDnD();
	$("#table-6").tableDnD();
	$("#table-7").tableDnD();
   //Acciones
   
   // día lunes //
   $('#table-1').tableDnD({
    	onDrop: function(table, row) 
		{
			console.log(row);
			//Tomando los datos del row que se movió
			id 		   = row.id;
			dia_semana = "Actualiza_Lunes";
			CambiarDia(id,dia_semana)	
    	}	
	});
	
	// día Martes //
   $('#table-2').tableDnD({
    	onDrop: function(table, row) 
		{
			console.log(row);
			//Tomando los datos del row que se movió
			id = row.id;
			dia_semana = "Actualiza_Martes";
			CambiarDia(id,dia_semana)	
    	}	
	});
	
	// día miércoles//
	 $('#table-3').tableDnD({
    	onDrop: function(table, row) 
		{
			console.log(row);
			//Tomando los datos del row que se movió
			id = row.id;
			dia_semana = "Actualiza_Miercoles";
			CambiarDia(id,dia_semana)	
    	}	
	});
	
	// día Jueves//
	 $('#table-4').tableDnD({
    	onDrop: function(table, row) 
		{
			console.log(row);
			//Tomando los datos del row que se movió
			id = row.id;
			dia_semana = "Actualiza_Jueves";
			CambiarDia(id,dia_semana)	
    	}	
	});
	
	// día Viernes//
	 $('#table-5').tableDnD({
    	onDrop: function(table, row) 
		{
			console.log(row);
			//Tomando los datos del row que se movió
			id = row.id;
			dia_semana = "Actualiza_Viernes";
			CambiarDia(id,dia_semana)	
    	}	
	});
	
	// día Sábado//
	 $('#table-6').tableDnD({
    	onDrop: function(table, row) 
		{
			console.log(row);
			//Tomando los datos del row que se movió
			id = row.id;
			dia_semana = "Actualiza_Sabado";
			CambiarDia(id,dia_semana)	
    	}	
	});
	
	// día Domingo//
	 $('#table-7').tableDnD({
    	onDrop: function(table, row) 
		{
			console.log(row);
			//Tomando los datos del row que se movió
			id = row.id;
			dia_semana = "Actualiza_Domingo";
			CambiarDia(id,dia_semana)	
    	}	
	});
	
}//InicializarTablas

function CambiarDia(id_par,dia_semana)
{
	//Obtener el tr que está encima
		idJquery = "#"+id;
		Padre = $(idJquery).prev()[0];
		son = $(idJquery).next()[0];
		
		id = parseInt(id_par);
		
		//Ahora verificaremos si tiene se tiene id arriba y abajo o solo de un lado.
		
		if(Padre == undefined) 
		{
			id_Padre 		 = 0;
			AccionCambio 	 = "SinPadre";
		}else {id_Padre = Padre.id;}
		
		if(son == undefined) 
		{
			id_Hijo 		 = 0;
			AccionCambio 	 = "SinHijo";
		}else {id_Hijo = son.id;}
		
		if(Padre != undefined && son !=undefined)
		{
			id_Padre 	 = Padre.id;
			id_Hijo  	 = son.id;
			
			//verificando si se bajó o subió posiciones
			// 1) si el padre es mayor, es por que se bajó la posición
			if(id_Padre>id)
			{
				AccionCambio 	 = "ConAmbosBajoPosicion";
				Cantidad_Puestos = id_Padre - id; 
			}//if
			
			if(id_Padre<id)
			{
				AccionCambio 	 = "ConAmbosSubioPosicion";
				Cantidad_Puestos = id - id_Hijo;
			}//if
		}//if
		
		console.log(id);
		console.log(id_Padre+ " padre");
		console.log(id_Hijo);
		
		// Escenarios posibles del cambio de lugar
		
		// 1) Cuando no se tiene padre -> Esto significa que se movió al primer puesto de la lista

		if (id_Padre == 0)
		{
			//Tomar la cantidad de puestos que se movió
			Cantidad_Puestos = id-id_Hijo;
		} // id_Padre == 0	
		
		if (id_Hijo == 0)
		{
			Cantidad_Puestos = id_Padre-id;
		}
		
		
		
			
			//Tomando los valores para mandarlos al controller
			var Arr = new Object();
			Arr['id_Rutina'] 		= $("#id_Rutina").val();
			Arr['id_Cambio'] 		= id;
			Arr['id_Hijo']	 		= id_Hijo;
			Arr['id_Padre']	 		= id_Padre;
			Arr['Cantidad_Puestos'] = Cantidad_Puestos;
			Arr['AccionCambio'] 	= AccionCambio;
			Arr['Accion']	 		= "CambioLugarEjercicio"
			var Params= JSON.stringify(Arr);
			
			//Validación, si el hijo es mayor por solo 1 o el padre menor por 1
			Cantidad_DiferenciaHijo  = id_Hijo - id; //Diferencia entre id_hijo y el id que fue movido
			Cantidad_DiferenciaPadre = id - id_Padre;
			Actividad_Sola			 = 0;
			MismoLugar_Hijo 		 = 0;
			MismoLugar_Padre 	 	 = 0;
			
			console.log(Cantidad_DiferenciaHijo+" diferencia");
			//Verificando, si no tiene ni padre o hijio, es que es una sola actividad
			if(id_Hijo==0 && id_Padre==0 )
			{
				Actividad_Sola = 1;
			}//if
			
			if(Cantidad_DiferenciaHijo!=1 && Cantidad_DiferenciaPadre!=1 && Actividad_Sola!=1 )
			{
				$.ajax("modulos/Rutinas/Funciones.php?Params="+Params).done(function(response){
					//Después del Ajax
					//var objJSON = eval("(function(){return " + response + ";})()");
					ActualizaDia(dia_semana)
				})//ajax
			}//if
			
			
			
} // cambiardia



function ActualizaDia(dia)
{
	//Tomando los valores
	//id_dia 	  = dia.id;
	//id_Rutina = $("#id_Rutina").val();
	
	//Tomando el número de día por el id del botón
	switch(dia)
	{
		case 'Actualiza_Lunes':
			Dia_Semana = 1;
		break;
		
		case 'Actualiza_Martes':
			Dia_Semana = 2;
		break;
		
		case 'Actualiza_Miercoles':
			Dia_Semana = 3;
		break;
		
		case 'Actualiza_Jueves':
			Dia_Semana = 4;
		break;
		
		case 'Actualiza_Viernes':
			Dia_Semana = 5;
		break;
		
		case 'Actualiza_Sabado':
			Dia_Semana = 6;
		break;
		
		case 'Actualiza_Domingo':
			Dia_Semana = 7;
		break;
		
	}//switch
	
	//se crea el objeto y el array Json para mandarlos al archivo donde se van a cargar los nuevos datos
	//Tomando los valores para mandarlos al controller
			var Arr = new Object();
			Arr['id_Rutina'] 	= $("#id_Rutina").val();
			Arr['Dia_Semana'] 		= Dia_Semana;
			Arr['Accion']	 	= "CambioLugarEjercicio"
			var Params= JSON.stringify(Arr);
	
	//Tomando el id del día a sustituir a partir del id del botón
	switch(dia)
	{
		case 'Actualiza_Lunes':
			id_Sustituye = "#"+"table-1";
		break;
		
		case 'Actualiza_Martes':
			id_Sustituye = "#"+"table-2";
		break;
		
		case 'Actualiza_Miercoles':
			id_Sustituye = "#"+"table-3";
		break;
		
		case 'Actualiza_Jueves':
			id_Sustituye = "#"+"table-4";
		break;
		
		case 'Actualiza_Viernes':
			id_Sustituye = "#"+"table-5";
		break;
		
		case 'Actualiza_Sabado':
			id_Sustituye = "#"+"table-6";
		break;
		
		case 'Actualiza_Domingo':
			id_Sustituye = "#"+"table-7";
		break;
		
	}//switch
				
	//Sustituyendo la tabla
	//alert(id_Sustituye);
	$.post( "modulos/Rutinas/DiasEjercicioCargar.php", { Params: Params})
  .done(function( response ) {
		$(id_Sustituye).html(response).hide();
		$(id_Sustituye).show('slideDown');
		$(id_Sustituye).tableDnD();
		InicializarTablas()
  });
				
}//ActualizaDia



</script>

