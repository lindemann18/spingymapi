<?php
	include("../../../libs/libs.php");
	require '../../../includes/PhpMailer/PHPMailerAutoload.php';
	require '../../../includes/PhpMailer/class.smtp.php';
	$conexion   = new ConexionBean(); //Variable de conexión
	$con        = $conexion->_con(); //Variable de conexión
	require_once('tcpdf_include.php');
	
	$id_cliente = $_POST['id_cliente'];

	// Consultando el id de la rutina por el cliente.
	$rutina    = R::findOne("sgrutinasclientes","id_cliente= ?",[$id_cliente]);
	$id_rutina = $rutina->id;
	
	$consultar=new Consultar();

	//Consultar los ejercicios de la rutina
	$result   = $consultar->_ConsultarInformacionRutinaPreFinalClientePorId($id_rutina);
	$num_rows = count($result);
	
	//Consultar información del cliente
	$cliente = R::findOne("sgclientes","WHERE id = ?",[$id_cliente]);
	
	
	
	//Datos del cliente
	$nb_nombre 	  	 = $cliente->nb_cliente;
	$nb_apellidos 	 = $cliente->nb_apellidos;
	$de_email	  	 = $cliente->de_email;
	$id_cliente		 = $cliente->id_cliente;
	$nombre_completo = ($nb_nombre." ".$nb_apellidos);		
	
	//Fecha actual
	date_default_timezone_set("Mexico/General");
	$fecha_actual = date("Y-m-d"); //fecha del día de hoy

	// Contenedores de los ejercicios de los días
	$lunes	   = array();
	$martes    = array();
	$miercoles = array();
	$jueves    = array();
	$viernes   = array();
	$sabado	   = array();
	$domingo   = array();				
				
	//Tomando los datos
	$ejercicios="";
	
	for($i=0; $i<$num_rows; $i++)
	{
		$filaInfo = $result[$i];
		
		// insertando al respectivo array
		switch($filaInfo['id_dia'])
		{
			case 1:
				array_push($lunes,$filaInfo);
			break;
			case 2:
				array_push($martes,$filaInfo);
			break;
			case 3:
				array_push($miercoles,$filaInfo);
			break;
			case 4:
				array_push($jueves,$filaInfo);
			break;
			case 5:
				array_push($viernes,$filaInfo);
			break;
			case 6:
				array_push($sabado,$filaInfo);
			break;
			case 7:
				array_push($domingo,$filaInfo);
			break;
		}//switch
	}//for				
	

	//Creando los agregados de cada día
	$can_lunes = count($lunes);
	$lun_content = "";
	$mar_content = "";
	$mie_content = "";
	$jue_content = "";
	$vie_content = "";
	$sab_content = "";
	$dom_content = "";

	foreach ($lunes as $lun) {
		$lun_content.= "
		<tr class=\"text-center\" align=\"center\">
			<td class=\"text-center\">".$lun['num_maquina']."</td>
			<td class=\"text-center\">".$lun['nb_ejercicio']."</td>
			<td class=\"text-center\">".$lun['num_circuitos']."</td>
			<td class=\"text-center\">".$lun['num_repeticiones']."</td>
		</tr>";
	}

	foreach ($martes as $mar) {
		$mar_content.= "
		<tr class=\"text-center\" align=\"center\">
			<td class=\"text-center\">".$mar['num_maquina']."</td>
			<td class=\"text-center\">".$mar['nb_ejercicio']."</td>
			<td class=\"text-center\">".$mar['num_circuitos']."</td>
			<td class=\"text-center\">".$mar['num_repeticiones']."</td>
		</tr>";
	}

	foreach ($miercoles as $mie) {
		$mie_content.= "
		<tr class=\"text-center\" align=\"center\">
			<td class=\"text-center\">".$mie['num_maquina']."</td>
			<td class=\"text-center\">".$mie['nb_ejercicio']."</td>
			<td class=\"text-center\">".$mie['num_circuitos']."</td>
			<td class=\"text-center\">".$mie['num_repeticiones']."</td>
		</tr>";
	}

	foreach ($jueves as $jue) {
		$jue_content.= "
		<tr class=\"text-center\" align=\"center\">
			<td class=\"text-center\">".$jue['num_maquina']."</td>
			<td class=\"text-center\">".$jue['nb_ejercicio']."</td>
			<td class=\"text-center\">".$jue['num_circuitos']."</td>
			<td class=\"text-center\">".$jue['num_repeticiones']."</td>
		</tr>";
	}

	foreach ($viernes as $vie) {
		$vie_content.= "
		<tr class=\"text-center\" align=\"center\">
			<td class=\"text-center\">".$vie['num_maquina']."</td>
			<td class=\"text-center\">".$vie['nb_ejercicio']."</td>
			<td class=\"text-center\">".$vie['num_circuitos']."</td>
			<td class=\"text-center\">".$vie['num_repeticiones']."</td>
		</tr>";
	}

	foreach ($sabado as $sab) {
		$sab_content.= "
		<tr class=\"text-center\" align=\"center\">
			<td class=\"text-center\">".$sab['num_maquina']."</td>
			<td class=\"text-center\">".$sab['nb_ejercicio']."</td>
			<td class=\"text-center\">".$sab['num_circuitos']."</td>
			<td class=\"text-center\">".$sab['num_repeticiones']."</td>
		</tr>";
	}

	foreach ($domingo as $dom) {
		$dom_content.= "
		<tr class=\"text-center\" align=\"center\">
			<td class=\"text-center\">".$dom['num_maquina']."</td>
			<td class=\"text-center\">".$dom['nb_ejercicio']."</td>
			<td class=\"text-center\">".$dom['num_circuitos']."</td>
			<td class=\"text-center\">".$dom['num_repeticiones']."</td>
		</tr>";
	}


	// Extend the TCPDF class to create custom Header and Footer
		class MYPDF extends TCPDF {
		
		//Page header
		public function Header() {
		// Logo
		
		$this->Rect(0, 0, 2000, 20,'F',array(),array(242, 242, 242));
		$image_file = K_PATH_IMAGES.'logopdf.png';
		$this->Image($image_file, 8, 7, 35, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont("century", '', 14, '', false);
		//$this->SetFont('helvetica', 'B', 20);
		// Title
		date_default_timezone_set("Mexico/General");
	$fecha_actual = date("Y-m-d"); //fecha del día de hoy
		$this->Cell(0, 60, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		}
		
		// Page footer
		public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		
		//$this->SetFont($fontname, 'I', 8);
		
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
		$pdf->SetFont("century", '', 14, '', false);
		//$pdf->SetFont('helvetica', 'BI', 12);
		
		// add a page
		$pdf->AddPage();
		// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
		// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
		
		// create some HTML content
		$html = '
		
			<style>
				.dia{text-align:left; background-color:#D14841; color:#fff; height:100px; margin-bottom:80px !important; padding:20px;}
				table {border-collapse: collapse;border-spacing: 0;}
				table {max-width: 100%; background-color: #e7e8ea;background-color: #fff; color:#9E9E9E;}
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

			<div style="width:100%;">
				<h1 style="text-align:center;">'.$nombre_completo.'</h1>
				<h3 style="text-align:center;">Fecha: '.$fecha_actual.'</h3>
				<p>Desde <strong>SPINGYM</strong> deseamos que disfrutes tu tiempo aquí, por eso te mandamos tu rutina. 
				   Recuerda que las rutinas seguidas debidamente tienen un lapso de duración máximo de 1 mes.
				   Renueva frecuente tu rutina con tu entrenador favorito.
				</p>
				<h3 style="text-align:center; color:#cd2027;">#vivespingym</h3>
			</div>
				
			
			<body style="width:1024px; font-size:15px">
				<div align="center" style="width: 600px;" id="lunes">
					<h3 class="dia">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lunes</h3>
					<div></div>
					<div style="width:1000px; ">
						<table class=\"table table-striped \" width="100%" cellspacing="0" cellpadding="55%" style="font-size: 11.5px; margin-top:25px !important;" border="0"> 
						  <thead>
							<tr width="100%" >
								<th align="center" >MAQUINA</th>
								<th align="center">EJERCICIO</th>
								<th align="center">CIRCUITOS</th>
								<th align="center">REPETICIONES</th>
							</tr>
						  </thead>
						  <tbody>
								'.$lun_content.'
						  </tbody>
						</table>
					</div>
				</div><!-- Lunes -->
				
				<br>

				<div align="center" style="width: 600px;" id="Martes">
					<h3 class="dia">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Martes</h3>
					<div></div>
					<div style="width:800px">
						<table class=\"table table-striped \" width="100%" cellspacing="0" cellpadding="55%" style="font-size: 11.5px" border="0"> 
						  <thead>
							<tr width="100%" >
								<th align="center" >MAQUINA</th>
								<th align="center">EJERCICIO</th>
								<th align="center">CIRCUITOS</th>
								<th align="center">REPETICIONES</th>
							</tr>
						  </thead>
						  <tbody>
								'.$mar_content.'
						  </tbody>
						</table>
					</div>
				</div><!-- Martes -->
				

				<div align="center" style="width: 600px;" id="Miercoles">
					<h3 class="dia">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Miercoles</h3>
					<div></div>
					<div style="width:1000px;">
						<table class=\"table table-striped \" width="100%" cellspacing="0" cellpadding="55%" style="font-size: 11.5px" border="0"> 
						  <thead>
							<tr width="100%" >
								<th align="center" >MAQUINA</th>
								<th align="center">EJERCICIO</th>
								<th align="center">CIRCUITOS</th>
								<th align="center">REPETICIONES</th>
							</tr>
						  </thead>
						  <tbody>
								'.$mie_content.'
						  </tbody>
						</table>
					</div>
				</div><!-- Miercoles -->

				<div align="center" style="width: 600px;" id="Jueves">
					<h3 class="dia">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jueves</h3>
					<div></div>
					<div style="width:1000px;">
						<table class=\"table table-striped \" width="100%" cellspacing="0" cellpadding="55%" style="font-size: 11.5px" border="0"> 
						  <thead>
							<tr width="100%" >
								<th align="center" >MAQUINA</th>
								<th align="center">EJERCICIO</th>
								<th align="center">CIRCUITOS</th>
								<th align="center">REPETICIONES</th>
							</tr>
						  </thead>
						  <tbody>
								'.$jue_content.'
						  </tbody>
						</table>
					</div>
				</div><!-- Jueves -->

				<div align="center" style="width: 600px;" id="Viernes">
					<h3 class="dia">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Viernes</h3>
					<div></div>
					<div style="width:1000px;">
						<table class=\"table table-striped \" width="100%" cellspacing="0" cellpadding="55%" style="font-size: 11.5px" border="0"> 
						  <thead>
							<tr width="100%" >
								<th align="center" >MAQUINA</th>
								<th align="center">EJERCICIO</th>
								<th align="center">CIRCUITOS</th>
								<th align="center">REPETICIONES</th>
							</tr>
						  </thead>
						  <tbody>
								'.$vie_content.'
						  </tbody>
						</table>
					</div>
				</div><!-- Viernes -->

				<div align="center" style="width: 600px;" id="Sabado">
					<h3 class="dia">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sabado</h3>
					<div></div>
					<div style="width:1000px;">
						<table class=\"table table-striped \" width="100%" cellspacing="0" cellpadding="55%" style="font-size: 11.5px" border="0"> 
						  <thead>
							<tr width="100%" >
								<th align="center" >MAQUINA</th>
								<th align="center">EJERCICIO</th>
								<th align="center">CIRCUITOS</th>
								<th align="center">REPETICIONES</th>
							</tr>
						  </thead>
						  <tbody>
								'.$sab_content.'
						  </tbody>
						</table>
					</div>
				</div><!-- Sabado -->

				<div align="center" style="width: 600px;" id="Domingo">
					<h3 class="dia">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Domingo</h3>
					<div></div>
					<div style="width:1000px;">
						<table class=\"table table-striped \" width="100%" cellspacing="0" cellpadding="55%" style="font-size: 11.5px" border="0"> 
						  <thead>
							<tr width="100%" >
								<th align="center" >MAQUINA</th>
								<th align="center">EJERCICIO</th>
								<th align="center">CIRCUITOS</th>
								<th align="center">REPETICIONES</th>
							</tr>
						  </thead>
						  <tbody>
								'.$dom_content.'
						  </tbody>
						</table>
					</div>
				</div><!-- Domingo -->
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

$nombrepdf = $id_cliente."Rutina".".pdf"; 	//Local

		//$this->SetFont($fontname, 'I', 8);

$pdf->Output("../../../pdf/".$nombrepdf, 'F');
$mailFile     = "/spingym/pdf/".$nombrepdf;
$mail  = new PHPMailer();
$body="<b>This mail is sent using PHP Mailer</b>";#HTML tags can be included
$mail->IsSMTP();
//$mail->SMTPDebug  = 2; 
$mail->Host = "mail.ashernetz.com:2525";  // Servidor de Salida.
$mail->SMTPAuth = true; 
$mail->Username = "spingym@ashernetz.com";  // Correo Electrónico
$mail->Password = "spingym123"; // Contraseña
$mail->From = "spingym@ashernetz.com";
$mail->FromName = "SpinGym";
$mail->Subject    = "Resultados Biotest SpinGym";
$mail->AddAddress($de_email);
//$mail->SMTPDebug  = 2; 
$mail->Body    = 'Desde SpinGym queremos que disfrutes tu tiempo aqu&iacute;, para tu comodidad te enviamos tus rutina a tu correo. Vive SpinGym';
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


