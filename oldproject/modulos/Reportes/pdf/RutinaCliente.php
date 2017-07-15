<?php
	include("../../../libs/libs.php");
	$consultar = new Consultar();
	require_once('tcpdf_include.php');
	
	$id_rutina = $_GET['id_rutina'];
	
	
	
	$consultar=new Consultar();
	//Consultar los ejercicios de la rutina
	$result   = $consultar->_ConsultarInformacionRutinaPreFinalClientePorId($id_rutina);
	$num_rows = $result->num_rows;
	
	//Consultar información del cliente acorde la rutina
	$resultCliente = $consultar->_ConsultarInformacionClientePorRutinaId($id_rutina);
	$filaCliente   = $resultCliente->fetch_assoc();
	
	//Datos del cliente
	$nb_nombre 	  	 = $filaCliente['nb_cliente'];
	$nb_apellidos 	 = $filaCliente['nb_apellidos'];
	$de_email	  	 = $filaCliente['de_email'];
	$id_cliente		 = $filaCliente['id_cliente'];
	$nombre_completo = ($nb_nombre." ".$nb_apellidos);		
	
	//Fecha actual
	date_default_timezone_set("Mexico/General");
	$fecha_actual = date("Y-m-d"); //fecha del día de hoy
				
				
	//Tomando los datos
	$ejercicios="";
	
	for($i=0; $i<$num_rows; $i++)
	{
		$filaInfo = $result->fetch_assoc();
		$ejercicios.="
		<tr class=\"text-center\" align=\"center\">
			<td class=\"text-center\">".$filaInfo['num_maquina']."</td>
			<td class=\"text-center\">".$filaInfo['nb_ejercicio']."</td>
			<td class=\"text-center\">".$filaInfo['nb_TipoRutina']."</td>
			<td class=\"text-center\">".$filaInfo['nb_dia']."</td>
			<td class=\"text-center\">".$filaInfo['num_Circuitos']."</td>
			<td class=\"text-center\">".$filaInfo['num_Repeticiones']."</td>
			<td class=\"text-center\">".$filaInfo['ejercicio_relacion']."</td>
		</tr>";
	}//for				
	
	// Extend the TCPDF class to create custom Header and Footer
		class MYPDF extends TCPDF {
		
		//Page header
		public function Header() {
		// Logo
		
		$this->Rect(0, 0, 2000, 20,'F',array(),array(242, 242, 242));
		$image_file = K_PATH_IMAGES.'logopdf.png';
		$this->Image($image_file, 8, 7, 35, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('helvetica', 'B', 20);
		// Title
		date_default_timezone_set("Mexico/General");
	$fecha_actual = date("Y-m-d"); //fecha del día de hoy
		$this->Cell(0, 30, 'Rutina SpinGym', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		}
		
		// Page footer
		public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		}
		}
		
		// create new PDF document
		$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('TCPDF Example 003');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		
		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		
		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		require_once(dirname(__FILE__).'/lang/eng.php');
		$pdf->setLanguageArray($l);
		}
		
		// ---------------------------------------------------------
		
		// set font
		$pdf->SetFont('helvetica', 'BI', 12);
		
		// add a page
		$pdf->AddPage();
		// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
		// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
		
		// create some HTML content
		$html = '
		
			<style>
				table {border-collapse: collapse;border-spacing: 0;}
				table {max-width: 100%; background-color: #e7e8ea;}
				thead {display: table-header-group;}
			  	tr,img {page-break-inside: avoid;}
				th {text-align: left;}
				.table {width: 100%;margin-bottom: 20px;}
					
					.table > thead > tr > th,
					.table > tbody > tr > th,
					.table > tfoot > tr > th,
					.table > thead > tr > td,
					.table > tbody > tr > td,
					.table > tfoot > tr > td {
					  padding: 8px;
					  line-height: 1.428571429;
					  vertical-align: top;
					 
					}
					
					.table > thead > tr > th {
					  vertical-align: bottom;
					
					}
					
					.table > caption + thead > tr:first-child > th,
					.table > colgroup + thead > tr:first-child > th,
					.table > thead:first-child > tr:first-child > th,
					.table > caption + thead > tr:first-child > td,
					.table > colgroup + thead > tr:first-child > td,
					.table > thead:first-child > tr:first-child > td {
					  border-top: 0;
					}
					
					.table > tbody + tbody {
					
					}
					
					.table .table {
					 
					}
					
					.table-condensed > thead > tr > th,
					.table-condensed > tbody > tr > th,
					.table-condensed > tfoot > tr > th,
					.table-condensed > thead > tr > td,
					.table-condensed > tbody > tr > td,
					.table-condensed > tfoot > tr > td {
					  padding: 5px;
					}
					
					.table-bordered {
					 
					}
					
					.table-bordered > thead > tr > th,
					.table-bordered > tbody > tr > th,
					.table-bordered > tfoot > tr > th,
					.table-bordered > thead > tr > td,
					.table-bordered > tbody > tr > td,
					.table-bordered > tfoot > tr > td {
					  border: 1px solid #dddddd;
					}
					
					.table-bordered > thead > tr > th,
					.table-bordered > thead > tr > td {
					  border-bottom-width: 2px;
					}
					
					/*
					.table-striped > tbody > tr:nth-child(odd) > td,
					.table-striped > tbody > tr:nth-child(odd) > th {
					 
					}
					*/
					
					.table-hover > tbody > tr:hover > td,
					.table-hover > tbody > tr:hover > th {
					 
					}
					
					table col[class*="col-"] {
					  position: static;
					  display: table-column;
					  float: none;
					}
					
					table td[class*="col-"],
					table th[class*="col-"] {
					  display: table-cell;
					  float: none;
					}
					
					.table > thead > tr > .active,
					.table > tbody > tr > .active,
					.table > tfoot > tr > .active,
					.table > thead > .active > td,
					.table > tbody > .active > td,
					.table > tfoot > .active > td,
					.table > thead > .active > th,
					.table > tbody > .active > th,
					.table > tfoot > .active > th {
					 
					}
					
					.table-hover > tbody > tr > .active:hover,
					.table-hover > tbody > .active:hover > td,
					.table-hover > tbody > .active:hover > th {
					  
					}
					
					.table > thead > tr > .success,
					.table > tbody > tr > .success,
					.table > tfoot > tr > .success,
					.table > thead > .success > td,
					.table > tbody > .success > td,
					.table > tfoot > .success > td,
					.table > thead > .success > th,
					.table > tbody > .success > th,
					.table > tfoot > .success > th {
					  
					}
					
					.table-hover > tbody > tr > .success:hover,
					.table-hover > tbody > .success:hover > td,
					.table-hover > tbody > .success:hover > th {
					  
					}
					
					.table > thead > tr > .danger,
					.table > tbody > tr > .danger,
					.table > tfoot > tr > .danger,
					.table > thead > .danger > td,
					.table > tbody > .danger > td,
					.table > tfoot > .danger > td,
					.table > thead > .danger > th,
					.table > tbody > .danger > th,
					.table > tfoot > .danger > th {
					 
					}
					
					.table-hover > tbody > tr > .danger:hover,
					.table-hover > tbody > .danger:hover > td,
					.table-hover > tbody > .danger:hover > th {
					 
					}
					
					.table > thead > tr > .warning,
					.table > tbody > tr > .warning,
					.table > tfoot > tr > .warning,
					.table > thead > .warning > td,
					.table > tbody > .warning > td,
					.table > tfoot > .warning > td,
					.table > thead > .warning > th,
					.table > tbody > .warning > th,
					.table > tfoot > .warning > th {
					  
					}
					
					.table-hover > tbody > tr > .warning:hover,
					.table-hover > tbody > .warning:hover > td,
					.table-hover > tbody > .warning:hover > th {
					 
					}
				.text-center{text-align:center;}
			</style>

			<div style="width:100%">
				<h1 style="text-align:center;">'.$nombre_completo.'</h1>
				<h3 style="text-align:center;">Fecha: '.$fecha_actual.'</h3>
				<p>Desde <strong>SPINGYM</strong> deseamos que disfrutes tu tiempo aquí, por eso te mandamos tu rutina. 
				   Recuerda que las rutinas seguidas debidamente tienen un lapso de duración máximo de 1 mes.
				   Renueva frecuente tu rutina con tu entrenador favorito.
				</p>
				<p>
					La relación indica el orden de ejecución de los ejercicios, recuerda seguirlos como te los ha asignado tu
					entrenador para un mejor resultado.
				</p>
				<h3 style="text-align:center; color:#cd2027;">Vive Spin Gym!</h3>
			</div>
				
			
			<body style="width:1024px; font-size:15px">
					<div style="width:1000px">
					<table class=\"table table-striped \" width="100%" cellspacing="0" cellpadding="55%" style="border: 1px solid #ddd;font-size: 11.5px" border="1"> 
				  <thead>
					<tr width="100%" >
						<th align="center" >MAQUINA</th>
						<th align="center">EJERCICIO</th>
						<th align="center">TIPO RUTINA</th>
						<th align="center">DIA</th>
						<th align="center">CIRCUITOS</th>
						<th align="center">REPETICIONES</th>
						<th align="center">RELACION</th>
					</tr>
				  </thead>
				  <tbody>
						'.$ejercicios.'
				  </tbody>
				</table>
				</div>
			</body>
		';
				

		// output the HTML content
		$pdf->writeHTML($html, $linebreak = true, $fill = false, $reseth = true, $cell = false, $align = '');
		
		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		// test pre tag
		
		$pdf->lastPage();
		
		// ---------------------------------------------------------
		
		//Close and output PDF document
		//Datos del pdf, nombre, ubicación y demás.

		$nombrepdf = $id_cliente."file".".pdf"; 	//Local
		$pdf->Output("../../../pdf/".$nombrepdf, 'F');
	require '../../../includes/PhpMailer/PHPMailerAutoload.php';
require '../../../includes/PhpMailer/class.smtp.php';

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
	
?>


