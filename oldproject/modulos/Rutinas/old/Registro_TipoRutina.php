<?php
	$consultar=new Consultar();
	$result=$consultar->_ConsultarTiposMusculos();
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
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
                        <small>Registrar Tipos De Rutina</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="active">Rutinas</li>
                    </ol>
                </section>
                
                
                <!-- Main content -->
                <section class="content">
                	<!-- HEADER DEL CONTENIDO-->
                    <div class="alert alert-success alert-dismissible" role="alert" style="display:none;" id="TipoRutinaAgregadoNotificacion">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Bien Hecho!</strong> M&uacute;sculo Registrado.</div>
                    <h4 class="page-header">
                        Formulario Tipos De Rutina
                        <small>
                        	En este apartado podrá registrar las Tipos De Rutinapara usos de varios cat&aacute;logos de <span class="text-red">spin gym</span>.
                        </small>
                    </h4>
                    <!-- HEADER DEL CONTENIDO-->

                    <!-- FORMULARIO -->
                    <form name="TipoRutinaRegistrar" id="TipoRutinaRegistrar" method="post" role="form">
                    <!-- RENGLON CON EL FORMULARIO Y DOS COLUMNAS-->
                    <div class="row">
                    	<!-- COLUMNA IZQUIERDA -->
                    	<div class="col-md-8 pull-right Cuestionario">
                        	<!-- CAJA -->
							<div class="box box-primary">
                                <!-- HEADER DE LA CAJA -->
                                <div class="box-header">
                                    <h3 class="box-title">Datos Tipos De Rutina</h3>
                                </div>
                                <!-- HEADER DE LA CAJA -->
                                    
                                <!-- CUERPO DE LA CAJA -->
                                <div class="box-body">
                                	
                                    <!-- input con el id de quien lo registró-->
                                	<input type="hidden" id="id_usuario" value="<?php echo $_SESSION['Sesion']['id_usuario'];?>">
                                    <div class="form-group">
                                        <label for="nb_cliente">Nombre </label>
                                        <input type="text" name="nb_TipoRutina" id="nb_TipoRutina" campo="Nombres" class="form-control requerido" placeholder="Nombre de Tipo de rutina">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="nb_apellidos">Descripci&oacute;n</label>
                                        <textarea name="desc_TipoRutina" id="desc_TipoRutina" class="form-control requerido"></textarea>
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
                        <div class="col-md-6" align="left"><button type="reset" class="btn btn-danger" onclick="window.location='index.php?nav=Tipos_Rutina';">CANCELAR</button></div>
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
		RegistraTipoRutina();
	}
}

function RegistraTipoRutina()
{
	
	var Arr=new Object();	
	Arr['nb_TipoRutina']		= $("#nb_TipoRutina").val();
	Arr['desc_TipoRutina']		= $('#desc_TipoRutina').val();
	Arr['id_usuario']			= $('#id_usuario').val();
	Arr['Accion']			="AgregaTipoRutina";
	
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
					$("#TipoRutinaRegistrar").reset();
					$("#TipoRutinaAgregadoNotificacion").css("display","inherit");
					$("#TipoRutinaAgregadoNotificacion").delay( 8000 ).fadeOut();
					
				}
				
			});	
	
}

</script>
