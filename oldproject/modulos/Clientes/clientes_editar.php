<?php 
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
		if(isset($_GET['id']))
		{
			$id=$_GET['id'];
			require_once("libs/libs.php");
			$consultar=new Consultar();
			$result=$consultar->_ConsultarInformacionClientePorId($id);
			$fila=$result->fetch_assoc();
		}
?>
<style>
    .mesomorfo{background-image: url(css/img/mesomorfo.jpg); background-repeat: no-repeat; height: 200px;}
    .endomorfo{background-image: url(css/img/endomorfo.jpg); background-repeat: no-repeat; height: 200px;}
    .ectomorfo{background-image: url(css/img/ectomorfo.jpg); background-repeat: no-repeat; height: 200px;}
</style>
<!-- Modal -->
<div class="modal fade" id="ModalCuerpo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Tipo De Cuerpo</h4>
      </div>
      <div class="modal-body col-md-12">
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <h1 class="text-center">Mesomorfo</h1>
                        <div class="col-md-12 mesomorfo"></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <input type="radio" id="id_cuerpo" value="MESOMORFO" name="id_cuerpo" <?php if($fila['nb_cuerpo']=="MESOMORFO") echo "checked";?>>
                        </div>
                    </div><!-- col-md-3 -->

                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <h1 class="text-center">Endomorfo</h1>
                        <div class="col-md-12 endomorfo"></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <input type="radio" id="id_cuerpo" value="ENDOMORFO" name="id_cuerpo" <?php if($fila['nb_cuerpo']=="ENDOMORFO") echo "checked";?>>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <h1 class="text-center">Ectomorfo</h1>
                        <div class="col-md-12 ectomorfo"></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <input type="radio" id="id_cuerpo" value="ECTOMORFO" name="id_cuerpo" <?php if($fila['nb_cuerpo']=="ECTOMORFO") echo "checked";?>>
                        </div>
                    </div>

                </div><!-- row -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Usuarios
                        <small>Editar Usuarios</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="active">Usuarios</li>
                    </ol>
                </section>
                
                
                <!-- Main content -->
                <section class="content">
                	<!-- HEADER DEL CONTENIDO-->
                    <div class="alert alert-success alert-dismissible" role="alert" style="display:none;" id="UsuarioAgregadoNotificacion">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Bien Hecho!</strong> Usuario Registrado.</div>
                    <h4 class="page-header">
                        Formulario de Usuario 
                        <small>
                        	En este apartado podrá Editar los usuarios de <span class="text-red">spin gym</span>, ya sean administradores o entrenadores.
                        </small>
                    </h4>
                    <!-- HEADER DEL CONTENIDO-->
					<div class="alert alert-success alert-dismissible" role="alert" style="display:none;" id="UsuarioEditadoNotificacion">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Bien Hecho!</strong> Cliente Editado.</div>
                    <!-- FORMULARIO -->
                    <form name="clientesRegistrar" id="clientesRegistrar" method="post" role="form">
                    <!-- RENGLON CON EL FORMULARIO Y DOS COLUMNAS-->
                    <div class="row">
                    	<!-- COLUMNA IZQUIERDA -->
                    	<div class="col-md-6">
                        	<!-- CAJA -->
							<div class="box box-primary">
                                <!-- HEADER DE LA CAJA -->
                                <div class="box-header">
                                    <h3 class="box-title">Datos Generales</h3>
                                </div>
                                <!-- HEADER DE LA CAJA -->
                                    
                                <!-- CUERPO DE LA CAJA -->
                                <div class="box-body">
                                	
                                
                                    <div class="form-group">
                                    <input type="hidden" id="id_cliente" value="<?php echo $fila['id_cliente']?>">
                                        <label for="nb_cliente">Nombres </label>
                                        <input type="text" name="nb_cliente" id="nb_cliente" campo="Nombres" class="form-control requerido" 
                                        placeholder="Nombres" value="<?php echo $fila['nb_cliente']?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="nb_apellidos">Apellidos</label>
                                        <input type="text" name="nb_apellidos" id="nb_apellidos" campo="Apellido de Usuario" class="form-control requerido" 
                                        placeholder="Apellidos" value="<?php echo $fila['nb_apellidos']?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Genero del Usuario</label>
                                        <select class="form-control" id="de_genero">
                                            <option value="MASCULINO" <?php if($fila['de_genero']=='MASCULINO') echo "selected"?>>MASCULINO</option>
                                            <option value="FEMENINO" <?php if($fila['de_genero']=='FEMENINO') echo "selected"?>>FEMENINO</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="num_edad">Edad del Usuario</label>
                                          <label>D&iacute;a</label>
                                        <select id="dia_nacimiento" name="dia_nacimiento"  class="form-control requerido">
                                        <option value="0">Seleccionar...</option>
                                            <?php 
                                                for($i=1; $i<=31; $i++)
												{
													if($i==$fila['birth_day'])
													{
														echo '<option value='.$i.' selected>'.$i.'</option>';
													}
													else {echo '<option value='.$i.'>'.$i.'</option>';}
												}
                                            ?>
                                        </select>
                                    </div>
                                     <div class="form-group">
                                         <label for="">Mes </label>
                                           <select  id="mes_nacimiento" name="mes_nacimiento"  class="form-control requerido">
                                                 <option value="0">Seleccionar...</option>
                                                <?php 
                                                    
                                                    for($i=1; $i<=12; $i++)
                                                    {
                                                        switch($i)
                                                        {
                                                            case 1:
                                                                $mes="Enero";
                                                            break;	
                                                            case 2:
                                                                $mes="Febrero";
                                                            break;	
                                                            case 3:
                                                                $mes="Marzo";
                                                            break;	
                                                            case 4:
                                                                $mes="Abril";
                                                            break;	
                                                            case 5:
                                                                $mes="Mayo";
                                                            break;	
                                                            case 6:
                                                                $mes="Junio";
                                                            break;
                                                            case 7:
                                                                $mes="Julio";
                                                            break;	
                                                            case 8:
                                                                $mes="Agosto";
                                                            break;	
                                                            case 9:
                                                                $mes="Septiembre";
                                                            break;	
                                                            case 10:
                                                                $mes="Ocubre";
                                                            break;	
                                                            case 11:
                                                                $mes="Noviembre";
                                                            break;	
                                                            case 12:
                                                                $mes="Diciembre";
                                                            break;	
                                                        }
														if($i==$fila['birth_month'])
                                                        {echo '<option value='.$i.' selected="selected">'.$mes.'</option>';}
														else {echo '<option value='.$i.' >'.$mes.'</option>';}
                                                    }
                                                ?>
                                          </select>
                                    	</div>
                                        
                                        <div class="form-group">
                                        <label for="">A&ntilde;o</label>
                                        	<select id="year" name="year" class="form-control requerido">
                                             <option value="0">Seleccionar...</option>
                                                <?php 
                                                    for($i=1940; $i<=2008; $i++)
													{
														if($i==$fila['birth_year'])
														{echo '<option value='.$i.' selected="selected">'.$i.'</option>';}
														else {echo '<option value='.$i.'>'.$i.'</option>';}
													}
                                                ?>
                                            </select>
                                        </div>
                                        
                                    <div class="form-group">
                                        <label for="de_email">Email Usuario</label>
                                        <input type="email" name="de_email" id="de_email" campo="Email de Cliente" class="form-control requerido" 
                                        placeholder="Email del Usuario" value="<?php echo $fila['de_email']?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Telefono Usuario:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input type="text" name="num_telefono" id="num_telefono" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask
                                            value="<?php echo $fila['num_telefono']?>">
                                        </div><!-- /.input group -->
                                    </div>
                                    <div class="form-group">
                                        <label>Celular Usuario:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input type="text" name="num_celular" id="num_celular" campo="Celular de Cliente" class="form-control requerido" 
                                            data-inputmask='"mask": "(999) 999-9999"' data-mask value="<?php echo $fila['num_celular']?>">
                                        </div><!-- /.input group -->
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
                                    <h3 class="box-title">Datos de Ubicaci&oacute;n</h3>
                                </div>
                                <!-- HEADER DE LA CAJA -->
                                
                                <!-- CUERPO DE LA CAJA -->
                                <div class="box-body">
                                
                                   
                                    <div class="form-group">
                                        <label>Colonia</label>
                                        <input type="text" name="de_colonia" id="de_colonia" class="form-control" placeholder="Colonia del Usuario" value="<?php echo $fila['de_colonia']?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Direcci&oacute;n</label>
                                        <textarea name="de_domicilio" id="de_domicilio" campo="Dirección de Cliente" class="form-control requerido" rows="3" 
                                        placeholder="Dirección del Usuario"> <?php echo $fila['de_domicilio']?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>C&oacute;dico Postal</label>
                                        <input type="text" name="num_codigoPostal" id="num_codigoPostal" class="form-control"
                                         placeholder="Código Postal del Usuario" value="<?php echo $fila['num_codigoPostal']?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Tipo De Cuerpo</label>
                                        <input type="button" class="btn btn-info" onclick="TipoCuerpo()" value="Seleccionar" >
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
                    	<div class="col-md-6" align="right"><button type="button" class="btn btn-primary" onclick="checkRequeridosEditar();">EDITAR USUARIO</button></div>
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
	
	
}); //document ready

function TipoCuerpo()
{
    $("#ModalCuerpo").modal("show");
}//TipoCuerpo

function checkRequeridosEditar(){
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
		EditarUsuarios();
	}
}//checkrequeridos

function EditarUsuarios()
{
	year           = $("#year").val();
	mes_nacimiento = $("#mes_nacimiento").val();
	dia_nacimiento = $("#dia_nacimiento").val();
	fh_nacimiento  = year+"-"+mes_nacimiento+"-"+dia_nacimiento;
	var Arr                 = new Object();
	Arr['nb_apellidos']		= $('#nb_apellidos').val();
	Arr['de_genero']		= $('#de_genero').val();
	Arr['fh_nacimiento']	= fh_nacimiento;
	Arr['de_email']			= $('#de_email').val();
	Arr['num_telefono']		= $('#num_telefono').val();
	Arr['num_celular']		= $('#num_celular').val();
	Arr['de_colonia']		= $('#de_colonia').val();
	Arr['de_domicilio']		= $('#de_domicilio').val();
	Arr['num_codigoPostal']	= $('#num_codigoPostal').val();
	Arr['nb_cliente']		= $("#nb_cliente").val();
	Arr['id_cliente']		= $("#id_cliente").val();
    Arr['id_cuerpo']        = $("input[type='radio'][name='id_cuerpo']:checked").val()
	Arr['Accion']			="Editar";
	var Params= JSON.stringify(Arr);	
	$.post( "modulos/Clientes/Funciones.php", { Params: Params}).done(function( response ) {
				console.log(response);	
					var objJSON = eval("(function(){return " + response + ";})()");
					$("#UsuarioEditadoNotificacion").css("display","inherit");
					$("#UsuarioEditadoNotificacion").delay( 8000 ).fadeOut();
		});
		
		

}




</script>
