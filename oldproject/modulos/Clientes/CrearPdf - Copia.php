<?php
include("PdfRutinas.php");
include("../../libs/libs.php");
$id_rutina=$_GET['id_rutina'];


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
$nombre_completo = utf8_decode($nb_nombre." ".$nb_apellidos);		

$datosReporte = array();
for($i=0; $i<$num_rows; $i++)
{
	$fila=$result->fetch_assoc();
	array_push($datosReporte, $fila);	
}

$pdf = new PDF();
 
$pdf->AddPage();

$miCabecera = array( 'Ejercicio', 'Tipo Rutina', 'Dia', 'Circuitos', 'Repeticiones', );
 


$pdf->tablaHorizontal($miCabecera, $datosReporte);
 $nombrepdf=$datosReporte[0]['id_rutinaCliente'].$datosReporte[0]['nb_nombre'].".pdf";
// $pdf->Image('C:/xampp/htdocs/Spinpgym/includes/PDF/logo.jpg',10,8,33);
 
//$pdf->Output(); //Salida al navegador
 $filename="C:/xampp/htdocs/Spinpgym/".$nombrepdf;
$pdf->Output($filename,"F");


//Mandar el PDF al mail

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
$mail->Subject    = "Rutina SpinGym";
$mail->Body    = 'Desde SpinGym queremos que disfrutes tu tiempo aqu&iacute;, para tu comidad te mandamos tu rutina a tu correo. Vive SpinGym';
 $mail->AddAttachment($filename,"Rutina.Pdf");
$mail->WordWrap   = 50;
$mail->AddAddress($de_email, $nombre_completo);
$mail->IsHTML(true); // send as HTML
if(!$mail->Send())
{
echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
	unlink($filename); //Eliminando archivo
	//Redirigir a la página
	$salidaJson=array("id_cliente"=>$id_cliente);
	echo json_encode($salidaJson);
}


?>