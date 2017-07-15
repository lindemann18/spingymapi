<?php
	
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
		$id_cliente=$_GET['id'];
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
                        <li class="">BioTest</li>
                    </ol>
                </section>
                
                
                <!-- Main content -->
                <section class="content">
                	<!-- HEADER DEL CONTENIDO-->
                    <h4 class="page-header">
                        Apartado de Biotest
                        <small>
                        	En este apartado podr&aacute; hacer el biotest  a todos los Clientes registrados en <span class="text-red">spin gym</span>,
                             además podrá ver resultados y consejos para mejorar o mantener su condici&oacute;n f&iacute;sica.
                        </small>
                    </h4>
                    <!-- HEADER DEL CONTENIDO-->
                    <div class="alert alert-success alert-dismissible" role="alert" style="display:none;" id="UsuarioEliminadoNotificacion">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Bien Hecho!</strong> Cliente Eliminado.</div>
					<div class="row">
                    	<div class="col-xs-12">
							<div class="box">
                                <div class="box-header">
                                    <div class="col-sm-12">
                                    	<h4>Para comenzar con los test de CONDICI&Oacute;N F&Iacute;SICA, PESO, MASA CORPORAL, STAMINA, FUERZA y 
                                        FLEXIBILIDAD, de en el botón continuar..</h4>
                                        <input type="hidden" id="id_cliente" value="<?php echo $id_cliente?>">
                                        <button type="button" class="btn btn-success" onclick="IniciarBiotest()">Continuar</button>
                                    </div>
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
	$('#m-biotest').addClass('active');
	
		
	
});//document ready

function IniciarBiotest()
{
	idCliente=$("#id_cliente").val();
	window.location='index.php?nav=Condicion&id='+idCliente;
}
</script>