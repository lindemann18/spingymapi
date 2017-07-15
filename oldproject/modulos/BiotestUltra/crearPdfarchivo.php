<?php
 // INCLUDE THE phpToPDF.php FILE
include("../../libs/libs.php");
require("phpToPDF.php"); 
$conexion   = new ConexionBean(); //Variable de conexión
$con        = $conexion->_con(); //Variable de conexión

// Tomando los datos.
$id_cliente   = $_GET['Id_Cliente'];
$consultar   = new Consultar();
$Utilidades  = new Utilidades();

//Se debe verificar si el cliente

$json_return = $Utilidades->ReportePdfultra($id_cliente);
$decode      = json_decode($json_return,true);

//Datos de Peso.
$Peso         = $decode['Peso']; //Array de resultados de la prueba de Peso.
$BarraPeso    = $Peso[0]['Barra'];
$LongitudPeso = $Peso[0]['Longitud'];
$ConsejoPeso  = $Peso[0]['consejo'];
$PorcenPeso1  = $Peso[0]['Porcentaje'];
$fechaPeso    = $Peso[0]['fecha'];
$PorcenPeso2  = $Peso[1]['Porcentaje'];
$fechaPeso2   = $Peso[1]['fecha'];
$PorcenPeso3  = $Peso[2]['Porcentaje'];
$fechaPeso3   = $Peso[2]['fecha'];

//Datos de IMC
$Imc 	      = $decode['Imc'];
$BarraImc     = $Imc[0]['Barra'];
$LongitudImc  = $Imc[0]['Longitud'];
$ConsejoImc   = $Imc[0]['consejo'];
$PorcenImc1   = $Imc[0]['porcentaje'];
$fechaImc     = $Imc[0]['fh_creacion'];
$PorcenImc2   = $Imc[1]['porcentaje'];
$fechaImc2    = $Imc[1]['fh_creacion'];
$PorcenImc3   = $Imc[2]['porcentaje'];
$fechaImc3    = $Imc[2]['fh_creacion'];

// Datos de condición 
$condicion 	  = $decode['condicion'];
$Barracon     = $condicion[0]['Barra'];
$Longitudcon  = $condicion[0]['Longitud'];
$Consejocon   = $condicion[0]['consejo'];
$Porcencon1   = $condicion[0]['Porcentaje'];
$fechacon     = $condicion[0]['fecha'];
$Porcencon2   = $condicion[1]['Porcentaje'];
$fechacon2    = $condicion[1]['fecha'];
$Porcencon3   = $condicion[2]['Porcentaje'];
$fechacon3    = $condicion[2]['fecha'];

// Datos de Resistencia 
$Resistencia  = $decode['Resistencia'];
$Barrares     = $Resistencia[0]['Barra'];
$Longitudres  = $Resistencia[0]['Longitud'];
$Consejores   = $Resistencia[0]['consejo'];
$Porcenres1   = $Resistencia[0]['Porcentaje'];
$fechares     = $Resistencia[0]['fecha'];
$Porcenres2   = $Resistencia[1]['Porcentaje'];
$fechares2    = $Resistencia[1]['fecha'];
$Porcenres3   = $Resistencia[2]['Porcentaje'];
$fechares3    = $Resistencia[2]['fecha'];

// Datos de Stamina 
$Stamina      = $decode['Stamina'];
$Barrasta     = $Stamina[0]['Barra'];
$Longitudsta  = $Stamina[0]['Longitud'];
$Consejosta   = $Stamina[0]['consejo'];
$Porcensta1   = $Stamina[0]['Porcentaje'];
$fechasta     = $Stamina[0]['fecha'];
$Porcensta2   = $Stamina[1]['Porcentaje'];
$fechasta2    = $Stamina[1]['fecha'];
$Porcensta3   = $Stamina[2]['Porcentaje'];
$fechasta3    = $Stamina[2]['fecha'];

// Datos de Fuerza 
$Fuerza       = $decode['Fuerza'];
$Barrafue     = $Fuerza[0]['Barra'];
$Longitudfue  = $Fuerza[0]['Longitud'];
$Consejofue   = $Fuerza[0]['consejo'];
$Porcenfue1   = $Fuerza[0]['Porcentaje'];
$fechafue     = $Fuerza[0]['fecha'];
$Porcenfue2   = $Fuerza[1]['Porcentaje'];
$fechafue2    = $Fuerza[1]['fecha'];
$Porcenfue3   = $Fuerza[2]['Porcentaje'];
$fechafue3    = $Fuerza[2]['fecha'];

// Datos de Flexibilidad 
$Flexibilidad = $decode['Flexibilidad'];
$Barrafle     = $Flexibilidad[0]['Barra'];
$Longitudfle  = $Flexibilidad[0]['Longitud'];
$Consejofle   = $Flexibilidad[0]['consejo'];
$Porcenfle1   = $Flexibilidad[0]['Porcentaje'];
$fechafle     = $Flexibilidad[0]['fecha'];
$Porcenfle2   = $Flexibilidad[1]['Porcentaje'];
$fechafle2    = $Flexibilidad[1]['fecha'];
$Porcenfle3   = $Flexibilidad[2]['Porcentaje'];
$fechafle3    = $Flexibilidad[2]['fecha'];


// Datos de IMM
$IMM      = $decode['IMM'];
$fechaimm = $IMM['fecha'];
$Espalda  = $IMM['Espalda'];
$Pecho    = $IMM['Pecho'];
$Abdomen  = $IMM['Abdomen'];
$Cadera   = $IMM['Cadera'];
$Brazo    = $IMM['Brazo'];
$Muslo    = $IMM['Muslo'];


// DAtos de IMM2
//Tomando los datos del IMM2.
$IMM2 		 	  = $decode['IMM2'];
$fechaimm2 = $IMM2['fecha'];
$Espalda2  = $IMM2['Espalda'];
$Pecho2    = $IMM2['Pecho'];
$Abdomen2  = $IMM2['Abdomen'];
$Cadera2   = $IMM2['Cadera'];
$Brazo2    = $IMM2['Brazo'];
$Muslo2    = $IMM2['Muslo'];

//Datos de la diferencia de IMM
$resultadosIMM = $decode['resultadosIMM'];
$EspaldaR  = $resultadosIMM['Espalda'];
$PechoR    = $resultadosIMM['Pecho'];
$AbdomenR  = $resultadosIMM['Abdomen'];
$CaderaR   = $resultadosIMM['Cadera'];
$BrazoR    = $resultadosIMM['Brazo'];
$MusloR    = $resultadosIMM['Muslo'];

//Consultar la información del cliente
$ResultCliente   = $consultar->_ConsultarClientesPorId($id_cliente);
$nb_nombre 	  	 = $ResultCliente['nb_cliente'];
$nb_apellidos 	 = $ResultCliente['nb_apellidos'];
$de_email	  	 = $ResultCliente['de_email'];

$nombre_completo = utf8_decode($nb_nombre." ".$nb_apellidos);	
	
		//Fecha actual
date_default_timezone_set("Mexico/General");
$fecha_actual = date("Y-m-d"); //fecha del día de hoy

$progress    = "
         <div class=\"progress\">
             <div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" aria-valuenow=\"40\" 
               aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 20%\">
              Bajo&nbsp;&nbsp;
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

<style type=\"text/css\">
body{    padding-top: 0px !important;}
.Cabecera {background-color: #b02823; color:white; font-family: serif; margin-bottom:3%;}
.right{margin-right:8%;}
.ResultImg{background-image: url(../../css/img/grafica.jpg);
        background-repeat: no-repeat;}
.Logo {margin-top:30px;}
.spinlogo{margin-left:170px;}
.FechasDatos{margin-left:145px; width:300px}
.vacio{height: 200px;}    
#datos{width:300px; float:right}  
.containerbar{margin-bottom: 3%; margin-top:3%;}  
.containerbarPeso{margin-bottom: 3%;}  
.ResultadosIMM{margin-top: 5%; border: 1px solid #ccc;margin-left: 8%;padding: 4%; width:100%}
.ContainerGraphic2{ margin-left: 8%; margin-top: 2%;}
.Consejo{width:450px; }
.spinlogo{margin-left:95px;}
.spinlogo img {width:200px; height:45px;}
.ContainerGraphic{height:360px; margin-top:25px;}
.ResultadoIMM{width:100%;}
#chart_div{margin-left:15%;}
#chart_imc{margin-left:15%;}
#chart_imm{margin-left:15%;}
.Resultados{margin-top:8%;}
.Resultados2{margin-top:8%;}
.Resultados3{margin-top:8%;}
</style>

<!-- Dibujando el reporte-->
<!-- Peso-->
<div class=\" containerbarPeso Grafica\" id=\"ContainerBar\" style=\"margin-bottom:80px;\"> 
 	<div class=\"col-md-12 col-xs-12 col-sm-12 Cabecera\">
 		<h1 class=\"text-left\">Peso</h1>
 	</div>
 	<div class=\"  Datos\">
 		<div class=\" ResultImg\">
 		</div>

 		<div class=\"  Logo \">
 			  <div class=\"datos \" id=\"datos\">
 				  <div style=\"col-md-12 col-sm-12\" class=\"spinlogo\">
 					<img src=\"http://imagizer.imageshack.us/v2/128x32q90/673/NaZt1l.png\">
 				</div>
 				<div class=\" FechasDatos \">
          <h5 class=\"text-left\" style=\"margin-left:20px\">Biotest: <strong>".$fecha_actual."</strong></h5>
        </div>
 		</div>

 		<div class=\" Consejo\" align=\"center\">
 			<p class=\"text-center\">
 				".$ConsejoPeso."
 			</p>
 		</div>
 	</div><!-- Datos -->

	   <div class=\"progress\" style=\"margin-top:5%;\">
        <div class=\"progress-bar ".$BarraPeso."\" role=\"progressbar\" aria-valuenow=\"60\" aria-valuemin=\"0\"
         aria-valuemax=\"100\" id=\"ProgresBarResultado\" style=\"".$LongitudPeso."\">
        <span class=\"sr-only\">60% Complete</span>
      </div>
    </div><!--progress -->
    
    <!-- Barra de comparación-->
  ".$progress."

    <div class=\"\" style=\"border: 1px solid #ccc\">
        <div  id=\"chart_div\" style=\" width:800px;\" align=\"center\"></div>    
    </div><!-- ContainerGraphic -->
    
</div><!--containerbar -->  

<!-- IMC-->
 <div class=\" containerbar Grafica\" id=\"ContainerBar\" style=\"margin-bottom:320px;\"> 
  <div class=\"col-md-12 col-xs-12 col-sm-12 Cabecera\">
    <h1 class=\"text-left\">IMC</h1>
  </div>
  
  <div class=\"  Datos\">
    

    <div class=\" Consejo\" align=\"center\">
      <p class=\"text-center\">
        ".$ConsejoImc."
      </p>
    </div>
  </div><!-- Datos -->

    
    <div class=\"progress\" style=\"margin-top:5%;\">
        <div class=\"progress-bar ".$BarraImc."\" role=\"progressbar\" aria-valuenow=\"60\" aria-valuemin=\"0\"
         aria-valuemax=\"100\" id=\"ProgresBarResultado\" style=\"".$LongitudImc."\">
        <span class=\"sr-only\">60% Complete</span>
      </div>
    </div><!--progress -->
    
    <!-- Barra de comparación-->
  ".$progress."
    <div class=\"ContainerGraphic\" style=\"border: 1px solid #ccc; height:320px;\">
        <div  id=\"chart_imc\" style=\" width:800px;\" align=\"center\"></div>    
    </div><!-- ContainerGraphic -->
    
</div><!--containerbar -->  

<!-- Condicion Física-->
<div class=\" containerbar Grafica\" id=\"ContainerBar\" style=\"margin-bottom:80px;\"> 
  <div class=\"col-md-12 col-xs-12 col-sm-12 Cabecera\">
    <h1 class=\"text-left\">Condicion Fisica</h1>
  </div>
  
  <div class=\"  Datos\">
    

    <div class=\" Consejo\" align=\"center\">
      <p class=\"text-center\">
        ".$Consejocon."
      </p>
    </div>
  </div><!-- Datos -->

    <div class=\"progress\" style=\"margin-top:5%; margin-bottom:3%;\">
        <div class=\"progress-bar ".$Barracon."\" role=\"progressbar\" aria-valuenow=\"60\" aria-valuemin=\"0\"
         aria-valuemax=\"100\" id=\"ProgresBarResultado\" style=\"".$Longitudcon."\">
        <span class=\"sr-only\">60% Complete</span>
      </div>
    </div><!--progress -->
    
    <!-- Barra de comparación-->
  ".$progress."
  
    <div class=\"ContainerGraphic\" style=\"border: 1px solid #ccc; height:320px;\">
        <div  id=\"chart_con\" style=\" width:800px; margin-left:15%;\" align=\"center\"></div>    
    </div><!-- ContainerGraphic -->
    
</div><!--containerbar -->  

<!-- Resistencia-->
 <div class=\" containerbar Grafica\" id=\"ContainerBar\" style=\"margin-bottom:320px;\"> 
  <div class=\"col-md-12 col-xs-12 col-sm-12 Cabecera\">
    <h1 class=\"text-left\">Resistencia</h1>
  </div>
  
  <div class=\"  Datos\">
    

    <div class=\" Consejo\" align=\"center\">
      <p class=\"text-center\">
        ".$Consejores."
      </p>
    </div>
  </div><!-- Datos -->

    <div class=\"progress\" style=\"margin-top:5%;\">
        <div class=\"progress-bar ".$Barrares."\" role=\"progressbar\" aria-valuenow=\"60\" aria-valuemin=\"0\"
         aria-valuemax=\"100\" id=\"ProgresBarResultado\" style=\"".$Longitudres."\">
        <span class=\"sr-only\">60% Complete</span>
      </div>
    </div><!--progress -->
    
    <!-- Barra de comparación-->
  ".$progress."

    <div class=\"ContainerGraphic\" style=\"border: 1px solid #ccc; height:320px;\">
        <div  id=\"chart_res\" style=\" width:800px; margin-left:15%;\" align=\"center\"></div>    
    </div><!-- ContainerGraphic -->
    
</div><!--containerbar -->  

  
 

<!-- Fuerza-->
 <div class=\" containerbar Grafica\" id=\"ContainerBar\" style=\"margin-bottom:80;\"> 
  <div class=\"col-md-12 col-xs-12 col-sm-12 Cabecera\">
    <h1 class=\"text-left\">Fuerza</h1>
  </div>
  
  <div class=\"  Datos\">
    

    <div class=\" Consejo\" align=\"center\">
      <p class=\"text-center\">
        ".$Consejofue."
      </p>
    </div>
  </div><!-- Datos -->
    
     <div class=\"progress\" style=\"margin-top:5%; margin-bottom:3%;\">
        <div class=\"progress-bar ".$Barrafue."\" role=\"progressbar\" aria-valuenow=\"60\" aria-valuemin=\"0\"
         aria-valuemax=\"100\" id=\"ProgresBarResultado\" style=\"".$Longitudfue."\">
        <span class=\"sr-only\">60% Complete</span>
      </div>
    </div><!--progress -->
    
    <!-- Barra de comparación-->
  ".$progress."
  
    <div class=\"ContainerGraphic\" style=\"border: 1px solid #ccc; height:320px;\">
        <div  id=\"chart_fue\" style=\" width:800px; margin-left:15%;\" align=\"center\"></div>    
    </div><!-- ContainerGraphic -->
    
</div><!--containerbar -->  


<!-- Stamina-->
 <div class=\" containerbar Grafica\" id=\"ContainerBar\" style=\"margin-bottom:80;\"> 
  <div class=\"col-md-12 col-xs-12 col-sm-12 Cabecera\">
    <h1 class=\"text-left\">Stamina</h1>
  </div>
  
  <div class=\"  Datos\">
    

    <div class=\" Consejo\" align=\"center\">
      <p class=\"text-center\">
        ".$Consejosta."
      </p>
    </div>
  </div><!-- Datos -->
    
     <div class=\"progress\" style=\"margin-top:5%; margin-bottom:3%;\">
        <div class=\"progress-bar ".$Barrasta."\" role=\"progressbar\" aria-valuenow=\"60\" aria-valuemin=\"0\"
         aria-valuemax=\"100\" id=\"ProgresBarResultado\" style=\"".$Longitudsta."\">
        <span class=\"sr-only\">60% Complete</span>
      </div>
    </div><!--progress -->
    
    <!-- Barra de comparación-->
  ".$progress."
  
    <div class=\"ContainerGraphic\" style=\"border: 1px solid #ccc; height:320px;\">
        <div  id=\"chart_sta\" style=\" width:800px; margin-left:15%;\" align=\"center\"></div>    
    </div><!-- ContainerGraphic -->
    
</div><!--containerbar -->  

 <!-- IMM-->
<div class=\"col-md-12 containerbar  \" > 
    <div class=\"col-md-12 Cabecera\">
        <h1 class=\"text-left\">IMM</h1>
    </div>
    
    <div class=\"col-md-12 col-xs-12 col-lg-4  resultadosCompara\" style=\"border:1px solid #ccc; height:350px\">
      <div style=\"width:1000px;\">

       <div class=\"Resultados2 col-md-4 col-xs-4 col-lg-4 pull-left \" >
              <!-- Segundos Resultados-->
           <h5 id=\"Fecha\" class=\"text-center\">".$fechaimm2."</h5>
            <!--Primeros Resultados -->
            <div class=\"col-sm-12 col-xs-12 Espalda pull-right\">
                <label class=\"text-center col-sm-12 col-xs-12\">Espalda:".$Espalda2."</label>
             </div>
            <div class=\"col-sm-12 col-xs-12 Cadera pull-right\">
                <label class=\"text-center col-sm-12 col-xs-12\">Pecho: ".$Pecho2."</label>
             </div>
            <div class=\"ResultadoIMM col-sm-12 col-xs-12 col-md-12 col-lg-12 Per_Espalda \">
                <label class=\"text-center col-sm-12 col-xs-12\">Abdomen: ".$Abdomen2."</label>
            </div>
            <div class=\"col-sm-12 col-xs-12 Per_Pecho  pull-right\">
                <label class=\"text-center col-sm-12 col-xs-12\">Cadera: ".$Cadera2."</label>
             </div>
            <div class=\"col-sm-21 col-xs-12 Per_Brazo pull-right\">
                <label class=\"text-center col-sm-12 col-xs-12 right\">Brazo: ".$Brazo2."></label>
             </div>
            <div class=\"col-sm-12 col-xs-12 Per_Brazo_Fle pull-right\">
                <label class=\"text-center col-sm-12 col-xs-12\">Muslo: ".$Muslo2."</label>
             </div>
        </div><!-- Resultados -->
        
        
        <div class=\"Resultados  col-md-4 col-xs-4 col-lg-4 pull-right \" >
            <h5 class=\"text-center\">Resultados</h5>
            <!--Resultados Finales -->
            <div class=\"col-sm-12 col-xs-12 Espalda pull-right\">
                <label class=\"text-center col-sm-12 col-xs-12\">Espalda: ".$EspaldaR."</label>
             </div>
            <div class=\"col-sm-12 col-xs-12 Cadera pull-right\">
                <label class=\"text-center col-sm-12 col-xs-12\">Pecho: ".$PechoR."</label>
             </div>
            <div class=\"col-sm-12 col-xs-12 col-md-12 col-lg-12 Per_Espalda\">
                <label class=\" text-center col-sm-12 col-xs-12 col-md-12 col-lg-12\">Abdomen: ".$AbdomenR."</label>
            </div>
            <div class=\"col-sm-12 col-xs-12 Per_Pecho  pull-right\">
                <label class=\"text-center col-sm-12 col-xs-12\">Cadera: ".$CaderaR."</label>
             </div>
            <div class=\"col-sm-21 col-xs-12 Per_Brazo pull-right\">
                <label class=\"text-center col-sm-12 col-xs-12 right\">Brazo: ".$BrazoR."</label>
             </div>
            <div class=\"col-sm-12 col-xs-12 Per_Brazo_Fle pull-right\">
                <label class=\"text-center col-sm-12 col-xs-12\">Muslo: ".$MusloR."</label>
             </div>
        </div><!-- Resultados -->
      
        <div class=\"Resultados3 col-md-4 col-xs-4 col-lg-4 pull-right\" >
            <h5 id=\"Fecha\" class=\"text-center\">".$fechaimm."</h5>
            <!--Primeros Resultados -->
            <div class=\"ResultadoIMM Espalda pull-right\">
                <label class=\"text-center col-sm-12 col-xs-12 \">Espalda: ".$Espalda."</label>
             </div>
            <div class=\"ResultadoIMM Cadera pull-right\">
                <label class=\"text-center col-sm-12 col-xs-12\">Pecho: ".$Pecho."</label>
             </div>
            <div class=\"ResultadoIMM Per_Espalda  pull-right\">
                <label class=\"text-center col-sm-12 col-xs-12\">Abdomen: ".$Abdomen."</label>
            </div>
            <div class=\"ResultadoIMM Per_Pecho  pull-right\">
                <label class=\"text-center col-sm-12 col-xs-12 \">Cadera: ".$Cadera."</label>
             </div>
            <div class=\"ResultadoIMM Per_Brazo pull-right\">
                <label class=\"text-center col-sm-12 col-xs-12 right\">Brazo: ".$Brazo."</label>
             </div>
            <div class=\"ResultadoIMM Per_Brazo_Fle pull-right\">
                <label class=\"text-center col-sm-12 col-xs-12\">Muslo: ".$Muslo."</label>
             </div>
            </div><!-- Resultados-->
    </div><!-- Contenedor-->
    </div><!-- container result-->
    

      <div class=\"ContainerGraphic col-md-12 col-lg-12 col-xs-12 \" style=\"border: 1px solid #ccc\">
          <div  id=\"chart_imm\" style=\"height:270px; width:800px;\" align=\"center\"></div>    
      </div><!-- ContainerGraphic -->
    </div><!-- -->    
</div><!--containerbar -->  

    </div> <!-- row -->
	</div> <!-- container fluid-->
</body>

<script type=\"text/javascript\">
      google.load('visualization', '1.0', {'packages':['corechart']});
      google.setOnLoadCallback(drawChart);

   function drawChart() {
	
	var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Peso', { role: 'style' });
        data.addRows([
          ['".$fechaPeso."', ".$PorcenPeso1.",],
          ['".$fechaPeso2."', ".$PorcenPeso2.",],
          ['".$fechaPeso3."', ".$PorcenPeso3.",]
        ]);	  
		  
      var data2 = new google.visualization.DataTable();
        data2.addColumn('string', 'Topping');
        data2.addColumn('number', 'IMM', { role: 'style' });
        data2.addRows([
          ['".$fechaImc."', ".$PorcenImc1.",],
          ['".$fechaImc2."',".$PorcenImc2.",],
          ['".$fechaImc3."',".$PorcenImc3.",]
        ]);

		var data4 = new google.visualization.DataTable();
	        data4.addColumn('string', 'Topping');
	        data4.addColumn('number', 'Condicion Fisica', { role: 'style' });
	        data4.addRows([
	          ['".$fechacon."', ".$Porcencon1.",],
	          ['".$fechacon2."',".$Porcencon2.",],
	          ['".$fechacon3."',".$Porcencon3.",]
        ]);

		var data5 = new google.visualization.DataTable();
	        data5.addColumn('string', 'Topping');
	        data5.addColumn('number', 'Res', { role: 'style' });
	        data5.addRows([
	          ['".$fechares."', ".$Porcenres1.",],
	          ['".$fechares2."',".$Porcenres2.",],
	          ['".$fechares3."',".$Porcenres3.",]
        ]);

		var data6 = new google.visualization.DataTable();
	        data6.addColumn('string', 'Topping');
	        data6.addColumn('number', 'Stamina', { role: 'style' });
	        data6.addRows([
	          ['".$fechasta."', ".$Porcensta1.",],
	          ['".$fechasta2."',".$Porcensta2.",],
	          ['".$fechasta3."',".$Porcensta3.",]
        ]);

		var data7 = new google.visualization.DataTable();
	        data7.addColumn('string', 'Topping');
	        data7.addColumn('number', 'Fuerza', { role: 'style' });
	        data7.addRows([
	          ['".$fechafue."', ".$Porcenfue1.",],
	          ['".$fechafue2."',".$Porcenfue2.",],
	          ['".$fechafue3."',".$Porcenfue3.",]
        ]);
		  
       var data3 = new google.visualization.arrayToDataTable([
          ['Resultados','".$fechaImc."', '".$fechaImc2."'],
          ['Espalda', ".$Espalda.", ".$Espalda2."],
          ['Pecho', ".$Pecho.", ".$Pecho2."],
          ['Abdomen', ".$Abdomen.", ".$Abdomen2."],
          ['Cadera', ".$Cadera.", ".$Cadera2."],
          ['Brazo', ".$Brazo.",".$Brazo2."],
          ['Muslo', ".$Muslo.",".$Muslo2."]
        ]);
        
        var options  = {'title':'Peso','width':700,'height':350};
        var options2 = {'title':'IMC','width':730,'height':300};
        var options3  = {'title':'IMM','width':700,'height':350};
        var options4  = {'title':'Condicion Fisica','width':730,'height':300};
        var options5  = {'title':'Resistencia','width':730,'height':300};
        var options6  = {'title':'Stamina','width':700,'height':300};
        var options7  = {'title':'Fuerza','width':700,'height':300};

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
        var chart = new google.visualization.BarChart(document.getElementById('chart_imc'));
        chart.draw(data2, options2);
        var chart = new google.visualization.BarChart(document.getElementById('chart_imm'));
        chart.draw(data3, options3);
        var chart = new google.visualization.BarChart(document.getElementById('chart_con'));
        chart.draw(data4, options4);
        var chart = new google.visualization.BarChart(document.getElementById('chart_res'));
        chart.draw(data5, options5);
        var chart = new google.visualization.BarChart(document.getElementById('chart_sta'));
        chart.draw(data6, options6);
        var chart = new google.visualization.BarChart(document.getElementById('chart_fue'));
        chart.draw(data7, options7);
        
    }
    </script>  
      </html>";



// PUT YOUR HTML HEADER IN A VARIABLE
$my_html_header="";



// PUT YOUR HTML FOOTER IN A VARIABLE (AND I USE PAGE NUMBERS)
$my_html_footer="
<div style=\"display:block;\">
  <div style=\"float:left; width:33%; text-align:left;\">
          &nbsp; 
  </div>
  <div style=\"float:left; width:33%; text-align:center;\">
         Pagina phptopdf_on_page_number De phptopdf_pages_total
  </div>
  <div style=\"float:left; width:33%; text-align:right;\">
          &nbsp;
   </div>
   <br style=\"clear:left;\"/>
</div>";





// SET YOUR PDF OPTIONS -- FOR ALL AVAILABLE OPTIONS, VISIT HERE:  http://phptopdf.com/documentation/
 $nombrepdf=$id_cliente."fileBiotestUltra".".pdf";
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
//Mandar el PDF al mail
require '../../includes/PhpMailer/PHPMailerAutoload.php';
require '../../includes/PhpMailer/class.smtp.php';

$mailFile     = "/spingym/pdf/".$nombrepdf;
$mail  = new PHPMailer();
$body="<b>This mail is sent using PHP Mailer</b>";#HTML tags can be included
$mail->IsSMTP();
// $mail->SMTPDebug  = 2; 
$mail->Host = "mail.ashernetz.com:2525";  // Servidor de Salida.
$mail->SMTPAuth = true; 
$mail->Username = "spingym@ashernetz.com";  // Correo Electrónico
$mail->Password = "spingym123"; // Contraseña
$mail->From = "spingym@ashernetz.com";
$mail->FromName = "SpinGym";
$mail->Subject    = "Resultados Biotest SpinGym";
$mail->AddAddress($de_email);
//$mail->SMTPDebug  = 2; 
$mail->Body    = 'Desde SpinGym queremos que disfrutes tu tiempo aqu&iacute;, para tu comidad te mandamos tus resultados a tu correo. Vive SpinGym';
//$mail->AddAttachment($_SERVER['DOCUMENT_ROOT']."/".$mailFile,"Rutina.Pdf");
$mail->AddAttachment($_SERVER['DOCUMENT_ROOT'].$mailFile,"Rutina.Pdf");$mail->WordWrap   = 50;
$mail->AddAddress($de_email, "SpinGym");
$mail->IsHTML(true); // send as HTML

if(!$mail->Send())
{
  unlink($_SERVER['DOCUMENT_ROOT']."/".$mailFile); //Eliminando archivo
  //Redirigir a la página
  $salidaJson=array("exito"=>0);
  echo json_encode($salidaJson);
}
else
{
  //unlink($pdfpath); //Eliminando archivo local
  unlink($_SERVER['DOCUMENT_ROOT']."/".$mailFile); //Eliminando archivo host
  //Redirigir a la página
  $salidaJson=array("exito"=>1);
  echo json_encode($salidaJson);
}


?>