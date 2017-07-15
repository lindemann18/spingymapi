<?php
require("phpToPDF.php"); 
include("../../libs/libs.php");

$consultar=new Consultar();
//Consultar la información de los entrenadores
$result   = $consultar->_ReporteCantidadBiotestClientes();
$num_rows = $result->num_rows;

date_default_timezone_set("Mexico/General");
$fecha_actual = date("Y-m-d"); //fecha del día de hoy

//Tomando los datos
$ejercicios="";

for($i=0; $i<$num_rows; $i++)
{
	$filaInfo = $result->fetch_assoc();
	$ejercicios.='
	<tr>
		<td>'.$filaInfo['id_cliente'].'</td>
		<td class="">'.$filaInfo['Cliente_nombre'].'</td>
		<td>'.$filaInfo['Cliente_Apellidos'].'</td>
		<td class="text-center">'.$filaInfo['Cantidad_Biotest'].'</td>
		<td class="text-center">'.$filaInfo['Entrenador_nombre']." ".$filaInfo['Entrenador_Apellidos'].'</td>
		
	</tr>';
}

if(isset($_GET['Mail']))
{
	session_start();
	$id_usuario = $_SESSION['Sesion']['id_usuario'];
	$mail 		= $_GET['Mail'];	
}//iff
else {$mail = 0;}

// PUT YOUR HTML IN A VARIABLE
$my_html="<html>
  <head>
    <title>Example Report with Page Numbers, Header and Footer - phpToPDF.com</title>
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


    

    <div class=\"container-fluid\">
      <div class=\"row\">

        <div class=\"main\">
          <h1 class=\"page-header text-center\">Reporte Creado en SpinGym</h1>



          <h2 class=\"sub-header text-center\">Clientes Y Biotest</h2>
          <div class=\"\">
            <table class=\"table table-striped\">
              <thead>
                <tr>
					<th>CODIGO</th>
					<th>NOMBRE</th>
					<th>APELLIDOS</th>
					<th  class='sorting_desc'>BIOTEST</th>
					<th>ENTRENADOR</th>
                </tr>
              </thead>
              <tbody>
                ".$ejercicios."
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>



    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>
    <script src=\"http://getbootstrap.com/dist/js/bootstrap.min.js\"></script>
    <script src=\"http://getbootstrap.com/assets/js/docs.min.js\"></script>
  </body>
</html>
";




// PUT YOUR HTML HEADER IN A VARIABLE
$my_html_header="
<div style=\"display:block; background-color:#f2f2f2; padding:10px; border-bottom:2pt solid #cccccc; color:#6e6e6e; font-size:.85em; font-family:verdana;\">
  <div style=\"float:left; width:33%; text-align:left;\">
      <img src=\"http://imagizer.imageshack.us/v2/128x32q90/673/NaZt1l.png\">
  </div>
  <div style=\"float:left; width:33%; text-align:center;\">
    	Reporte de Clientes
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
if($mail == 0)
{
	$nombrepdf    	 = "ReporteClientes.pdf";
	$filename    	 = "C:/xampp/htdocs/Spinpgym/".$nombrepdf;
	$pdf_options 	 = array(
	"source_type"	 => 'html',
	"source" 	   	 => $my_html,
	"action" 	     => 'view',
	"save_directory" => '../../pdf',
	"file_name"		 => $nombrepdf,
	"header" 	     => $my_html_header,
	"footer"		 => $my_html_footer);
	$pdfpath		 = "C:/xampp/htdocs/Spinpgym/pdf/".$nombrepdf;
	phptopdf($pdf_options);
}
else
{
	//Creando el pdf
	$nombrepdf		 = $id_usuario."ReporteClientes.pdf";
	$filename		 = "C:/xampp/htdocs/Spinpgym/".$nombrepdf;
	$pdf_options	 = array(
	"source_type"	 => 'html',
	"source"		 => $my_html,
	"action" 		 => 'save',
	"save_directory" => '../../pdf',
	"file_name"		 => $nombrepdf,
	"header"		 => $my_html_header,
	"footer"		 => $my_html_footer);
	$pdfpath		 = "C:/xampp/htdocs/Spinpgym/pdf/".$nombrepdf;
	phptopdf($pdf_options);
	
	//Mandando por maill
	require '../../includes/PhpMailer/PHPMailerAutoload.php';
	require '../../includes/PhpMailer/class.smtp.php';
	$mail  = new PHPMailer();
	$body="<b>This mail is sent using PHP Mailer</b>";#HTML tags can be included
	$mail->IsSMTP();
	$mail->SMTPAuth  = true;                 #enable SMTP authentication
	$mail->SMTPSecure = "ssl";               #sets the prefix to the server
	$mail->Host  = "smtp.gmail.com";         #sets GMAIL as the SMTP server
	$mail->Port       = 465;                 #set the SMTP port
	$mail->Username   = "ashernetz@gmail.com";                  #your gmail username
	$mail->Password   = "corridorsoftime5";                  #Your gmail password
	$mail->From       = "ashernetz";                  #your gmail id
	$mail->FromName   = "SpinGym";                  #your name
	$mail->Subject    = "Reporte Clientes SpinGym";
	$mail->Body    = 'Desde SpinGym queremos que disfrutes tu tiempo aqu&iacute;, para tu comidad te mandamos tu rutina a tu correo. Vive SpinGym';
	$mail->AddAttachment($pdfpath,"ReporteClientes.Pdf");
	$mail->WordWrap   = 50;
	$mail->AddAddress("Ashernetz@hotmail.com", "SpinGym");
	$mail->IsHTML(true); // send as HTML
	if(!$mail->Send())
	{
	echo "Mailer Error: " . $mail->ErrorInfo;
	}
	else
	{
		unlink($pdfpath); //Eliminando archivo
		//Redirigir a la página
		$salidaJson=array("id_usuario"=>$id_usuario);
		echo json_encode($salidaJson);
	}
}
// CALL THE phpToPDF FUNCTION WITH THE OPTIONS SET ABOVE

 
//$pdf->Output(); //Salida al navegador
 //$filename="C:/xampp/htdocs/Spinpgym/".$nombrepdf;
//$pdf->Output($filename,"F");





?>