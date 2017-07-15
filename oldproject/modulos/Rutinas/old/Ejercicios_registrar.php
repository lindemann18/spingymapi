<?php
	$consultar=new Consultar();
	$result=$consultar->_ConsultarTiposMusculos();
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
		
		//Buscando los tipos de musculo y de rutina
		$ResultMusculo = $consultar->_ConsultarMusculos();
		$ResultRutinas = $consultar->_ConsultarTiposDeRutina();
		$ResultCMaq    = $consultar->_ConsultarCategoriaMaquinasGeneral();
		
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
                    <div class="alert alert-success alert-dismissible" role="alert" style="display:none;" id="EjercicioAgregadoNotificacion">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Bien Hecho!</strong> Ejercicios Registrado.</div>
                    <h4 class="page-header">
                        Formulario De Ejercicios
                        <small>
                        	En este apartado podrá registrar las Ejercicios para usos de varios cat&aacute;logos de <span class="text-red">spin gym</span>.
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
                                	<input type="hidden" id="id_usuario" value="<?php echo $_SESSION['Sesion']['id_usuario'];?>">
                                    <div class="form-group">
                                        <label for="nb_cliente">Nombre </label>
                                        <input type="text" name="nb_ejercicio" id="nb_ejercicio" campo="Nombres" class="form-control requerido" placeholder="Nombre del Ejercicio">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="nb_apellidos">Descripci&oacute;n</label>
                                        <textarea name="desc_ejercicio" id="desc_ejercicio" class="form-control requerido"></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="nb_apellidos">M&uacute;sculo</label>
                                       <select name="id_musculo" id="id_musculo" class="form-control requerido" onChange="TraertiposRutina()">
                                       	<option value="">Seleccionar...</option>
                                        <?php 
											while ($filaMusculo=$ResultMusculo->fetch_assoc())
											{
												echo '<option value="'.$filaMusculo['id'].'">'.$filaMusculo['nb_musculo'].'</option>';
											}//while
										
										?>
                                       </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="nb_apellidos">Categoría Máquina</label>
                                       <select name="id_CategoriaMaquina" id="id_CategoriaMaquina" class="form-control requerido"
                                        onChange="TraerMaquinasPorCategoria()">
                                            <option value="">Seleccionar...</option>
                                             <?php 
                                                while ($filaMaquina=$ResultCMaq->fetch_assoc())
                                                {
                                                    echo '<option value="'.$filaMaquina['id'].'">'.$filaMaquina['nb_CategoriaMaquina'].'</option>';
                                                }//while
                                            
                                            ?>
                                        	<option value="0">Ninguna</option >
                                        </select>
                                    </div>
                                    
                                     <div class="form-group">
                                        <label for="nb_apellidos">Máquina</label>
                                       <select name="id_maquina" id="id_maquina" class="form-control requerido" onChange="">
                                       		<option value="">Seleccionar...</option>
                                        	<option value="0">Ninguna</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                    	<label for="nb_apellidos">Tipo De Rutina</label>
                                        <select name="id_TipoRutina" id="id_TipoRutina" class="form-control requerido">
                                       	<option value="">Seleccionar...</option>
                                       
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
	
	
});

function TraertiposRutina()
{
	var Arr=new Object();	
	Arr['id_musculo']		= $("#id_musculo").val();
	Arr['Accion']			="BuscarRutinasPorMusculo";
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
					var objJSON = eval("(function(){return " + response + ";})()");
					console.log(objJSON);
					console.log(objJSON.Rutinas.length);
					clearSelect("id_TipoRutina");
					//clearSelect("id_maquina");
					
					//Pegando las opciones de máquinas
					//$("#id_maquina").append("<option value='7'>Ninguna</option>");
					//Pegando las opciones de rutinas
				/*	for(i=0; i<objJSON.Maquinas.length; i++)
					{
						Maquina=objJSON.Maquinas[i];
						AgregarOption("id_maquina",Maquina.id,Maquina.nb_maquina);
					}//for*/
					//Pegando las opciones de rutinas
					for(i=0; i<objJSON.Rutinas.length; i++)
					{
						rutina=objJSON.Rutinas[i];
						AgregarOption("id_TipoRutina",rutina.id,rutina.nb_TipoRutina);
					}//for
				}
				
			});	
}//TraertiposRutina

function TraerMaquinasPorCategoria()
{
	var Arr=new Object();	
	Arr['id_CategoriaMaquina'] = $("#id_CategoriaMaquina").val();
	Arr['Accion']			   ="BuscarMaquinasPorCategoria";
	var Params				   = JSON.stringify(Arr);	
	
	$.post( "modulos/Rutinas/Funciones.php", { Params: Params})
     .done(function( response ) {
		var objJSON = eval("(function(){return " + response + ";})()");
		Maquinas = objJSON.Maquinas;
		console.log(Maquinas);
		size = Maquinas.length;
		
		//Dejando limpio el select
		clearSelect("id_maquina");
		for(i=0; i<size; i++)
		{
			maquina    = Maquinas[i]; //Se toma la máquina a pegarse.
			id         = maquina.id_maquina;
			nb_maquina = maquina.nb_maquina;
			$("#id_maquina").append("<option value="+id+">"+nb_maquina+"</option>");

		}//for
  });//done
		
}//TraertiposRutina

function AgregarOption(idcombo,value,text)
 {
 	option=document.createElement('option');
	option.value=value;
	option.text=text;
	cel=document.getElementById(idcombo);
	cel.options.add(option);
 }	

function clearSelect(idSelect)
{
	sel= document.getElementById(idSelect);
	tope= sel.options.length - 1;
	for (ind= tope; ind > -1; ind--)
	{
		sel.options.remove(ind);
	} //for
}//clearSelect

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
	
	var Arr=new Object();	
	Arr['nb_ejercicio']		= $("#nb_ejercicio").val();
	Arr['desc_ejercicio']	= $('#desc_ejercicio').val();
	Arr['id_musculo']		= $('#id_musculo').val();
	Arr['id_TipoRutina']	= $('#id_TipoRutina').val();
	Arr['id_maquina']		= $("#id_maquina").val();
	Arr['id_usuario']		= $('#id_usuario').val();
	Arr['Accion']			="AgregaEjercicio";
	
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
					$("#MusculosRegistrar").reset();
					$("#EjercicioAgregadoNotificacion").css("display","inherit");
					$("#EjercicioAgregadoNotificacion").delay( 8000 ).fadeOut();
					
				}
				
			});	
	
}

</script>
