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
		
		 
		$id_cliente    = $Parametros['Id_Cliente'];
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
		$Flexibilidad  = $decode["Flexibilidad"]; // Array de resultado de pruebas de flexibilidad
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
    <script type=\"text/javascript\">
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

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>    
</head>
<body>

<style>
	.right{margin-right:8%;}
</style>

	<div class=\"container-fluid\">
		<div class=\"row\">
						<h4 class='text-center' id='TituloPrueba'>Resultados Biotest</h4>
                                     
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
                                     </div><!--containerbar -->  
									 
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
                                     </div><!--containerbar -->  
									 
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
                                     </div><!--containerbar --> 
									 
									 <div class=\"col-sm-12  col-xs-12 containerbar pull-right Grafica\" id=\"ContainerBar\"
									 style=\"display:none\"> 
                                     
									 <p class=\"text-center \">".$Consejofuer."</p>
                                     </div><!--containerbar -->  
									 
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
                                     </div><!--containerbar -->  
									 
									  <div class=\"col-sm-12  col-xs-12 containerbar pull-right Grafica\" id=\"ContainerBar\"> 
									  </br></br>
									  <h1>&nbsp;</h1>
									  </br></br>
									  <h1>&nbsp;</h1>
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
                                     </div><!--containerbar --> 
									 
									   <div class='col-sm-12 col-xs-12 containerbar pull-left Grafica' id='ContainerBar'> 
                                      <h2 id=\"CondicionTitulo\" class=\"text-center\" >IMM</h2>  
                                          <div class=\"Resultados2 col-sm-4 col-xs-4\">
                                                      <!-- Segundos Resultados-->
                                                   <h5 id=\"Fecha\" class=\"text-center\">". $fecha2."</h5>
                                                    <!--Primeros Resultados -->
                                                	<div class=\"col-sm-12 col-xs-12 Cintura pull-right\">
                                                    	<label for=\"\" id=\"\" class=\"text-right col-sm-6 col-xs-6 right\">".$CantidadCintura."</label>
                                                     </div>
                                                    <div class=\"col-sm-12 col-xs-12 Cadera pull-right\">
                                                    	<label for=\"\" id=\"\" class=\"text-right col-sm-6 col-xs-6 right\">". $CantidadCadera2."</label>
                                                     </div>
                                                    <div class=\"col-sm-12 col-xs-12 Per_Espalda  pull-right\">
                                                    	<label for=\"\" id=\"\" class=\"text-right col-sm-6 col-xs-6 right\">". $per_espalda_can2."</label>
                                                    </div>
                                                    <div class=\"col-sm-12 col-xs-12 Per_Pecho   pull-right\">
                                                    	<label for=\"\" id=\"\" class=\"text-right col-sm-6 col-xs-6 right\">". $Per_Pecho2 ."</label>
                                                     </div>
                                                    <div class=\"col-sm-21 col-xs-12 Per_Brazo pull-right\">
                                                    	<label for=\"\" id=\"\" class=\"text-right col-sm-6 col-xs-6 right\">". $Per_Brazo2."</label>
                                                     </div>
                                                    <div class=\"col-sm-12 col-xs-12 Per_Brazo_Fle pull-right\">
                                                    	<label for=\"\" id=\"\" class=\"text-right col-sm-6 col-xs-6 right\">". $Per_Brazo_Fle2."</label>
                                                     </div>
                                                    <div class=\"col-sm-12 col-xs-12 Perimetro_femoral pull-right\">
                                                    	<label for=\"\" id=\"\" class=\"text-right col-sm-6 col-xs-6 right\">".$Per_Femoral2."</label>
                                                     </div>
                                                    <div class=\"col-sm-12 col-xs-12 Per_Pantorrilla pull-right\">
                                                    	<label for=\"\" id=\"\" class=\"text-right col-sm-6 col-xs-6 right\">". $Per_Pantorrilla2."</label>
                                                    </div>
                                                </div><!-- Resultados -->
                                                
                                                
                                                <div class=\"Resultados col-sm-4 col-xs-4 pull-right\">
                                                	<h5 id=\"text-left\" style=\"margin-left:12%\">Resultados</h5>
                                                    <!--Resultados Finales -->
                                                	<div class=\"col-sm-10  col-xs-10 Cintura pull-left\">
                                                    	<label for=\"\" id=\"\" class=\"text-left col-sm-6 right\">
														Cadera: ". $ResCintura."</label>
                                                     </div>
                                                    <div class=\"col-sm-10  col-xs-10 Cadera pull-left\">
                                                    	<label for=\"\" id=\"\" class=\"text-left col-sm-6 right\">
														Cintura: ". $Res_Cadera."</label>
                                                     </div>
                                                    <div class=\"col-sm-10  col-xs-10 Per_Espalda  pull-left\">
                                                    	<label for=\"\" id=\"\" class=\"text-left col-sm-6 right\">
														Espalda: ". $Res_per_esp."</label>
                                                    </div>
                                                    <div class=\"col-sm-10  col-xs-10 Per_Pecho   pull-left\">
                                                    	<label for=\"\" id=\" \" class=\"text-left col-sm-6 right\">
														Pecho: ". $Res_pecho ."</label>
                                                     </div>
                                                    <div class=\"col-sm-10  col-xs-10 Per_Brazo pull-left\">
                                                    	<label for=\"\" id=\"\" class=\"text-left col-sm-6 right\">
														Brazo: ". $Res_Brazo."</label>
                                                     </div>
                                                    <div class=\"col-sm-10  col-xs-10 Per_Brazo_Fle pull-left\">
                                                    	<label for=\"\" id=\"\" class=\"text-left col-sm-6 right\">
														Brazo Flexionado: ". $Res_BrazoFle."</label>
                                                     </div>
                                                    <div class=\"col-sm-10  col-xs-10 Perimetro_femoral pull-left\">
                                                    	<label for=\"\" id=\"\" class=\"text-left col-sm-6 right\">
														Femoral: ". $Res_PeriFemo."</label>
                                                     </div>
                                                    <div class=\"col-sm-12 col-xs-12 Per_Pantorrilla pull-left\">
                                                    	<label for=\"\" id=\"\" class=\"text-center col-sm-12 col-xs-12\">
															Pantorrilla: ". $ResPerPant."</label>
                                                    </div>
                                                </div><!-- Resultados -->
												
												
                                                
                                            	<div class=\"Resultados col-sm-4 col-xs-4 pull-right\">
                                                	<h5 id=\"Fecha\" class=\"text-center\">". $fecha."</h5>
                                                    <!--Primeros Resultados -->
                                                	<div class=\"col-sm-12 col-xs-12 Cintura pull-right\">
                                                    <label for=\"\" id=\"\" class=\"text-center col-xs-12 col-sm-12\">
													Cintura: ".$CantidadCintura."</label>
                                                     </div>
                                                    <div class=\"col-sm-12 col-xs-12 Cadera pull-right\">
                                                    	<label for=\"\" id=\"\" class=\"text-center col-xs-12 col-sm-12\">
														Cadera: ". $CantidadCadera."</label>
                                                     </div>
                                                    <div class=\"col-sm-12 col-xs-12 Per_Espalda  pull-right\">
                                                    	<label for=\"\" id=\"\" class=\"text-center col-xs-12 col-sm-12\">
														Espalda: ". $per_espalda_can."</label>
                                                    </div>
                                                    <div class=\"col-sm-12 col-xs-12 Per_Pecho   pull-right\">
                                                    	<label for=\"\" id=\" \" class=\"text-center col-xs-12 col-sm-12\">
														Pecho: ". $Per_Pecho ."</label>
                                                     </div>
                                                    <div class=\"col-sm-21 col-xs-12 Per_Brazo pull-right\">
                                                    	<label for=\"\" id=\"\" class=\"text-center col-xs-12 col-sm-12\">
														Brazo: ". $Per_Brazo."</label>
                                                     </div>
                                                    <div class=\"col-sm-12 col-xs-12 Per_Brazo_Fle pull-right\">
                                                    	<label for=\"\" id=\"\" class=\"text-center col-xs-12 col-sm-12\">
														Brazo Flexionado: ". $Per_Brazo_Fle."</label>
                                                     </div>
                                                    <div class=\"col-sm-12 col-xs-12 Perimetro_femoral pull-right\">
                                                    	<label for=\"\" id=\"\" class=\"text-center col-xs-12 col-sm-12\">
														Femoral: ". $Per_Femoral."</label>
                                                     </div>
                                                    <div class=\"col-sm-12 col-xs-12 Per_Pantorrilla pull-right\">
                                                    	<label for=\"\" id=\"\" class=\"text-center col-xs-12 col-sm-12\">
														Pantorrilla: ". $Per_Pantorrilla."</label>
                                                    </div>
                                                    </div><!-- Resultados-->
                                      </div><!--containerbar -->
		</div> <!-- row -->
	</div> <!-- container fluid-->

    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>
    <script src=\"http://getbootstrap.com/dist/js/bootstrap.min.js\"></script>
    <script src=\"http://getbootstrap.com/assets/js/docs.min.js\"></script>
      </body>
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
$mail->AddAddress("ashernetz@hotmail.com");
//$mail->SMTPDebug  = 2; 
$mail->Body    = 'Desde SpinGym queremos que disfrutes tu tiempo aqu&iacute;, para tu comidad te mandamos tus resultados a tu correo. Vive SpinGym';
$mail->AddAttachment($_SERVER['DOCUMENT_ROOT']."/".$mailFile,"Rutina.Pdf");
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



// OPTIONAL - PUT A LINK TO DOWNLOAD THE PDF YOU JUST CREATED
//echo ("<a href='sample_pdf_report.pdf'>Download Your PDF</a>");
?>