<style>
	#ContentCondicion h2{text-align: center; margin-right: 18%;}
	#ContentCondicion img {width: 34%; float: right; margin-right: 41%;}
	.formulario {margin-top: 4%;}
	.pregunta {float: right; margin-right: 26%; }
	.pregunta label {float: left; margin-top: 0%; font-size: 22px;}
</style>
<?php
	
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
			$id_cliente=$_GET['id'];
			//verificar si el usuario ya se hizo alguna vez el biotest.
			require_once("libs/libs.php");
			$consultar = new Consultar();
			$result	   = $consultar->_ConsultarBioTestPorIdCliente($id_cliente);
			$num	   = $result->num_rows;
			//Si existe más de 0 registros, la persona ya hizo el biotest, lo que significa que ahora se editan los datos del biotest.
			$permiso 	  = false; // si lapersona ya hizo el formulario puede hacer el biotest, si no, no puede.
			$PermisoFecha = false; // Si la persona hizo el biotest hoy, no puede repetirle de nuevo.
			if($num>0)
			{
				$permiso = true;	
			}
			
			//Verificando la fecha del último biotest, se necesitará cambiar para que sea por lo menos a unos 15 dísa de haberlo hecho.
			date_default_timezone_set("Mexico/General");
			$Fecha_Actual		= date("Y-m-d"); //fecha del día de hoy.
			$ResultFechaBiotest = $consultar->_ConsultarFechaUltimoBiotestRealizado($id_cliente);
			$FilaFechaBiotest   = $ResultFechaBiotest->fetch_assoc();
			$Ultimo_Biotest		= $FilaFechaBiotest['Ultimo_Biotest'];
			if ($Ultimo_Biotest !="")
			{
				//Quitando las horas y minutos
				$fechas				= explode(" ",$Ultimo_Biotest);
				$fechaSinHoras		= $fechas[0];
				//$PermisoFecha		= ($Fecha_Actual == $fechaSinHoras)?false:true; //Silas fechas osn idénticas, no hay permiso
				
				//Convirtiendo a mili segundos
				$Utilidades			= new Utilidades();
				$Dias_Milisegundos  = 2592000000;
				$ResTrans			= $ResMilli = $Utilidades->udate($fechaSinHoras, $Fecha_Actual);
				$FilaDias			= $ResTrans->fetch_assoc();
				$Dias_Transcurridos = $FilaDias['Dias_Transcurridos'];
				//$PermisoFecha		= ($Dias_Transcurridos < 15)?false:true; //Silas fechas osn idénticas, no hay permiso
				//Este es para las pruebas el de arriba es el bueno
				$PermisoFecha		= ($Dias_Transcurridos >=15)?true:false; //Silas fechas osn idénticas, no hay permiso
			}//if
			else {$PermisoFecha=true;}
?>
		<?php if($permiso==true && $PermisoFecha==true){?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        BioTest
                        <small>Evaluación F&iacute;sica</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="">BioTest</li>
                         <li class="fa fa-dashboard">Condici&oacute;n</li>
                    </ol>
                </section>
                
                
                <!-- Main content -->
                <section class="content">
                	<!-- HEADER DEL CONTENIDO-->
                    <h4 class="page-header">
                        Apartado de Condici&oacute;n f&iacute;sica
                        <small>
                        	En este apartado podr&aacute; hacer el test de condici&oacute;n f&iacute;sica en reposo  a todos los Clientes registrados 
                            en <span class="text-red">spin gym</span>,además podrá ver resultados y consejos para mejorar o mantener
                             su condici&oacute;n f&iacute;sica.
                        </small>
                    </h4>
                    <!-- HEADER DEL CONTENIDO-->
                    <div class="alert alert-success alert-dismissible" role="alert" style="display:none;" id="UsuarioEliminadoNotificacion">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Bien Hecho!</strong> Cliente Eliminado.</div>
					<div class="row">
                    	<div class="col-xs-12">
							<div class="box">
                            
                            <!-- APARTADO DEL FORMULARIO DONDE NO SE HA HECHO LA EVALUACIÓN FÍSICA-->
                                <div class="box-header">
                                    <div class="col-sm-12">
                                    	<h4 class="text-center">Para comenzar el examen de condici&oacute;n f&iacute;sica en reposo, debe medir 
                                        la misma del cliente
                                        he ingresar el Resultado en la caja de texto. </h4>
                                        
                                        <div class="col-sm-12" id="ContentCondicion">
                                        	<h2 id="titleCondicion">Condici&oacute;n F&iacute;sica</h2>
                                            <img src="css/img/body_and_heart_istock(1).jpg" alt="">
                                        </div><!--ContentCondicion -->
                                        
                                        <div class="formulario col-xs-12">
                                            <form action="index.php?nav=Resultado" method="post">
                                                <div class="pregunta col-xs-6">
                                                <label for="">Resultado: </label>
                                                <div class="col-xs-5">
                                                <input type="hidden" id="Id_Cliente" name="Id_Cliente" value="<?php echo $id_cliente?>">
                                                <input type="hidden" name="TipoPrueba" id="TipoPrueba" value="1">
                                                <input type="text" name="ResultadoCondicion" id="ResultadoCondicion" placeholder="Ingrese el resultado"
                                                class="form-control">
                                                </div>
                                                <button type="submit" class="btn btn-success" >Evaluar</button>
                                                </div><!--pregunta -->
                                          </div><!--formulario -->
                                            </form>
                                    </div><!--col-sm-12 -->
                                </div><!-- /.box-header -->
                                
                                
                             	<div class="box-body">
                                
                                </div><!-- box-body-->
                            </div><!--box -->
                        </div><!--col-xs-12 -->
                    </div><!--row -->
                </section>
            </aside>

</div>

<?php }else if($permiso==false) {?>
 <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        BioTest
                        <small>Evaluación F&iacute;sica</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="">BioTest</li>
                         <li class="fa fa-dashboard">Condici&oacute;n</li>
                    </ol>
                </section>
                
                
                <!-- Main content -->
                <section class="content">
                	<!-- HEADER DEL CONTENIDO-->
                    <h4 class="page-header">
                        Apartado de Errores
                        <small>
                        	Si llegó a este apartado es por que el cliente no ha hecho su formulario de salud, para poder disfrutar de este servicio
                            que ofrece <span class="text-red">spin gym</span>. Deberá hacer el formulario para garantizar la seguridad, salud y buen
                            uso del mismo.
                        </small>
                    </h4>
                    <!-- HEADER DEL CONTENIDO-->
                    <div class="alert alert-success alert-dismissible" role="alert" style="display:none;" id="UsuarioEliminadoNotificacion">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Bien Hecho!</strong> Cliente Eliminado.</div>
					<div class="row">
                    	<div class="col-xs-12">
							<div class="box">
                            
                            <!-- APARTADO DEL FORMULARIO DONDE NO SE HA HECHO LA EVALUACIÓN FÍSICA-->
                                <div class="box-header">
                                    <div class="col-sm-12">
                                    	<h4 class="text-center">
                                        	Para Poder hacer el biotest debe Llenar el formulario OBLIGATORIO de salud. De click en el botón para
                                            hacer el formulario.
                                        </h4>
                                            <div class="col-sm-2 pull-right" id="">
	                                            <input type="hidden" id="Id_Cliente" name="Id_Cliente" value="<?php echo $id_cliente?>">
                                                <label>Formulario: </label>
                                                <button type="submit" class="btn btn-success pull-right" onclick="LlevarAlFormulario()" >Formulario</button>
                                            </div>
                                    </div><!--col-sm-12 -->
                                </div><!-- /.box-header -->
                                
                                
                             	<div class="box-body">
                                
                                </div><!-- box-body-->
                            </div><!--box -->
                        </div><!--col-xs-12 -->
                    </div><!--row -->
                </section>
            </aside>

</div>

<?php }else if($PermisoFecha==false) {?>
 <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        BioTest
                        <small>Evaluación F&iacute;sica</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="">BioTest</li>
                         <li class="fa fa-dashboard">Condici&oacute;n</li>
                    </ol>
                </section>
                
                
                <!-- Main content -->
                <section class="content">
                	<!-- HEADER DEL CONTENIDO-->
                    <h4 class="page-header">
                        Apartado de Errores
                        <small>
                        	Si llegó a este apartado es por que el cliente ya hizo el biotest el día de hoy o en una fecha muy cercana, para poder disfrutar de
                             este servicio nuevamente que ofrece <span class="text-red">spin gym</span>. Deberá esperar un estimado de 15 días a partir del día
                             en el que el biotest fue hecho.
                        </small>
                    </h4>
                    <!-- HEADER DEL CONTENIDO-->
                    <div class="alert alert-success alert-dismissible" role="alert" style="display:none;" id="UsuarioEliminadoNotificacion">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Bien Hecho!</strong> Cliente Eliminado.</div>
					<div class="row">
                    	<div class="col-xs-12">
							<div class="box">
                            
                            <!-- APARTADO DEL FORMULARIO DONDE NO SE HA HECHO LA EVALUACIÓN FÍSICA-->
                                <div class="box-header">
                                    <div class="col-sm-12">
                                    	<h4 class="text-center">
                                        	Para Poder hacer el biotest debe Esperar 15 días a partir del día <?php echo $fechaSinHoras ?>,
                                            entonces podrá repetir nuevamente el BIOTEST. Disculpe las molestias que esto le ocasione. 
                                            <br /> <br />
                                            Han transcurrido:  <?php echo $Dias_Transcurridos. " Dias, desde el último biotest."; ?>
                                            
                                            
                                        </h4>
                                    </div><!--col-sm-12 -->
                                </div><!-- /.box-header -->
                                
                                
                             	<div class="box-body">
                                
                                </div><!-- box-body-->
                            </div><!--box -->
                        </div><!--col-xs-12 -->
                    </div><!--row -->
                </section>
            </aside>

</div>


<?php }?>
        
      
<?php include('includes/footer.php');?>


<?php } else {header("Location: Login.php");}?>
<script>
$(document).ready(function(){
	var raizModulo = 'clientes_listadp.php';
	//AÑADIMOS LA CLASE ACTIVE, AL <LI> DEL MENU LATERAL, ESTO CON LA
	//FINALIDAD DE QUE SE SEPA EN QUE SECCIÓN SE ENCUENTRA EL USUARIO
	$('#m-biotest').addClass('active');
	
	//DAMOS EL FOCO AL INPUT DEL NOMBRE
	//$('#nb_cliente').focus();
	
	idClienteEliminar=0;
		
	
});//document ready

function LlevarAlFormulario()
{
		id_Cliente=$("#Id_Cliente").val();
		var confirmacion = confirm('¿Está seguro de hacer el FORMULARIO?');
		if(confirmacion == true){
			
				window.location='index.php?nav=Formulario&id='+id_Cliente;
			
		}
}

function TestCondicion()
{
	var Arr=new Object();	
	Arr['Id_Cliente']		= $("#Id_Cliente").val();
	Arr['ResultadoEvaluado']= $("#ResultadoEvaluado").val();
	Arr['Accion']			="CondicionFisica";
	
	var Params= JSON.stringify(Arr);	
	console.log(Params);
		$.ajax({
				
				cache: false,
				type: "GET",
				contentType:false,
				processData:false,
				url: "modulos/Biotest/Funciones.php?Params="+Params,
				data: Params,
				datatype:"json",
				success: function(response){
					console.log(response);	
					var objJSON = eval("(function(){return " + response + ";})()");
					
					
				}
				
			});	
}//TestCondicion
</script>