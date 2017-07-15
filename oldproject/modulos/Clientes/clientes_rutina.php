<style type="text/css">
	.ListaInstructores {margin-left: 4%; margin-top: 0%; visibility:hidden}
	.LeftButton {margin-left: 7%;}
	.Opcion {background-color: #eee; padding: 20px; margin-top: 10px; margin-right: 0px; text-align: center; border-radius: 15px; margin-left:1%; width: 31.5%;}
	.Derecha {margin-right: 13%;}
</style>
<?php
	
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
		
		//Tomando el id del cliente
		if(isset($_GET['id_cliente']) && $_GET['id_cliente']!="")
		{
			$id_instructor = $_SESSION['Sesion']['id_usuario']; //id el usuario entrenador
			$id_cliente	   = $_GET['id_cliente'];	
			$consultar	   = new Consultar();
			
			//Verificar  si el cliente ya hizo el formulario 
			$resultFormulario = $consultar->_ConsultarSiClienteHizoElFormulario($id_cliente);
			$num_formulario	  = $resultFormulario->num_rows;
			$puerta			  = ($num_formulario>0)?true:false;
			
			$resultFormulario = $consultar->_ConsultarInfoFormularioPorIdCliente($id_cliente); //Buscando la información del formulario del cliente
			$filaFormulario	  = $resultFormulario->fetch_assoc(); //Conviertiéndolo en un row
			$result			  = $consultar->_ConsultarInformacionClientesRutinaPorIdCliente($id_cliente); //Tomando los datos
			$num_res		  = $result->num_rows;
			if($num_res>0){$fila=$result->fetch_assoc();} //Convirtiéndolos en un row en caso de que haya más de uno
		}
?>


			

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Clientes
                        <small>Rutinas Para Clientes</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="">Clientes</li>
                    </ol>
                </section>
                
                
                <!-- Main content -->
                <section class="content">
                	<!-- HEADER DEL CONTENIDO-->
                    <h4 class="page-header">
                        Rutinas Para Clientes
                        <small>
                        	En este apartado encontrará a todas las opciones de rutinas para los clientes de <span class="text-red">spin gym</span>,
                             a demás podrá crear rutinas, ver la rutina, asignar una ya existente y/o ver las metas del cliente.
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
                                    	<h4>Para realizar alguna acción con un registro, por favor de clic sobre la información correspondiente
                                        del cliente para seleccionarlo, y a continuación, de clic en alguno de los botones EDITAR o ELIMINAR.</h4>
                                    </div>
                                    
                                    <!-- Datos del cliente sobre sus metas y tiempo de dedicación a la semana-->
                                    <div class="col-xs-12 InfoCliente">
                                        <div class="row">
                                            <h3 class="text-center"><?php echo $filaFormulario['nb_cliente']." ".$filaFormulario['nb_apellidos']?></h3>
                                            <div class="col-xs-4">
                                            	<h4>Minutos A dedicar Por d&iacute;a: <?php echo $filaFormulario['Minutos_Dia']; ?></h4>
                                            </div>
                                            
                                            <div class="col-xs-4">
                                            	<h4>d&iacute;as a dedicar por semana: <?php echo $filaFormulario['Dias_Semana']; ?></h4>
                                            </div>
                                            
                                            <div class="col-xs-4">
                                            	<h4>Objetivo del ejercicio: <br /> <?php echo $filaFormulario['Resultado_Ejercicio']; ?></h4>
                                            </div>
                                        </div><!--row -->
                                    </div><!--InfoCliente -->
                                    
                                    <!-- Opciones de rutina para el cliente-->
                                    <div class="col-xs-12 OpcionesRutinas">
                                    	<div class="row">
                                      	  <h3 class="text-center">Opciones De Rutinas</h3>
                                        	<div class="col-xs-4 Opcion">
                                            	<h4 class="text-center">Crear Rutina</h4>
                                                <p class="text-center">
                                                	 Apartado Para Crear una rutina personalizada para el cliente.
                                                 </p>
                                                <button type="button" class="btn btn-info LeftButton" onclick="CrearRutinaCliente(<?php echo $id_cliente?>)">Crear Rutina</button>
                                            </div><!-- Opcion -->
                                            
                                          
                                        	<div class="col-xs-4 Opcion">
                                            	<h4 class="text-center">Ver Rutina</h4>
                                                <p class="text-center">
                                                	 Apartado Para ver la rutina del cliente y mandarla por email.
                                                 </p>
                                                <button type="button" class="btn btn-primary LeftButton" onclick="InfoRutina(<?php echo $id_cliente?>)">Info Rutina</button>
                                            </div><!-- Opcion -->
                                            
                                            <div class="col-xs-4 Opcion">
                                            	<h4 class="text-center">Asignar Rutina</h4>
                                                <p class="text-center">
                                                	 Apartado Para asignar una rutina ya existente al cliente
                                                     
                                                 </p>
                                                <button type="button" class="btn btn-warning LeftButton" onclick="AsignarRutina(<?php echo $id_cliente?>)">Asignar Rutina</button>
                                            </div><!-- Opcion -->
                                            
                                          
                                            
                                        </div><!-- row-->
                                    </div><!-- OpcionesRutinas -->
                                </div><!-- /.box-header -->
                            </div>
                        </div>
                    </div><!--- -->
                </section>
            </aside>

</div>


        
      
<?php include('includes/footer.php');?>


<?php } else {header("Location: Login.php");}?>
<script>
$(document).ready(function(){
	var raizModulo = 'clientes_listadp.php';
	//AÑADIMOS LA CLASE ACTIVE, AL <LI> DEL MENU LATERAL, ESTO CON LA
	//FINALIDAD DE QUE SE SEPA EN QUE SECCIÓN SE ENCUENTRA EL USUARIO
	$('#m-clientes').addClass('active');
	
	//DAMOS EL FOCO AL INPUT DEL NOMBRE
	//$('#nb_cliente').focus();
	
	idClienteEliminar=0;
		
	
});//document ready

function CrearRutinaCliente(id)
{
	var confirmacion = confirm('¿Está seguro que desea acceder al apartado de rutina?');
		if(confirmacion == true){
			
				window.location='index.php?nav=clientes_AgregarRu&id_cliente='+id;
			
		}
	
}

function InfoRutina(id)
{
	var confirmacion = confirm('¿Está seguro que desea acceder al apartado de info rutina?');
		if(confirmacion == true){
			
				window.location='index.php?nav=RutinaOrden&id_cliente='+id;
			
		}	
}//InfoRutina

function AsignarRutina(id)
{
	var confirmacion = confirm('¿Está seguro que desea acceder al apartado de Asignar rutina?');
		if(confirmacion == true){
			
				window.location='index.php?nav=Asignar_Rutinas&id_cliente='+id;
			
		}
	
}//AsignarRutina

function LlevarAlFormulario()
{
		id_cliente=$("#id_cliente").val();
		var confirmacion = confirm('¿Está seguro de hacer el FORMULARIO?');
		if(confirmacion == true){
			
				window.location='index.php?nav=Formulario&id='+id_cliente;
			
		}
}//LlevarAlFormulario
</script>

