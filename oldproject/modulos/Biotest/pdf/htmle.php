<?php
session_start();
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
include("../../../libs/libs.php");
$Params 	= $_GET['Params'];
$Parametros = json_decode($Params,true);
$Accion 	= $Parametros['Accion'];

switch($Accion)
{
	//Creando el PDF
	case 'CrearPdf':	
		//Tomando lso datos del Params
		$id_cliente 		= $Parametros['Id_Cliente'];
		$CondicionFisicaVar = $Parametros['CondicionFisicaVar'];
		$PesoVar			= $Parametros['PesoVar'];
		$IMCVar				= $Parametros['IMCVar'];
		$IMMVar				= $Parametros['IMMVar'];
		$StaminaVar			= $Parametros['StaminaVar'];
		$FuerzaVar			= $Parametros['FuerzaVar'];
		$ResistenciaVar		= $Parametros['ResistenciaVar'];
		$FlexibilidadVar 	= $Parametros['FlexibilidadVar'];
		$Folder_Name		= $Parametros['Folder_Name']; 
		
		//Array con todas las variables
		$fotosResultados = array();
		$fotosResultados[0] = $CondicionFisicaVar;
		$fotosResultados[1] = $PesoVar;
		$fotosResultados[2] = $IMCVar;
		$fotosResultados[3] = $IMMVar;
		$fotosResultados[4] = $StaminaVar;
		$fotosResultados[5] = $FuerzaVar;
		$fotosResultados[6] = $ResistenciaVar;
		$fotosResultados[7] = $FlexibilidadVar;
		
		$consultar			=  new Consultar();
		$url_absoluta		= "http://localhost/Spinpgym/Biotest/".$Folder_Name."/";
		//$url_absoluta2		= "C:/xampp/htdocs/Spinpgym/modulos/Biotest/".$Folder_Name; local
		$url_absoluta2		= $_SERVER['DOCUMENT_ROOT']."/"."/Spinpgym/modulos/Biotest/".$Folder_Name;
		//Consultar información del cliente por ID
		$resultCliente = $consultar->_ConsultarClientesPorId($id_cliente);
		$filaCliente   = $resultCliente->fetch_assoc();
		
		//Datos del cliente
		$nb_nombre 	  	 = $filaCliente['nb_cliente'];
		$nb_apellidos 	 = $filaCliente['nb_apellidos'];
		$de_email	  	 = $filaCliente['de_email'];
		$id_cliente		 = $filaCliente['id_cliente'];
		$nombre_completo = ($nb_nombre." ".$nb_apellidos);	
		$pdf_name		 = $id_cliente."file.pdf";
		$_SESSION['NombreCompleto'] = $nombre_completo;
		
		//Función para borrar la carpeta con todos los archivos
		function Delete($path)
		{
			if (is_dir($path) === true)
			{
				$files = array_diff(scandir($path), array('.', '..'));
			
			foreach ($files as $file)
			{
				Delete(realpath($path) . '/' . $file);
			}
			
			return rmdir($path);
			}
			
			else if (is_file($path) === true)
			{
				return unlink($path);
			}
			
			return false;
		}
		
		// Extend the TCPDF class to create custom Header and Footer
		class MYPDF extends TCPDF {
		
		//Page header
		public function Header() {
		// Logo
		
		$this->Rect(0, 0, 2000, 20,'F',array(),array(249, 249, 249));
		$image_file = K_PATH_IMAGES.'logopdf.png';
		$this->Image($image_file, 8, 7, 35, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('helvetica', 'B', 20);
		// Title
		$this->Cell(0, 30, 'Resultados Biotest', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		}
		
		// Page footer
		public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
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
		$pdf->SetFont('times', 'BI', 12);
		
		// add a page
		$pdf->AddPage();
		// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
		// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
		
		// create some HTML content
		$html = '
		<h1 style="text-align:center;">Resultado Biotest</h1>
		<h2 style="text-align:center;">'.$_SESSION['NombreCompleto'].'</h2>	
		<div style="text-align:center"><h2>Resultados</h2><br /><br>
		<div style="text-align:center"><h3>Condicion Fisica</h3>
		<img src="../'.$Folder_Name.'/'.$CondicionFisicaVar.'" alt="test alt attribute" width="300" height="170" border="0" />
		<div style="text-align:center"><h3>Peso</h3>
		<img src="../'.$Folder_Name.'/'.$PesoVar.'" alt="test alt attribute" width="300" height="170" border="0" />
		
		<div style="text-align:center"><h3>IMC</h3>
		<img src="../'.$Folder_Name.'/'.$IMCVar.'" alt="test alt attribute" width="300" height="170" border="0" />
		<h2> </h2><br>
		<div style="text-align:center"><h3>Stamina</h3><br />
		<img src="../'.$Folder_Name.'/'.$StaminaVar.'" alt="test alt attribute" width="300" height="170" border="0" />
		<h2> </h2><br>
		<div style="text-align:center"><h3>Fuerza</h3><br />
		<img src="../'.$Folder_Name.'/'.$FuerzaVar.'" alt="test alt attribute" width="300" height="170" border="0" />
		<h2> </h2><br>
		<div style="text-align:center"><h3>Resistencia</h3><br />
		<img src="../'.$Folder_Name.'/'.$ResistenciaVar.'" alt="test alt attribute" width="300" height="170" border="0" />
		<h2> </h2><br>
		<div style="text-align:center"><h3>Flexibilidad</h3><br />
		<img src="../'.$Folder_Name.'/'.$FlexibilidadVar.'" alt="test alt attribute" width="300" height="170" border="0" />
		<h2> </h2><br>
		<div style="text-align:center"><h3>IMM</h3><br />
		<img src="../'.$Folder_Name.'/'.$IMMVar.'" alt="test alt attribute" width="700" height="400" border="0" />
		
		</div>';
		
		// output the HTML content
		$pdf->writeHTML($html, $linebreak = true, $fill = false, $reseth = true, $cell = false, $align = '');
		
		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		// test pre tag
		
		$pdf->lastPage();
		
		// ---------------------------------------------------------
		
		//Close and output PDF document
		$pdf->Output($pdf_name, 'F');
		
		//Eliminando la carpeta
		Delete($url_absoluta2);
		$salidaJson=array("pdf_name"=>$pdf_name, "de_email"=>$de_email, "nombre_completo"=>$nombre_completo);
	echo json_encode($salidaJson);
	break;
	
	case 'EnviarResultados':
		
		//tomar los datos para el mailing
		$pdf_name		 = $Parametros['pdf_name'];
		$de_email 		 = $Parametros['de_email'];
		$nombre_completo = $Parametros['nombre_completo'];
			
		//Enviando por correo los resultados
		$pdfpath = "/Spinpgym/modulos/Biotest/pdf/".$pdf_name;
		require '../../../includes/PhpMailer/PHPMailerAutoload.php';
		require '../../../includes/PhpMailer/class.smtp.php';
		$mail  = new PHPMailer();
		/*$body="<b>This mail is sent using PHP Mailer</b>";#HTML tags can be included
		$mail->IsSMTP();
		$mail->SMTPAuth  = true;                 #enable SMTP authentication
		$mail->SMTPSecure = "ssl";               #sets the prefix to the server
		$mail->Host  = "smtp.gmail.com";         #sets GMAIL as the SMTP server
		$mail->Port       = 465;                 #set the SMTP port
		$mail->Username   = "ashernetz@gmail.com";                  #your gmail username
		$mail->Password   = "corridorsoftime5";                  #Your gmail password
		$mail->From       = "ashernetz";                  #your gmail id
		$mail->FromName   = "SpinGym";                  #your name
		$mail->Subject    = "Resultados SpinGym";
		$mail->Body    = 'Desde SpinGym queremos que disfrutes tu tiempo aqu&iacute;, para tu comodidad te mandamos tus resultados a tu correo. Vive SpinGym';
		$mail->AddAttachment($pdfpath,"Resultados.Pdf");
		$mail->WordWrap   = 50;
		$mail->AddAddress($de_email, $nombre_completo);
		$mail->IsHTML(true); // send as HTML*/
		
		//$mail->Timeout = 3600;  //Agregado por que daba timeout error 
	 $mail->IsSMTP(); 
	// $mail->SMTPDebug  = 2; 
    $mail->Host = "mail.ashernetz.net:2525";  // Servidor de Salida.
    $mail->SMTPAuth = true; 
    $mail->Username = "ashernetz@ashernetz.net";  // Correo Electrónico
    $mail->Password = "Chuvaca800"; // Contraseña
	$mail->From = "ashernetz@ashernetz.net";
	$mail->FromName = "SpinGym";
	$mail->Subject    = "Resultado Biotest";
	$mail->AddAddress($de_email);
	//$mail->SMTPDebug  = 2; 
	$mail->Body    = 'Desde SpinGym queremos que disfrutes tu tiempo aqu&iacute;, para tu comidad te mandamos tus resultados a tu correo. Vive SpinGym';
	$mail->AddAttachment($_SERVER['DOCUMENT_ROOT']."/".$pdfpath,"ResultadosBiotest.Pdf");
	$mail->WordWrap   = 50;
	$mail->AddAddress($de_email, "SpinGym"); //Mail del cliente
	$mail->IsHTML(true); // send as HTML
		if(!$mail->Send())
		{
		echo "Mailer Error: " . $mail->ErrorInfo;
		}
		else
		{
			//unlink($pdfpath); local
			unlink($_SERVER['DOCUMENT_ROOT']."/".$pdfpath);
			$salidaJson=array("Enviado"=>"Enviado");
			echo json_encode($salidaJson);
		}
	break;
}




//============================================================+
// END OF FILE
//============================================================+