<?php
include("../../libs/libs.php");
require_once('tcpdf_include.php');
$consultar=new Consultar();
if(isset($_POST['codigo']))
{
	$codigo=$_POST['codigo'];
	$result=$consultar->_ConsultarInfoInstitucionPorcodigo($codigo);
	$fila=mysql_fetch_array($result);
	//print_r($fila);
	$num=mysql_num_rows($result);
	$nombre=utf8_encode(rawurldecode($fila['nb_institucion']));	
	$contacto=utf8_decode(rawurldecode($fila['nb_contacto']));
	$pais=$fila['nb_pais'];
	$mail=$fila['de_mail'];
	$tipo=rawurldecode($fila['de_tipo']);
	$pais=$fila['nb_pais'];
	$cargo=utf8_encode(rawurldecode($fila['de_cargo']));	
	$imagen="";
/*		if(file_exists ($fila['url_logo'])==false)
	{
		$imagen="";
	}
	if($fila['url_logo']!="img/instituciones/")
	{
		$imagen="../../../".$fila['url_logo'];
	}
	else{
	$imagen="";
	}*/
	
}


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Chuvacoso');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

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

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = <<<EOD
<h2 style="text-align:center">Institution: </h2>
<i style="text-align:center">Name: $nombre </i> <br>
<i style="text-align:center">Country: $pais</i><br>
<i style="text-align:center">character: $tipo</i><br>
<i style="text-align:center">Email: $mail</i><br>
<i style="text-align:center">contact name: $contacto</i><br>
<i style="text-align:center">position: $cargo</i><br>
<i style="text-align:center"><img  src="$imagen" style=""></i>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
