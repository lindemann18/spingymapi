<?php
	$consultar=new Consultar();
	$result=$consultar->_ConsultarTiposMusculos();
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
		$id_cliente=$_GET['id_cliente']; //id del cliente
		
		//Verificar que el usuario no tenga una rutina ya asignada.
		$Puerta=true;
		$consultar			 = new Consultar();
		$ResultUsuarios 	 = $consultar->_ConsultarUsuarios();
		$ResultRutinaCliente = $consultar->_ConsultarRutinasClientesPorIdCliente($id_cliente);
		$num_Rutinas		 = $ResultRutinaCliente->num_rows;
		$Cambio 			 = (isset($_GET['Asig']))?$_GET['Asig']:0;
		$Puerta				 = false;
		if($num_Rutinas==0)
		{
			$Puerta		   = true;
			//Buscando los tipos de musculo y de rutina
			$ResultMusculo = $consultar->_ConsultarMusculos();
			$ResultRutinas = $consultar->_ConsultarTiposDeRutina(); //rutinas existentes
			$num_rutinas   = $ResultRutinas->num_rows; //cantidad de rutinas
			$Rutinas	   = Array(); 
			
			//Tomando todas las rutinas para pegarlas en los selects
			for($i=0; $i<$num_rutinas; $i++)
			{
				$fila 	= $ResultRutinas->fetch_assoc();
				$rutina = array("id"=>$fila['id'], "nb_TipoRutina"=>$fila['nb_TipoRutina']);
				array_push($Rutinas, $rutina);
			}//for
			
			//Consultar las categorías de rutina que existen
			$resultCategoriaRutinas = $consultar->_ConsultarCategoriasDeRutinas();
			$numCategoriaRutinas	= $resultCategoriaRutinas->num_rows;
		}//if $num_Rutinas==0
		else {$Puerta=false;}
?>
<?php if($Puerta==true) {?>

<style>
.Cuestionario{margin-right: 20%;}
.Botones {margin-right: 4%;}
</style>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Rutinas
                        <small>Registrar Ejercicios</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="active">Rutinas</li>
                    </ol>
                </section>
                
                
                <!-- Main content -->
                <section class="content">
                	<!-- HEADER DEL CONTENIDO-->
                    <div class="alert alert-success alert-dismissible" role="alert" style="display:none;" id="RutinaNoExistenteNotificacion">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Bien !</strong> Esta Rutina No existe.</div>
 <div class="alert alert-danger alert-dismissible" role="alert" style="display:none;" id="RutinaExistenteNotificacion">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Espera!</strong> Esta nombre ya existe para una rutina de la misma categoría.</div> 		
  
                    <h4 class="page-header">
                        Formulario De Rutinas
                        <small>
                        	En este apartado podrá registrar las Rutinas para los clientes de <span class="text-red">spin gym</span>. Anote el nombre de la rutina, descripci&oacute;n
                            seleccione el tipo de rutina para cada día de la semana de la persona.
                        </small>
                    </h4>
                    <!-- HEADER DEL CONTENIDO-->

                    <!-- FORMULARIO -->
                    <form name="MusculosRegistrar" id="MusculosRegistrar" method="post" role="form">
                    <!-- RENGLON CON EL FORMULARIO Y DOS COLUMNAS-->
                    <div class="row">
                    	<!-- COLUMNA IZQUIERDA -->
                    	<div class="col-md-8 pull-right Cuestionario">
                        	<!-- CAJA -->
							<div class="box box-primary">
                                <!-- HEADER DE LA CAJA -->
                                <div class="box-header">
                                    <h3 class="box-title">Datos Rutinas</h3>
                                </div>
                                <!-- HEADER DE LA CAJA -->
                                    
                                <!-- CUERPO DE LA CAJA -->
                                <div class="box-body">
                                	
                                    <!-- input con el id de quien lo registró-->
                                	<input type="hidden" id="id_usuario" value="<?php echo $_SESSION['Sesion']['id_usuario'];?>">
                                    <input type="hidden" id="id_cliente" value="<?php echo $id_cliente?>" />
                                    <div class="form-group">
                                        <label for="nb_cliente">Nombre </label>
                                        <input type="text" name="nb_rutina" id="nb_rutina" campo="Nombres" class="form-control requerido" placeholder="Nombre de Rutina">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="nb_apellidos">Descripci&oacute;n</label>
                                        <textarea name="desc_rutina" id="desc_rutina" class="form-control requerido"></textarea>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <label for="nb_apellidos">Categor&iacute;a</label>
                                       <select name="id_CategoriaRutina" id="id_CategoriaRutina" class="form-control requerido" onchange="">
                                       	<option value="">Seleccionar...</option>
                                        <?php 
											for($i=0; $i<$numCategoriaRutinas; $i++)
											{
												$filaCategoriaRutinas=$resultCategoriaRutinas->fetch_assoc();
												echo '<option value="'.$filaCategoriaRutinas['id'].'">'.$filaCategoriaRutinas['nb_CategoriaRutina'].'</option>';
											}//for
											
										?>
                                       </select>
                                    </div>
                                    
                                    <!-- días de la rutina-->
                                    <div class="form-group">
                                        <label for="nb_apellidos">Lunes</label>
                                       <select name="Ejercicio_Lunes" id="Ejercicio_Lunes" class="form-control requerido" onChange="">
                                       	<option value="">Seleccionar...</option>
                                        <?php 
										print_r($Rutinas);
											for($i=0; $i<$num_rutinas; $i++)
											{
												echo '<option value="'.$Rutinas[$i]['id'].'">'.$Rutinas[$i]['nb_TipoRutina'].'</option>';
											}	
											
										?>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nb_apellidos">Martes</label>
                                       <select name="Ejercicio_Martes" id="Ejercicio_Martes" class="form-control requerido" onChange="">
                                       	<option value="">Seleccionar...</option>
                                        <?php 
										print_r($Rutinas);
											for($i=0; $i<$num_rutinas; $i++)
											{
												echo '<option value="'.$Rutinas[$i]['id'].'">'.$Rutinas[$i]['nb_TipoRutina'].'</option>';
											}	
											
										?>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nb_apellidos">Mi&eacute;rcoles</label>
                                       <select name="Ejercicio_Miercoles" id="Ejercicio_Miercoles" class="form-control requerido" onChange="">
                                       	<option value="">Seleccionar...</option>
                                        <?php 
										print_r($Rutinas);
											for($i=0; $i<$num_rutinas; $i++)
											{
												echo '<option value="'.$Rutinas[$i]['id'].'">'.$Rutinas[$i]['nb_TipoRutina'].'</option>';
											}	
											
										?>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nb_apellidos">Jueves</label>
                                       <select name="Ejercicio_Jueves" id="Ejercicio_Jueves" class="form-control requerido" onChange="">
                                       	<option value="">Seleccionar...</option>
                                        <?php 
										print_r($Rutinas);
											for($i=0; $i<$num_rutinas; $i++)
											{
												echo '<option value="'.$Rutinas[$i]['id'].'">'.$Rutinas[$i]['nb_TipoRutina'].'</option>';
											}	
											
										?>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nb_apellidos">Viernes</label>
                                       <select name="Ejercicio_Viernes" id="Ejercicio_Viernes" class="form-control requerido" onChange="">
                                       	<option value="">Seleccionar...</option>
                                        <?php 
										print_r($Rutinas);
											for($i=0; $i<$num_rutinas; $i++)
											{
												echo '<option value="'.$Rutinas[$i]['id'].'">'.$Rutinas[$i]['nb_TipoRutina'].'</option>';
											}	
											
										?>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nb_apellidos">S&aacute;bado</label>
                                       <select name="Ejercicio_Sabado" id="Ejercicio_Sabado" class="form-control requerido" onChange="">
                                       	<option value="">Seleccionar...</option>
                                        <?php 
										print_r($Rutinas);
											for($i=0; $i<$num_rutinas; $i++)
											{
												echo '<option value="'.$Rutinas[$i]['id'].'">'.$Rutinas[$i]['nb_TipoRutina'].'</option>';
											}	
											
										?>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nb_apellidos">Domingo</label>
                                       <select name="Ejercicio_Domingo" id="Ejercicio_Domingo" class="form-control requerido" onChange="">
                                       	<option value="">Seleccionar...</option>
                                        <?php 
										print_r($Rutinas);
											for($i=0; $i<$num_rutinas; $i++)
											{
												echo '<option value="'.$Rutinas[$i]['id'].'">'.$Rutinas[$i]['nb_TipoRutina'].'</option>';
											}	
											
										?>
                                       </select>
                                    </div>
                                    
                                    
                                </div><!-- box-body -->
                                <!-- CUERPO DE LA CAJA -->

                                <!-- FOOTER DE LA CAJA -->
                                <div class="box-footer">
                                     Los campos marcados con <span class="text-red"><strong>*</strong></span> son obligatorios.
                                </div>
                                <!-- FOOTER DE LA CAJA -->
                            </div>
                            <!-- CAJA -->
                        </div>
                        <!-- COLUMNA IZQUIERDA -->
                        
                       
                    </div>
                    <!-- RENGLON CON EL FORMULARIO Y DOS COLUMNAS-->
                    
                    <div class="row Botones">
                    	<div class="col-md-6" align="right"><button type="button" class="btn btn-primary" onclick=" checkRequeridos();">REGISTRAR</button></div>
                        <div class="col-md-6" align="left"><button type="reset" class="btn btn-danger" onclick="window.location='index.php?nav=Rutinas';">CANCELAR</button></div>
                    </div>
                    </form>
                    <!-- FORMULARIO -->
                </section>
            </aside>

</div>
<?php } else{?>
<style>
	.RightButton {margin-right: 17%;}
</style>
 <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Rutinas
                        <small>Advertencia Rutinas</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="">Rutinas</li>
                    </ol>
                </section>
                
                
                <!-- Main content -->
                <section class="content">
                	<!-- HEADER DEL CONTENIDO-->
                    <h4 class="page-header">
                       	Advertencia de Rutinas
                        <small>

                        	En este apartado podrá Registrar una nueva rutina para un cliente de <span class="text-red">spin gym</span>,
                            <strong><span class="text-red">RECUERDE</span></strong> que si el cliente ya tiene una rutina
                            previa, esta será desechada para crearle una nueva rutina
                        </small>
                    </h4>
                    <!-- HEADER DEL CONTENIDO-->
                    <div class="alert alert-success alert-dismissible" role="alert" style="display:none;" id="EjercicioEliminadoNotificacion">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Bien Hecho!</strong>Ejercicio Eliminado.</div>
					<div class="row">
                    	<div class="col-xs-12">
							<div class="box">
                                <div class="box-header">
                                    <div class="col-sm-12">
                                    	<h4>
                                            El cliente actual ya cuenta con una rutina (Asignada o personalizada) de 
                                            <span class="text-red">Spin Gym</span>, recuerde que Al pasar al siguiente apartado se 
                                            <strong>dará de baja</strong> la rutina actual del cliente,
                                        	para crearle una rutina personalizada. Si no desea crearle una nueva rutina presione al 
                                            botón cancelar, si desea crearle una rutina nueva, de click en continuar.
                                        </h4>
                                        <div class="col-xs-6 pull-right Botones RightButton">
                                        	<div class="col-xs-3"><input type="button" class="btn btn-danger" value="Cancelar" onclick="CancelarR()"></div>
                                            <div class="col-xs-3"><input type="button" class="btn btn-success" value="Continuar" onclick="ContinuarR()"></div>
                                            <input type="hidden" value="<?php echo $id_cliente?>" id="id_cliente">
                                        </div><!-- Botones-->
                                    </div><!-- col-sm-12 -->
                                </div><!-- /.box-header -->
                                
                            </div>
                        </div>
                    </div>
                </section>
            </aside>

</div>

<?php } ?>
<?php 
	include('includes/footer.php');
	include("modulos/Usuarios/JavaScript.php");
?>

<?php } else {header("Location: Login.php");}?>
<script>
$(document).ready(function(){
	var raizModulo = 'clientes_listado.php';
	
	//AÑADIMOS LA CLASE ACTIVE, AL <LI> DEL MENU LATERAL, ESTO CON LA
	//FINALIDAD DE QUE SE SEPA EN QUE SECCIÓN SE ENCUENTRA EL USUARIO
	$('#m-rutinas').addClass('active');
	
	//DAMOS EL FOCO AL INPUT DEL NOMBRE
	$('#nb_cliente').focus();
	
	RutinaVerificada=0; //Esta variable nos dice si la rutina existe o no, 1 no existe y 0 si existe. A la hora de hacer el regsitro se verifica.
	DiaActual=""; //Variable que incida el día actual en el que se encuentra el proceso de la creación de Rutinas.
	
});



function checkRequeridos(){
	var contador 	= 0;
	var campo		= '';
	var	id			= '';
	
	//PARA CADA ELEMENTO CON CLASE requerido
	$(".requerido").each(function(index){
		//SI EL VALOR DE ESTE ELEMENTO ES VACIO
		if ($(this).val() == '' ){
			contador++;									//AUMENTAMOS EN 1 A contador
			$(this).parent().addClass('has-error');		//AGREGAMOS AL DIV PADRE DEL ELEMENTO (CON CLASE requerido) LA CLASE has-error
			$(this).focus();							//LE PASAMOS EL FOCO AL ELEMENTO
			return false;								//RETORNAMOS UN FALSE PARA QUE NO SE EJECUTE EL SUBMIT
		}
		
		//SI EL DIV PADRE DEL ELEMENTO TIENE LA CLASE has-error Y EL VALOR DEL ELEMENTO CON CLASE REQUERIDO ES
		//DIFERENTE DE VACIO
		if( $(this).parent().hasClass('has-error') && $(this).val() != '' ){
			//REMOVEMOS LA CLASE has-error DEL DIV PADRE DEL ELEMENTO CON CLASE requerido
			$(this).parent().removeClass('has-error');
			//RESETEAMOS contador PARA QUE VUELVA A SER 0 Y NO AFECTE EN LA SIGUIENTE VALIDACION
			contador = 0;
		}
	});
	
	//SI CONTADOR (POR ALGUNA EXTRAÑA RAZON) ES DIFERENTE DE 0
	if( contador != 0 ){
		//RETORNAMOS FALSE PARA QUE NO SE EJECUTE EL SUBMIT
		return false;
	//SI NO
	}else{
		//EJECUTAMOS  LA FUNCION clientesRegistrar()
		RegistraMaquina();
	}
}

function ContinuarR()
{
	var confirmacion = confirm('¿Está seguro que desea crear una rutina nueva?. La anterior será eliminada');
		if(confirmacion == true)
		{
			id_cliente 			  = $("#id_cliente").val();
			var Arr				  = new Object();	
			Arr['id_cliente']	  = id_cliente;
			Arr['Accion']		  = "DesactivarRutina";
			
			//Mandando por AJAX la información a la BD
			var Params= JSON.stringify(Arr);
			$.ajax("modulos/Clientes/Funciones.php?Params="+Params).then(function(response){
				window.location='index.php?nav=clientes_AgregarRu&id_cliente='+id_cliente;
			});//ajax
		}//confirmación
}//ContinuarR

function CancelarR()
{
	id_cliente = $("#id_cliente").val();
	
	var confirmacion = confirm('¿Está seguro que desea cancelar la asignación de rutina?');
		if(confirmacion == true){
			
				window.location='index.php?nav=clientes_rutina&id_cliente='+id_cliente;
			
		}
}//CancelarR

function VerificarDiaPorCodigo(Dia)
{
	switch(Dia)
	{
		case 'Ejercicio_Lunes':
			DiaActual="1";
		break;
		case 'Ejercicio_Martes':
			DiaActual="2";
		break;
		case 'Ejercicio_Miercoles':
			DiaActual="3";
		break;
		case 'Ejercicio_Jueves':
			DiaActual="4";
		break;
		case 'Ejercicio_Viernes':
			DiaActual="5";
		break;
		case 'Ejercicio_Sabado':
			DiaActual="6";
		break;
		case 'Ejercicio_Domingo':
			DiaActual="7";
		break;
	}//switch
}//VerificarDiaPorCodigo

function RegistraMaquina()
{
	LunesValor=$('#Ejercicio_Lunes').val();
	//Tomando los valores en cookies
	$.cookie("id_CategoriaRutina",$('#id_CategoriaRutina').val());
	$.cookie("Ejercicio_Lunes",$('#Ejercicio_Lunes').val());
	$.cookie("Ejercicio_Martes",$('#Ejercicio_Martes').val());
	$.cookie("Ejercicio_Miercoles",$('#Ejercicio_Miercoles').val());
	$.cookie("Ejercicio_Jueves",$('#Ejercicio_Jueves').val());
	$.cookie("Ejercicio_Viernes",$('#Ejercicio_Viernes').val());
	$.cookie("Ejercicio_Sabado",$('#Ejercicio_Sabado').val());
	$.cookie("Ejercicio_Domingo",$('#Ejercicio_Domingo').val());
	
	//Tomando los valores y metiéndolos en el array
	Ejercicio_Lunes		= $('#Ejercicio_Lunes').val();
	Ejercicio_Martes	= $('#Ejercicio_Martes').val();
	Ejercicio_Miercoles	= $('#Ejercicio_Miercoles').val();
	Ejercicio_Jueves	= $('#Ejercicio_Jueves').val();
	Ejercicio_Viernes	= $('#Ejercicio_Viernes').val();
	Ejercicio_Sabado	= $('#Ejercicio_Sabado').val();
	Ejercicio_Domingo	= $('#Ejercicio_Domingo').val();
	
	RutinasDias=new Array();
	RutinasDias.push(Ejercicio_Lunes);
	RutinasDias.push(Ejercicio_Martes);
	RutinasDias.push(Ejercicio_Miercoles);
	RutinasDias.push(Ejercicio_Jueves);
	RutinasDias.push(Ejercicio_Viernes);
	RutinasDias.push(Ejercicio_Sabado);
	RutinasDias.push(Ejercicio_Domingo);
	
	//tomando los textos de los tipos de rutina y metiéndolos al vector
	TiposRutinasSemana=new Array(); //Vector con todos los tipos de rutina de la semana
	TiposRutinasSemana.push($("#Ejercicio_Lunes option:selected").text()); //Tomando el tipo de rutina
	TiposRutinasSemana.push($("#Ejercicio_Martes option:selected").text()); //Tomando el tipo de rutina
	TiposRutinasSemana.push($("#Ejercicio_Miercoles option:selected").text()); //Tomando el tipo de rutina
	TiposRutinasSemana.push($("#Ejercicio_Jueves option:selected").text()); //Tomando el tipo de rutina
	TiposRutinasSemana.push($("#Ejercicio_Viernes option:selected").text()); //Tomando el tipo de rutina
	TiposRutinasSemana.push($("#Ejercicio_Sabado option:selected").text()); //Tomando el tipo de rutina
	TiposRutinasSemana.push($("#Ejercicio_Domingo option:selected").text()); //Tomando el tipo de rutina
	
	ContadorRutinasDias=0; //Contador para ir recorriendo ambos vectores, el de que valor tienes las categorías y el texto
	
	//Guardando los vectores como Cookies
	$.cookie("RutinasDias",RutinasDias);
	$.cookie("TiposRutinasSemana",TiposRutinasSemana);
	$.cookie("ContadorRutinasDias",ContadorRutinasDias);

	
	//Definir el día actual para editar
	$.cookie("Dia_ActualRutina","Ejercicio_Lunes");
	RutinaProvicional=$("#Ejercicio_Lunes").val(); //Tomando el valor del primer día de rutina
	TipoRutina=$("#Ejercicio_Lunes option:selected").text(); //Tomando el tipo de rutina
	Tipo_RutinaActual=(TipoRutina!="Varios")?"Simple":"Compleja"; //Se toma el tipo de rutina que se ha seleccionado para ver a donde se 
	//Dirige al usuario, si a elegir varios tipos de rutina o ejercicios de forma directa.
	
	 //Tipo de rutina a la que se mandará la primera opción si es Varios es rutina compleja, si no sencilla.
	$.cookie("Tipo_RutinaActual",Tipo_RutinaActual);
	VerificarDiaPorCodigo("Ejercicio_Lunes");
	

		var confirmacion = confirm('¿Está seguro de pasar al siguiente FORMULARIO?');
		if(confirmacion == true)
			{
				//Guardando la rutina en la BD
				
				//Objeto con la información a guardar en la BD
				var Arr=new Object();	
				Arr['nb_rutina']		  = $("#nb_rutina").val();
				Arr['desc_rutina']		  = $("#desc_rutina").val();
				Arr['id_CategoriaRutina'] = $("#id_CategoriaRutina").val();
				Arr['id_usuario']		  = $("#id_usuario").val();
				Arr['id_cliente']		  = $("#id_cliente").val();	
				Arr['Accion']		 	  = "AgregarRutina";
				
				//Mandando por AJAX la información a la BD
				var Params= JSON.stringify(Arr);	
				
		$.ajax({
				
				cache: false,
				type: "GET",
				contentType:false,
				processData:false,
				url: "modulos/Clientes/Funciones.php?Params="+Params,
				data: Params,
				datatype:"json",
				success: function(response){
					console.log(response);	
					var objJSON = eval("(function(){return " + response + ";})()");
					//Tomando el id de la rutina 
					id_rutina=objJSON.id_rutina;
					//Haciendo la cookie de la rutina
					
					//Verificar el tipo de rutina que se eligió
				
				}
				
			});	
				
			//Verificando si manda a elegir rutinas por día o a elegir los ejercicios directamente.				
			if(Tipo_RutinaActual=="Compleja")
				{
					//$.cookie("DiaActual",DiaActual);
					window.location='index.php?nav=Rutina_CompCl&Day='+DiaActual; //Elegir rutinas porm día
				}else {window.location='index.php?nav=RutinasClient2&Day='+DiaActual+"&Rut="+LunesValor;}	//elegir ejercicios directamente
	
	}//confirmacion
}//registrar



</script>
