<style type="text/css">
	.LabelPregunta {width: 100%;}
	.hide {display: none;}
</style>
<?php
	
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
		if(isset($_GET['id']))
		{
			$id=$_GET['id'];
			//verificar si el usuario ya se hizo alguna vez el biotest
			require_once("libs/libs.php");
			$consultar=new Consultar();
			$result=$consultar->_ConsultarBioTestPorIdCliente($id);
			$num=$result->num_rows;
			//Si existe más de 0 registros, la persona ya hizo el biotest, lo que significa que ahora se editan los datos del biotest
			if($num>0)
			{
				
				//Tomando los datos para poner los valores
				$fila=$result->fetch_assoc();
				
				//formulario1
				$Condicion_Cardiaca 	   = $fila['Condicion_Cardiaca'];
				$Condicion_Pecho		   = $fila['Condicion_Pecho'];
				$Condicion_Pecho_reciente  = $fila['Condicion_Pecho_reciente'];
				$Condicion_Balance		   = $fila['Condicion_Balance'];
				$Lesion_Fisica			   = $fila['Lesion_Fisica'];
				$Medicamentos_Corazon	   = $fila['Medicamentos_Corazon'];
				$Impedimento_Entrenamiento = $fila['Impedimento_Entrenamiento'];
					
				//formulario2
				$Lecturas_Anormales 	  = $fila['Lecturas_Anormales'];
				$Cirujia_Bypass			  = $fila['Cirujia_Bypass'];
				$Dificultad_Respirar 	  = $fila['Dificultad_Respirar'];
				$Enfermedades_Renales	  = $fila['Enfermedades_Renales'];
				$Arritmia				  = $fila['Arritmia'];
				$Colesterol			 	  = $fila['Colesterol'];
				$Presion_Alta		 	  =	$fila['Presion_Alta'];
				$cantidad_Cigarros	  	  = $fila['cantidad_Cigarros'];
				$Molestias_Articulaciones = $fila['Molestias_Articulaciones'];
				$Molestias_Espalda 		  = $fila['Molestias_Espalda'];
			}//if num>0
			
		}//if E_GET
?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Clientes
                        <small>Formulario de salud de Clientes</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="active">Clientes</li>
                    </ol>
                </section>
                
                
                <!-- Main content -->
                <section class="content">
                	<!-- HEADER DEL CONTENIDO-->
                    <div class="alert alert-success alert-dismissible" role="alert" style="display:none;" id="UsuarioAgregadoNotificacion">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Bien Hecho!</strong> Usuario Registrado.</div>
                    <h4 class="page-header">
                        Formulario de Salud
                        <small>
                        	En este apartado podrá aplicar el formulario de salud a los clientes de <span class="text-red">spin gym</span>, 
                            para verificar cualquier problema de salud que le evite o limite de hacer alguna actividad.
                        </small>
                    </h4>
                    <!-- HEADER DEL CONTENIDO-->

                    <!-- FORMULARIO -->
                    <form name="clientesRegistrar" id="clientesRegistrar" method="post" role="form">
                    
                    <input type="hidden" id="id_cliente" value="<?php echo $id?>">
                    <!-- RENGLON CON EL FORMULARIO Y DOS COLUMNAS-->
                    <div class="row">
                    	<!-- COLUMNA IZQUIERDA -->
                    	<div class="col-md-6">
                        	<!-- CAJA -->
							<div class="box box-primary">
                                <!-- HEADER DE LA CAJA -->
                                <div class="box-header">
                                    <h3 class="box-title">Formulario 1-Enfermedades Y Padecimientos</h3>
                                </div>
                                <!-- HEADER DE LA CAJA -->
                                    
                                <!-- CUERPO DE LA CAJA -->
                                <div class="box-body">
                                	<div class="form-group">
                                        <label for="nb_cliente" class="LabelPregunta">1.Alguna vez tu doctor te a señalado que tienes alguna condición cardiaca?</label>
                                        <select name="Condicion_Cardiaca" id="Condicion_Cardiaca" class="LabelPregunta form-control requerido">
                                        	<option value="">Seleccionar...</option>
                                            <option value="1" <?php if(isset($Condicion_Cardiaca) && $Condicion_Cardiaca==1){echo "selected";}?>>Si</option>
                                            <option value="0" <?php if(isset($Condicion_Cardiaca) && $Condicion_Cardiaca==0){echo "selected";}?>>No</option>
                                        </select>
                                    </div>
                                	
                                	 <div class="form-group">
                                        <label for="nb_cliente" class="LabelPregunta">2.Has experimentado dolor en el pecho al realizar alguna actividad física?</label>
                                        <select name="Condicion_Pecho" id="Condicion_Pecho" class="LabelPregunta form-control requerido">
                                        	<option value="">Seleccionar...</option>
                                            <option value="1" <?php if(isset($Condicion_Pecho) && $Condicion_Pecho==1){echo "selected";}?>>Si</option>
                                            <option value="0" <?php if(isset($Condicion_Pecho) && $Condicion_Pecho==0){echo "selected";}?>>No</option>
                                        </select>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="nb_cliente" class="LabelPregunta">3.En el ultimo mes, has experimentado dolor en el pecho al realizar alguna actividad física? </label>
										 <select name="Condicion_Pecho_reciente" id="Condicion_Pecho_reciente" class="LabelPregunta form-control requerido">
                                        	<option value="">Seleccionar...</option>
                                            <option value="1" <?php if(isset($Condicion_Pecho_reciente) && $Condicion_Pecho_reciente==1){echo "selected";}?>>Si</option>
                                            <option value="0" <?php if(isset($Condicion_Pecho_reciente) && $Condicion_Pecho_reciente==0){echo "selected";}?>>No</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="nb_apellidos" class="LabelPregunta">4.Pierdes el balance por mareos o alguna vez has perdido la conciencia?</label>
                                        <select name="Condicion_Balance" id="Condicion_Balance" class="LabelPregunta form-control requerido">
                                        	<option value="">Seleccionar...</option>
                                            <option value="1" <?php if(isset($Condicion_Balance) && $Condicion_Balance==1){echo "selected";}?>>Si</option>
                                            <option value="0" <?php if(isset($Condicion_Balance) && $Condicion_Balance==0){echo "selected";}?>>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="LabelPregunta">5.Tienes algún problema o lesión en osea o de articulación que pueda agravarse al realizar cambios en tu actividad física?</label>
                                         <select name="Lesion_Fisica" id="Lesion_Fisica"  class="LabelPregunta form-control requerido">
                                        	<option value="">Seleccionar...</option>
                                            <option value="1" <?php if(isset($Lesion_Fisica) && $Lesion_Fisica==1){echo "selected";}?>>Si</option>
                                            <option value="0" <?php if(isset($Lesion_Fisica) && $Lesion_Fisica==0){echo "selected";}?>>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="num_edad" class="LabelPregunta">6.Estas tomando medicamentos para la presión o el corazón?</label>
                                         <select name="Medicamentos_Corazon" id="Medicamentos_Corazon" class="LabelPregunta form-control requerido">
                                        	<option value="">Seleccionar...</option>
                                            <option value="1" <?php if(isset($Medicamentos_Corazon) && $Medicamentos_Corazon==1){echo "selected";}?>>Si</option>
                                            <option value="0" <?php if(isset($Medicamentos_Corazon) && $Medicamentos_Corazon==0){echo "selected";}?>>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="de_email" class="LabelPregunta">7.Conoces alguna razón por la cual no deberías participar en un programa de entrenamiento físico?</label>
                                         <select name="Impedimento_Entrenamiento" id="Impedimento_Entrenamiento" class="LabelPregunta form-control requerido">
                                        	<option value="">Seleccionar...</option>
                                            <option value="1" <?php if(isset($Impedimento_Entrenamiento) && $Impedimento_Entrenamiento==1){echo "selected";}?>>Si</option>
                                            <option value="0" <?php if(isset($Impedimento_Entrenamiento) && $Impedimento_Entrenamiento==0){echo "selected";}?>>No</option>
                                        </select>
                                    </div>
                                </div>
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
                        
                        <!-- COLUMNA DERECHA -->
                    	<div class="col-md-6">
							<!-- CAJA -->
                            <div class="box box-warning">
                                <!-- HEADER DE LA CAJA -->
                                <div class="box-header">
                                    <h3 class="box-title">Formulario 2-Enfermedades Y Padecimientos</h3>
                                </div>
                                <!-- HEADER DE LA CAJA -->
                                
                                <!-- CUERPO DE LA CAJA -->
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>8.Algun doctor le a señalado que usted tiene problemas cardiacos, lecturas anormales
                                         de electrocardiogramas o a tenido algún ataque cardiaco?</label>
                                        <select class="form-control requerido" name="Lecturas_Anormales" id="Lecturas_Anormales">
                                            <option value="">SELECCIONAR</option>
                                            <option value="1" <?php if(isset($Lecturas_Anormales) && $Lecturas_Anormales==1){echo "selected";}?>>Si</option>
                                            <option value="0" <?php if(isset($Lecturas_Anormales) && $Lecturas_Anormales==0){echo "selected";}?>>No</option>
                                        </select>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label>9.Se a realizado alguna cirugía de by-pass coronario, angioplastia o algún otro tipo de cirugía cardiaca?</label>
                                           <select class="form-control requerido" campo="Estado" name="Cirujia_Bypass" id="Cirujia_Bypass">
                                            <option value="">SELECCIONAR</option>
                                            <option value="1" <?php if(isset($Cirujia_Bypass) && $Cirujia_Bypass==1){echo "selected";}?>>Si</option>
                                            <option value="0" <?php if(isset($Cirujia_Bypass) && $Cirujia_Bypass==0){echo "selected";}?>>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>10.Ha tenido dificultad para respirar al realizar actividades físicas ligeras o de intensidad normal?</label>
                                          <select class="form-control requerido" campo="Estado" name="Dificultad_Respirar" id="Dificultad_Respirar">
                                            <option value="">SELECCIONAR</option>
                                            <option value="1" <?php if(isset($Dificultad_Respirar) && $Dificultad_Respirar==1){echo "selected";}?>>Si</option>
                                            <option value="0" <?php if(isset($Dificultad_Respirar) && $Dificultad_Respirar==0){echo "selected";}?>>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>11.Tiene historial de enfermedades relacionadas con diabetes, tiroides, riñones o hígado? </label>
                                          <select class="form-control requerido" campo="Estado" name="Enfermedades_Renales" id="Enfermedades_Renales">
                                            <option value="">SELECCIONAR</option>
                                            <option value="1" <?php if(isset($Enfermedades_Renales) && $Enfermedades_Renales==1){echo "selected";}?>>Si</option>
                                            <option value="0" <?php if(isset($Enfermedades_Renales) && $Enfermedades_Renales==0){echo "selected";}?>>No</option>
                                        </select>
                                    </div>
                                    
                                     <div class="form-group">
                                        <label>12.Ha experimentado arritmia o ha sido diagnosticado con alguna condición o enfermedad cardiaca?</label>
                                          <select class="form-control requerido" campo="Estado" name="Arritmia" id="Arritmia">
                                            <option value="">SELECCIONAR</option>
                                            <option value="1" <?php if(isset($Arritmia) && $Arritmia==1){echo "selected";}?>>Si</option>
                                            <option value="0" <?php if(isset($Arritmia) && $Arritmia==0){echo "selected";}?>>No</option>
                                        </select>
                                    </div>
                                    
                                      <div class="form-group">
                                        <label>13.En los últimos 12 meses, se le ha indicado por algún profesional medico que tiene niveles de colesterol elevados?</label>
                                          <select class="form-control requerido" campo="Estado" name="Colesterol" id="Colesterol">
                                            <option value="">SELECCIONAR</option>
                                            <option value="1" <?php if(isset($Colesterol) && $Colesterol==1){echo "selected";}?>>Si</option>
                                            <option value="0" <?php if(isset($Colesterol) && $Colesterol==0){echo "selected";}?>>No</option>
                                        </select>
                                    </div>
                                    
                                     <div class="form-group">
                                        <label>14.En los últimos 12 meses, se le ha indicado por algún profesional medico que tiene condición de alta presión sanguinea?</label>
                                          <select class="form-control requerido" campo="Estado" name="Presion_Alta" id="Presion_Alta">
                                            <option value="">SELECCIONAR</option>
                                            <option value="1" <?php if(isset($Presion_Alta) && $Presion_Alta==1){echo "selected";}?>>Si</option>
                                            <option value="0" <?php if(isset($Presion_Alta) && $Presion_Alta==0){echo "selected";}?>>No</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>15.Fuma actualmente? En caso de responder "Si" Cuantos cigarros al dia?</label>
                                          <input type="text" class="form-control requerido" name="cantidad_Cigarros" id="cantidad_Cigarros"
                                          value="<?php if(isset($cantidad_Cigarros)) echo $cantidad_Cigarros?>">
                                    </div>
                                    
                                     <div class="form-group">
                                        <label>16.Actualmente sufre de dolores o molestias en sus huesos, articulaciones o musculos que puedan agravarse con el ejercicio?</label>
                                        <select class="form-control requerido" campo="Estado" name="Molestias_Articulaciones" id="Molestias_Articulaciones">
                                            <option value="">SELECCIONAR</option>
                                            <option value="1" <?php if(isset($Molestias_Articulaciones) && $Molestias_Articulaciones==1){echo "selected";}?>>Si</option>
                                            <option value="0" <?php if(isset($Molestias_Articulaciones) && $Molestias_Articulaciones==0){echo "selected";}?>>No</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>17. Actualmente experimente molestias en su espalda o cuello?</label>
                                        <select class="form-control requerido" campo="Estado" name="Molestias_Espalda" id="Molestias_Espalda">
                                            <option value="">SELECCIONAR</option>
                                            <option value="1" <?php if(isset($Molestias_Espalda) && $Molestias_Espalda==1){echo "selected";}?>>Si</option>
                                            <option value="0" <?php if(isset($Molestias_Espalda) && $Molestias_Espalda==0){echo "selected";}?>>No</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                <!-- CUERPO DE LA CAJA -->
                                
								<!-- FOOTER DE LA CAJA -->
                                <div class="box-footer">
                                    Los campos marcados con <span class="text-red"><strong>*</strong></span> son obligatorios.
                                </div>
                                <!-- FOOTER DE LA CAJA -->
                            </div>
                            <!-- CAJA -->
                        </div>
                        <!-- COLUMNA DERECHA -->
                    </div>
                    <!-- RENGLON CON EL FORMULARIO Y DOS COLUMNAS-->
                    
                    <div class="row">
                    	<div class="col-md-6" align="right"><button type="button" class="btn btn-primary" onclick=" checkRequeridos();">REGISTRAR</button></div>
                        <div class="col-md-6" align="left"><button type="reset" class="btn btn-danger" onclick="window.location='index.php?nav=Clientes';">CANCELAR</button></div>
                    </div>
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
	$('#m-clientes').addClass('active');
	
	//DAMOS EL FOCO AL INPUT DEL NOMBRE
	$('#nb_cliente').focus();
	
	PaseFormulario=0; //si pase formulario es igual a 0, no te deja ir a los siguientes formularios, si es 1 es que ya se llenaron todos y se puede proceder.
	
	
}); //document ready

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
		RegistrarUsuarios();
	}
}

function RegistrarUsuarios()
{
	
	//Se guarda en cookies el valor de los inputs del formulario para pasar al siguiente.
	$.cookie("Condicion_Cardiaca",$('#Condicion_Cardiaca').val());
	$.cookie("Condicion_Pecho",$('#Condicion_Pecho').val());
	$.cookie("Condicion_Pecho_reciente",$('#Condicion_Pecho_reciente').val());
	$.cookie("Condicion_Balance",$('#Condicion_Balance').val());
	$.cookie("Lesion_Fisica",$('#Lesion_Fisica').val());
	$.cookie("Medicamentos_Corazon",$('#Medicamentos_Corazon').val());
	$.cookie("Impedimento_Entrenamiento",$('#Impedimento_Entrenamiento').val());
	$.cookie("Lecturas_Anormales",$('#Lecturas_Anormales').val());
	$.cookie("Cirujia_Bypass",$('#Cirujia_Bypass').val());
	$.cookie("Dificultad_Respirar",$('#Dificultad_Respirar').val());
	$.cookie("Enfermedades_Renales",$('#Enfermedades_Renales').val());
	$.cookie("Arritmia",$('#Arritmia').val());
	$.cookie("Colesterol",$('#Colesterol').val());
	$.cookie("Presion_Alta",$('#Presion_Alta').val());
	$.cookie("cantidad_Cigarros",$('#cantidad_Cigarros').val());
	$.cookie("Molestias_Articulaciones",$('#Molestias_Articulaciones').val());
	$.cookie("Molestias_Espalda",$('#Molestias_Espalda').val());
	
	var confirmacion = confirm('¿Está seguro de pasar al siguiente FORMULARIO?');
		if(confirmacion == true){
			
				window.location='index.php?nav=Formulario2&id='+$("#id_cliente").val();
		}
	
}


</script>
