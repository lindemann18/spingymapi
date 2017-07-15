<style type="text/css">
#ContainerConsejo{background-color: #f4f4f4; float: right;}
#BotonPrueba {float: right; margin-right: 3.5%; margin-top: 2%;}
</style>
<script src="modulos/Biotest/javascript.js"></script>

<?php
	
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
	
		
		//Verificando que viene el resultado del test
		$Id_Cliente=(isset($_POST['Id_Cliente']) && $_POST['Id_Cliente']!="")?$_POST['Id_Cliente']:0;
		$Tipo_Prueba=(isset($_POST['TipoPrueba']) && $_POST['TipoPrueba']!="")?$_POST['TipoPrueba']:0;
		$Cintura=(isset($_POST['Cintura']) && $_POST['Cintura']!="")?$_POST['Cintura']:0;
		$Cadera=(isset($_POST['Cadera']) && $_POST['Cadera']!="")?$_POST['Cadera']:0;
		$Perimetro_Espalda=(isset($_POST['Perimetro_Espalda']) && $_POST['Perimetro_Espalda']!="")?$_POST['Perimetro_Espalda']:0;
		$Perimetro_Pecho=(isset($_POST['Perimetro_Pecho']) && $_POST['Perimetro_Pecho']!="")?$_POST['Perimetro_Pecho']:0;
		$Perimetro_brazo_relajado=(isset($_POST['Perimetro_brazo_relajado']) && $_POST['Perimetro_brazo_relajado']!="")?$_POST['Perimetro_brazo_relajado']:0;
		$Perimetro_brazo_flexionado=(isset($_POST['Perimetro_brazo_flexionado']) && $_POST['Perimetro_brazo_flexionado']!="")?$_POST['Perimetro_brazo_flexionado']:0;
		$Perimetro_femoral=(isset($_POST['Perimetro_femoral']) && $_POST['Perimetro_femoral']!="")?$_POST['Perimetro_femoral']:0;
		$Perimetro_Pantorrilla=(isset($_POST['Perimetro_Pantorrilla']) && $_POST['Perimetro_Pantorrilla']!="")?$_POST['Perimetro_Pantorrilla']:0;
?>



            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        BioTest
                        <small>Evaluación F&iacute;sica</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="">BioTest</li>
                         <li class="fa fa-dashboard" id="PruebaInfo">Condici&oacute;n</li>
                         <li class="fa fa-dashboard">Resultado</li>
                    </ol>
                </section>
                
                
                <!-- Main content -->
                <section class="content">
                	<!-- HEADER DEL CONTENIDO-->
                    <h4 class="page-header">
                        Apartado de Resultados
                        <small>
                        	En este apartado se le proporcionan los resultados de las evaluaciones f&iacute;sicas  a todos los Clientes registrados 
                            en <span class="text-red">spin gym</span>,además podrá ver resultados y consejos para mejorar o mantener
                             su condici&oacute;n f&iacute;sica.
                        </small>
                    </h4>
                    <!-- HEADER DEL CONTENIDO-->
                    <div class="alert alert-success alert-dismissible" role="alert" style="display:none;" id="UsuarioEliminadoNotificacion">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Bien Hecho!</strong> Cliente Eliminado.</div>
					<div class="row">
                    	<div class="col-xs-12">
							<div class="box">
                            
                            <!-- APARTADO DEL FORMULARIO DONDE NO SE HA HECHO LA EVALUACIÓN FÍSICA-->
                                <div class="box-header">
                                    <div class="col-sm-12">
                                    	<h4 class="text-center" id="TituloPrueba"></h4>
                                      
                                        
                                       
                                        <div class="col-sm-12 containergraphic"><div class="" id="GraficaResultados" >&nbsp;</div></div><!--containergraphic -->
                                        <div class="col-sm-12" id="ContainerConsejo">
                                        	<h1 class="text-center">Comparaci&oacute;n De Resultados</h1>
                                            <p id="ConsejoTexto">
                                                
                                                <div class="Resultados2 col-sm-4">
                                                	<h3 id="Fecha2"></h3>
                                                      <!-- Segundos Resultados-->
                                                    <div class="col-sm-8 Cintura"><label for="" id="Cintura2" class="text-right"></label></div>
                                                    <div class="col-sm-8 Cadera"><label for="" id="Cadera2" class="text-right"></label></div>
                                                    <div class="col-sm-8 Per_Espalda"><label for="" id="per_espalda2" class="text-right"></label></div>
                                                    <div class="col-sm-8 Per_Pecho"><label for="" id="Per_Pecho2" class="text-right"></label></div>
                                                    <div class="col-sm-8 Per_Brazo"><label for="" id="Per_Brazo2" class="text-right"></label></div>
                                                    <div class="col-sm-8 Per_Brazo_Fle"><label for="" id="Per_Brazo_Fle2" class="text-right"></label></div>
                                                    <div class="col-sm-8 Perimetro_femoral"><label for="" id="Perimetro_femoral2" class="text-right"></label></div>
                                                    <div class="col-sm-8 Per_Pantorrilla"><label for="" id="Per_Pantorrilla2" class="text-right"></label></div>
                                                </div><!-- Resultados -->
                                                
                                                
                                            	<div class="Resultados col-sm-4">
                                                	<h3 id="Fecha"></h3>
                                                    <!--Primeros Resultados -->
                                                	<div class="col-sm-8 Cintura"><label for="" id="CinturaLabel" class="text-right"></label></div>
                                                    <div class="col-sm-8 Cadera"><label for="" id="CaderaLabel" class="text-right"></label></div>
                                                    <div class="col-sm-8 Per_Espalda"><label for="" id="per_espalda" class="text-right"></label></div>
                                                    <div class="col-sm-8 Per_Pecho"><label for="" id="Per_Pecho" class="text-right"></label></div>
                                                    <div class="col-sm-8 Per_Brazo"><label for="" id="Per_Brazo" class="text-right"></label></div>
                                                    <div class="col-sm-8 Per_Brazo_Fle"><label for="" id="Per_Brazo_Fle" class="text-right"></label></div>
                                                    <div class="col-sm-8 Perimetro_femoral"><label for="" id="Perimetro_femoral_res" class="text-right"></label></div>
                                                    <div class="col-sm-8 Per_Pantorrilla"><label for="" id="Per_Pantorrilla" class="text-right"></label></div>
                                                  
                                                </div><!-- Resultados -->
                                                
                                                <div class="Resultados col-sm-4">
                                                	<h3 id="">Resultados</h3>
                                                    <!--Resultados Finales -->
                                                	<div class="col-sm-8 Cintura"><label for="" id="Res_Cintura" class="text-right"></label></div>
                                                    <div class="col-sm-8 Cadera"><label for="" id="Res_Cadera" class="text-right"></label></div>
                                                    <div class="col-sm-8 Per_Espalda"><label for="" id="Res_per_esp" class="text-right"></label></div>
                                                    <div class="col-sm-8 Per_Pecho"><label for="" id="Res_Per_Pecho" class="text-right"></label></div>
                                                    <div class="col-sm-8 Per_Brazo"><label for="" id="Res_Per_Brazo" class="text-right"></label></div>
                                                    <div class="col-sm-8 Per_Brazo_Fle"><label for="" id="Res_Per_Brazo_Fle" class="text-right"></label></div>
                                                    <div class="col-sm-8 Perimetro_femoral"><label for="" id="Res_Perimetro_femoral" class="text-right"></label></div>
                                                    <div class="col-sm-8 Per_Pantorrilla"><label for="" id="Res_Per_Pantorrilla" class="text-right"></label></div>
                                                  
                                                </div><!-- Resultados -->
                                                
                                            </p>
                                         </div> <!-- ContainerConsejo -->
                                            
                                        <div class="col-sm-1 pull-right" id="BotonPrueba" style=""></div>
                                                <div class="col-xs-5">
                                                <input type="hidden" id="Id_Cliente" name="Id_Cliente" value="<?php echo $Id_Cliente?>">
                                                <input type="hidden" name="Tipo_Prueba" id="Tipo_Prueba" value="<?php echo $Tipo_Prueba?>">
                                                <input type="hidden" id="id_instructor" value=<?php echo $_SESSION['Sesion']['id_usuario'] ?>>
                                                <!-- inputs de los valores provenientes de las evaluaciones-->
                                                <!--Condición física en reposo-->
                                                <input type="hidden" name="Cintura" id="Cintura" value="<?php echo $Cintura; ?>">
                                                <input type="hidden"  name="Cadera" id="Cadera" value="<?php echo $Cadera; ?>">
                                                <input type="hidden"  name="Perimetro_Espalda" id="Perimetro_Espalda" value="<?php echo $Perimetro_Espalda?>">
                                                 <input type="hidden" name="Perimetro_Pecho" id="Perimetro_Pecho" value="<?php echo $Perimetro_Pecho?>">
                                                 <input type="hidden" name="Perimetro_brazo_relajado" id="Perimetro_brazo_relajado" 
                                                 value="<?php echo $Perimetro_brazo_relajado?>">
                                                <input type="hidden"  name="Perimetro_brazo_flexionado" id="Perimetro_brazo_flexionado" 
                                                value="<?php echo $Perimetro_brazo_flexionado?>">
                                                <input type="hidden"  name="Perimetro_femoral" id="Perimetro_femoral" value="<?php echo $Perimetro_femoral?>">
                                                 <input type="hidden" name="Perimetro_Pantorrilla" id="Perimetro_Pantorrilla"
                                                  value="<?php echo $Perimetro_Pantorrilla?>">
                                                  <input type="hidden" name="img_resultado" id="img_resultado"  style="display:inherit"/>
                                                </div>
                                               
                                    </div><!--col-sm-12 -->
                                </div><!-- /.box-header -->
                                
                                
                             	<div class="box-body">
                                
                                </div><!-- box-body-->
                            </div><!--box -->
                        </div><!--col-xs-12 -->
                    </div><!--row -->
                </section>
            </aside>

</div>



        
      
<?php include('includes/footernolte.php');?>


<?php } else {header("Location: Login.php");}?>
<script>
$(document).ready(function(){

	//AÑADIMOS LA CLASE ACTIVE, AL <LI> DEL MENU LATERAL, ESTO CON LA
	//FINALIDAD DE QUE SE SEPA EN QUE SECCIÓN SE ENCUENTRA EL USUARIO
	$('#m-biotest').addClass('active');
	
	
	
	idClienteEliminar=0;
	
	//Verificando el tipo de prueba para mandar llamar a la función pertinente
		Tipo_Prueba=$("#Tipo_Prueba").val();
		Id_Cliente=$("#Id_Cliente").val();
		ResultadoEvaluado=$("#ResultadoEvaluado").val();
		id_instructor=$("#id_instructor").val();
		//Verificando el tipo de prueba que es para elegir la evaluación y dar el resultado
		switch(Tipo_Prueba)
		{
			case '1':
				TestCondicion(Id_Cliente, ResultadoEvaluado);
			break;	
			
			case '2':
				TestPeso(Id_Cliente, ResultadoEvaluado);
			break;	
			
			case '3':
				IMC(Id_Cliente, ResultadoEvaluado);
			break;	
			
			case '4':
				IMM(Id_Cliente, ResultadoEvaluado);
			break;
			
			
			case '5':
				TestStamina(Id_Cliente, ResultadoEvaluado);
			break;	
		}
	
});//document ready

function PegarScriptMenu()
{
	$.getScript( "js/AdminLTE/app.js" ) //Pegando el script para que funcione el menú de nuevo
					.done(function( script, textStatus ) {
					console.log( textStatus );
					})
					.fail(function( jqxhr, settings, exception ) {
					$( "div.log" ).text( "Triggered ajaxError handler." );
					});	
}





function IMM(Id_Cliente,ResultadoEvaluado)
{
	//Ponerle el título al Test
	$("#TituloPrueba").text("IMM");
	var Arr=new Object();	
	Arr['Id_Cliente']				 = Id_Cliente;
	Arr['Cintura']					 = $("#Cintura").val();
	Arr['Cadera']					 = $("#Cadera").val();
	Arr['Perimetro_Espalda']		 = $("#Perimetro_Espalda").val();
	Arr['Perimetro_Pecho']			 = $("#Perimetro_Pecho").val();
	Arr['Perimetro_brazo_relajado']	 = $("#Perimetro_brazo_relajado").val();
	Arr['Perimetro_brazo_flexionado']= $("#Perimetro_brazo_flexionado").val();
	Arr['Perimetro_femoral']		 = $("#Perimetro_femoral").val();
	Arr['Perimetro_Pantorrilla']	 = $("#Perimetro_Pantorrilla").val();
	Arr['id_instructor']			 = id_instructor;
	
	Arr['Accion']					 = "IMM";
	
		var Params= JSON.stringify(Arr);	
	console.log(Params);
	$.ajax({
				
				cache: false,
				type: "GET",
				contentType:false,
				processData:false,
				url: "modulos/Biotest/Funciones.php?Params="+Params,
				data: Params,
				datatype:"json",
				success: function(response){
					//Pegando el botón para cambiar de prueba
					$("#BotonPrueba").append('<button type="button" class="btn btn-success" onclick="Prueba5('+Id_Cliente+')">Siguiente Prueba</button>');
					//console.log(response);	
					var objJSON = eval("(function(){return " + response + ";})()");
					//console.log(objJSON);
					console.log(response);
					//var objJSON = $.parseJSON(response,true);
					console.log(objJSON);
					PegarScriptMenu(); //Trayendo de vuelta el script de menu. Función declarada bajo el document ready de este archivo
					
					//Gráficas de javascript
					
					//Tomando los resultados de las pruebas
					pruebas=objJSON.Resultados;
					pruebas2=objJSON.Resultados2;
					
					
					console.log(pruebas);
					console.log(pruebas2);
					
					//Tomando los valores de las últimas pruebas.
					//Se declaran de esta manera las variables dado que no siempre vienen los valores de la misma manera.
					//Así que con el dato de DescPrueba comparamos en el switch para tomarlos siempre de la forma correcta.
					
					
					Fecha=pruebas[0].Fecha; //Fecha para todas las primeras 8 pruebas.
					//Perímetro brazo relajado
					Perimetro_brazo_relajado   = "IMM - Perimetro_brazo_relajado";
					Per_Brazo				   = "";
					//Perímetro brazo_flexionado
					Perimetro_brazo_flexionado = "IMM - Perimetro_brazo_flexionado";
					Per_Brazo_Fle			   = "";
					//Perímetro Femoral
					Perimetro_femoral = "IMM - Perimetro_femoral";
					Per_Femoral		  = "";
					//Perímetro de pantorrilla
					Perimetro_Pantorrilla = "IMM - Perimetro_Pantorrilla";
					Per_Pantorrilla		  = "";
					//Perímetro Cintura
					Cintura			= "IMM - Cintura";
					CantidadCintura = "";
					//Perímetro Cadera
					Cadera		   = "IMM - Cadera";
					CantidadCadera = "";
					//Perímetro Espalda
					Perimetro_Espalda = "IMM - Perimetro_Espalda";
					per_espalda_can	  = "";
					//Perímetro Pecho
					Perimetro_Pecho = "IMM - Perimetro_Pecho";
					Per_Pecho		= "";
					
					//Se hace en un ciclo por que no se sabe en que orden vienen.
					for(i=0; i<8; i++)
					{
						//Tomando los valores de las pruebas a partir del nombre de las mismas.
						switch(pruebas[i].DescPrueba)
						{
							case "IMM - Perimetro_brazo_relajado": 
								Per_Brazo = pruebas[i].PorcentResultadoNumericoaje;
							break;
							case 'IMM - Perimetro_brazo_flexionado': 
								Per_Brazo_Fle = pruebas[i].PorcentResultadoNumericoaje;
							break;
							case 'IMM - Perimetro_femoral': 
								Per_Femoral = pruebas[i].PorcentResultadoNumericoaje;
							break;
							case 'IMM - Perimetro_Pantorrilla': 
								Per_Pantorrilla = pruebas[i].PorcentResultadoNumericoaje;
							break;
							case 'IMM - Cintura': 
								CantidadCintura = pruebas[i].PorcentResultadoNumericoaje;
							break;
							case 'IMM - Cadera': 
								CantidadCadera = pruebas[i].PorcentResultadoNumericoaje;
							break;
							case 'IMM - Perimetro_Espalda': 
								per_espalda_can = pruebas[i].PorcentResultadoNumericoaje;
							break;
							case 'IMM - Perimetro_Pecho': 
								Per_Pecho = pruebas[i].PorcentResultadoNumericoaje;
							break;
							
						}//switch
						
					}//for
					
					//Tomando los valores de Pruebas 2, que son las pruebas más antiguas del mes pasado.
					//Perímetro brazo_flexionado
					Per_Brazo_Fle2				= "";
					//Perímetro Femoral
					Per_Femoral2	   = "";
					//Perímetro de pantorrilla
					Per_Pantorrilla2	   = "";
					//Perímetro Cintura
					CantidadCintura2 = "";
					//Perímetro Cadera
					CantidadCadera2 = "";
					//Perímetro Espalda
					Perimetro_Espalda2 = "";
					//Perímetro Pecho
					Per_Pecho2		 = "";
					//Perímetro brazo relajado
					Perimetro_brazo_relajado2 = "";
					
					//Se hace en un ciclo por que no se sabe en que orden vienen.
					Fecha2=(pruebas2[0].Fecha!=0)?pruebas2[0].Fecha:"BioTest No hecho"; //Fecha para todas las primeras 8 pruebas.
					
					// Si vienen en 0 cualquiera de la descripción de las pruebas es el primer biotest, de no ser así es el 2do o cualquier otro.
					// Para efecto de que se vean las pruebas se asignan en 0 todos los valores dado que no hay otro punto de comparación.
					
					if(pruebas2[0].DescPrueba == 0)
					{
						Perimetro_brazo_relajado2 = 0;
						Per_Brazo_Fle2			  = 0;
						Per_Femoral2 			  = 0;
						Per_Pantorrilla2 		  = 0;
						CantidadCintura2		  = 0;
						CantidadCadera2			  = 0;
						Perimetro_Espalda2 		  = 0;
						Per_Pecho2 				  = 0;
					}
					else
					{
						for(i=0; i<8; i++)
						{
							//Tomando los valores de las pruebas a partir del nombre de las mismas.
							switch(pruebas2[i].DescPrueba)
							{
								case "IMM - Perimetro_brazo_relajado": 
									Perimetro_brazo_relajado2 = pruebas2[i].PorcentResultadoNumericoaje;
								break;
								case 'IMM - Perimetro_brazo_flexionado': 
									Per_Brazo_Fle2 = pruebas2[i].PorcentResultadoNumericoaje;
								break;
								case 'IMM - Perimetro_femoral': 
									Per_Femoral2 = pruebas2[i].PorcentResultadoNumericoaje;
								break;
								case 'IMM - Perimetro_Pantorrilla': 
									Per_Pantorrilla2 = pruebas2[i].PorcentResultadoNumericoaje;
								break;
								case 'IMM - Cintura': 
									CantidadCintura2 = pruebas2[i].PorcentResultadoNumericoaje;
								break;
								case 'IMM - Cadera': 
									CantidadCadera2 = pruebas2[i].PorcentResultadoNumericoaje;
								break;
								case 'IMM - Perimetro_Espalda': 
									Perimetro_Espalda2 = pruebas2[i].PorcentResultadoNumericoaje;
								break;
								case 'IMM - Perimetro_Pecho': 
									Per_Pecho2 = pruebas2[i].PorcentResultadoNumericoaje;
								break;
								
							}//switch
							
						}//for
					}//else
				
					
					
					//Sacando las diferencias de resultados.
					//Primeros  Resultados.
					$("#Fecha").text(Fecha);
					$("#CinturaLabel").text("Cintura: "+CantidadCintura);	
					$("#CaderaLabel").text("Cadera: "+CantidadCadera);
					$("#per_espalda").text("perímetro Espalda: "+per_espalda_can);	
					$("#Per_Pecho").text("Perímetro Pecho: "+Per_Pecho);
					$("#Per_Brazo").text("Perímetro Brazo Relajado: "+Per_Brazo);
					$("#Per_Brazo_Fle").text("Perímetro Brazo Flexionado: "+Per_Brazo_Fle);
					$("#Perimetro_femoral_res").text("Perímetro Femoral: "+Per_Femoral);
					$("#Per_Pantorrilla").text("Perímetro Pantorrilla: "+Per_Pantorrilla);
					//Segundos  Resultados.
					$("#Fecha2").text(Fecha2);
					$("#Cintura2").text("Cintura: "+CantidadCintura2);	
					$("#Cadera2").text("Cadera: "+CantidadCadera2);
					$("#per_espalda2").text("perímetro Espalda: "+Perimetro_Espalda2);	
					$("#Per_Pecho2").text("Perímetro Pecho: "+Per_Pecho2);
					$("#Per_Brazo2").text("Perímetro Brazo Relajado: "+Perimetro_brazo_relajado2);
					$("#Per_Brazo_Fle2").text("Perímetro Brazo Flexionado: "+Per_Brazo_Fle2);
					$("#Perimetro_femoral2").text("Perímetro Femoral: "+Per_Femoral2);
					$("#Per_Pantorrilla2").text("Perímetro Pantorrilla: "+Per_Pantorrilla2);
					
					//sacando los resultados de si se subió o disminuyeron tallas.
					//CINtura.
					ResCin=CantidadCintura-CantidadCintura2;
					if(CantidadCintura==ResCin)ResCintura="Primer Biotest";
					if(ResCin>0 && CantidadCintura!=ResCin)ResCintura="Aumentaste: "+ResCin;
					if(ResCin==0)ResCintura="Sin Cambios";
					if(ResCin<0)ResCintura="Disminuiste: "+(ResCin*-1);
					$("#Res_Cintura").text(ResCintura);				 	
					
					
					//Cadera.
					ResCad=CantidadCadera-CantidadCadera2;
					if(CantidadCadera==ResCad)Res_Cadera="Primer Biotest";
					if(ResCad>0 && CantidadCadera!=ResCad)Res_Cadera="Aumentaste: "+ResCad;
					if(ResCad==0)Res_Cadera="Sin Cambios";
					if(ResCad<0)Res_Cadera="Disminuiste: "+(ResCad*-1);
					$("#Res_Cadera").text(Res_Cadera);	
					
					//Perímetro Espalda.
					Resesp=per_espalda_can-Perimetro_Espalda2;
					if(per_espalda_can==Resesp)Res_per_esp="Primer Biotest"; //Da la misma cantidad por que se le resta un 0 y no hay cambios.
					if(Resesp>0 && per_espalda_can!=Resesp)Res_per_esp="Aumentaste: "+Resesp;
					if(Resesp==0)Res_per_esp="Sin Cambios";
					if(Resesp<0)Res_per_esp="Disminuiste: "+(Resesp*-1);
					$("#Res_per_esp").text(Res_per_esp);	
					
					//Perímetro Pecho.
					ResPecho=Per_Pecho-Per_Pecho2;
					if(Per_Pecho==ResPecho)Res_pecho="Primer Biotest";
					if(ResPecho>0 && Per_Pecho!=ResPecho)Res_pecho="Aumentaste: "+ResPecho;
					if(ResPecho==0)Res_pecho="Sin Cambios";
					if(ResPecho<0)Res_pecho="Disminuiste: "+(ResPecho*-1);
					$("#Res_Per_Pecho").text(Res_pecho);	
					
					//Perímetro BRazo Relajado.
					PerBrazo=Per_Brazo-Perimetro_brazo_relajado2;
					if(Per_Brazo==PerBrazo)Res_Brazo="Primer Biotest";
					if(PerBrazo>0 && Per_Brazo!=PerBrazo)Res_Brazo="Aumentaste: "+PerBrazo;
					if(PerBrazo==0)Res_Brazo="Sin Cambios";
					if(PerBrazo<0)Res_Brazo="Disminuiste: "+(PerBrazo*-1);
					$("#Res_Per_Brazo").text(Res_Brazo);	
					
					
					//Perímetro BRazo Flexionado.
					PerBrazoFle=Per_Brazo_Fle-Per_Brazo_Fle2;
					if(PerBrazoFle==PerBrazoFle)Res_BrazoFle="Primer Biotest";
					if(PerBrazoFle>0 && Per_Brazo_Fle!=PerBrazoFle)Res_BrazoFle="Aumentaste: "+PerBrazoFle;
					if(PerBrazoFle==0)Res_BrazoFle="Sin Cambios";
					if(PerBrazoFle<0)Res_BrazoFle="Disminuiste: "+(PerBrazoFle*-1);
					$("#Res_Per_Brazo_Fle").text(Res_BrazoFle);	
					
					//Perímetro  Femoral.
					Perfemo=Per_Femoral-Per_Femoral2;
					if(Per_Femoral==Perfemo)Res_PeriFemo="Primer Biotest";
					if(Perfemo>0 && Per_Femoral!=Perfemo)Res_PeriFemo="Aumentaste: "+Perfemo;
					if(Perfemo==0)Res_PeriFemo="Sin Cambios";
					if(Perfemo<0)Res_PeriFemo="Disminuiste: "+(Perfemo*-1);
					$("#Res_Perimetro_femoral").text(Res_PeriFemo);	
					
					//Perímetro Pantorrilla.
					PerPanto=Per_Pantorrilla-Per_Pantorrilla2;
					if(Per_Pantorrilla==PerPanto)ResPerPant="Primer Biotest";
					if(PerPanto>0 && Per_Pantorrilla!=PerPanto)ResPerPant="Aumentaste: "+PerPanto;
					if(PerPanto==0)ResPerPant="Sin Cambios";
					if(PerPanto<0)ResPerPant="Disminuiste: "+(PerPanto*-1);
					$("#Res_Per_Pantorrilla").text(ResPerPant);	
						
					TituloPrueba="Resultados IMC";
					//tomando los valores que se les van a indicar a la gráfica.
					options = ObtenerOptions(Fecha,Fecha2,CantidadCintura, CantidadCintura2,CantidadCadera, CantidadCadera2,per_espalda_can,
											Perimetro_Espalda2,Per_Pecho,Per_Pecho2,Per_Brazo,Perimetro_brazo_relajado2,Per_Brazo_Fle,Per_Brazo_Fle2,
											Per_Femoral,Per_Femoral2,Per_Pantorrilla,Per_Pantorrilla2);
					$(function () {
						$('#GraficaResultados').highcharts(options); //Graficando los resultados.
					});
					
					$('g.highcharts-legend').attr('transform','translate(217,4)'); //Cambiando de lugar el cuadro de explicación de la gráfica
				}//success
	});//ajax
}


function ObtenerOptions(Fecha,Fecha2,CantidadCintura, CantidadCintura2,CantidadCadera, CantidadCadera2,per_espalda_can,
						Perimetro_Espalda2,Per_Pecho,Per_Pecho2,Per_Brazo,Perimetro_brazo_relajado2,Per_Brazo_Fle,Per_Brazo_Fle2,
						Per_Femoral,Per_Femoral2,Per_Pantorrilla,Per_Pantorrilla2)
{
		  options={
				 chart: {
                type: 'bar'
            },
            title: {
                text: TituloPrueba
            },
            subtitle: {
                text: 'BioTest'
            },
            xAxis: {
                categories: ['Cintura', 'Cadera', 'perímetro Espalda', 'Perímetro pecho', 'Perímetro Brazo Relajado', 'Perímetro Brazo flexionado', 'Perímetro Femoral', 'Perímetro Pantorrilla'],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Resultados',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' Porciento'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor || '#FFFFFF'),
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: Fecha,
                data: [parseInt(CantidadCintura),parseInt(CantidadCadera),parseInt(per_espalda_can),parseInt(Per_Pecho),parseInt(Per_Brazo)
					  ,parseInt(Per_Brazo_Fle),parseInt(Per_Femoral),parseInt(Per_Pantorrilla)]
            }, {
                name: Fecha2,
                data: [parseInt(CantidadCintura2),parseInt(CantidadCadera2),parseInt(Perimetro_Espalda2),parseInt(Per_Pecho2),parseInt(Perimetro_brazo_relajado2)
					  ,parseInt(Per_Brazo_Fle2),parseInt(Per_Femoral2),parseInt(Per_Pantorrilla2)]
            }]	
			};
			return options;	
}

//Función que redirije a la prueba 2, la de peso.
function Prueba2(id_cliente)
{
	var confirmacion = confirm('¿Está seguro que desea pasar a la siguiente prueba?');
		if(confirmacion == true){
			
				window.location='index.php?nav=Peso&id='+id_cliente;
		}
}

function Prueba3(id_cliente)
{
	var confirmacion = confirm('¿Está seguro que desea pasar a la siguiente prueba?');
		if(confirmacion == true){
			
				window.location='index.php?nav=IMC&id='+id_cliente;
		}
}


function Prueba4(id_cliente)
{
	var confirmacion = confirm('¿Está seguro que desea pasar a la siguiente prueba?');
		if(confirmacion == true){
			
				window.location='index.php?nav=Masa&id='+id_cliente;
		}
}

function Prueba5(id_cliente)
{
	var confirmacion = confirm('¿Está seguro que desea pasar a la siguiente prueba?');
		if(confirmacion == true)
		{
			window.location='index.php?nav=Stamina&id='+id_cliente;
			//Tomando la captura del resultado.
			/*	$('#ContainerConsejo').html2canvas({
					onrendered: function (canvas) 
					{
						//Set hidden field's value to image data (base-64 string)
						$('#img_resultado').val(canvas.toDataURL("image/png"));
						
						//Creando el array de objetos para mandarlo al Controller Funciones
						var Arr=new Object();	
						Arr['Id_Cliente']		= Id_Cliente;
						Arr['Prueba']			= "IMM";
						Arr['de_imagen']		= $('#img_resultado').val();
						Arr['Folder_Name']		= $.cookie("Folder_Name");
						Arr['Accion']			= "CrearCapturaImagen";
						var Params= JSON.stringify(Arr);
						$.post( "modulos/Biotest/Funciones.php", { Params: Params,  } ).done(function (response){
							var objJSON = eval("(function(){return " + response + ";})()");
							IMMVar = objJSON.IMMVar; //Nombre del archivo de condición física
							//Se crea la cookie para mandarlas al pdf y luego eliminar los archivos
							$.cookie("IMMVar",IMMVar);
							window.location='index.php?nav=Stamina&id='+id_cliente;
						}); //end jquery post
						
					}//onrendered
				});//html2canvas*/
		}
}
</script>
<script src="js/charts/highcharts.js"></script>
<script src="js/charts/exporting.js"></script>