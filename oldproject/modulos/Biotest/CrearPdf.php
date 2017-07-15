<?php
 // INCLUDE THE phpToPDF.php FILE
require("phpToPDF.php"); 
		include("../../libs/libs.php");
// Tomando los datos.
		$Params 	= (isset($_GET['Params']))?$_GET['Params']:$_POST['Params'];
		$Parametros = json_decode($Params,true);
		$Accion		= $Parametros['Accion'];
		
		switch ($Accion)
		{
			case '':
			
			break;
		}//switch

		$id_cliente   = $Parametros['Id_Cliente'];
		$consultar   = new Consultar();
		$Utilidades  = new Utilidades();
		$json_return = $Utilidades->ReportePdf($id_cliente);
		$decode      = json_decode($json_return,true);
		//Datos de condición física
		$Condicion   = $decode['Condicion'];
		$Barra       = $Condicion[0]['Barra'];
		$Longitud    = $Condicion[0]['Longitud'];
		$Consejo     = $Condicion[0]['Consejo'];
		$dato1       = $Condicion[0]['Porcentaje'];
		$fechaCond   = $Condicion[0]['fecha'];
		$dato2       = $Condicion[1]['Porcentaje'];
		$fechaCond2  = $Condicion[1]['fecha'];
		$dato3       = $Condicion[2]['Porcentaje'];
		$fechaCond3  = $Condicion[2]['fecha'];
		//Datos de Peso.
		$Peso         = $decode['Peso']; //Array de resultados de la prueba de Peso.
		$BarraPeso    = $Peso[0]['Barra'];
		$LongitudPeso = $Peso[0]['Longitud'];
		$ConsejoPeso  = $Peso[0]['Consejo'];
		$PorcenPeso1  = $Peso[0]['Porcentaje'];
		$fechaPeso    = $Peso[0]['fecha'];
		$PorcenPeso2  = $Peso[1]['Porcentaje'];
		$fechaPeso2   = $Peso[1]['fecha'];
		$PorcenPeso3  = $Peso[2]['Porcentaje'];
		$fechaPeso3   = $Peso[2]['fecha'];
		//Datos de Stamina
		$Stamina	  = $decode['Stamina']; // Array de resultados de la prueba de Stamina.
		$BarraStam    = $Stamina[0]['Barra'];
		$Longitudstam = $Stamina[0]['Longitud'];
		$Consejostam  = $Stamina[0]['Consejo'];
		$PorcenStam1  = $Stamina[0]['Porcentaje'];
		$fechaStam    = $Stamina[0]['fecha'];
		$PorcenStam2  = $Stamina[1]['Porcentaje'];
		$fechaStam2   = $Stamina[1]['fecha'];
		$PorcenStam3  = $Stamina[2]['Porcentaje'];
		$fechaStam3   = $Stamina[2]['fecha'];
		//Datos de Fuerza
		$Fuerza		  = $decode['Fuerza']; // Array de resultados de la prueba de Fuerza.
		$BarraFuerza  = $Fuerza[0]['Barra'];
		$Longitudfuer = $Fuerza[0]['Longitud'];
		$Consejofuer  = $Fuerza[0]['Consejo'];
		$PorcenFuer   = $Fuerza[0]['Porcentaje'];
		$fechaFuer    = $Fuerza[0]['fecha'];
		$PorcenFuer2  = $Fuerza[1]['Porcentaje'];
		$fechaFuer2   = $Fuerza[1]['fecha'];
		$PorcenFuer3  = $Fuerza[2]['Porcentaje'];
		$fechaFuer3   = $Fuerza[2]['fecha'];
		//Datos de resistencia.
		$Resistencia  = $decode['Resistencia']; // Array de resultado de la prueba de Resistencia.
		$BarraResis   = $Resistencia[0]['Barra'];
		$LongitudResi = $Resistencia[0]['Longitud'];
		$ConsejoResi  = $Resistencia[0]['Consejo'];
		$PorcenResis  = $Resistencia[0]['Porcentaje'];
		$fechaResis   = $Resistencia[0]['fecha'];
		$PorcenResis2 = $Resistencia[1]['Porcentaje'];
		$fechaResis2  = $Resistencia[1]['fecha'];
		$PorcenResis3 = $Resistencia[2]['Porcentaje'];
		$fechaResis3  = $Resistencia[2]['fecha'];
		//Datos de flexibilidad
		$Flexibilidad  = $decode["Flexibilidad"]; // Array de resultado de pruebas de flexibilidad
		$BarraFlexi    = $Flexibilidad[0]['Barra'];
		$LongitudFlexi = $Flexibilidad[0]['Longitud'];
		$ConsejoFlexi  = $Flexibilidad[0]['Consejo'];
		$PorcenFlexi   = $Flexibilidad[0]['Porcentaje'];
		$fechaFlexi    = $Flexibilidad[0]['fecha'];
		$PorcenFlexi2  = $Flexibilidad[1]['Porcentaje'];
		$fechaFlexi2   = $Flexibilidad[1]['fecha'];
		$PorcenFlexi3  = $Flexibilidad[2]['Porcentaje'];
		$fechaFlexi3   = $Flexibilidad[2]['fecha'];
		//DAtos de IMM
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
		
		//Consultar la información del cliente
		$ResultCliente   =  $consultar->_ConsultarClientesPorId($id_cliente);
		$filaCliente     = $ResultCliente->fetch_assoc();
		$nb_nombre 	  	 = $filaCliente['nb_cliente'];
		$nb_apellidos 	 = $filaCliente['nb_apellidos'];
		$de_email	  	 = $filaCliente['de_email'];
		$nombre_completo = utf8_decode($nb_nombre." ".$nb_apellidos);	
		
		$progress    = "
			   <div class=\"progress\">
             <div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" aria-valuenow=\"40\" 
            	 aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 20%\">
           		Pobre&nbsp;&nbsp;
             </div>
         	
             <div class=\"progress-bar progress-bar-warning\" role=\"progressbar\" aria-valuenow=\"40\" 
             	aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 20%\">
           		Promedio&nbsp;&nbsp;
             </div>
            
          <div class=\"progress-bar\" role=\"progressbar\" aria-valuenow=\"40\" aria-valuemin=\"0\"
               aria-valuemax=\"100\" style=\"width: 20%\">
               Bueno&nbsp;&nbsp;
           </div>
           
            <div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"40\" 
                aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 20%\">
            	Excelente&nbsp;&nbsp;
            </div>
            
           <div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"40\" 
           		aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 20%\">
           		Atleta&nbsp;&nbsp;
           </div>
			
    </div><!-- Progress -->
		";
		//Fecha actual
date_default_timezone_set("Mexico/General");
$fecha_actual = date("Y-m-d"); //fecha del día de hoy

// PUT YOUR HTML IN A VARIABLE
$my_html = "<html>
<head>
<link href=\"http://phptopdf.com/bootstrap.css\" rel=\"stylesheet\">
<link href=\"http://getbootstrap.com/examples/dashboard/dashboard.css\" rel=\"stylesheet\">
 <script type=\"text/javascript\" src=\"https://www.google.com/jsapi\"></script>
 <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>
    <script src=\"http://getbootstrap.com/dist/js/bootstrap.min.js\"></script>
    <script src=\"http://getbootstrap.com/assets/js/docs.min.js\"></script>
     
</head>
<body>

<style>
	.right{margin-right:8%;}
</style>

	<div class=\"container-fluid\">
		<div class=\"row\">
				<!-- valores escondidos-->
				
				
				<!-- fin valores escondidos-->
						<h4 class='text-center' id='TituloPrueba'>Resultados Biotest</h4>
                                     
									 <!-- Condición física -->
                                       <div class=\"col-sm-12  col-xs-12 containerbar pull-right Grafica\" id=\"ContainerBar\"> 
                                     <h1 class=\"text-center\">Condición Física</h1>
                                      <h2 id=\"CondicionTitulo\" ></h2>  
                                        <div class=\"progress\">
                                            <div class=\"progress-bar ".$Barra."\" role=\"progressbar\" aria-valuenow=\"60\" aria-valuemin=\"0\"
                                             aria-valuemax=\"100\" id=\"ProgresBarResultado\" style=\"".$Longitud."\">
                                            <span class=\"sr-only\">60% Complete</span>
                                          </div>
                                        </div><!--progress -->
                                        
                                        <!-- Barra de comparación-->
                                    	 ".$progress."
                                      <p class=\"text-center \">".$Consejo."</p>
									  
									  <div id=\"chart_div\" style=\"height:270px; width:800px;\"align=\"center\"> </div> <!-- chart_div -->
                                     </div><!--containerbar -->  
									 
									 <!-- Peso -->
									 <div class=\"col-sm-12  col-xs-12 containerbar pull-right Grafica\" id=\"ContainerBar\"> 
                                     <h1 class=\"text-center\">Peso</h1>
                                      <h2 id=\"CondicionTitulo\" ></h2>  
                                        <div class=\"progress\">
                                            <div class=\"progress-bar ".$BarraPeso."\" role=\"progressbar\" aria-valuenow=\"60\" aria-valuemin=\"0\"
                                             aria-valuemax=\"100\" id=\"ProgresBarResultado\" style=\"".$LongitudPeso."\">
                                            <span class=\"sr-only\">60% Complete</span>
                                          </div>
                                        </div><!--progress -->
                                        
                                        <!-- Barra de comparación-->
                                     	".$progress."
                                        <p class=\"text-center \">".$ConsejoPeso."</p>
										<div id=\"chart_peso\" style=\"height:270px; width:800px;\"align=\"center\"></div>
										<h1>&nbsp;</h1> <!-- para hacer el espacio y bajarlo-->
										<h1>&nbsp;</h1> <!-- para hacer el espacio y bajarlo-->
                                     </div><!--containerbar -->  
									 <!-- Final de Peso  -->
									 
									 <!-- Stamina -->
									 <div class=\"col-sm-12  col-xs-12 containerbar pull-right Grafica\" id=\"ContainerBar\"> 
                                     <h1 class=\"text-center\">Stamina</h1>
                                      <h2 id=\"CondicionTitulo\" ></h2>  
                                        <div class=\"progress\">
                                            <div class=\"progress-bar ".$BarraStam."\" role=\"progressbar\" aria-valuenow=\"60\"
											 aria-valuemin=\"0\"
                                             aria-valuemax=\"100\" id=\"ProgresBarResultado\" style=\"".$Longitudstam."\">
                                            <span class=\"sr-only\">60% Complete</span>
                                          </div>
                                        </div><!--progress -->
                                        
                                        <!-- Barra de comparación-->
                                     ".$progress."
									  <p class=\"text-center \">".$Consejostam."</p>
									  <div id=\"chart_stamina\" style=\"height:270px; width:800px;\"align=\"center\"></div>
                                     </div><!--containerbar --> 
									 
									 <!-- final stamina-->
									 
									 <!-- fuerza-->
								
									 
									  <div class=\"col-sm-12  col-xs-12 containerbar pull-right Grafica\" id=\"ContainerBar\"> 
                                     <h1 class=\"text-center\">Fuerza</h1>
                                      <h2 id=\"CondicionTitulo\" ></h2>  
                                        <div class=\"progress\">
                                            <div class=\"progress-bar ".$BarraFuerza."\" role=\"progressbar\" aria-valuenow=\"60\"
											 aria-valuemin=\"0\"
                                             aria-valuemax=\"100\" id=\"ProgresBarResultado\" style=\"".$Longitudfuer."\">
                                            <span class=\"sr-only\">60% Complete</span>
                                          </div>
                                        </div><!--progress -->
                                        
                                        <!-- Barra de comparación-->
                                     ".$progress."
									 <p class=\"text-center \">".$Consejofuer."</p>
									 <div id=\"chart_fuerza\" style=\"height:270px; width:800px;\"align=\"center\"></div>
									 <h1>&nbsp;</h1> <!-- para hacer el espacio y bajarlo-->
                                     </div><!--containerbar -->  
									 
									  <div class=\"col-sm-12  col-xs-12 containerbar pull-right Grafica\" id=\"ContainerBar\"> 
									  </br></br>
									  <h1>&nbsp;</h1>
									  <h1>&nbsp;</h1>
									  <h1>&nbsp;</h1> <!-- para hacer el espacio y bajarlo-->
									  <h1>&nbsp;</h1> <!-- para hacer el espacio y bajarlo-->
                                     <h1 class=\"text-center\">Resistencia</h1>
                                      <h2 id=\"CondicionTitulo\" ></h2>  
                                        <div class=\"progress\">
                                            <div class=\"progress-bar ".$BarraResis."\" role=\"progressbar\" aria-valuenow=\"60\"
											 aria-valuemin=\"0\"
                                             aria-valuemax=\"100\" id=\"ProgresBarResultado\" style=\"".$LongitudResi."\">
                                            <span class=\"sr-only\">60% Complete</span>
                                          </div>
                                        </div><!--progress -->
                                        
                                        <!-- Barra de comparación--> 
                                     ".$progress."
									 <p class=\"text-center \">".$ConsejoResi."</p>
									 <div id=\"chart_Resistencia\" style=\"height:270px; width:800px;\"align=\"center\"></div>
                                     </div><!--containerbar --> 
									  
									 
									 
									 <div class=\"col-sm-12  col-xs-12 containerbar pull-right Grafica\" id=\"ContainerBar\">
									 <div class=\"col-sm-12  col-xs-12 \" id=\"ContainerBar\">
										 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
									 </div> 
                                     <h1 class=\"text-center\">Flexibilidad</h1>
                                      <h2 id=\"CondicionTitulo\" ></h2>  
                                        <div class=\"progress\">
                                            <div class=\"progress-bar ".$BarraFlexi."\" role=\"progressbar\" aria-valuenow=\"60\"
											 aria-valuemin=\"0\"
                                             aria-valuemax=\"100\" id=\"ProgresBarResultado\" style=\"".$LongitudFlexi."\">
                                            <span class=\"sr-only\">60% Complete</span>
                                          </div>
                                        </div><!--progress -->
                                        
                                        <!-- Barra de comparación-->
                                     ".$progress."
									 <p class=\"text-center \">".$ConsejoFlexi."</p>
									 <div id=\"chart_flexibilidad\" style=\"height:270px; width:800px;\"align=\"center\"></div>
									 <h1>&nbsp;</h1> <!-- para hacer el espacio y bajarlo-->
									 <h1>&nbsp;</h1> <!-- para hacer el espacio y bajarlo-->
									 <h1>&nbsp;</h1> <!-- para hacer el espacio y bajarlo-->
									 <h1>&nbsp;</h1> <!-- para hacer el espacio y bajarlo-->
                                     </div><!--containerbar --> 
									 
									   <div class='col-sm-12 col-xs-12 containerbar pull-left Grafica' id='ContainerBar'> 
                                      <h2 id=\"CondicionTitulo\" class=\"text-center\" >IMM</h2>  
                                          <div class=\"Resultados2 col-sm-4 col-xs-4\">
                                                      <!-- Segundos Resultados-->
                                                   <h5 id=\"Fecha\" class=\"text-center\">".$fecha2."</h5>
                                                    <!--Primeros Resultados -->
                                                	<div class=\"col-sm-12 col-xs-12 Cintura pull-right\">
                                                    	<label class=\"text-center col-sm-12 col-xs-12 \">Cintura: ".$CantidadCintura2."</label>
                                                     </div>
                                                    <div class=\"col-sm-12 col-xs-12 Cadera pull-right\">
                                                    	<label class=\"text-center col-sm-12 col-xs-12\">Cadera: ". $CantidadCadera2."</label>
                                                     </div>
                                                    <div class=\"col-sm-12 col-xs-12 Per_Espalda  pull-right\">
                                                    	<label class=\"text-center col-sm-12 col-xs-12\">Espalda: ". $per_espalda_can2."</label>
                                                    </div>
                                                    <div class=\"col-sm-12 col-xs-12 Per_Pecho  pull-right\">
                                                    	<label class=\"text-center col-sm-12 col-xs-12 \">Pecho: ". $Per_Pecho2 ."</label>
                                                     </div>
                                                    <div class=\"col-sm-21 col-xs-12 Per_Brazo pull-right\">
                                                    	<label class=\"text-center col-sm-12 col-xs-12 right\">Brazo: ". $Per_Brazo2."</label>
                                                     </div>
                                                    <div class=\"col-sm-12 col-xs-12 Per_Brazo_Fle pull-right\">
                                                    	<label class=\"text-center col-sm-12 col-xs-12\">Brazo Flexionado: ". $Per_Brazo_Fle2."</label>
                                                     </div>
                                                    <div class=\"col-sm-12 col-xs-12 Perimetro_femoral pull-right\">
                                                    	<label class=\"text-center col-sm-12 col-xs-12\">Femoral: ".$Per_Femoral2."</label>
                                                     </div>
                                                    <div class=\"col-sm-12 col-xs-12 Per_Pantorrilla pull-right\">
                                                    	<label class=\"text-center col-sm-12 col-xs-12\">Pantorrilla: ". $Per_Pantorrilla2."</label>
                                                    </div>
                                                </div><!-- Resultados -->
                                                
                                                
                                                <div class=\"Resultados col-sm-4 col-xs-4 pull-right\">
                                                	<h5 id=\"text-left\" style=\"margin-left:12%\">Resultados</h5>
                                                    <!--Resultados Finales -->
                                                	<div class=\"col-sm-10  col-xs-10 Cintura pull-left\">
                                                    	<label for=\"\" id=\"\" class=\"text-left col-sm-6 right\">". $ResCintura."</label>
                                                     </div>
                                                    <div class=\"col-sm-10  col-xs-10 Cadera pull-left\">
                                                    	<label for=\"\" id=\"\" class=\"text-left col-sm-6 right\">". $Res_Cadera."</label>
                                                     </div>
                                                    <div class=\"col-sm-10  col-xs-10 Per_Espalda  pull-left\">
                                                    	<label for=\"\" id=\"\" class=\"text-left col-sm-6 right\">". $Res_per_esp."</label>
                                                    </div>
                                                    <div class=\"col-sm-10  col-xs-10 Per_Pecho   pull-left\">
                                                    	<label for=\"\" id=\" \" class=\"text-left col-sm-6 right\">". $Res_pecho ."</label>
                                                     </div>
                                                    <div class=\"col-sm-10  col-xs-10 Per_Brazo pull-left\">
                                                    	<label for=\"\" id=\"\" class=\"text-left col-sm-6 right\">". $Res_Brazo."</label>
                                                     </div>
                                                    <div class=\"col-sm-10  col-xs-10 Per_Brazo_Fle pull-left\">
                                                    	<label for=\"\" id=\"\" class=\"text-left col-sm-6 right\">". $Res_BrazoFle."</label>
                                                     </div>
                                                    <div class=\"col-sm-10  col-xs-10 Perimetro_femoral pull-left\">
                                                    	<label for=\"\" id=\"\" class=\"text-left col-sm-6 right\">". $Res_PeriFemo."</label>
                                                     </div>
                                                    <div class=\"col-sm-10  col-xs-10 Per_Pantorrilla pull-left\">
                                                    	<label for=\"\" id=\"\" class=\"text-left col-sm-6 right\">". $ResPerPant."</label>
                                                    </div>
                                                </div><!-- Resultados -->
												
												
                                                
                                            	<div class=\"Resultados col-sm-4 col-xs-4 pull-right\">
                                                	<h5 id=\"Fecha\" class=\"text-center\">". $fecha."</h5>
                                                    <!--Primeros Resultados -->
                                                	<div class=\"col-sm-12 col-xs-12 Cintura pull-right\">
                                                    <label class=\"text-center col-xs-12 col-sm-12\">Cintura: ".$CantidadCintura."</label>
                                                     </div>
                                                    <div class=\"col-sm-12 col-xs-12 Cadera pull-right\">
                                                    	<label class=\"text-center col-xs-12 col-sm-12\">Cadera: ". $CantidadCadera."</label>
                                                     </div>
                                                    <div class=\"col-sm-12 col-xs-12 Per_Espalda  pull-right\">
                                                    	<label class=\"text-center col-xs-12 col-sm-12\">Espalda: ". $per_espalda_can."</label>
                                                    </div>
                                                    <div class=\"col-sm-12 col-xs-12 Per_Pecho pull-right\">
                                                    	<label class=\"text-center col-xs-12 col-sm-12\">Pecho: ". $Per_Pecho ."</label>
                                                     </div>
                                                    <div class=\"col-sm-21 col-xs-12 Per_Brazo pull-right\">
                                                    	<label class=\"text-center col-xs-12 col-sm-12\">Brazo: ". $Per_Brazo."</label>
                                                     </div>
                                                    <div class=\"col-sm-12 col-xs-12 Per_Brazo_Fle pull-right\">
                                                    	<label class=\"text-center col-xs-12 col-sm-12\">Brazo Flexionado: ". $Per_Brazo_Fle."</label>
                                                     </div>
                                                    <div class=\"col-sm-12 col-xs-12 Perimetro_femoral pull-right\">
                                                    	<label class=\"text-center col-xs-12 col-sm-12\">Femoral: ". $Per_Femoral."</label>
                                                     </div>
                                                    <div class=\"col-sm-12 col-xs-12 Per_Pantorrilla pull-right\">
                                                    	<label class=\"text-center col-xs-12 col-sm-12\">Pantorrill: ". $Per_Pantorrilla."</label>
                                                    </div>
                                                    </div><!-- Resultados-->
													
                                      </div><!--containerbar -->
									  <div id=\"chart_imm\" style=\"height:300px; width:800px;\"align=\"center\"
									  class=\"col-md-12 col-xs-12\"></div>
		</div> <!-- row -->
	</div> <!-- container fluid-->

    
      </body>
	   <script type=\"text/javascript\">
      google.load('visualization', '1.0', {'packages':['corechart']});
      google.setOnLoadCallback(drawChart);

      function drawChart() {
		  
		  //Tomando los datos de las fechas
		  
        var data = google.visualization.arrayToDataTable([
        ['Resultados', 'Condicion Fisica',{ role: 'style' }],
        ['".$fechaCond."', ".$dato1.",'silver'],
        ['".$fechaCond2."', ".$dato2.",'silver'],
        ['".$fechaCond3."', ".$dato3.",'silver']
      ]);
	
		var data2 = google.visualization.arrayToDataTable([
        ['Resultados', 'Peso',{ role: 'style' }],
        ['".$fechaPeso."', ".$PorcenPeso1.",'silver'],
        ['".$fechaPeso2."', ".$PorcenPeso2.",'silver'],
        ['".$fechaPeso3."', ".$PorcenPeso3.",'silver']
      ]);
	  
	  var data3 = google.visualization.arrayToDataTable([
        ['Resultados', 'Stamina',{ role: 'style' }],
        ['".$fechaStam."', ".$PorcenStam1.",'silver'],
        ['".$fechaStam2."', ".$PorcenStam2.",'silver'],
        ['".$fechaStam3."', ".$PorcenStam3.",'silver']
      ]);
	  
	  var data4 = google.visualization.arrayToDataTable([
        ['Resultados', 'Fuerza',{ role: 'style' }],
        ['".$fechaFuer."', ".$PorcenFuer.",'silver'],
        ['".$fechaFuer2."', ".$PorcenFuer2.",'silver'],
        ['".$fechaFuer3."', ".$PorcenFuer3.",'silver']
      ]);
	  
	  var data5 = google.visualization.arrayToDataTable([
        ['Resultados', 'Resistencia',{ role: 'style' }],
        ['".$fechaResis."', ".$PorcenResis.",'silver'],
        ['".$fechaResis2."', ".$PorcenResis2.",'silver'],
        ['".$fechaResis3."', ".$PorcenResis3.",'silver']
      ]);
	  
	  var data6 = google.visualization.arrayToDataTable([
        ['Resultados', 'Flexibilidad',{ role: 'style' }],
        ['".$fechaFlexi."', ".$PorcenFlexi.",'silver'],
        ['".$fechaFlexi2."', ".$PorcenFlexi2.",'silver'],
        ['".$fechaFlexi3."', ".$PorcenFlexi3.",'silver']
      ]);
	
		var data7 = new google.visualization.arrayToDataTable([
          ['Resultados', '".$fecha."', '".$fecha2."'],
          ['Cintura', ".$CantidadCintura.", ".$CantidadCintura2."],
          ['Cadera', ".$CantidadCadera.", ".$CantidadCadera2."],
          ['Espalda', ".$per_espalda_can.", ".$per_espalda_can2."],
          ['Pecho', ".$Per_Pecho.", ".$Per_Pecho2."],
          ['Brazo', ".$Per_Brazo.", ".$Per_Brazo2."],
		  ['brazo Flexionado', ".$Per_Brazo_Fle.", ".$Per_Brazo_Fle2."],
		  ['Perimetro femoral', ".$Per_Femoral.", ".$Per_Femoral2."],
		  ['Pantorrilla', ".$Per_Pantorrilla.", ".$Per_Pantorrilla2."]
        ]);
     

      var options = {
        title: 'Condicion Fisica',
		colors: ['silver'],
        chartArea: {width: '50%'},
        annotations: {
          alwaysOutside: true,
          textStyle: {
            fontSize: 12,
            auraColor: 'none',
            color: '#555'
          },
          boxStyle: {
            stroke: '#ccc',
            strokeWidth: 1,
            gradient: {
              color1: '#f3e5f5',
              color2: '#f3e5f5',
              x1: '0%', y1: '0%',
              x2: '100%', y2: '100%'
            }
          }
        },
        hAxis: {
          title: 'Resultados Totales',
          minValue: 0,
        },
        vAxis: {
          title: 'Resultados'
        }
      };
	  
	 var options2 = {
        title: 'Peso', chartArea: {width: '50%'},
		colors: ['silver'],
        annotations: {alwaysOutside: true, textStyle: {fontSize: 12,auraColor: 'none',color: '#555'},
          boxStyle: { stroke: '#ccc', strokeWidth: 1, gradient: {color1: '#f3e5f5',color2: '#f3e5f5',x1: '0%', y1: '0%',x2: '100%', y2: '100%'}}
        },
        hAxis: {title: 'Resultados Totales',minValue: 0,},
        vAxis: {title: 'Resultados'}
      }; // Options 2
	  
	  var options3 = {
        title: 'Stamina', chartArea: {width: '50%'},
		colors: ['silver'],
        annotations: {alwaysOutside: true, textStyle: {fontSize: 12,auraColor: 'none',color: '#555'},
          boxStyle: { stroke: '#ccc', strokeWidth: 1, gradient: {color1: '#f3e5f5',color2: '#f3e5f5',x1: '0%', y1: '0%',x2: '100%', y2: '100%'}}
        },
        hAxis: {title: 'Resultados Totales',minValue: 0,},
        vAxis: {title: 'Resultados'}
      }; // Options 3
	  
	  var options4 = {
        title: 'Fuerza', chartArea: {width: '50%'},
		colors: ['silver'],
        annotations: {alwaysOutside: true, textStyle: {fontSize: 12,auraColor: 'none',color: '#555'},
          boxStyle: { stroke: '#ccc', strokeWidth: 1, gradient: {color1: '#f3e5f5',color2: '#f3e5f5',x1: '0%', y1: '0%',x2: '100%', y2: '100%'}}
        },
        hAxis: {title: 'Resultados Totales',minValue: 0,},
        vAxis: {title: 'Resultados'}
      }; // Options 4
	  
	   var options5 = {
        title: 'Resistencia', chartArea: {width: '50%'},
		colors: ['silver'],
        annotations: {alwaysOutside: true, textStyle: {fontSize: 12,auraColor: 'none',color: '#555'},
          boxStyle: { stroke: '#ccc', strokeWidth: 1, gradient: {color1: '#f3e5f5',color2: '#f3e5f5',x1: '0%', y1: '0%',x2: '100%', y2: '100%'}}
        },
        hAxis: {title: 'Resultados Totales',minValue: 0,},
        vAxis: {title: 'Resultados'}
      }; // Options 5
	  
	   var options6 = {
        title: 'Flexibilidad', chartArea: {width: '50%'},
		colors: ['silver'],
        annotations: {alwaysOutside: true, textStyle: {fontSize: 12,auraColor: 'none',color: '#555'},
          boxStyle: { stroke: '#ccc', strokeWidth: 1, gradient: {color1: '#f3e5f5',color2: '#f3e5f5',x1: '0%', y1: '0%',x2: '100%', y2: '100%'}}
        },
        hAxis: {title: 'Resultados Totales',minValue: 0,},
        vAxis: {title: 'Resultados'}
      }; // Options 6
	  
	   var options7 = {
          width: 900,
          chart: {
            title: 'IMM',
			colors: ['silver'],
            subtitle: ''
          },
          bars: 'horizontal', // Required for Material Bar Charts.
          series: {
            0: { axis: 'distance' }, // Bind series 0 to an axis named 'distance'.
            1: { axis: 'brightness' } // Bind series 1 to an axis named 'brightness'.
          },
          axes: {
            x: {
              distance: {label: 'parsecs'}, // Bottom x-axis.
              brightness: {side: 'top', label: 'apparent magnitude'} // Top x-axis.
            }
          } // option 7
        };
	  
	   var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
      chart.draw(data, options);
	  
	  var chart2 = new google.visualization.BarChart(document.getElementById('chart_peso'));
      chart2.draw(data2, options2);
	  
	  var chart3 = new google.visualization.BarChart(document.getElementById('chart_stamina'));
      chart3.draw(data3, options3);
	  
	  var chart4 = new google.visualization.BarChart(document.getElementById('chart_fuerza'));
      chart4.draw(data4, options4);
	  
	  var chart5 = new google.visualization.BarChart(document.getElementById('chart_Resistencia'));
      chart5.draw(data5, options5);
	  
	  var chart6 = new google.visualization.BarChart(document.getElementById('chart_flexibilidad'));
      chart6.draw(data6, options6);
	  
	   var chart7 = new google.visualization.BarChart(document.getElementById('chart_imm'));
      chart7.draw(data7, options7);
	  
      }
    </script>  
      </html>";



// PUT YOUR HTML HEADER IN A VARIABLE
$my_html_header="
<div style=\"display:block; background-color:#f2f2f2; padding:10px; border-bottom:2pt solid #cccccc; color:#6e6e6e; font-size:.85em; font-family:verdana;\">
  <div style=\"float:left; width:33%; text-align:left;\">
      <img src=\"http://imagizer.imageshack.us/v2/128x32q90/673/NaZt1l.png\">
  </div>
  <div style=\"float:left; width:33%; text-align:center;\">
     Resultados de Biotest
  </div>
  <div style=\"float:left; width:33%; text-align:right;\">
     Reporte: ".$fecha_actual."
  </div>
  <br style=\"clear:left;\"/>
</div>";



// PUT YOUR HTML FOOTER IN A VARIABLE (AND I USE PAGE NUMBERS)
$my_html_footer="
<div style=\"display:block;\">
  <div style=\"float:left; width:33%; text-align:left;\">
          &nbsp; 
  </div>
  <div style=\"float:left; width:33%; text-align:center;\">
         Page phptopdf_on_page_number of phptopdf_pages_total
  </div>
  <div style=\"float:left; width:33%; text-align:right;\">
          &nbsp;
   </div>
   <br style=\"clear:left;\"/>
</div>";





// SET YOUR PDF OPTIONS -- FOR ALL AVAILABLE OPTIONS, VISIT HERE:  http://phptopdf.com/documentation/
 $nombrepdf=$id_cliente."fileBiotest".".pdf";
  $filename="C:/xampp/htdocs/Spinpgym/".$nombrepdf;
$pdf_options = array(
  "source_type" => 'html',
  "source" => $my_html,
  "action" => 'save',
  "save_directory" => '../../pdf',
  "file_name" => $nombrepdf,
  "header" => $my_html_header,
  "footer" => $my_html_footer);
$pdfpath="C:/xampp/htdocs/Spinpgym/pdf/".$nombrepdf;


// CALL THE phpToPDF FUNCTION WITH THE OPTIONS SET ABOVE
phptopdf($pdf_options);

//Mandar el PDF al mail

require '../../includes/PhpMailer/PHPMailerAutoload.php';
require '../../includes/PhpMailer/class.smtp.php';

$mailFile 		= "/Spinpgym/pdf/".$nombrepdf;
$mail  = new PHPMailer();
$body="<b>This mail is sent using PHP Mailer</b>";#HTML tags can be included
$mail->IsSMTP();
// $mail->SMTPDebug  = 2; 
$mail->Host = "mail.ashernetz.net:2525";  // Servidor de Salida.
$mail->SMTPAuth = true; 
$mail->Username = "ashernetz@ashernetz.net";  // Correo Electrónico
$mail->Password = "Chuvaca800"; // Contraseña
$mail->From = "ashernetz@ashernetz.net";
$mail->FromName = "SpinGym";
$mail->Subject    = "Resultados Biotest SpinGym";
$mail->AddAddress($de_email);
//$mail->SMTPDebug  = 2; 
$mail->Body    = 'Desde SpinGym queremos que disfrutes tu tiempo aqu&iacute;, para tu comidad te mandamos tus resultados a tu correo. Vive SpinGym';
$mail->AddAttachment($_SERVER['DOCUMENT_ROOT']."/".$mailFile,"Resultados.Pdf");
$mail->WordWrap   = 50;
$mail->AddAddress($de_email, "SpinGym");
$mail->IsHTML(true); // send as HTML

/*$mail->SMTPAuth  = true;                 #enable SMTP authentication
$mail->SMTPSecure = "ssl";               #sets the prefix to the server
$mail->Host  = "smtp.gmail.com";         #sets GMAIL as the SMTP server
$mail->Port       = 465;                 #set the SMTP port
$mail->Username   = "ashernetz@gmail.com";                  #your gmail username
$mail->Password   = "corridorsoftime5";                  #Your gmail password
$mail->From       = "ashernetz";                  #your gmail id
$mail->FromName   = "SpinGym";                  #your name
$mail->Subject    = "Rutina SpinGym";
$mail->Body    = 'Desde SpinGym queremos que disfrutes tu tiempo aqu&iacute;, para tu comidad te mandamos tu rutina a tu correo. Vive SpinGym';
 $mail->AddAttachment($pdfpath,"Rutina.Pdf");
$mail->WordWrap   = 50;
$mail->AddAddress($de_email, $nombre_completo);
$mail->IsHTML(true); // send as HTML*/
if(!$mail->Send())
{
	unlink($_SERVER['DOCUMENT_ROOT']."/".$mailFile); //Eliminando archivo
	//Redirigir a la página
	$salidaJson=array("id_cliente"=>$id_cliente);
	echo json_encode($salidaJson);
}
else
{
	//unlink($pdfpath); //Eliminando archivo local
	unlink($_SERVER['DOCUMENT_ROOT']."/".$mailFile); //Eliminando archivo host
	//Redirigir a la página
	$salidaJson=array("id_cliente"=>$id_cliente);
	echo json_encode($salidaJson);
}


?>