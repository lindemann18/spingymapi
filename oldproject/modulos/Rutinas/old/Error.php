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
		$TipoError  = $_POST['Error'];
		
		switch($TipoError)
		{
			case "Ejercicios":
				//Se toman las rutinas en las que existen los ejercicios
				$RutinasJson    = $_POST['Rutinas'];
				$Rutinas 		= json_decode($RutinasJson,true);
				$sizeVector 	= count($Rutinas);
				$error			= 'Si llegó a este apartado, es por que hay rutinas TEMPLATE existentes que dependen de estos ejercicios,
									para poder eliminar los ejercicios es necesario eliminar estas rutinas. En la tabla inferior
									se muestran cuales son las rutinas dependientes del ejercicio a eliminar.';
			break;
			
			case "EjerciciosClientes":
				$RutinasJson    = $_POST['Rutinas'];
				$Rutinas 		= json_decode($RutinasJson,true);
				$sizeVector 	= count($Rutinas);
				$error			= 'Si llegó a este apartado, es por que hay rutinas Personalizadas existentes que dependen de estos ejercicios,
									para poder eliminar los ejercicios es necesario eliminar estas rutinas. En la tabla inferior
									se muestran cuales son las rutinas dependientes del ejercicio a eliminar.';
			break;
			
			case "Musculos":
				$error			= 'Si llegó a este apartado, es por que hay Musculos ligados a ejercicios que dependen de este Ejercicio.
								   Para poder eliminar este músculo es necesario eliminar los ejercicios que dependen de este.
								   En la tabla inferior se muestran cuales son los ejercicios dependientes de estos músculos.';
			break;
			
			case "TipoRutina":
				$error	= 'Si llegó a este apartado, es por que hay Tipos de Rutinas ligadas a <strong>Músculos</strong> que dependen 
				de estos <strong>Tipos De Rutinas</strong>. Para poder eliminar este músculo es necesario eliminar los ejercicios 
				que dependen de este. En la tabla inferior se muestran cuales son los ejercicios dependientes de estos músculos.';
			break;
			
			case "Maquina":
				$error	= 'Si llegó a este apartado, es por que hay ejercicios ligados a <strong>Máquina</strong> que dependen 
				de estos <strong>ejercicios</strong>. Para poder eliminar esta máquina es necesario eliminar los ejercicios 
				que dependen de esta. En la tabla inferior se muestran cuales son los ejercicios dependientes de esta máquina.';
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
                <section class="content" data-ng-app>
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
  						<input type="hidden" id="TipoError" value="<?php echo $TipoError?>">
					<div class="row">
                    	<div class="col-xs-12">
							<div class="box">
                            
                            <!-- APARTADO DEL FORMULARIO DONDE NO SE HA HECHO LA EVALUACIÓN FÍSICA-->
                                <div class="box-header">
                                    <div class="col-sm-12">
                                    	<h4 class="text-center"><?php echo $error?> </h4>
                                        
                                        <div class="col-sm-12" id="ContentCondicion">
                                        	<h2 id="titleCondicion">Error</h2>
                                            <img src="css/img/error.jpg" alt="">
                                        </div><!--ContentCondicion -->
                                        <div class="formulario col-xs-12" ng-controller="TablaErrores">
                                            <table class="table table-striped">
                                                <?php 
													switch($TipoError)
													{
														case 'Ejercicios':
															include("ErroresEliminar/DeleteEjercicios.php");														
														break; 
														
														case 'EjerciciosClientes':
															include("ErroresEliminar/DeleteEjercicios.php");														
														break;
														
														case 'Musculos':
															include("ErroresEliminar/DeleteMusculos.php");														
														break;
														
														case 'TipoRutina':
															include("ErroresEliminar/DeleteTipoRutina.php");														
														break;
														
														case 'Maquina':
															include("ErroresEliminar/DeleteMaquina.php");														
														break;
													}//switch 
												?>
                                            </table>
                                         </div><!--formulario -->
                                         <div class="row Botones">
                                        <div class="col-md-6" align="right">
	                                        <button type="button" class="btn btn-primary" onclick=" VolverEjercicios();">Regresar</button>
                                        </div>
		
        					            </div><!-- rowbotones-->
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



<?php }?>

        <!--EMP1219201459742  folio programa 1,2,3 por mi banorte-->
      
<?php include('includes/footer.php');?>


<?php } else {header("Location: Login.php");}?>
 <script src="js/angular.min.js"></script>
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

function VolverEjercicios()
{
	var confirmacion = confirm('¿Está seguro que desea volver al apartado de ejercicios?.');
		if(confirmacion == true){
				
		//Removiendo las cookies
		//Elimando todas las cookies
		var cookies = $.cookie();
		for(var cookie in cookies) 
		{
			$.removeCookie(cookie);
		}
			TipoError = $("#TipoError").val();
			switch(TipoError)
			{
				case 'Ejercicios' :
					window.location='index.php?nav=Ejercicios';
				break;
				
				case 'EjerciciosClientes' :
					window.location='index.php?nav=Ejercicios';
				break;
				
				case 'Musculos' :
					window.location='index.php?nav=Musculos';
				break;
				
				case 'TipoRutina' :
					window.location='index.php?nav=Tipos_Rutina';
				break;
				
				case 'Maquina' :
					window.location='index.php?nav=Maquinas';
				break;
			}//switch
			
		}//if true
}//VolverEjercicios

function TablaErrores($scope)
{
	TipoError = $("#TipoError").val();
	switch(TipoError)
	{
		case 'Ejercicios' :
			console.log($.cookie("RutinasJson"));
			$scope.RutinasJson = eval("(function(){return " + $.cookie("RutinasJson")+ ";})()");
			$scope.JsonDep =JSON.stringify($scope.RutinasJson);	
			$scope.Usuarios = $scope.RutinasJson;
		break;
		
		case 'EjerciciosClientes':
			console.log($.cookie("RutinasJson"));
			$scope.RutinasJson = eval("(function(){return " + $.cookie("RutinasJson")+ ";})()");
			$scope.JsonDep     = JSON.stringify($scope.RutinasJson);	
			$scope.Usuarios    = $scope.RutinasJson;
		break;
		
		case 'Musculos' : 
			$scope.EjeciciosJson = eval("(function(){return " + $.cookie("EjeciciosJson")+ ";})()");
			$scope.JsonDep       = JSON.stringify($scope.EjeciciosJson);	
			$scope.Usuarios      = $scope.EjeciciosJson;
		break;
		
		case 'TipoRutina' : 
			$scope.musculosJson  = eval("(function(){return " + $.cookie("musculosJson")+ ";})()");
			$scope.JsonDep       = JSON.stringify($scope.musculosJson);	
			$scope.Usuarios      = $scope.musculosJson;
			console.log($scope.musculosJson);
		break;
		
		case 'Maquina' : 
			$scope.MaquinasJson  = eval("(function(){return " + $.cookie("MaquinasJson")+ ";})()");
			$scope.JsonDep       = JSON.stringify($scope.MaquinasJson);	
			$scope.Usuarios      = $scope.MaquinasJson;
			console.log($scope.MaquinasJson);
		break;
		
		
	}//switch
	

}//TablaErrores



</script>	