<?php
require("phpToPDF.php"); 
include("../../libs/libs.php");
$id_rutina=$_POST['id_rutina'];
$conexion   = new ConexionBean(); //Variable de conexión
$con        = $conexion->_con(); //Variable de conexión

$consultar=new Consultar();
//Consultar los ejercicios de la rutina
$result   = $consultar->_ConsultarInformacionRutinaPreFinalClientePorId($id_rutina);
$num_rows = count($result);

//Consultar información del cliente acorde la rutina
$resultCliente = $consultar->_ConsultarInformacionClientePorRutinaId($id_rutina);


//Datos del cliente
$nb_nombre 	  	 = $resultCliente['nb_cliente'];
$nb_apellidos 	 = $resultCliente['nb_apellidos'];
$de_email	  	 = $resultCliente['de_email'];
$id_cliente		 = $resultCliente['id_cliente'];
$nombre_completo = utf8_decode($nb_nombre." ".$nb_apellidos);		

//Datos del cliente
$nb_nombre 	  	 = $resultCliente['nb_cliente'];
$nb_apellidos 	 = $resultCliente['nb_apellidos'];
$de_email	  	 = $resultCliente['de_email'];
$id_cliente		 = $resultCliente['id_cliente'];

//Fecha actual
date_default_timezone_set("Mexico/General");
$fecha_actual = date("Y-m-d"); //fecha del día de hoy

//Tomando los datos
$ejercicios="";

for($i=0; $i<$num_rows; $i++)
{
	$filaInfo = $result[$i];
	$ejercicios.="
	<tr class=\"text-center\" align=\"center\">
		<td class=\"text-center\">".$filaInfo['num_maquina']."</td>
		<td class=\"text-center\">".$filaInfo['nb_ejercicio']."</td>
		<td class=\"text-center\">".$filaInfo['nb_tiporutina']."</td>
		<td class=\"text-center\">".$filaInfo['nb_dia']."</td>
		<td class=\"text-center\">".$filaInfo['num_circuitos']."</td>
		<td class=\"text-center\">".$filaInfo['num_repeticiones']."</td>
		<td class=\"text-center\">".$filaInfo['ejercicio_relacion']."</td>
	</tr>";
}

// PUT YOUR HTML IN A VARIABLE
$my_html="<html>
  <head>
    <title>Example Report with Page Numbers, Header and Footer - phpToPDF.com</title>
    <link href=\"css/bootstrap.css\" rel=\"stylesheet\">
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
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
  </head>
  <body>


    

    <div class=\"container-fluid  col-md-12 col-xs-12 col-sm-12 \">
      <div class=\"row\">
		  <div class=\"col-sm-12  col-xs-12 col-md-12 containerbar  \" id=\"ContainerBar\"> 
        <div class=\"main col-xs-12 col-sm-12 col-md-12 \">
         <div align=\"center\"> <h1 class=\"page-header \">Rutina Creada en SpinGym</h1></div>

	        </div><!-- main-->
		</div><!--  containerbar -->
      </div><!-- row -->
    </div><!-- container fluid-->

          <div align=\"center\"><h2 class=\"sub-header text-center\">".$nombre_completo."</h2></div>
			<div align=\"center\">  
				<p class=\"text-center\">
					Las letras en el apartado relaci&oacute;n indican los ejercicios 
					que van relacionados y la secuencia.
				</p> 
				<p class=\"text-center\">
					Ejemplo: El A1 y el A2 se hacen en orden A1, despu&eacute;s A2 y as&iacute;. 
					Si no contiene relación es que no va seriado y puede hacerse a decisi&oacute;n propia.
				</p>
			  </div> <!-- div contenedor del texto-->
			  <div class=\"\">
            <table class=\"table table-striped col-xs-12 col-sm-12 col-md-12 \" border= \"1\">
              <thead>
                <tr>
					<th class=\"text-center\">MAQUINA</th>
                	<th class=\"text-center\">EJERCICIO</th>
                 	<th class=\"text-center\">TIPO RUTINA</th>
					<th class=\"text-center\">DIA</th>
					<th class=\"text-center\">CIRCUITOS</th>
					<th class=\"text-center\">REPETICIONES</th>
					<th class=\"text-center\">RELACION</th>
                </tr>
              </thead>
              <tbody>
                ".$ejercicios."
              </tbody>
            </table>
          </div> <!-- div sin clase-->




    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>
    <script src=\"http://getbootstrap.com/dist/js/bootstrap.min.js\"></script>
    <script src=\"http://getbootstrap.com/assets/js/docs.min.js\"></script>
  </body>
</html>
";




// PUT YOUR HTML HEADER IN A VARIABLE
$my_html_header="
<div style=\"display:block; background-color:#f2f2f2; padding:10px; border-bottom:2pt solid #cccccc; color:#6e6e6e; font-size:.85em; font-family:verdana; width:100%\">
  <div style=\"float:left; width:33%; text-align:left;\">
      <img src=\"http://imagizer.imageshack.us/v2/128x32q90/673/NaZt1l.png\">
  </div>
  <div style=\"float:left; width:33%; text-align:center;\">
      Rutina de ejercicios
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
	$nombrepdf=$id_cliente."file".".pdf"; 	//Local
	$filename="C:/xampp/htdocs/Spinpgym/".$nombrepdf; //Local
	//$nombrepdf		 = $id_usuario."ReporteEntrenadores.pdf"; //Host
	//$filename		 = "/home/asherne1/Spinpgym/".$nombrepdf;	  //Host	
$pdf_options = array(
  "source_type" => 'html',
  "source" => $my_html,
  "action" => 'save',
  "save_directory" => '../../pdf',
  "file_name" => $nombrepdf,
  "header" => $my_html_header,
  "footer" => $my_html_footer);
$pdfpath="C:/xampp/htdocs/Spinpgym/pdf/".$nombrepdf;	//Local
//$pdfpath		 = "home/asherne1/Spinpgym/pdf/".$nombrepdf; //Host

// CALL THE phpToPDF FUNCTION WITH THE OPTIONS SET ABOVE
phptopdf($pdf_options);



//Mandar el PDF al mail

require '../../includes/PhpMailer/PHPMailerAutoload.php';
require '../../includes/PhpMailer/class.smtp.php';

$mailFile 		= "/Spinpgym/pdf/".$nombrepdf;
$mail  = new PHPMailer();
$body="<b>This mail is sent using PHP Mailer</b>";#HTML tags can be included
$mail->IsSMTP();
//$mail->SMTPDebug  = 2; 
$mail->Host = "mail.ashernetz.net:2525";  // Servidor de Salida.
$mail->SMTPAuth = true; 
$mail->Username = "ashernetz@ashernetz.net";  // Correo Electrónico
$mail->Password = "Chuvaca800"; // Contraseña
$mail->From = "ashernetz@ashernetz.net";
$mail->FromName = "SpinGym";
$mail->Subject    = "Rutina SpinGym";
$mail->AddAddress("ashernetz@hotmail.com");
//$mail->SMTPDebug  = 2; 
$mail->Body    = 'Desde SpinGym queremos que disfrutes tu tiempo aqu&iacute;, para tu comidad te mandamos tu rutina a tu correo. Vive SpinGym';
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
/*
if(!$mail->Send())
{
	unlink($_SERVER['DOCUMENT_ROOT']."/".$mailFile); //Eliminando archivo
	//Redirigir a la página
	$salidaJson=array("id_cliente"=>$id_cliente);
	echo json_encode($salidaJson);
}
else
{
	//echo "no enviado";
	//unlink($pdfpath); //Eliminando archivo local
	unlink($_SERVER['DOCUMENT_ROOT']."/".$mailFile); //Eliminando archivo host
	//Redirigir a la página
	$salidaJson=array("id_cliente"=>$id_cliente);
	echo json_encode($salidaJson);
}
*/

?>