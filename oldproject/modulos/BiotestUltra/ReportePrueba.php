<?php
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
		
		$id_cliente    = $_GET['id_cliente'];
		$consultar     = new Consultar();
		$Utilidades    = new Utilidades();
		$json_return   = $Utilidades->ReportePdf($id_cliente);
		$decode        = json_decode($json_return,true);
		$Condicion     = $decode['Condicion'];
		$Barra         = $Condicion[0]['Barra'];
		$Longitud      = $Condicion[0]['Longitud'];
		$Consejo       = $Condicion[0]['Consejo'];
		$Peso          = $decode['Peso']; //Array de resultados de la prueba de Peso.
		$BarraPeso     = $Peso[0]['Barra'];
		$LongitudPeso  = $Peso[0]['Longitud'];
		$ConsejoPeso   = $Peso[0]['Consejo'];
		$Stamina	   = $decode['Stamina']; // Array de resultados de la prueba de Stamina.
		$BarraStam     = $Stamina[0]['Barra'];
		$Longitudstam  = $Stamina[0]['Longitud'];
		$Consejostam   = $Stamina[0]['Consejo'];
		$Fuerza		   = $decode['Fuerza']; // Array de resultados de la prueba de Fuerza.
		$BarraFuerza   = $Fuerza[0]['Barra'];
		$Longitudfuer  = $Fuerza[0]['Longitud'];
		$Consejofuer   = $Fuerza[0]['Consejo'];
		$Resistencia   = $decode['Resistencia']; // Array de resultado de la prueba de Resistencia.
		$BarraResis    = $Resistencia[0]['Barra'];
		$LongitudResi  = $Resistencia[0]['Longitud'];
		$ConsejoResi   = $Resistencia[0]['Consejo'];
		$Flexibilidad  = $decode["Flexibilidad"]; // Array de resultado de pruebas de flexibilidad.
		$BarraFlexi    = $Flexibilidad[0]['Barra'];
		$LongitudFlexi = $Flexibilidad[0]['Longitud'];
		$ConsejoFlexi  = $Flexibilidad[0]['Consejo'];
		$IMM		   = $decode['IMM']; //Array de resultados de las pruebas de IMM.
		$IMM2 		   = $decode['IMM2']; //Array de segundos resultados de las pruebas de IMM.
		$IMMResultados = $decode['IMMResultados'];// Array con los resultados de las comparaciones de los arrays de IMM y IMM2.
		
		//Tomando los datos del IMM.
		$fecha			 = $IMM['fecha'];
		$Per_Brazo 		 = $IMM['Per_Brazo'];
		$Per_Brazo_Fle 	 = $IMM['Per_Brazo_Fle'];
		$Per_Femoral 	 = $IMM['Per_Femoral'];
		$Per_Pantorrilla = $IMM['Per_Pantorrilla'];
		$CantidadCintura = $IMM['CantidadCintura'];
		$CantidadCadera  = $IMM['CantidadCadera'];
		$per_espalda_can = $IMM['per_espalda_can'];
		$Per_Pecho		 = $IMM['Per_Pecho'];
		
		//Tomando los datos del IMM2.
		$fecha2			  = $IMM2['fecha'];
		$Per_Brazo2       = $IMM2['Per_Brazo'];
		$Per_Brazo_Fle2   = $IMM2['Per_Brazo_Fle'];
		$Per_Femoral2 	  = $IMM2['Per_Femoral'];
		$Per_Pantorrilla2 = $IMM2['Per_Pantorrilla'];
		$CantidadCintura2 = $IMM2['CantidadCintura'];
		$CantidadCadera2  = $IMM2['CantidadCadera'];
		$per_espalda_can2 = $IMM2['per_espalda_can'];
		$Per_Pecho2		  = $IMM2['Per_Pecho'];
		
		//Tomando los datos del IMMResultados. 
		$ResCintura	  = $IMMResultados['ResCintura'];
		$Res_Cadera   = $IMMResultados['Res_Cadera'];
		$Res_per_esp  = $IMMResultados['Res_per_esp'];
		$Res_Brazo 	  = $IMMResultados['Res_Brazo'];
		$Res_pecho	  = $IMMResultados['Res_pecho'];
		$Res_BrazoFle = $IMMResultados['Res_BrazoFle'];
		$Res_PeriFemo = $IMMResultados['Res_PeriFemo'];
		$ResPerPant   = $IMMResultados['ResPerPant'];
		$Res_pecho	  = $IMMResultados['Res_pecho'];
		
		//echo $IMM2['CantidadCintura'];
		print_r($IMMResultados);
		//Tomar los datos de cada uno de los arrays.
?>	
<style>
	.Grafica{margin-right: 33%;}
	.HighChart{margin-right: 33%;}
</style>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
   <script type="text/javascript">
      google.load('visualization', '1.0', {'packages':['corechart']});
      google.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Selection 1', 3],
          ['Selection 2', 1],
          ['Selection 3', 1],
          ['Selection 4', 1],
          ['Selection 5', 2]
        ]);

        var options = {'title':'Example Chart',
                       'width':800,
                       'height':600};

       // var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        //chart.draw(data, options);
      }
    </script>  
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
                         <li class="fa fa-dashboard" id="PruebaInfo">Condici&oacute;n</li>
                         <li class="fa fa-dashboard">Resultado</li>
                    </ol>
                </section>
                
                
                <!-- Main content -->
                <section class="content">
                	<!-- HEADER DEL CONTENIDO-->
                    <h4 class="page-header">
                        Apartado de Resultados
                        <small>
                        	En este apartado se le proporcionan los resultados de las evaluaciones f&iacute;sicas  a todos los Clientes registrados 
                            en <span class="text-red">spin gym</span>,además podrá ver resultados y consejos para mejorar o mantener
                             su condici&oacute;n f&iacute;sica. <?php echo $BarraPeso; ?>
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
                                    	<h4 class="text-center" id="TituloPrueba"></h4>
                                     <!-- Condicion {fisica-->
                                     <div class='col-sm-6 containerbar pull-right Grafica' id='ContainerBar'> 
                                     <h1 class='text-center'>Resultado Actual</h1>
                                      <h2 id="CondicionTitulo" class="text-center" >Condición Física</h2>  
                                        <div class="progress">
                                            <div class="progress-bar <?php echo $Barra;?>" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                                             aria-valuemax="100" id="ProgresBarResultado" style="<?php echo $Longitud?>">
                                            <span class="sr-only">60% Complete</span>
                                          </div>
                                        </div><!--progress -->
                                        
                                        <!-- Barra de comparación-->
                                      <?php include("barracomparativa.php");?>
                                      	 <p class="text-center "><?php echo $Consejo?></p>
                                      <!-- Peso-->
                                        
                                     </div><!--containerbar -->  
                                         <div class='col-sm-6 containerbar pull-right Grafica' id='ContainerBar'> 
                                    
                                      <h2 id="CondicionTitulo" class="text-center" >Peso</h2>  
                                        <div class="progress">
                                            <div class="progress-bar <?php echo $BarraPeso;?>" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                                             aria-valuemax="100" id="ProgresBarResultado" style="<?php echo $LongitudPeso; ?>">
                                            <span class="sr-only">60% Complete</span>
                                          </div>
                                        </div><!--progress -->
                                        
                                        <!-- Barra de comparación-->
                                      <?php include("barracomparativa.php");?>
                                       <p class="text-center "><?php echo $ConsejoPeso?></p>
                                      </div><!--containerbar -->  
                                      
                                      <div class='col-sm-6 containerbar pull-right Grafica' id='ContainerBar'> 
                                    
                                      <h2 id="CondicionTitulo" class="text-center" >Stamina</h2>  
                                        <div class="progress">
                                            <div class="progress-bar <?php echo $BarraStam;?>" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                                             aria-valuemax="100" id="ProgresBarResultado" style="<?php echo $Longitudstam; ?>">
                                            <span class="sr-only">60% Complete</span>
                                          </div>
                                        </div><!--progress -->
                                        
                                        <!-- Barra de comparación-->
                                      <?php include("barracomparativa.php");?>
                                       <p class="text-center "><?php echo $Consejostam?></p>
                                      </div><!--containerbar --> 
                                       <div class='col-sm-6 containerbar pull-right Grafica' id='ContainerBar'> 
                                    
                                      <h2 id="CondicionTitulo" class="text-center" >Fuerza</h2>  
                                        <div class="progress">
                                            <div class="progress-bar <?php echo $BarraFuerza;?>" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                                             aria-valuemax="100" id="ProgresBarResultado" style="<?php echo $Longitudfuer; ?>">
                                            <span class="sr-only">60% Complete</span>
                                          </div>
                                        </div><!--progress -->
                                        
                                        <!-- Barra de comparación-->
                                      <?php include("barracomparativa.php");?>
                                       <p class="text-center "><?php echo $Consejofuer?></p>
                                      </div><!--containerbar -->  
                                      
                                      <div class='col-sm-6 containerbar pull-right Grafica' id='ContainerBar'> 
                                    
                                      <h2 id="CondicionTitulo" class="text-center" >Resistencia</h2>  
                                        <div class="progress">
                                            <div class="progress-bar <?php echo $BarraResis;?>" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                                             aria-valuemax="100" id="ProgresBarResultado" style="<?php echo $LongitudResi; ?>">
                                            <span class="sr-only">60% Complete</span>
                                          </div>
                                        </div><!--progress -->
                                        
                                        <!-- Barra de comparación-->
                                      <?php include("barracomparativa.php");?>
                                       <p class="text-center "><?php echo $ConsejoResi?></p>
                                      </div><!--containerbar --> 
                                      
                                       <div class='col-sm-6 containerbar pull-right Grafica' id='ContainerBar'> 
                                    
                                      <h2 id="CondicionTitulo" class="text-center" >Flexibilidad</h2>  
                                        <div class="progress">
                                            <div class="progress-bar <?php echo $BarraFlexi ;?>" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0"
                                             aria-valuemax="100" id="ProgresBarResultado" style="<?php echo $LongitudFlexi; ?>">
                                            <span class="sr-only">60% Complete</span>
                                          </div>
                                        </div><!--progress -->
                                        
                                        <!-- Barra de comparación-->
                                      <?php include("barracomparativa.php");?>
                                       <p class="text-center "><?php echo $ConsejoFlexi?></p>
                                      </div><!--containerbar -->  
                                      
                                      
                                      <div class='col-sm-6 containerbar pull-right Grafica' id='ContainerBar'> 
                                    
                                      <h2 id="CondicionTitulo" class="text-center" >IMM</h2>  
                                          <div class="Resultados2 col-sm-4">
                                                	<h4 id="Fecha2"></h4>
                                                      <!-- Segundos Resultados-->
                                                   <h5 id="Fecha" class="text-center"><?php echo $fecha2?></h5>
                                                    <!--Primeros Resultados -->
                                                	<div class="col-sm-8 Cintura pull-right">
                                                    	<label for="" id="CinturaLabel" class="text-right"><?php echo $CantidadCintura2?></label>
                                                     </div>
                                                    <div class="col-sm-8 Cadera pull-right">
                                                    	<label for="" id="CaderaLabel" class="text-right"><?php echo $CantidadCadera2?></label>
                                                     </div>
                                                    <div class="col-sm-8 Per_Espalda  pull-right">
                                                    	<label for="" id="per_espalda" class="text-right"><?php echo $per_espalda_can2?></label>
                                                    </div>
                                                    <div class="col-sm-8 Per_Pecho  pull-right">
                                                    	<label for="" id="Per_Pecho" class="text-right"><?php echo $Per_Pecho2?></label>
                                                     </div>
                                                    <div class="col-sm-8 Per_Brazo pull-right">
                                                    	<label for="" id="Per_Brazo" class="text-right"><?php echo $Per_Brazo2?></label>
                                                     </div>
                                                    <div class="col-sm-8 Per_Brazo_Fle pull-right">
                                                    	<label for="" id="Per_Brazo_Fle" class="text-right"><?php echo $Per_Brazo_Fle2?></label>
                                                     </div>
                                                    <div class="col-sm-8 Perimetro_femoral pull-right">
                                                    	<label for="" id="Perimetro_femoral_res" class="text-right"><?php echo $Per_Femoral2?></label>
                                                     </div>
                                                    <div class="col-sm-8 Per_Pantorrilla pull-right">
                                                    	<label for="" id="Per_Pantorrilla" class="text-right"><?php echo $Per_Pantorrilla2?></label>
                                                    </div>
                                                </div><!-- Resultados -->
                                                
                                                
                                            	<div class="Resultados col-sm-4">
                                                	<h5 id="Fecha" class="text-center"><?php echo $fecha?></h5>
                                                    <!--Primeros Resultados -->
                                                	<div class="col-sm-8 Cintura pull-right">
                                                    	<label for="" id="CinturaLabel" class="text-right"><?php echo $CantidadCintura?></label>
                                                     </div>
                                                    <div class="col-sm-8 Cadera pull-right">
                                                    	<label for="" id="CaderaLabel" class="text-right"><?php echo $CantidadCadera?></label>
                                                     </div>
                                                    <div class="col-sm-8 Per_Espalda  pull-right">
                                                    	<label for="" id="per_espalda" class="text-right"><?php echo $per_espalda_can?></label>
                                                    </div>
                                                    <div class="col-sm-8 Per_Pecho  pull-right">
                                                    	<label for="" id="Per_Pecho" class="text-right"><?php echo $Per_Pecho?></label>
                                                     </div>
                                                    <div class="col-sm-8 Per_Brazo pull-right">
                                                    	<label for="" id="Per_Brazo" class="text-right"><?php echo $Per_Brazo?></label>
                                                     </div>
                                                    <div class="col-sm-10 Per_Brazo_Fle pull-right">
                                                    	<label for="" id="Per_Brazo_Fle" class="text-right"><?php echo $Per_Brazo_Fle?></label>
                                                     </div>
                                                    <div class="col-sm-10 Perimetro_femoral pull-right">
                                                    	<label for="" id="Perimetro_femoral_res" class="text-right"><?php echo $Per_Femoral?></label>
                                                     </div>
                                                    <div class="col-sm-10 Per_Pantorrilla pull-right">
                                                    	<label for="" id="Per_Pantorrilla" class="text-right">
															<?php echo $Per_Pantorrilla?>
                                                            </label>
                                                    </div>
                                                  
                                                </div><!-- Resultados -->
                                                
                                                <div class="Resultados col-sm-4">
                                                	<h5 id="text-left" style="margin-left:12%">Resultados</h5>
                                                    <!--Resultados Finales -->
                                                	<div class="col-sm-10 Cintura pull-left">
                                                    	<label for="" id="CinturaLabel" class="text-left"><?php echo $ResCintura?></label>
                                                     </div>
                                                    <div class="col-sm-10 Cadera pull-center">
                                                    	<label for="" id="CaderaLabel" class="text-center"><?php echo $Res_Cadera?></label>
                                                     </div>
                                                    <div class="col-sm-10 Per_Espalda  pull-center">
                                                    	<label for="" id="per_espalda" class="text-center"><?php echo $Res_per_esp?></label>
                                                    </div>
                                                    <div class="col-sm-10 Per_Pecho  pull-center">
                                                    	<label for="" id="Per_Pecho" class="text-center"><?php echo $Res_pecho?></label>
                                                     </div>
                                                    <div class="col-sm-10 Per_Brazo pull-center">
                                                    	<label for="" id="Per_Brazo" class="text-center"><?php echo $Res_Brazo?></label>
                                                     </div>
                                                    <div class="col-sm-10 Per_Brazo_Fle pull-center">
                                                    	<label for="" id="Per_Brazo_Fle" class="text-center"><?php echo $Res_BrazoFle?></label>
                                                     </div>
                                                    <div class="col-sm-10 Perimetro_femoral pull-center">
                                                    	<label for="" id="Perimetro_femoral_res" class="text-center"><?php echo $Res_PeriFemo?></label>
                                                     </div>
                                                    <div class="col-sm-10 Per_Pantorrilla pull-center">
                                                    	<label for="" id="Per_Pantorrilla" class="text-center"><?php echo $ResPerPant?></label>
                                                    </div>
                                                </div><!-- Resultados -->
                                      </div><!--containerbar -->  
                                       
                                        <div class="col-sm-6 pull-right HighChart containergraphic"><div class="" id="GraficaResultados" >&nbsp;</div></div><!--containergraphic -->
                                        <div class="col-sm-6" id="ContainerConsejo"><h1 class="text-center">Consejo Físico</h1><p id="ConsejoTexto"></p></div> 
                                        <div class="col-sm-3 pull-right" id="BotonPrueba"></div>
                                                <div class="col-xs-5">
                                                <input type="hidden" id="id_cliente" name="id_cliente" value="<?php echo $id_cliente?>">
                                                <input type="hidden" name="Tipo_Prueba" id="Tipo_Prueba" value="<?php echo $Tipo_Prueba?>">
                                                </div>
                                    </div><!--col-sm-12 -->
                                </div><!-- /.box-header -->
                                
                                
                             	<div class="box-body">
                                	<div id="chart_div"></div>
                                </div><!-- box-body-->
                            </div><!--box -->
                        </div><!--col-xs-12 -->
                    </div><!--row -->
                </section>
            </aside>

</div>

 <!--Modal de enviando -->
            
            <div class="modal fade" id="pleaseWaitDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1>Enviando...</h1>
                        </div>
                    <div class="modal-body">
                        <div class="progress progress-striped active">
                        <div class="progress-bar progress-striped active"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        
                        </div>
                        </div>
                    </div><!-- modal body-->
                    <div class="modal-footer">
                    </div>
                    </div>
                </div>
            </div><!-- pleaseWaitDialog-->
        
      
<?php ?>
<script src="js/jquery-1.11.1.min.js"></script>

<?php } else {header("Location: Login.php");}?>
<script>
$(document).ready(function(){
	
	//Tomando los datos para comenzar el reporte
	/*id_cliente = $("#id_cliente").val();

	var Arr=new Object();	
		Arr['Id_Cliente']		  = id_cliente;
		Arr['Accion']		 	  = "ReportePdf";
		var Params= JSON.stringify(Arr);
		//Mandando por AJAX la información a la BD
		$.post( "modulos/Biotest/Funciones.php", { Params: Params}).done(function( response ) {
    		var objJSON = eval("(function(){return " + response + ";})()");
			
			//Obteniendo los datos devueltos.
			Condicion = objJSON.Condicion;
			size	  = Condicion.length;
			console.log(Condicion);
			//Dando los resultados. Se debe tomar el primer resultado de la condición
			Condicion_actual = Condicion[0].Condicion; //Resultado del biotest actual
		/*	switch(Condicion_actual)
					{
						case 'Atleta':
							$("#ProgresBarResultado").addClass("progress-bar-success");
							$("#ProgresBarResultado").css("width","100%");
						break;
						
						case 'Excelente':
							$("#ProgresBarResultado").addClass("progress-bar-success");
							$("#ProgresBarResultado").css("width","80%");
						break;
						
						case 'Bueno':
							$("#ProgresBarResultado").css("width","60%");
						break;
						
						case 'Promedio':
							$("#ProgresBarResultado").addClass("progress-bar-warning");
							$("#ProgresBarResultado").css("width","40%");
						break;
						
						case 'Pobre':
							$("#ProgresBarResultado").addClass("progress-bar-danger");
							$("#ProgresBarResultado").css("width","20%");
						break;
					}//switch
			
			//Imprimiendo las high charts.
			//Tomando los resultados de las pruebas
					
					//Valores de la prueba 3
					fecha3=Condicion[0].fecha;
					resultado3=Condicion[0].Porcentaje;
					
					//valores de la prueba 2
					if(Condicion[1].fecha!=0){fecha2=Condicion[1].fecha}else{fecha2="BioTest No Hecho"} 
					resultado2=(Condicion[1].Porcentaje!=0)?Condicion[1].Porcentaje:0;
					
					//valores de la prueba 3
					fecha1=(Condicion[2].fecha!=0)?Condicion[2].fecha:"BioTest No Hecho";
					resultado1=(Condicion[2].Porcentaje!=0)?Condicion[2].Porcentaje:0;
					
					TituloPrueba="Resultados Condición Física";
					categoria="Condición Física";
										//tomando los valores que se les van a indicar a la gráfica
					options=ObtenerOptions(fecha3,resultado3,fecha2,resultado2,fecha1,resultado1,TituloPrueba,categoria);
					$("script[src='js/AdminLTE/app.js']").remove();
			
					 $(function () {
						$('#GraficaResultados').highcharts(options);
					});
					
					$('g.highcharts-legend').attr('transform','translate(217,55)'); //Cambiando de lugar el cuadro de explicación de la gráfica
					
					PegarScriptMenu(); //Trayendo de vuelta el script de menu. Función declarada bajo el document ready de este archivo
			
  		});//post*/
		
		
		
	
});//document ready

function PegarScriptMenu()
{
	$.getScript( "js/AdminLTE/app.js" ) //Pegando el script para que funcione el menú de nuevo
					.done(function( script, textStatus ) {
					console.log( textStatus );
					})
					.fail(function( jqxhr, settings, exception ) {
					$( "div.log" ).text( "Triggered ajaxError handler." );
					});	
}//PegarScriptMenu

function ObtenerOptions(fecha3,resultado3,fecha2,resultado2,fecha1,resultado1,TituloPrueba,categoria)
{
		  options={
				 chart: {
                type: 'bar'
            },
            title: {
                text: TituloPrueba
            },
            subtitle: {
                text: 'BioTest'
            },
            xAxis: {
                categories: [categoria],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Resultados',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' Porciento'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor || '#FFFFFF'),
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: fecha1,
                data: [parseInt(resultado1)]
            }, {
                name: fecha2,
                data: [parseInt(resultado2)]
            }, {
                name: fecha3,
                data: [parseInt(resultado3)]
            }]	
			};
			return options;	
} //optoins

</script>

<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/charts/highcharts.js"></script>
<script src="js/charts/exporting.js"></script>