<style type="text/css">
	.LabelPregunta {width: 100%;}
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
				
				//formulario 3
				$Desayuno_Diario=$fila['Desayuno_Diario'];
				$Comida_Diaria=$fila['Comida_Diaria'];
				$Cena_Diaria=$fila['Cena_Diaria'];
				$EntreComida_Diaria=$fila['EntreComida_Diaria'];
				$Frecuencia_EntreComida=$fila['Frecuencia_EntreComida'];
				$Plan_Alimenticio=$fila['Plan_Alimenticio'];
				$Plan_Alimenticio=$fila['Plan_Alimenticio'];
				
				//Formulario 4
				$Intensidad_Ejercicio=$fila['Intensidad_Ejercicio'];
				$Intensidad_Ejercicio2=$fila['Intensidad_Ejercicio2'];
				$Intensidad_Ejercicio3=$fila['Intensidad_Ejercicio3'];
				$Intensidad_Ejercicio4=$fila['Intensidad_Ejercicio4'];
				$Intensidad_Ejercicio5=$fila['Intensidad_Ejercicio5'];
				$Programa_Ejercicio=$fila['Programa_Ejercicio'];
				$Actividades_deseables=$fila['Actividades_deseables'];
				$Actividades_indeseables=$fila['Actividades_indeseables'];
				$deporte_Frecuente=$fila['deporte_Frecuente'];
				$Minutos_Dia=$fila['Minutos_Dia'];
				$Dias_Semana=$fila['Dias_Semana'];
				$Resultado_Ejercicio=$fila['Resultado_Ejercicio'];
				
			}//num
			
		}// E_GET
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
                    <input type="hidden" id="id_instructor" value="<?php echo $_SESSION['Sesion']['id_usuario']?>">
                    <!-- RENGLON CON EL FORMULARIO Y DOS COLUMNAS-->
                    <div class="row">
                    	<!-- COLUMNA IZQUIERDA -->
                    	<div class="col-md-6">
                        	<!-- CAJA -->
							<div class="box box-primary">
                                <!-- HEADER DE LA CAJA -->
                                <div class="box-header">
                                    <h3 class="box-title">Formulario 3-Dieta </h3>
                                </div>
                                <!-- HEADER DE LA CAJA -->
                                    
                                <!-- CUERPO DE LA CAJA -->
                                <div class="box-body">
                                	<div class="form-group">
                                        <label for="nb_cliente" class="LabelPregunta">1. Que desayuna normalmente?</label>
                                        <input type="text" name="Desayuno_Diario" id="Desayuno_Diario" class="form-control requerido"
                                        value="<?php if(isset($Desayuno_Diario)) echo $Desayuno_Diario?>">
                                    </div>
                                	
                                	 <div class="form-group">
                                        <label for="nb_cliente" class="LabelPregunta">2. Que como a medio dia normalmente?</label>
                                        <input type="text" name="Comida_Diaria" id="Comida_Diaria" class="form-control requerido"
                                        value="<?php if(isset($Comida_Diaria)) echo $Comida_Diaria?>">
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="nb_cliente" class="LabelPregunta">3. Que cena normalmente?</label>
										 <input type="text" name="Cena_Diaria" id="Cena_Diaria" class="form-control requerido"
                                          value="<?php if(isset($Cena_Diaria)) echo $Cena_Diaria?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="nb_apellidos" class="LabelPregunta">4. Que tipo de alimentos como entre comidas?</label>
                                         <input type="text" name="EntreComida_Diaria" id="EntreComida_Diaria" class="form-control requerido"
                                         value="<?php if(isset($EntreComida_Diaria)) echo $EntreComida_Diaria?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="LabelPregunta">5. Que tan frecuente como entre comidas?</label>
                                         <input type="text" name="Frecuencia_EntreComida" id="Frecuencia_EntreComida" class="form-control requerido"
                                         value="<?php if(isset($Frecuencia_EntreComida)) echo $Frecuencia_EntreComida?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="num_edad" class="LabelPregunta">6. Ha estado bajo algún plan alimenticio? Explique?</label>
                                   		<textarea name="Plan_Alimenticio" id="Plan_Alimenticio" 
                                        class="LabelPregunta form-control requerido" ><?php if(isset($Plan_Alimenticio)) echo $Plan_Alimenticio?></textarea>
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
                                    <h3 class="box-title">Formulario 4- Entrenamiento</h3>
                                </div>
                                <!-- HEADER DE LA CAJA -->
                                
                                <!-- CUERPO DE LA CAJA -->
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>7. Favor de calificar su nivel de ejercicio en una escala de
                                         1 a 5 (5 siendo muy intenso) para cada rango de edad hasta su edad presente:</label>
                                      	<label for="">15-20: </label>
                                         <select class="form-control requerido" campo="Estado" name="Intensidad_Ejercicio" id="Intensidad_Ejercicio">
                                            <option value="">SELECCIONAR</option>
                                            <option value="0" <?php if(isset($Intensidad_Ejercicio) && $Intensidad_Ejercicio==0){echo "selected";}?>>No tengo esta edad</option>
                                            <option value="1" <?php if(isset($Intensidad_Ejercicio) && $Intensidad_Ejercicio==1){echo "selected";}?>>1</option>
                                            <option value="2" <?php if(isset($Intensidad_Ejercicio) && $Intensidad_Ejercicio==2){echo "selected";}?>>2</option>
                                            <option value="3" <?php if(isset($Intensidad_Ejercicio) && $Intensidad_Ejercicio==3){echo "selected";}?>>3</option>
                                            <option value="4" <?php if(isset($Intensidad_Ejercicio) && $Intensidad_Ejercicio==4){echo "selected";}?>>4</option>
                                            <option value="5" <?php if(isset($Intensidad_Ejercicio) && $Intensidad_Ejercicio==5){echo "selected";}?>>5</option>
                                        </select>
                                        <label for="">21-30: </label>
                                         <select class="form-control requerido" campo="Estado" name="Intensidad_Ejercicio2" id="Intensidad_Ejercicio2">
                                            <option value="">SELECCIONAR</option>
                                      		<option value="0" <?php if(isset($Intensidad_Ejercicio2) && $Intensidad_Ejercicio2==0){echo "selected";}?>>No tengo esta edad</option>
                                            <option value="1" <?php if(isset($Intensidad_Ejercicio2) && $Intensidad_Ejercicio2==1){echo "selected";}?>>1</option>
                                            <option value="2" <?php if(isset($Intensidad_Ejercicio2) && $Intensidad_Ejercicio2==2){echo "selected";}?>>2</option>
                                            <option value="3" <?php if(isset($Intensidad_Ejercicio2) && $Intensidad_Ejercicio2==3){echo "selected";}?>>3</option>
                                            <option value="4" <?php if(isset($Intensidad_Ejercicio2) && $Intensidad_Ejercicio2==4){echo "selected";}?>>4</option>
                                            <option value="5" <?php if(isset($Intensidad_Ejercicio2) && $Intensidad_Ejercicio2==5){echo "selected";}?>>5</option>
                                        </select>
                                        <label for="">31-40: </label>
                                         <select class="form-control requerido" campo="Estado" name="Intensidad_Ejercicio3" id="Intensidad_Ejercicio3">
                                            <option value="">SELECCIONAR</option>
                                            <option value="0" <?php if(isset($Intensidad_Ejercicio3) && $Intensidad_Ejercicio3==0){echo "selected";}?>>No tengo esta edad</option>
                                            <option value="1" <?php if(isset($Intensidad_Ejercicio3) && $Intensidad_Ejercicio3==1){echo "selected";}?>>1</option>
                                            <option value="2" <?php if(isset($Intensidad_Ejercicio3) && $Intensidad_Ejercicio3==2){echo "selected";}?>>2</option>
                                            <option value="3" <?php if(isset($Intensidad_Ejercicio3) && $Intensidad_Ejercicio3==3){echo "selected";}?>>3</option>
                                            <option value="4" <?php if(isset($Intensidad_Ejercicio3) && $Intensidad_Ejercicio3==4){echo "selected";}?>>4</option>
                                            <option value="5" <?php if(isset($Intensidad_Ejercicio3) && $Intensidad_Ejercicio3==5){echo "selected";}?>>5</option>
                                        </select>
                                         <label for="">41-50: </label>
                                         <select class="form-control requerido" campo="Estado" name="Intensidad_Ejercicio4" id="Intensidad_Ejercicio4">
                                            <option value="">SELECCIONAR</option>
                                            <option value="0" <?php if(isset($Intensidad_Ejercicio4) && $Intensidad_Ejercicio4==0){echo "selected";}?>>No tengo esta edad</option>
                                            <option value="1" <?php if(isset($Intensidad_Ejercicio4) && $Intensidad_Ejercicio4==1){echo "selected";}?>>1</option>
                                            <option value="2" <?php if(isset($Intensidad_Ejercicio4) && $Intensidad_Ejercicio4==2){echo "selected";}?>>2</option>
                                            <option value="3" <?php if(isset($Intensidad_Ejercicio4) && $Intensidad_Ejercicio4==3){echo "selected";}?>>3</option>
                                            <option value="4" <?php if(isset($Intensidad_Ejercicio4) && $Intensidad_Ejercicio4==4){echo "selected";}?>>4</option>
                                            <option value="5" <?php if(isset($Intensidad_Ejercicio4) && $Intensidad_Ejercicio4==5){echo "selected";}?>>5</option>
                                        </select>
                                         <label for="">51+: </label>
                                         <select class="form-control requerido" campo="Estado" name="Intensidad_Ejercicio5" id="Intensidad_Ejercicio5">
                                            <option value="">SELECCIONAR</option>
                                           <option value="0" <?php  if(isset($Intensidad_Ejercicio5) && $Intensidad_Ejercicio5==0){echo "selected";}?>>No tengo esta edad</option>
                                            <option value="1" <?php if(isset($Intensidad_Ejercicio5) && $Intensidad_Ejercicio5==1){echo "selected";}?>>1</option>
                                            <option value="2" <?php if(isset($Intensidad_Ejercicio5) && $Intensidad_Ejercicio5==2){echo "selected";}?>>2</option>
                                            <option value="3" <?php if(isset($Intensidad_Ejercicio5) && $Intensidad_Ejercicio5==3){echo "selected";}?>>3</option>
                                            <option value="4" <?php if(isset($Intensidad_Ejercicio5) && $Intensidad_Ejercicio5==4){echo "selected";}?>>4</option>
                                            <option value="5" <?php if(isset($Intensidad_Ejercicio5) && $Intensidad_Ejercicio5==5){echo "selected";}?>>5</option>
                                        </select>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label>8. Empieza programas de entrenamiento, pero tiene dificultades para llevarlos a cabo?</label>
                                          <select class="form-control requerido" campo="Estado" name="Programa_Ejercicio" id="Programa_Ejercicio">
                                            <option value="">SELECCIONAR</option>
                                            <option value="1" <?php  if(isset($Programa_Ejercicio) && $Programa_Ejercicio==1){echo "selected";}?>>Si</option>
                                            <option value="0" <?php  if(isset($Programa_Ejercicio) && $Programa_Ejercicio==0){echo "selected";}?>>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>9. Favor de indicar las actividades físicas que le gustaría incluir en su programa de entrenamiento?</label>
                                         <input type="text" class="form-control requerido" name="Actividades_deseables" id="Actividades_deseables"
                                         value="<?php if(isset($Actividades_deseables)) echo $Actividades_deseables?>">
                                    </div>
                                    <div class="form-group">
                                        <label>10. Favor de indicar las actividades físicas que le NO le gustaría incluir en su programa de entrenamiento?</label>
                                         <input type="text" class="form-control requerido" name="Actividades_indeseables" id="Actividades_indeseables"
                                         value="<?php if(isset($Actividades_indeseables)) echo $Actividades_indeseables?>">
                                    </div>
                                    
                                     <div class="form-group">
                                        <label>11. Indique cualquier deporte o actividad recreativa en la que participa con regularidad</label>
                                        <input type="text" class="form-control requerido" name="deporte_Frecuente" id="deporte_Frecuente"
                                        value="<?php if(isset($deporte_Frecuente)) echo $deporte_Frecuente?>">
                                    </div>
                                    
                                      <div class="form-group">
                                        <label>12. Con cuanto tiempo posee o desea dedicarle al programa de entrenamiento? (Minutes/day)Minutos al dia? (days/week)Cuantos días de la semana?</label>
                                          <label for=" ">Minutos Por día:</label>
                                           <input type="text" class="form-control requerido" name="Minutos_Dia" id="Minutos_Dia"
                                           value="<?php if(isset($Minutos_Dia)) echo $Minutos_Dia?>"> 
                                           <label for=" ">días por semana:</label>
                                           <input type="text" class="form-control requerido" name="Dias_Semana" id="Dias_Semana"
                                           value="<?php if(isset($Dias_Semana)) echo $Dias_Semana?>">  
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>13. Que desea lograr con el ejercicio?</label>
                                          <input type="text" class="form-control requerido" name="Resultado_Ejercicio" id="Resultado_Ejercicio"
                                           value="<?php if(isset($Resultado_Ejercicio)) echo $Resultado_Ejercicio?>"> 
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
	
	var Arr=new Object();
	//Valores del primer formulario
	Arr['Condicion_Cardiaca']		= $.cookie("Condicion_Cardiaca");
	Arr['Condicion_Pecho']			= $.cookie("Condicion_Pecho");	
	Arr['Condicion_Pecho_reciente']	= $.cookie("Condicion_Pecho_reciente");
	Arr['Condicion_Balance']		= $.cookie("Condicion_Balance");
	Arr['Lesion_Fisica']			= $.cookie("Lesion_Fisica");
	Arr['Medicamentos_Corazon']		= $.cookie("Medicamentos_Corazon");
	Arr['Impedimento_Entrenamiento']= $.cookie("Impedimento_Entrenamiento");
	Arr['Lecturas_Anormales']		= $.cookie("Lecturas_Anormales");
	Arr['Cirujia_Bypass']			= $.cookie("Cirujia_Bypass");
	Arr['Dificultad_Respirar']		= $.cookie('Dificultad_Respirar');
	Arr['Enfermedades_Renales']		= $.cookie('Enfermedades_Renales');
	Arr['Arritmia']					= $.cookie('Arritmia');
	Arr['Colesterol']				= $.cookie('Colesterol');
	Arr['Presion_Alta']				= $.cookie('Presion_Alta');
	Arr['cantidad_Cigarros']		= $.cookie('cantidad_Cigarros');
	Arr['Molestias_Articulaciones']	= $.cookie('Molestias_Articulaciones');
	Arr['Molestias_Espalda']		= $.cookie('Molestias_Espalda');
	//valores del 2do formulario
	Arr['Desayuno_Diario']			= $("#Desayuno_Diario").val();
	Arr['Comida_Diaria']			= $("#Comida_Diaria").val();
	Arr['Cena_Diaria']				= $("#Cena_Diaria").val();
	Arr['EntreComida_Diaria']		= $("#EntreComida_Diaria").val();
	Arr['Frecuencia_EntreComida']	= $("#Frecuencia_EntreComida").val();
	Arr['Plan_Alimenticio']			= $("#Plan_Alimenticio").val();
	Arr['Intensidad_Ejercicio']		= $("#Intensidad_Ejercicio").val();
	Arr['Intensidad_Ejercicio2']	= $("#Intensidad_Ejercicio2").val();
	Arr['Intensidad_Ejercicio3']	= $("#Intensidad_Ejercicio3").val();
	Arr['Intensidad_Ejercicio4']	= $("#Intensidad_Ejercicio4").val();
	Arr['Intensidad_Ejercicio5']	= $("#Intensidad_Ejercicio5").val();
	Arr['Programa_Ejercicio']		= $("#Programa_Ejercicio").val();
	Arr['Actividades_deseables']	= $("#Actividades_deseables").val();
	Arr['Actividades_indeseables']	= $("#Actividades_indeseables").val();
	Arr['deporte_Frecuente']		= $("#deporte_Frecuente").val();
	Arr['Minutos_Dia']				= $("#Minutos_Dia").val();
	Arr['Dias_Semana']				= $("#Dias_Semana").val();
	Arr['Resultado_Ejercicio']		= $("#Resultado_Ejercicio").val();
	//Datos default
	Arr['Accion']    				= "AgregarFormulario"
	Arr['id_cliente']    			= $('#id_cliente').val();
	Arr['id_instructor']			= $("#id_instructor").val();
	
	//Convirtiendo en un json Array para mandar por AJAX
	var Params= JSON.stringify(Arr);
		
	console.log(Params);
	

$.post( "modulos/Clientes/Funciones.php", { Params: Params})
  .done(function( response ) {
    alert("Gracias por proporcionar sus datos, ya puede hacer el BIOTEST.");
	var cookies = $.cookie();
	for(var cookie in cookies) { $.removeCookie(cookie); }	
	window.location='index.php?nav=Clientes';
  });
	/*		$.ajax({
				
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
					alert("Gracias por proporcionar sus datos, ya puede hacer el BIOTEST.");
					//window.location='index.php?nav=Clientes';
					//Elimando todas las cookies
var cookies = $.cookie();
for(var cookie in cookies) {
   $.removeCookie(cookie);
}	
				}
				
			});	
			*/
		
	
}//RegistrarUsuarios


</script>
