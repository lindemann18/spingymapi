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
		//$id_cliente=$_GET['id'];
		//print_r($_POST);
		//Tomadno los datos
		$Tipo_Prueba=$_POST['Tipo_Prueba'];
		$Id_Cliente=$_POST['Id_Cliente'];
		switch($Tipo_Prueba)
		{
			case "1":
				$pruebaNombre="Condición Física";
				$ResultadoEvaluado=$_POST['ResultadoEvaluado'];
			break;
			
			case "2":
				$pruebaNombre="Peso";
				$Altura=$_POST['Altura'];
				$peso=$_POST['peso'];
			break;
			
			case "3":
				$pruebaNombre="IMC";
				$Altura=$_POST['Altura'];
				$peso=$_POST['peso'];
			break;
		}//switch
		
	//verificar si el usuario ya se hizo alguna vez el biotest
			require_once("libs/libs.php");
		/*	$consultar=new Consultar();
			$result=$consultar->_ConsultarBioTestPorIdCliente($id_cliente);
			$num=$result->num_rows;
			//Si existe más de 0 registros, la persona ya hizo el biotest, lo que significa que ahora se editan los datos del biotest
			$permiso=false; //si lapersona ya hizo el formulario puede hacer el biotest, si no, no puede.
			if($num>0)
			{
				$permiso=true;	
			}*/
			$permiso=true;
?>
		<?php if($permiso==true){?>
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
                         <li class="fa fa-dashboard">Error</li>
                    </ol>
                </section>
                
                
                <!-- Main content -->
                <section class="content">
                	<!-- HEADER DEL CONTENIDO-->
                    <h4 class="page-header">
                        Apartado de Errores
                        <small>
                        	En este apartado se muestran los errores al haber efectuado mal un biotest, siga las instrucciones para efectuar
                            nuevamente el biotest a los clientes de <span class="text-red">spin gym</span>. Cualquier duda consulte con el
                            administrador, gracias.
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
                                    	<h4 class="text-center">Si llego a este apartado es por que algo salió mal en alguna de las pruebas </h4>
                                        
                                        <div class="col-sm-12" id="ContentCondicion">
                                        	<h2 id="titleCondicion">Error</h2>
                                            <img src="css/img/error.jpg" alt="">
                                        </div><!--ContentCondicion -->
                                        
                                        <div class="formulario col-xs-12">
                                        <input type="hidden" id="tipo_prueba" value="<?php echo $Tipo_Prueba?>">
										<input type="hidden" id="Id_Cliente" value="<?php echo $Id_Cliente?>">
                                           <h3>
                                           	Hubo un error en la prueba <?php echo " ".$pruebaNombre?>, verifique los datos que ingresó y repita nuevamente la prueba.
                                            Tal vez los datos estaban fuera del rango. Una vez verificado de al botón continuar para reanudar el biotest.<br />
                                            Datos: <br>
                                            <?php 
												switch($Tipo_Prueba)
												{
													case "1":
														echo "Condición física: ".$ResultadoEvaluado;
													break;	
													
													case "2":
														echo "Altura: ".$Altura."<br>";
														echo "Peso: ".$peso;
													break;	
													
													case "3":
														echo "Altura: ".$Altura."<br>";
														echo "Peso: ".$peso;
													break;	
													
												}
											?>
                                           </h3>
                                         </div><!--formulario -->
                                         
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

<?php }else {?>
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
                        Apartado de Peso
                        <small>
                        	En este apartado podr&aacute; hacer el test de Peso  a todos los Clientes registrados 
                            en <span class="text-red">spin gym</span>,además podrá ver resultados y consejos para mejorar o mantener
                             su Peso.
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


<?php }?>

        
      
<?php include('includes/footer.php');?>


<?php } else {header("Location: Login.php");}?>
<script>
$(document).ready(function(){
	var raizModulo = 'clientes_listadp.php';
	//AÑADIMOS LA CLASE ACTIVE, AL <LI> DEL MENU LATERAL, ESTO CON LA
	//FINALIDAD DE QUE SE SEPA EN QUE SECCIÓN SE ENCUENTRA EL USUARIO
	$('#m-biotest').addClass('active');
	
	tipo_prueba=$("#tipo_prueba").val();
	Id_Cliente=$("#Id_Cliente").val();
	//verificando que tipo de prueba para poner el botón
	switch(tipo_prueba)
	{
		case '1':
			$(".formulario").append('<button type="button" class="btn btn-success" onclick="IniciarBiotest()">Continuar</button>');
		break;
		
		case '2':
			$(".formulario").append('<button type="button" class="btn btn-success" onclick="Prueba2()">Continuar</button>');
		break;
		
	}//switch
	
});//document ready
function IniciarBiotest()
{
	idCliente=$("#Id_Cliente").val();
	window.location='index.php?nav=Condicion&id='+Id_Cliente;
}

function Prueba2()
{
	idCliente=$("#Id_Cliente").val();
		window.location='index.php?nav=Peso&id='+idCliente;	
}
</script>