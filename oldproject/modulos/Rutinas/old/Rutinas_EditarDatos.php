<?php
	$consultar=new Consultar();
	$result=$consultar->_ConsultarTiposMusculos();
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
		
		//atrapar los valores de la rutina
		$id_rutina = $_GET['id_rutina'];
		$result	   = $consultar->_ConsultarInformacionRutinaPorId($id_rutina);
		$fila	   = $result->fetch_assoc();
		
		//Consultando los géneros de rutina existentes
		$ResultGenero = $consultar->_ConsultarGenerosRutina();
		$num_genero   = $ResultGenero->num_rows;

		//Consultando tipos de cuerpo.
		$resultCuerpo = $consultar->_ConsultarTiposCuerpo();
		$num_cuerpos  = $resultCuerpo->num_rows;
?>

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
                    <div class="alert alert-success alert-dismissible" role="alert" style="display:none;" id="RutinaEditadoNotificacion">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Bien Hecho!</strong> Rutina Editada.</div>
                    <h4 class="page-header">
                        Formulario De Ejercicios
                        <small>
                        	En este apartado podrá Editar la información de las rutinas de <span class="text-red">spin gym</span>.
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
                                    <h3 class="box-title">Datos Ejercicios</h3>
                                </div>
                                <!-- HEADER DE LA CAJA -->
                                    
                                <!-- CUERPO DE LA CAJA -->
                                <div class="box-body">
                                	
                                    <!-- input con el id de quien lo registró-->
                                	<input type="hidden" id="id_rutina" value="<?php echo $id_rutina?>">
                                    <div class="form-group">
                                        <label for="nb_cliente">Nombre * </label>
                                        <input type="text" name="nb_rutina" id="nb_rutina" campo="Nombres" 
                                        class="form-control requerido" placeholder="Nombre de rutina" value="<?php echo $fila['nb_rutina']?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="nb_apellidos">Descripci&oacute;n *</label>
                                        <textarea name="desc_rutina" id="desc_rutina" 
                                        	class="form-control requerido"><?php echo $fila['desc_rutina']?></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="nb_apellidos">Género</label>
                                       <select name="id_GeneroRutina" id="id_GeneroRutina" class="form-control requerido" onchange="">
                                       	<option value="">Seleccionar...</option>
                                        <?php 
											for($i=0; $i<$num_genero; $i++)
											{
												$filaGenero = $ResultGenero->fetch_assoc();
												if($fila['id_GeneroRutina']==$filaGenero['id'])
												{echo '<option value="'.$filaGenero['id'].'" selected>'.$filaGenero['nb_TipoRutina'].'</option>';}
												else{echo '<option value="'.$filaGenero['id'].'">'.$filaGenero['nb_TipoRutina'].'</option>';}
											}//for
											
										?>
                                       </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="nb_apellidos">Tipo Cuerpo*</label>
                                        <select name="" id="id_cuerpo" class="form-control">
                                        <option value="">Seleccionar...</option>
                                        	<?php 
                                        		for($i=0; $i<$num_cuerpos; $i++)
                                    			{
                                    				$filacuerpo = $resultCuerpo->fetch_assoc();
                                    				if($fila['id_tipocuerpo']==$filacuerpo['id'])
													{echo '<option value="'.$filacuerpo['id'].'" selected>'.$filacuerpo['nb_cuerpo'].'</option>';}                                    				
													else{echo '<option value="'.$filacuerpo['id'].'">'.$filacuerpo['nb_cuerpo'].'</option>';}
                                    			}//for
                                        	?>
                                        </select>
                                    </div>

                                    <div class=" Botones  form-group">
										<div class="row">
                                <div class="col-md-1 col-xs-1 pull-left " >
                                	<button type="button" class="btn btn-primary" onclick=" checkRequeridos();">EDITAR</button>
                                </div>
                                	<div class="col-md-1 col-xs-1">&nbsp;</div>
                                <div class="col-md-1 col-xs-1 pull-left" >
                                <button type="reset" class="btn btn-danger" onclick="window.location='index.php?nav=Rutinas';">CANCELAR</button>	
                                </div>
                                <div class="col-md-1 col-xs-1">&nbsp;</div>
                            <div class="col-md-1 col-xs-1 pull-left" >
                                <button type="reset" class="btn btn-info" onclick="EditarDiasRutina()">Editar Dias</button>
                            </div>
				                    </div><!-- row-->
				                    </div><!-- botones-->
                                                                        
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
                    
                    
                    </form>
                    <!-- FORMULARIO -->
                </section>
            </aside>

</div>

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

function EditarDiasRutina()
{
	idRutina = $("#id_rutina").val();
	var confirmacion = confirm('¿Está seguro de editar esta Rutina?');
		if(confirmacion == true){
			if(idRutina!=0){window.location='index.php?nav=Rutinas_Editar&id_rutina='+idRutina;}
			else {alert("Por favor selecciona alguna Rutina para editar");}
		}//if true
}//EditarDiasRutina

function RegistraMaquina()
{
	var Arr=new Object();	
	Arr['id_rutina'] 	   = $("#id_rutina").val();
	Arr['nb_rutina']   	   = $('#nb_rutina').val();
	Arr['desc_rutina']	   = $('#desc_rutina').val();
	Arr['id_GeneroRutina'] = $("#id_GeneroRutina").val();
	Arr['id_cuerpo']  	   = $("#id_cuerpo").val();
	Arr['Accion']	   	   = "EditarDatosRutina";
	
	var Params= JSON.stringify(Arr);	
	console.log(Params);
		$.ajax({
				
				cache: false,
				type: "GET",
				contentType:false,
				processData:false,
				url: "modulos/Rutinas/Funciones.php?Params="+Params,
				data: Params,
				datatype:"json",
				success: function(response){
					console.log(response);	
					var objJSON = eval("(function(){return " + response + ";})()");
					$("#RutinaEditadoNotificacion").css("display","inherit");
					$("#RutinaEditadoNotificacion").delay( 8000 ).fadeOut();
					
				}
				
			});	
	
}

</script>
