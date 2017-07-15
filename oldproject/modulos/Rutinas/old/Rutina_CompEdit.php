<?php
	$consultar=new Consultar();
	$result=$consultar->_ConsultarTiposMusculos();
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
		//Atrapando el día de la semana el cual será la rutina compleja
		$id_rutina=$_GET['Rut'];
		$day=$_GET['Day'];
		
		//Definiendo el día de la semana
		switch($day)
		{
			case '1';
				$DiaRutina="LUNES";
			break;
			case '2';
				$DiaRutina="MARTES";
			break;
			case '3';
				$DiaRutina="MIERCOLES";
			break;
			case '4';
				$DiaRutina="JUEVES";
			break;
			case '5';
				$DiaRutina="VIERNES";
			break;
			case '6';
				$DiaRutina="SABADO";
			break;
			case '7';
				$DiaRutina="DOMINGO";
			break;
			
		}//switch
		
		//Buscando los tipos de musculo y de rutina
		$ResultRutinas=$consultar->_ConsultarTiposDeRutina(); //rutinas existentes
		$num_rutinas=$ResultRutinas->num_rows; //cantidad de rutinas
		$Rutinas=Array(); 
		
	
		
		//Consultar las categorías de rutina que existen
		$resultCategoriaRutinas=$consultar->_ConsultarCategoriasDeRutinas();
		$numCategoriaRutinas=$resultCategoriaRutinas->num_rows;
?>

<link rel="stylesheet" href="css/bootstrap-duallistbox.css">
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
                    <div class="alert alert-success alert-dismissible" role="alert" style="display:none;" id="EjercicioAgregadoNotificacion">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Bien Hecho!</strong> Ejercicios Registrado.</div>
                    <h4 class="page-header">
                        Formulario De Rutinas
                        <small>
                        	En este apartado podrá seleccionar las rutinas para el día seleccionado de la semana,
                          	seleccione las rutinas en el día y después se definirán los ejercicios para cada una de las 
                            rutinas.
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
                                	<h2><?php echo "Día: ".$DiaRutina; ?></h2>
                                    <!-- input con el id de quien lo registró-->
                                	<input type="hidden" id="id_usuario" value="<?php echo $_SESSION['Sesion']['id_usuario'];?>">
                                	<input type="hidden" id="id_dia" 	 value="<?php echo $day;?>">
                                    <input type="hidden" id="id_rutina"  value="<?php echo $id_rutina;?>">
                                
                                    <div class="form-group">
                                        <label for="nb_apellidos">Categor&iacute;a</label>
                                       <select multiple="multiple" size="10" name="duallistbox_demo2" class="demo2">
                                       <?php 
									   		for($i=0; $i<$num_rutinas; $i++)
											{
												$filaRutinas=$ResultRutinas->fetch_assoc();
												if($filaRutinas['nb_TipoRutina']!="Varios")
												{
													echo '<option value="'.$filaRutinas['id'].'" class="Actividad">'.$filaRutinas['nb_TipoRutina'].'</option>';
												}//if de Varios
											}//for
									   		echo '';
									  	?>
       
     								 </select>
       
                                    </div>
                                    
                                    <!-- días de la rutina-->
                                    
                                    
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
                        <div class="col-md-6" align="left"><button type="reset" class="btn btn-danger" onclick="window.location='index.php?nav=Ejercicios';">CANCELAR</button></div>
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
	$('#m-rutinas').addClass('active');
	
	//DAMOS EL FOCO AL INPUT DEL NOMBRE
	$('#nb_cliente').focus();
	
	  var demo2 = $('.demo2').bootstrapDualListbox({
          nonSelectedListLabel: 'Non-selected',
          selectedListLabel: 'Selected',
          preserveSelectionOnMove: 'moved',
          moveOnSelect: false
        });
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

function RegistraMaquina()
{
	//Tomando los valores de los tipos de rutina que habrá.
	RutinasDiaEdicion=new Array(); //Array donde se guardarán los tipos de rutina para este día.
	
	//Verificando, si hay rutinas seleccionadas se procede a continuar.
	CantidadTiposRutina=document.getElementById("bootstrap-duallistbox-selected-list_duallistbox_demo2").length;
	if(CantidadTiposRutina>0)
	{
		//Hay valores seleccionados
		$(".box2 .Actividad").each(function(){
			TipoRutina=$(this).val(); //Valor de la rutina tomada de las que están seleccionadas.
			RutinasDiaEdicion.push(TipoRutina); //Insertando las Rutinas en el array.
		});
		
		//Tomando los valores para agregar a la BD
		id_rutina=$("#id_rutina").val(); //id de la rutina a agregar los nuevos ejercicios
		id_dia=$("#id_dia").val(); //id del día donde se harán los ejercicios
		TotalActividadesDiaActual=RutinasDiaEdicion.length;  //Cantidad de actividades a realizar, se comparará con contador para saber si se completaron todas.
		ContadorActividadesDiaActual=0; //Contador de cuantas actividades se harán por este día
		RutinaActual=RutinasDiaEdicion[ContadorActividadesDiaActual]; //Tipo de actividad que toca para el día actual
		
		//definiendo las cookies
		$.cookie("RutinasDiaEdicion",RutinasDiaEdicion); //Array donde se guardan las cantidades de rutinas a realizar.
		$.cookie("TotalActividadesDiaActual",TotalActividadesDiaActual); //Cantidad total de actividades.
		$.cookie("ContadorActividadesDiaActual",ContadorActividadesDiaActual); //Contador para saber cuantas llevan hechas.
		
		//Mandando a definir la los ejercicios por rutina.
		window.location='index.php?nav=Rutina_EditarSencillo&Day='+id_dia+"&Rut="+id_rutina+"&TipoRut="+RutinaActual;	 
		 
	}//if
	else{alert("Favor de seleccionar algún tipo de rutina");}
	

}

</script>
