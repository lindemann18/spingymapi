<style type="text/css">
	#ContentCondicion h2{text-align: center; margin-right: 18%;}
	#ContentCondicion img {width: 34%; float: right; margin-right: 41%;}
	.Izquierda {margin-left: 43%;}
</style>
<?php
	
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
		
?>
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
                        <li class="">Clientes</li>
                         <li class="fa fa-dashboard">Biotest</li>
                    </ol>
                </section>
                
                
                <!-- Main content -->
                <section class="content">
                	<!-- HEADER DEL CONTENIDO-->
                    <h4 class="page-header">
                        Resultado Enviado
                        <small>
                        	si llegó a este apartado es por que ha enviado resultados de un biotest de <span class="text-red">spin gym</span>
                            a un cliente.
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
                                    	<h4 class="text-center">Los resultados se han enviado exitosamente al correo,
                                        	de click en el botón para volver al menú.
                                         </h4>
                                         <input type="hidden" value="<?php echo $id_cliente?>" id="id_cliente">
                                        <div class="col-sm-1 Arriba Izquierda"><button class="btn btn-info btn-sm" id="agregar" title="AGREGAR REGISTRO" data-original-title="AGREGAR REGISTRO" onclick="MenuRutina()"><i class="fa fa-plus"></i> Menú</button></div>
                                 
                                </div><!-- /.box-header -->
                                
                                
                             	<div class="box-body">
                                
                                </div><!-- box-body-->
                            </div><!--box -->
                        </div><!--col-xs-12 -->
                    </div><!--row -->
                </section>
            </aside>

</div>

      
<?php include('includes/footer.php');?>


<?php } else {header("Location: Login.php");}?>
<script>
$(document).ready(function(){
	var raizModulo = 'clientes_listadp.php';
	//AÑADIMOS LA CLASE ACTIVE, AL <LI> DEL MENU LATERAL, ESTO CON LA
	//FINALIDAD DE QUE SE SEPA EN QUE SECCIÓN SE ENCUENTRA EL USUARIO
	$('#m-clientes').addClass('active');
	
	//DAMOS EL FOCO AL INPUT DEL NOMBRE
	//$('#nb_cliente').focus();
	
	idClienteEliminar=0;
		
	
});//document ready

function MenuRutina()
{
	id_cliente = $("#id_cliente").val();
	window.location='index.php?nav=Clientes';
}//MenuRutina
</script>