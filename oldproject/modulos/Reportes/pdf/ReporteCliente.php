<?php
	include("../../../libs/libs.php");
	$consultar = new Consultar();
	require_once('tcpdf_include.php');
	
		//Atrpando el id del cliente y tomando la información
		$id_cliente = $_GET['id'];
		$conexion   = new ConexionBean(); //Variable de conexión
		$con        = $conexion->_con(); //Variable de conexión
		$fila     = $consultar->_ConsultarInformacionClienteReporteFormulario($id_cliente);
		
		
		
		//Datos para el reporte de formulario
		$nombre_completo   = $fila['nb_cliente']." ".$fila['nb_apellidos'];
		$cond_card 		   = ($fila['condicion_cardiaca']==1)?"SI":"NO";
		$cond_pecho		   = ($fila['condicion_pecho']==1)?"SI":"NO";
		$cond_pecho_re	   = ($fila['condicion_pechoreciente']==1)?"SI":"NO";
		$Cond_Ba		   = ($fila['condicion_balance']==1)?"SI":"NO";
		$Les_fisica		   = ($fila['lesion_fisica']==1)?"SI":"NO";
		$meds_corazon	   = ($fila['medicamentos_corazon']==1)?"SI":"NO";
		$imp_entrenamiento = ($fila['impedimento_entrenamiento']==1)?"SI":"NO";
		$Lect_Anormales	   = ($fila['lecturas_anormales']==1)?"SI":"NO";	
		$ByPass			   = ($fila['cirujia_bypass']==1)?"SI":"NO";	
		$Dif_Respirar	   = ($fila['dificultad_respirar']==1)?"SI":"NO";	
		$Enf_Renales	   = ($fila['enfermedades_renales']==1)?"SI":"NO";	
		$Arrit			   = ($fila['arritmia']==1)?"SI":"NO";	
		$Colest		 	   = ($fila['colesterol']==1)?"SI":"NO";		
		$Pres_Alta		   = ($fila['presion_alta']==1)?"SI":"NO";
		$cantidad_Cigarros = $fila['cantidad_cigarros'];
		$Molestias_Art	   = ($fila['molestias_articulaciones']==1)?"SI":"NO";	
		$Molestias_Espalda = ($fila['molestias_espalda']==1)?"SI":"NO";
		$Desayuno_Diario   = $fila['desayuno_diario'];
		$Comida_Diaria	   = $fila['comida_diaria'];
		$Cena_Diaria	   = $fila['cena_diaria'];
		$EntreComida_Dia   = $fila['entrecomida_diaria'];
		$Frecuencia_Entre  = $fila['frecuencia_entrecomida'];		
		$Plan_Alimen  	   = $fila['plan_alimenticio'];		
		$Intensidad_Ejer   = $fila['intensidad_ejercicio'];		
		$Intensidad_Ejer2  = $fila['intensidad_ejercicio2'];		
		$Intensidad_Ejer3  = $fila['intensidad_ejercicio3'];		
		$Intensidad_Ejer4  = $fila['intensidad_ejercicio4'];		
		$Intensidad_Ejer5  = $fila['intensidad_ejercicio5'];
		$Programa_Ejerc	   = $fila['programa_ejercicio'];	
		$Actividades_desea = $fila['actividades_deseables'];
		$Actividades_indes = $fila['actividades_indeseables'];
		$deporte_Frec 	   = $fila['deporte_frecuente'];	
		$Minutos_Dia	   = $fila['minutos_dia'];
		$Dias_Semana 	   = $fila['dias_semana'];
		$Resultado_Ejerc   = $fila['resultado_ejercicio'];
				
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
		$this->Cell(0, 30, 'Formulario Salud', 0, false, 'C', 0, '', 0, false, 'M', 'M');
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
			<div style="width:100%"> <h1 style="text-align:center;">'.$nombre_completo.'</h1></div>
			<div style="width:100%">
				<label style="text-align:left;">Alguna vez tu doctor te a señalado que tienes alguna condición cardiaca?</label><br>
				<label style="text-align:left;">Respuesta: &nbsp;'.$cond_card.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">Has experimentado dolor en el pecho al realizar alguna actividad física?</label><br>
				<label style="text-align:left;">Respuesta:&nbsp; '.$cond_pecho.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">En el ultimo mes, has experimentado dolor en el pecho al realizar alguna actividad física?</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$cond_pecho.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">Pierdes el balance por mareos o alguna vez has perdido la conciencia?</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Cond_Ba.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">
					Tienes algún problema o lesión en osea o de articulación que pueda agravarse al realizar cambios en tu actividad física?
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Les_fisica.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">Estas tomando medicamentos para la presión o el corazón?</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$meds_corazon.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">
					Conoces alguna razón por la cual no deberías participar en un programa de entrenamiento físico?
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$imp_entrenamiento.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">
					Algun doctor le a señalado que usted tiene problemas cardiacos, lecturas anormales de electrocardiogramas o a tenido algún ataque cardiaco?
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Lect_Anormales.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">
					Se a realizado alguna cirugía de by-pass coronario, angioplastia o algún otro tipo de cirugía cardiaca?
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$ByPass.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">
					Ha tenido dificultad para respirar al realizar actividades físicas ligeras o de intensidad normal?
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Dif_Respirar.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">
					Tiene historial de enfermedades relacionadas con diabetes, tiroides, riñones o hígado?
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Enf_Renales.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">
					Ha experimentado arritmia o ha sido diagnosticado con alguna condición o enfermedad cardiaca?
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Arrit.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">
					En los últimos 12 meses, se le ha indicado por algún profesional medico que tiene niveles de colesterol elevados?
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Colest.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">
					En los últimos 12 meses, se le ha indicado por algún profesional medico que tiene condición de alta presión sanguinea?
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Pres_Alta.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">
					Fuma actualmente? En caso de responder "Si" Cuantos cigarros al dia?
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$cantidad_Cigarros.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">
					Actualmente sufre de dolores o molestias en sus huesos, articulaciones o musculos que puedan agravarse con el ejercicio?
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Molestias_Art.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">
					Actualmente experimente molestias en su espalda o cuello?
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Molestias_Espalda.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">
					 Que desayuna normalmente?
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Desayuno_Diario.'</label>
			</div>
			
			<div style="width:100%">
				<label style="text-align:left;">
					 Que como a medio dia normalmente?
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Comida_Diaria.'</label>
			</div>
			
			<div style="width:100%">
				<label style="text-align:left;">
					 Que cena normalmente?
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Cena_Diaria.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">
					Que tipo de alimentos como entre comidas?
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$EntreComida_Dia.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">
					Que tan frecuente como entre comidas?
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Frecuencia_Entre.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">
					Ha estado bajo algún plan alimenticio? Explique?
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Plan_Alimen.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">
					Favor de calificar su nivel de ejercicio en una escala de 1 a 5 (5 siendo muy intenso) para cada rango de edad hasta su edad presente:
				</label> <br>
				<label style="text-align:left;">15-20: </label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Intensidad_Ejer.'</label><br>
				
				<label style="text-align:left;">21-30: </label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Intensidad_Ejer2.'</label><br>
				
				<label style="text-align:left;">31-40: </label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Intensidad_Ejer3.'</label><br>
				
				<label style="text-align:left;">41-50: </label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Intensidad_Ejer4.'</label><br>
				
				<label style="text-align:left;">51+: </label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Intensidad_Ejer5.'</label>
				
			</div>
			
			<div style="width:100%">
				<label style="text-align:left;">
					 Empieza programas de entrenamiento, pero tiene dificultades para llevarlos a cabo?
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Programa_Ejerc.'</label>
			</div>
			
			<div style="width:100%">
				<label style="text-align:left;">
					. Favor de indicar las actividades físicas que le gustaría incluir en su programa de entrenamiento?
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Actividades_desea.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">
					 Favor de indicar las actividades físicas que le NO le gustaría incluir en su programa de entrenamiento?
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Actividades_indes.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">
					 Indique cualquier deporte o actividad recreativa en la que participa con regularidad
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$deporte_Frec.'</label>
			</div> 
			
			<div style="width:100%">
				<label style="text-align:left;">
					 Con cuanto tiempo posee o desea dedicarle al programa de entrenamiento? (Minutes/day)Minutos al dia? (days/week)Cuantos días de la semana?
				</label> <br>
				<label style="text-align:left;">Minutos Por día: </label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Minutos_Dia.'</label><br>
				
				<label style="text-align:left;">días por semana: </label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Dias_Semana.'</label>
			</div>
			
			<div style="width:100%">
				<label style="text-align:left;">
					 Que desea lograr con el ejercicio?
				</label> <br>
				<label style="text-align:left;">Respuesta:&nbsp;'.$Resultado_Ejerc.'</label>
			</div> 
			
			<div style="width:100%; float:left;">
				<label style="text-align:center;">
					____________________________________
				</label> <br>
				<label style="text-align:center;">Gerente General: Alonso Bretón</label>
			</div> <br>
			
			<div style="width:100%; float:right;">
				<label style="text-align:center;">
					____________________________________
				</label> <br>
				<label style="text-align:center;">Cliente: '.$nombre_completo.'</label>
			</div> <br>
		';
				

		// output the HTML content
		$pdf->writeHTML($html, $linebreak = true, $fill = false, $reseth = true, $cell = false, $align = '');
		
		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		// test pre tag
		
		$pdf->lastPage();
		
		// ---------------------------------------------------------
		
		//Close and output PDF document
		$pdf->Output("report.pdf", 'I');
		
	
?>


