<?php
 // INCLUDE THE phpToPDF.php FILE
		
		include("../../libs/libs.php");
		$conexion   = new ConexionBean(); //Variable de conexión
		$con        = $conexion->_con(); //Variable de conexión
		// Tomando los datos.
		

		$id_cliente   = $_GET['Id_Cliente'];
		$consultar   = new Consultar();
		$Utilidades  = new Utilidades();
		$json_return = $Utilidades->ReportePdf($id_cliente);
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
?>
<style type="text/css">
body{    padding-top: 0px !important;}
.Cabecera {background-color: #b02823; color:white; font-family: serif;}
.right{margin-right:8%;}
.ResultImg{background-image: url(../../css/img/grafica.jpg);
        background-repeat: no-repeat;
    background-size: 78%;
    background-position: 0px 35px;
    height: 255px;}
.Logo {background-image: url(../../css/img/logosinfondo.png);
        background-repeat: no-repeat;
    background-size: 96%;
    background-position: 0px 37px;
    height: 200px;}
.vacio{height: 200px;}    
#datos{margin-top: 50%;}  
.containerbar{    margin-bottom: 3%}  
.ResultadosIMM{margin-top: 5%;border: 1px solid #ccc;margin-left: 8%;padding: 4%;}
.ContainerGraphic2{    margin-left: 8%; margin-top: 2%;}

</style>
<html>
<head>
<link href="http://phptopdf.com/bootstrap.css" rel="stylesheet">
<link href="http://getbootstrap.com/examples/dashboard/dashboard.css" rel="stylesheet">
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
    <script src="http://getbootstrap.com/assets/js/docs.min.js"></script>
     
</head>
<body>
	<div class="container-fluid">
		<div class="row">
		<!-- valores escondidos-->
		<input type="hidden" id="fechaPeso" value="<?php echo $fechaPeso?>">
		<input type="hidden" id="fechaPeso2" value="<?php echo $fechaPeso2?>">
        <input type="hidden" id="fechaPeso3" value="<?php echo $fechaPeso3?>">
        <input type="hidden" id="PorcenPeso1" value="<?php echo $PorcenPeso1?>">
        <input type="hidden" id="PorcenPeso2" value="<?php echo $PorcenPeso2?>">
        <input type="hidden" id="PorcenPeso3" value="<?php echo $PorcenPeso3?>">
        <!-- valores de IMC-->
        <input type="hidden" id="fechaImc" value="<?php echo $fechaImc?>">
        <input type="hidden" id="fechaImc2" value="<?php echo $fechaImc2?>">
        <input type="hidden" id="fechaImc3" value="<?php echo $fechaImc3?>">
        <input type="hidden" id="PorcenImc1" value="<?php echo $PorcenImc1?>">
        <input type="hidden" id="PorcenImc2" value="<?php echo $PorcenImc2?>">
        <input type="hidden" id="PorcenImc3" value="<?php echo $PorcenImc3?>">
        <!-- valores de IMM-->
        <input type="hidden" id="Espalda" value="<?php echo $Espalda?>">
        <input type="hidden" id="Pecho" value="<?php echo $Pecho?>">
        <input type="hidden" id="Abdomen" value="<?php echo $Abdomen?>">
        <input type="hidden" id="Cadera" value="<?php echo $Cadera?>">
        <input type="hidden" id="Brazo" value="<?php echo $Brazo?>">
        <input type="hidden" id="Muslo" value="<?php echo $Muslo?>">

        <input type="hidden" id="Espalda2" value="<?php echo $Espalda2?>">
        <input type="hidden" id="Pecho2" value="<?php echo $Pecho2?>">
        <input type="hidden" id="Abdomen2" value="<?php echo $Abdomen2?>">
        <input type="hidden" id="Cadera2" value="<?php echo $Cadera2?>">
        <input type="hidden" id="Brazo2" value="<?php echo $Brazo2?>">
        <input type="hidden" id="Muslo2" value="<?php echo $Muslo2?>">
        
		<!-- fin valores escondidos-->
				
                 
<!-- Peso-->
<div class="col-sm-12  col-xs-12 containerbar pull-right Grafica" id="ContainerBar"> 
 	<div class="col-md-12 Cabecera">
 		<h1 class="text-left">Peso</h1>
 	</div>
 	<div class="col-md-12 Datos">
 		<div class="col-md-3 ResultImg">
 		</div>

 		<div class="col-md-2 Logo pull-right">
 			<div class="col-md-12" id="datos">
 				<h5 class="text-left">Resultados De <strong>Biotest</strong></h5>
                <h5 class="text-left">Biotest: <strong><?php echo $fecha_actual;?></strong></h5>
 			</div>
 		</div>
 		<div class="col-md-8 Consejo">
 			<p class="text-center">
 				<?php echo utf8_decode($ConsejoPeso);?>
 			</p>
 		</div>
 	</div><!-- Datos -->
    <div class="col-md-1"></div>
    <div class="col-md-10 ContainerGraphic" style="border: 1px solid #ccc">
        <div class="col-md-2"></div>
        <div class="col-md-8" id="chart_div"></div>    
    </div><!-- ContainerGraphic -->
    
</div><!--containerbar -->  
				 
  <!-- IMC-->
 <div class="col-sm-12  col-xs-12 containerbar pull-right Grafica" id="ContainerBar"> 
      <div class="col-md-12 Cabecera">
          <h1 class="text-left">IMC</h1>
      </div>
      <div class="col-md-12 Datos">
          <div class="col-md-3 ResultImg">
          </div>
          <div class="col-md-2 vacio pull-right">
              <div class="col-md-12" id="datos">
                  
              </div>
          </div>
          <div class="col-md-8 Consejo">
              <p class="text-center">
                  <?php echo utf8_decode($ConsejoImc);?>
              </p>
          </div>
      </div><!-- Datos -->
      <div class="col-md-1"></div>
      <div class="col-md-10 ContainerGraphic" style="border: 1px solid #ccc">
          <div class="col-md-2"></div>
          <div class="col-md-8" id="chart_imc"></div>    
      </div><!-- ContainerGraphic -->
      
  </div><!--containerbar -->  

 <!-- IMM-->
<div class="col-sm-12  col-xs-12 containerbar pull-right Grafica" id="ContainerBar"> 
    <div class="col-md-12 Cabecera">
        <h1 class="text-left">IMM</h1>
    </div>
    
    <div class="col-md-10 ResultadosIMM">
        <div class="Resultados2 col-sm-4 col-xs-4">
              <!-- Segundos Resultados-->
           <h5 id="Fecha" class="text-center"><?php echo $fechaimm2;?></h5>
            <!--Primeros Resultados -->
            <div class="col-sm-12 col-xs-12 Espalda pull-right">
                <label class="text-center col-sm-12 col-xs-12 ">Espalda: <?php echo $Espalda2;?></label>
             </div>
            <div class="col-sm-12 col-xs-12 Cadera pull-right">
                <label class="text-center col-sm-12 col-xs-12">Pecho: <?php echo $Pecho2; ?></label>
             </div>
            <div class="col-sm-12 col-xs-12 Per_Espalda  pull-right">
                <label class="text-center col-sm-12 col-xs-12">Abdomen: <?php echo $Abdomen2;?></label>
            </div>
            <div class="col-sm-12 col-xs-12 Per_Pecho  pull-right">
                <label class="text-center col-sm-12 col-xs-12 ">Cadera: <?php echo $Cadera2;?></label>
             </div>
            <div class="col-sm-21 col-xs-12 Per_Brazo pull-right">
                <label class="text-center col-sm-12 col-xs-12 right">Brazo: <?php echo $Brazo2;?></label>
             </div>
            <div class="col-sm-12 col-xs-12 Per_Brazo_Fle pull-right">
                <label class="text-center col-sm-12 col-xs-12">Muslo: <?php echo $Muslo2;?></label>
             </div>
        </div><!-- Resultados -->
        
        
        <div class="Resultados col-sm-4 col-xs-4 pull-right">
            <h5 id="text-left" style="margin-left:12%">Resultados</h5>
            <!--Resultados Finales -->
            <div class="col-sm-12 col-xs-12 Espalda pull-right">
                <label class="text-center col-sm-12 col-xs-12 ">Espalda: <?php echo $EspaldaR;?></label>
             </div>
            <div class="col-sm-12 col-xs-12 Cadera pull-right">
                <label class="text-center col-sm-12 col-xs-12">Pecho: <?php echo $PechoR; ?></label>
             </div>
            <div class="col-sm-12 col-xs-12 Per_Espalda  pull-right">
                <label class="text-center col-sm-12 col-xs-12">Abdomen: <?php echo $AbdomenR;?></label>
            </div>
            <div class="col-sm-12 col-xs-12 Per_Pecho  pull-right">
                <label class="text-center col-sm-12 col-xs-12 ">Cadera: <?php echo $CaderaR;?></label>
             </div>
            <div class="col-sm-21 col-xs-12 Per_Brazo pull-right">
                <label class="text-center col-sm-12 col-xs-12 right">Brazo: <?php echo $BrazoR;?></label>
             </div>
            <div class="col-sm-12 col-xs-12 Per_Brazo_Fle pull-right">
                <label class="text-center col-sm-12 col-xs-12">Muslo: <?php echo $MusloR;?></label>
             </div>
        </div><!-- Resultados -->
        
        
        
        <div class="Resultados col-sm-4 col-xs-4 pull-right">
            <h5 id="Fecha" class="text-center"><?php echo $fechaimm;?></h5>
            <!--Primeros Resultados -->
            <div class="col-sm-12 col-xs-12 Espalda pull-right">
                <label class="text-center col-sm-12 col-xs-12 ">Espalda: <?php echo $Espalda;?></label>
             </div>
            <div class="col-sm-12 col-xs-12 Cadera pull-right">
                <label class="text-center col-sm-12 col-xs-12">Pecho: <?php echo $Pecho; ?></label>
             </div>
            <div class="col-sm-12 col-xs-12 Per_Espalda  pull-right">
                <label class="text-center col-sm-12 col-xs-12">Abdomen: <?php echo $Abdomen;?></label>
            </div>
            <div class="col-sm-12 col-xs-12 Per_Pecho  pull-right">
                <label class="text-center col-sm-12 col-xs-12 ">Cadera: <?php echo $Cadera;?></label>
             </div>
            <div class="col-sm-21 col-xs-12 Per_Brazo pull-right">
                <label class="text-center col-sm-12 col-xs-12 right">Brazo: <?php echo $Brazo;?></label>
             </div>
            <div class="col-sm-12 col-xs-12 Per_Brazo_Fle pull-right">
                <label class="text-center col-sm-12 col-xs-12">Muslo: <?php echo $Muslo;?></label>
             </div>
            </div><!-- Resultados-->
    </div><!-- Resultados-->
    <div class="col-md-10 ContainerGraphic2" style="border: 1px solid #ccc">
        <div class="col-md-2"></div>
        <div class="col-md-8" id="chart_imm"></div>    
    </div><!-- ContainerGraphic -->
</div><!--containerbar -->  
                
				 
		</div> <!-- row -->
	</div> <!-- container fluid-->

    
      </body>
	   <script type="text/javascript">
      google.load('visualization', '1.0', {'packages':['corechart']});
      google.setOnLoadCallback(drawChart);

       //Tomando los datos de las fechas
          fechaPeso   = $("#fechaPeso").val();
          fechaPeso2  = $("#fechaPeso2").val();
          fechaPeso3  = $("#fechaPeso3").val();
          PorcenPeso1 = parseInt($("#PorcenPeso1").val());
          PorcenPeso2 = parseInt($("#PorcenPeso2").val());
          PorcenPeso3 = parseInt($("#PorcenPeso3").val());
        // Datos de IMC
        fechaImc   = $("#fechaImc").val();
        fechaImc2  = $("#fechaImc2").val();
        fechaImc3  = $("#fechaImc3").val();
        PorcenImc1 = parseInt($("#PorcenImc1").val());
        PorcenImc2 = parseInt($("#PorcenImc2").val());
        PorcenImc3 = parseInt($("#PorcenImc3").val());
                
        // Datos de IMM
        Espalda = parseInt($("#Espalda").val());
        Pecho   = parseInt($("#Pecho").val());
        Abdomen = parseInt($("#Abdomen").val());
        Cadera  = parseInt($("#Cadera").val());
        Brazo   = parseInt($("#Brazo").val());
        Muslo   = parseInt($("#Muslo").val());

        Espalda2 = parseInt($("#Espalda2").val());
        Pecho2   = parseInt($("#Pecho2").val());
        Abdomen2 = parseInt($("#Abdomen2").val());
        Cadera2  = parseInt($("#Cadera2").val());
        Brazo2   = parseInt($("#Brazo2").val());
        Muslo2   = parseInt($("#Muslo2").val());

        

      function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Porcentaje Peso', { role: 'style' });
        data.addRows([
          [fechaPeso, PorcenPeso1,],
          [fechaPeso2, PorcenPeso2,],
          [fechaPeso3, PorcenPeso3,]
        ]);

        var data2 = new google.visualization.DataTable();
        data2.addColumn('string', 'Topping');
        data2.addColumn('number', 'Porcentaje', { role: 'style' });
        data2.addRows([
          [fechaImc, PorcenImc1,],
          [fechaImc2, PorcenImc2,],
          [fechaImc3, PorcenImc3,]
        ]);

        var data3 = new google.visualization.arrayToDataTable([
          ['Resultados',fechaImc, fechaImc2],
          ['Espalda', Espalda, Espalda2],
          ['Pecho', Pecho, Pecho2],
          ['Abdomen', Abdomen, Abdomen2],
          ['Cadera', Cadera, Cadera2],
          ['Brazo', Brazo,Brazo2],
          ['Muslo', Muslo,Muslo2]
        ]);

        var options  = {'title':'Peso','width':650,'height':480,};
        var options2  = {'title':'IMC','width':650,'height':480,};
        var options3  = {'title':'IMM','width':650,'height':480,};

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
        var chart = new google.visualization.BarChart(document.getElementById('chart_imc'));
        chart.draw(data2, options2);
		var chart = new google.visualization.BarChart(document.getElementById('chart_imm'));
        chart.draw(data3, options3);
            
		
	  
      }
    </script>  
      </html>";

