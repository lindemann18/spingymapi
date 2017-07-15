<style type="text/css">
#ContainerConsejo{background-color: #f4f4f4; float: right; margin-right: 30%;}
</style>
<script src="modulos/Biotest/javascript.js"></script>

<?php
	
	if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']['id_usuario']!="")
	{
	
		
		//Verificando que viene el resultado del test
		$Id_Cliente 		= (isset($_POST['Id_Cliente']) && $_POST['Id_Cliente']!="")?$_POST['Id_Cliente']:0;
		$Tipo_Prueba 		= (isset($_POST['TipoPrueba']) && $_POST['TipoPrueba']!="")?$_POST['TipoPrueba']:0;
		$ResultadoCondicion = (isset($_POST['ResultadoCondicion']) && $_POST['ResultadoCondicion']!="")?$_POST['ResultadoCondicion']:0;
		$peso				= (isset($_POST['Peso']) && $_POST['Peso']!="")?$_POST['Peso']:0;
		$Altura				= (isset($_POST['Altura']) && $_POST['Altura']!="")?$_POST['Altura']:0;
		$repeticiones		= (isset($_POST['repeticiones']) && $_POST['repeticiones']!="")?$_POST['repeticiones']:0;

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
                                     
                                     <div class="col-sm-5 containerbar" id="ContainerBar"> 
                                     <h1 class="text-center">Resultado Actual</h1>
                                      <h2 id="CondicionTitulo"></h2>  
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                                             aria-valuemax="100" id="ProgresBarResultado">
                                            <span class="sr-only">60% Complete</span>
                                          </div>
                                        </div><!--progress -->
                                        
                                        <!-- Barra de comparación-->
                                        <div class="progress">
                                                 <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                               Pobre&nbsp;&nbsp;<span class="glyphicon glyphicon-remove"></span></div>
                                             	
                                                 <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                               Promedio&nbsp;&nbsp;<span class="glyphicon glyphicon-user"></span></div>
                                                
                                              <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                               Bueno&nbsp;&nbsp;<span class="glyphicon glyphicon-upload"></span></div>
                                               
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                               Excelente&nbsp;&nbsp;<span class="glyphicon glyphicon-ok"></span></div>
                                                
                                               <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                               Atleta&nbsp;&nbsp;<span class="glyphicon glyphicon-star"></span></div>
												
                                        </div>
                                        
                                     </div><!--containerbar -->  
                                        
                                       
                                        <div class="col-sm-5 containergraphic"><div class="" id="GraficaResultados" >&nbsp;</div></div><!--containergraphic -->
                                        <div class="col-sm-6" id="ContainerConsejo"><h1 class="text-center">Consejo Físico</h1><p id="ConsejoTexto"></p></div> 
                                        <div class="col-sm-3 pull-right" id="BotonPrueba"></div>
                                                <div class="col-xs-5">
                                                <input type="hidden" id="Id_Cliente" name="Id_Cliente" value="<?php echo $Id_Cliente?>">
                                                <input type="hidden" name="Tipo_Prueba" id="Tipo_Prueba" value="<?php echo $Tipo_Prueba?>">
                                                <input type="hidden" id="id_instructor" value=<?php echo $_SESSION['Sesion']['id_usuario'] ?>>
                                                <!-- inputs de los valores provenientes de las evaluaciones-->
                                                <!--Condición física en reposo-->
                                                <input type="hidden" name="ResultadoEvaluado" id="ResultadoEvaluado" value="<?php echo $ResultadoCondicion?>">
                                                <!-- Peso -->
                                                <input type="hidden"  name="peso" id="peso" value="<?php echo $peso?>">
                                                <input type="hidden"  name="Altura" id="Altura" value="<?php echo $Altura?>">
                                                 <input type="hidden" name="repeticiones" id="repeticiones" value="<?php echo $repeticiones?>">
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

 <!--Modal de enviando -->
            
            <div class="modal fade" id="pleaseWaitDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1>Enviando...</h1>
                        </div>
                    <div class="modal-body">
                        <div class="progress progress-striped active">
                        <div class="progress-bar progress-striped active"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        
                        </div>
                        </div>
                    </div><!-- modal body-->
                    <div class="modal-footer">
                    </div>
                    </div>
                </div>
            </div><!-- pleaseWaitDialog-->

        
      
<?php include('includes/footernolte.php');?>


<?php } else {header("Location: Login.php");}?>
<script>
$(document).ready(function(){

	//AÑADIMOS LA CLASE ACTIVE, AL <LI> DEL MENU LATERAL, ESTO CON LA
	//FINALIDAD DE QUE SE SEPA EN QUE SECCIÓN SE ENCUENTRA EL USUARIO
	$('#m-biotest').addClass('active');
	
	
	
	idClienteEliminar=0;
	
	//Verificando el tipo de prueba para mandar llamar a la función pertinente
		Tipo_Prueba 	  = $("#Tipo_Prueba").val();
		Id_Cliente		  = $("#Id_Cliente").val();
		ResultadoEvaluado = $("#ResultadoEvaluado").val();
		id_instructor	  = $("#id_instructor").val();
		
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
			
			case '5':
				TestStamina(Id_Cliente, ResultadoEvaluado);
			break;	
			
			case '6':
				Fuerza(Id_Cliente, ResultadoEvaluado);
			break;	
			
			case '7':
				Resistencia(Id_Cliente, ResultadoEvaluado);
			break;
			
			case '8':
				Flexibilidad(Id_Cliente, ResultadoEvaluado);
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
}//PegarScriptMenu

function TestCondicion(Id_Cliente, ResultadoEvaluado)
{
	//Ponerle el título al Test
	$("#TituloPrueba").text("Condición Física");
	var Arr=new Object();	
	Arr['Id_Cliente']		= Id_Cliente;
	Arr['ResultadoEvaluado']= ResultadoEvaluado;
	Arr['id_instructor']	= id_instructor;
	Arr['Accion']			= "CondicionFisica";
	
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
					console.log(response);	
					var objJSON = eval("(function(){return " + response + ";})()");
					if(condicion=objJSON.Resultado=="Fuera de rango")
					{
						$('#TituloPrueba').append($('<form id="FormError" action="index.php?nav=Error" method="post"></form>'));
						$("#FormError").append('<input type="hidden" name="Tipo_Prueba" value="'+objJSON.Tipo_Prueba+'">');
						$("#FormError").append('<input type="hidden" name="Id_Cliente" value="'+objJSON.id_cliente+'">');
						$("#FormError").append('<input type="hidden" name="ResultadoEvaluado" value="'+objJSON.Resultado_Evaluado+'">');
						$("#FormError").submit();
					}
					else {
					//Tomando la variable y asignando el largo y color de la barra
					condicion=objJSON.Condicion; //Asignando el tipo de condición que obtuvo la persona
					$("#ConsejoTexto").text(objJSON.Consejo); //Asignando el consejo que se le da al cliente acorde el resultado.
					$("#CondicionTitulo").text("Condición: "+condicion); //Poniendo el título obtenido en la prueba en la cabecera de la prueba actual.
					// Pegando botón de siguiente prueba
					$("#BotonPrueba").append('<button type="button" class="btn btn-success" onclick="Prueba2('+Id_Cliente+')">Siguiente Prueba</button>');
					switch(condicion)
					{
						case 'Atleta':
							$("#ProgresBarResultado").addClass("progress-bar-success");
							$("#ProgresBarResultado").css("width","100%");
						break;
						
						case 'Excelente':
							$("#ProgresBarResultado").addClass("progress-bar-success");
							$("#ProgresBarResultado").css("width","80%");
						break;
						
						case 'Bueno':
							$("#ProgresBarResultado").css("width","60%");
						break;
						
						case 'Promedio':
							$("#ProgresBarResultado").addClass("progress-bar-warning");
							$("#ProgresBarResultado").css("width","40%");
						break;
						
						case 'Pobre':
							$("#ProgresBarResultado").addClass("progress-bar-danger");
							$("#ProgresBarResultado").css("width","20%");
						break;
					}//switch
					
					//Tomando los resultados de las pruebas
					pruebas=objJSON.Resultados;
					//Valores de la prueba 3
					fecha3=pruebas[0].Fecha;
					resultado3=pruebas[0].Porcentaje;
					
					//valores de la prueba 2
					if(pruebas[1].Fecha!=0){fecha2=pruebas[1].Fecha}else{fecha2="BioTest No Hecho"} 
					resultado2=(pruebas[1].Porcentaje1!=0)?pruebas[1].Porcentaje:0;
					
					//valores de la prueba 3
					fecha1=(pruebas[2].Fecha!=0)?pruebas[2].Fecha:"BioTest No Hecho";
					resultado1=(pruebas[2].Porcentaje1!=0)?pruebas[2].Porcentaje:0;
					
					TituloPrueba="Resultados Condición Física";
					categoria="Condición Física";
					//tomando los valores que se les van a indicar a la gráfica
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
                categories: [categoria],
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
                name: fecha1,
                data: [parseInt(resultado1)]
            }, {
                name: fecha2,
                data: [parseInt(resultado2)]
            }, {
                name: fecha3,
                data: [parseInt(resultado3)]
            }]	
			};
					$("script[src='js/AdminLTE/app.js']").remove();
			
					 $(function () {
						$('#GraficaResultados').highcharts(options);
					});
					
					$('g.highcharts-legend').attr('transform','translate(217,55)'); //Cambiando de lugar el cuadro de explicación de la gráfica
					
					PegarScriptMenu(); //Trayendo de vuelta el script de menu. Función declarada bajo el document ready de este archivo
					}//else
				}//response
				
			});	//ajax
			
			
				//$.ajax("modulos/Biotest/Funciones.php?Params="+Params+"&de_imagen="+de_imagen).then(function(response){var objJSON = eval("(function(){return " + response + ";})()");})
				
}//TestCondicion


function TestPeso(Id_Cliente, ResultadoEvaluado)
{
	//Ponerle el título al Test
	$("#TituloPrueba").text("Peso");
	var Arr=new Object();	
	Arr['Id_Cliente']		= Id_Cliente;
	Arr['peso']				= $("#peso").val();
	Arr['Altura']			= $("#Altura").val();
	Arr['id_instructor']	= id_instructor;
	Arr['Accion']			= "Peso";
	
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
					$("#BotonPrueba").append('<button type="button" class="btn btn-success" onclick="Prueba3('+Id_Cliente+')">Siguiente Prueba</button>');
					console.log(response);	
					var objJSON = eval("(function(){return " + response + ";})()");
					//Tomando la variable y asignando el largo y color de la barra
					condicion=objJSON.Condicion; //Asignando el tipo de condición que obtuvo la persona
					
					//Haciendo la verificación de las pruebas
					if(condicion=="Fuera de rango")
					{
						//si entra es por que se anotó mal un número
						$('#TituloPrueba').append($('<form id="FormError" action="index.php?nav=Error" method="post"></form>'));
						$("#FormError").append('<input type="hidden" name="Tipo_Prueba" value="'+objJSON.TipoPrueba+'">');
						$("#FormError").append('<input type="hidden" name="Id_Cliente" value="'+objJSON.id_cliente+'">');
						$("#FormError").append('<input type="hidden" name="Altura" value="'+objJSON.Altura+'">');
						$("#FormError").append('<input type="hidden" name="peso" value="'+objJSON.peso+'">');
						$("#FormError").submit();
					}
					else{
					Porcentaje=objJSON.Porcentaje; //Porcentaje de resultado de la prueba de peso.
					$("#ConsejoTexto").text(objJSON.Consejo); //Asignando el consejo que se le da al cliente acorde el resultado.
					$("#CondicionTitulo").text("Condición: "+condicion); //Poniendo el título obtenido en la prueba en la cabecera de la prueba actual.
					switch(Porcentaje)
					{
						case 100:
							$("#ProgresBarResultado").addClass("progress-bar-success");
							$("#ProgresBarResultado").css("width","100%");
						break;
						
						case 60:
							$("#ProgresBarResultado").addClass("progress-bar-success");
							$("#ProgresBarResultado").css("width","60%");
						break;
						
						case 20:
							$("#ProgresBarResultado").css("width","20%");
						break;
					}//switch
					
					PegarScriptMenu(); //Trayendo de vuelta el script de menu. Función declarada bajo el document ready de este archivo
					
					//Gráficas de javascript
					//Tomando los resultados de las pruebas
					pruebas=objJSON.Resultados;
					//Valores de la prueba 3
					fecha3=pruebas[0].Fecha;
					resultado3=pruebas[0].Porcentaje;
					
					//valores de la prueba 2
					if(pruebas[1].Fecha!=0){fecha2=pruebas[1].Fecha}else{fecha2="BioTest No Hecho"} 
					resultado2=(pruebas[1].Porcentaje1!=0)?pruebas[1].Porcentaje:0;
					
					//valores de la prueba 3
					fecha1=(pruebas[2].Fecha!=0)?pruebas[2].Fecha:"BioTest No Hecho";
					resultado1=(pruebas[2].Porcentaje1!=0)?pruebas[2].Porcentaje:0;
					
					TituloPrueba="Resultados Peso";
					categoria="Peso";
					//tomando los valores que se les van a indicar a la gráfica
					options=ObtenerOptions(fecha3,resultado3,fecha2,resultado2,fecha1,resultado1,TituloPrueba,categoria);
					$(function () {
						$('#GraficaResultados').highcharts(options);
					});
					
					$('g.highcharts-legend').attr('transform','translate(217,55)'); //Cambiando de lugar el cuadro de explicación de la gráfica
				 }//else
				}//response
			});//ajax
}//testpeso

function IMC(Id_Cliente,ResultadoEvaluado)
{
	//Ponerle el título al Test
	$("#TituloPrueba").text("IMC");
	var Arr=new Object();	
	Arr['Id_Cliente']		= Id_Cliente;
	Arr['peso']				= $("#peso").val();
	Arr['Altura']			= $("#Altura").val();
	Arr['id_instructor']	= id_instructor;
	Arr['Accion']			= "IMC";
	
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
					$("#BotonPrueba").append('<button type="button" class="btn btn-success" onclick="Prueba4('+Id_Cliente+')">Siguiente Prueba</button>');
					console.log(response);	
					var objJSON = eval("(function(){return " + response + ";})()");
					console.log(objJSON);
					//Tomando la variable y asignando el largo y color de la barra
					condicion=objJSON.Condicion; //Asignando el tipo de condición que obtuvo la persona
					if(condicion=="Fuera de rango")
					{
						//si entra es por que se anotó mal un número
						$('#TituloPrueba').append($('<form id="FormError" action="index.php?nav=Error" method="post"></form>'));
						$("#FormError").append('<input type="hidden" name="Tipo_Prueba" value="'+objJSON.TipoPrueba+'">');
						$("#FormError").append('<input type="hidden" name="Id_Cliente" value="'+objJSON.id_cliente+'">');
						$("#FormError").append('<input type="hidden" name="Altura" value="'+objJSON.Altura+'">');
						$("#FormError").append('<input type="hidden" name="peso" value="'+objJSON.peso+'">');
						$("#FormError").submit();
					}else{
					Porcentaje=objJSON.Porcentaje; //Porcentaje de resultado de la prueba de peso.
					$("#ConsejoTexto").text(objJSON.Consejo); //Asignando el consejo que se le da al cliente acorde el resultado.
					$("#CondicionTitulo").text("Condición: "+condicion); //Poniendo el título obtenido en la prueba en la cabecera de la prueba actual.
					switch(Porcentaje)
					{
						case 100:
							$("#ProgresBarResultado").addClass("progress-bar-success");
							$("#ProgresBarResultado").css("width","100%");
						break;
						
						case 60:
							$("#ProgresBarResultado").addClass("progress-bar-success");
							$("#ProgresBarResultado").css("width","60%");
						break;
						
						case 20:
						$("#ProgresBarResultado").addClass("progress-bar-danger");
							$("#ProgresBarResultado").css("width","20%");
						break;
					}//switch
					
					PegarScriptMenu(); //Trayendo de vuelta el script de menu. Función declarada bajo el document ready de este archivo
					
					//Gráficas de javascript
					//Tomando los resultados de las pruebas
					pruebas=objJSON.Resultados;
					//Valores de la prueba 3
					fecha3=pruebas[0].Fecha;
					resultado3=pruebas[0].Porcentaje;
					
					//valores de la prueba 2
					if(pruebas[1].Fecha!=0){fecha2=pruebas[1].Fecha}else{fecha2="BioTest No Hecho"} 
					resultado2=(pruebas[1].Porcentaje1!=0)?pruebas[1].Porcentaje:0;
					
					//valores de la prueba 3
					fecha1=(pruebas[2].Fecha!=0)?pruebas[2].Fecha:"BioTest No Hecho";
					resultado1=(pruebas[2].Porcentaje1!=0)?pruebas[2].Porcentaje:0;
					
					TituloPrueba="Resultados IMC";
					categoria="IMC";
					//tomando los valores que se les van a indicar a la gráfica
					options=ObtenerOptions(fecha3,resultado3,fecha2,resultado2,fecha1,resultado1,TituloPrueba,categoria);
					$(function () {
						$('#GraficaResultados').highcharts(options);
					});
					
					$('g.highcharts-legend').attr('transform','translate(217,55)'); //Cambiando de lugar el cuadro de explicación de la gráfica
					}//else
				}//success
	});//ajax
}

function TestStamina(Id_Cliente, ResultadoEvaluado)
{
	//Ponerle el título al Test
	$("#TituloPrueba").text("Peso");
	var Arr=new Object();	
	Arr['Id_Cliente']		= Id_Cliente;
	Arr['repeticiones']		= $("#repeticiones").val();
	Arr['id_instructor']	= id_instructor;
	Arr['Accion']			= "Stamina";
	
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
					$("#BotonPrueba").append('<button type="button" class="btn btn-success" onclick="Prueba6('+Id_Cliente+')">Siguiente Prueba</button>');
					$("#PruebaInfo").text("Stamina"); //Info de la prueba en el menú superior.
					
					console.log(response);	
					var objJSON = eval("(function(){return " + response + ";})()");
					//Tomando la variable y asignando el largo y color de la barra
					condicion=objJSON.Condicion; //Asignando el tipo de condición que obtuvo la persona
					Porcentaje=objJSON.Porcentaje; //Porcentaje de resultado de la prueba de peso.
					$("#ConsejoTexto").text(objJSON.Consejo); //Asignando el consejo que se le da al cliente acorde el resultado.
					$("#CondicionTitulo").text("Condición: "+condicion); //Poniendo el título obtenido en la prueba en la cabecera de la prueba actual.
					switch(Porcentaje)
					{
						case 100:
							$("#ProgresBarResultado").addClass("progress-bar-success");
							$("#ProgresBarResultado").css("width","100%");
						break;
						
						case 80:
							$("#ProgresBarResultado").addClass("progress-bar-success");
							$("#ProgresBarResultado").css("width","80%");
						break;
						
						case 60:
							$("#ProgresBarResultado").css("width","60%");
						break;
						
						case 40:
							$("#ProgresBarResultado").addClass("progress-bar-warning");
							$("#ProgresBarResultado").css("width","40%");
						break;
						
						case 20:
							$("#ProgresBarResultado").addClass("progress-bar-danger");
							$("#ProgresBarResultado").css("width","20%");
						break;
					}//switch
					
					PegarScriptMenu(); //Trayendo de vuelta el script de menu. Función declarada bajo el document ready de este archivo
					
					//Gráficas de javascript
					//Tomando los resultados de las pruebas
					pruebas=objJSON.Resultados;
					console.log(pruebas);
					//Valores de la prueba 3
					fecha3=pruebas[0].Fecha;
					resultado3=pruebas[0].Porcentaje;
					
					//valores de la prueba 2
					if(pruebas[1].Fecha!=0){fecha2=pruebas[1].Fecha}else{fecha2="BioTest No Hecho"} 
					resultado2=(pruebas[1].Porcentaje1!=0)?pruebas[1].Porcentaje:0;
					
					//valores de la prueba 3
					fecha1=(pruebas[2].Fecha!=0)?pruebas[2].Fecha:"BioTest No Hecho";
					resultado1=(pruebas[2].Porcentaje1!=0)?pruebas[2].Porcentaje:0;
					
					TituloPrueba="Resultados Stamina";
					categoria="Stamina";
					//tomando los valores que se les van a indicar a la gráfica
					options=ObtenerOptions(fecha3,resultado3,fecha2,resultado2,fecha1,resultado1,TituloPrueba,categoria);
					$(function () {
						$('#GraficaResultados').highcharts(options);
					});
					
					$('g.highcharts-legend').attr('transform','translate(217,55)'); //Cambiando de lugar el cuadro de explicación de la gráfica
				}//response
			});//ajax
}//Test STamina


function Fuerza(Id_Cliente, ResultadoEvaluado)
{
	//Ponerle el título al Test
	$("#TituloPrueba").text("Fuerza");
	var Arr=new Object();	
	Arr['Id_Cliente']		= Id_Cliente;
	Arr['repeticiones']		= $("#repeticiones").val();
	Arr['id_instructor']	= id_instructor;
	Arr['Accion']			= "Fuerza";
	
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
					$("#BotonPrueba").append('<button type="button" class="btn btn-success" onclick="Prueba7('+Id_Cliente+')">Siguiente Prueba</button>');
					$("#PruebaInfo").text("Fuerza"); //Info de la prueba en el menú superior.
					
					console.log(response);	
					var objJSON = eval("(function(){return " + response + ";})()");
					console.log(objJSON);
					//variales
					Condicion=objJSON.Condicion;
					Porcentaje=objJSON.Porcentaje;
					$("#ConsejoTexto").text(objJSON.Consejo); //Asignando el consejo que se le da al cliente acorde el resultado.
					$("#CondicionTitulo").text("Condición: "+Condicion); //Poniendo el título obtenido en la prueba en la cabecera de la prueba actual.
					switch(Porcentaje)
					{
						case 100:
							$("#ProgresBarResultado").addClass("progress-bar-success");
							$("#ProgresBarResultado").css("width","100%");
						break;
						
						case 80:
							$("#ProgresBarResultado").addClass("progress-bar-success");
							$("#ProgresBarResultado").css("width","80%");
						break;
						
						case 60:
							$("#ProgresBarResultado").css("width","60%");
						break;
						
						case 40:
							$("#ProgresBarResultado").addClass("progress-bar-warning");
							$("#ProgresBarResultado").css("width","40%");
						break;
						
						case 20:
							$("#ProgresBarResultado").addClass("progress-bar-danger");
							$("#ProgresBarResultado").css("width","20%");
						break;
					}//switch
					
					PegarScriptMenu(); //Trayendo de vuelta el script de menu. Función declarada bajo el document ready de este archivo
					
					//Gráficas de javascript
					//Tomando los resultados de las pruebas
					pruebas=objJSON.Resultados;
					console.log(pruebas);
					//Valores de la prueba 3
					fecha3=pruebas[0].Fecha;
					resultado3=pruebas[0].Porcentaje;
					
					//valores de la prueba 2
					if(pruebas[1].Fecha!=0){fecha2=pruebas[1].Fecha}else{fecha2="BioTest No Hecho"} 
					resultado2=(pruebas[1].Porcentaje1!=0)?pruebas[1].Porcentaje:0;
					
					//valores de la prueba 3
					fecha1=(pruebas[2].Fecha!=0)?pruebas[2].Fecha:"BioTest No Hecho";
					resultado1=(pruebas[2].Porcentaje1!=0)?pruebas[2].Porcentaje:0;
					
					TituloPrueba="Resultados Fuerza";
					categoria="Fuerza";
					//tomando los valores que se les van a indicar a la gráfica
					options=ObtenerOptions(fecha3,resultado3,fecha2,resultado2,fecha1,resultado1,TituloPrueba,categoria);
					$(function () {
						$('#GraficaResultados').highcharts(options);
					});
					
					$('g.highcharts-legend').attr('transform','translate(217,55)'); //Cambiando de lugar el cuadro de explicación de la gráfica
					
				}//response
			});//ajax
}//Test STamina

function Resistencia(Id_Cliente, ResultadoEvaluado)
{
	
	//Ponerle el título al Test
	$("#TituloPrueba").text("Resistencia");
	var Arr=new Object();	
	Arr['Id_Cliente']		= Id_Cliente;
	Arr['repeticiones']		= $("#repeticiones").val();
	Arr['id_instructor']	= id_instructor;
	Arr['Accion']			= "Resistencia";
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
					$("#BotonPrueba").append('<button type="button" class="btn btn-success" onclick="Prueba8('+Id_Cliente+')">Siguiente Prueba</button>');
					$("#PruebaInfo").text("Resistencia"); //Info de la prueba en el menú superior.
					console.log(response);	
					var objJSON = eval("(function(){return " + response + ";})()");
					console.log(objJSON);
					//variales
					Condicion=objJSON.Condicion;
					Porcentaje=objJSON.Porcentaje;
					$("#ConsejoTexto").text(objJSON.Consejo); //Asignando el consejo que se le da al cliente acorde el resultado.
					$("#CondicionTitulo").text("Condición: "+Condicion); //Poniendo el título obtenido en la prueba en la cabecera de la prueba actual.
					switch(Porcentaje)
					{
						case 100:
							$("#ProgresBarResultado").addClass("progress-bar-success");
							$("#ProgresBarResultado").css("width","100%");
						break;
						
						case 80:
							$("#ProgresBarResultado").addClass("progress-bar-success");
							$("#ProgresBarResultado").css("width","80%");
						break;
						
						case 60:
							$("#ProgresBarResultado").css("width","60%");
						break;
						
						case 40:
							$("#ProgresBarResultado").addClass("progress-bar-warning");
							$("#ProgresBarResultado").css("width","40%");
						break;
						
						case 20:
							$("#ProgresBarResultado").addClass("progress-bar-danger");
							$("#ProgresBarResultado").css("width","20%");
						break;
					}//switch
					PegarScriptMenu(); //Trayendo de vuelta el script de menu. Función declarada bajo el document ready de este archivo
					
					//Gráficas de javascript
					//Tomando los resultados de las pruebas
					pruebas=objJSON.Resultados;
					console.log(pruebas);
					//Valores de la prueba 3
					fecha3=pruebas[0].Fecha;
					resultado3=pruebas[0].Porcentaje;
					
					//valores de la prueba 2
					if(pruebas[1].Fecha!=0){fecha2=pruebas[1].Fecha}else{fecha2="BioTest No Hecho"} 
					resultado2=(pruebas[1].Porcentaje1!=0)?pruebas[1].Porcentaje:0;
					
					//valores de la prueba 3
					fecha1=(pruebas[2].Fecha!=0)?pruebas[2].Fecha:"BioTest No Hecho";
					resultado1=(pruebas[2].Porcentaje1!=0)?pruebas[2].Porcentaje:0;
					
					TituloPrueba="Resultados Resistencia";
					categoria="Resistencia";
					//tomando los valores que se les van a indicar a la gráfica
					options=ObtenerOptions(fecha3,resultado3,fecha2,resultado2,fecha1,resultado1,TituloPrueba,categoria);
					$(function () {
						$('#GraficaResultados').highcharts(options);
					});
					
					$('g.highcharts-legend').attr('transform','translate(217,55)'); //Cambiando de lugar el cuadro de explicación de la gráfica
				}//response
			});//ajax
			
}//Resistencia

function Flexibilidad(Id_Cliente, ResultadoEvaluado)
{
		//Ponerle el título al Test
	$("#TituloPrueba").text("Flexibilidad");
	var Arr=new Object();	
	Arr['Id_Cliente']		= Id_Cliente;
	Arr['Flexibilidad']		= $("#repeticiones").val();
	Arr['id_instructor']	= id_instructor;
	Arr['Accion']			= "Flexibilidad";
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
					$("#BotonPrueba").append('<button type="button" class="btn btn-success" onclick="Resultados('+Id_Cliente+')">Enviar Resultados</button>');
					$("#PruebaInfo").text("Flexibilidad"); //Info de la prueba en el menú superior.
					console.log(response);	
					var objJSON = eval("(function(){return " + response + ";})()");
					console.log(objJSON);
				Condicion=objJSON.Condicion;
					Porcentaje=objJSON.Porcentaje;
					$("#ConsejoTexto").text(objJSON.Consejo); //Asignando el consejo que se le da al cliente acorde el resultado.
					$("#CondicionTitulo").text("Condición: "+Condicion); //Poniendo el título obtenido en la prueba en la cabecera de la prueba actual.
					switch(Porcentaje)
					{
						case 100:
							$("#ProgresBarResultado").addClass("progress-bar-success");
							$("#ProgresBarResultado").css("width","100%");
						break;
						
						case 80:
							$("#ProgresBarResultado").addClass("progress-bar-success");
							$("#ProgresBarResultado").css("width","80%");
						break;
						
						case 60:
							$("#ProgresBarResultado").css("width","60%");
						break;
						
						case 40:
							$("#ProgresBarResultado").addClass("progress-bar-warning");
							$("#ProgresBarResultado").css("width","40%");
						break;
						
						case 20:
							$("#ProgresBarResultado").addClass("progress-bar-danger");
							$("#ProgresBarResultado").css("width","20%");
						break;
					}//switch
					PegarScriptMenu(); //Trayendo de vuelta el script de menu. Función declarada bajo el document ready de este archivo
					
					//Gráficas de javascript
					//Tomando los resultados de las pruebas
					pruebas=objJSON.Resultados;
					console.log(pruebas);
					//Valores de la prueba 3
					fecha3=pruebas[0].Fecha;
					resultado3=pruebas[0].Porcentaje;
					
					//valores de la prueba 2
					if(pruebas[1].Fecha!=0){fecha2=pruebas[1].Fecha}else{fecha2="BioTest No Hecho"} 
					resultado2=(pruebas[1].Porcentaje1!=0)?pruebas[1].Porcentaje:0;
					
					//valores de la prueba 3
					fecha1=(pruebas[2].Fecha!=0)?pruebas[2].Fecha:"BioTest No Hecho";
					resultado1=(pruebas[2].Porcentaje1!=0)?pruebas[2].Porcentaje:0;
					
					TituloPrueba="Resultados Flexibilidad";
					categoria="Flexibilidad";
					//tomando los valores que se les van a indicar a la gráfica
					options=ObtenerOptions(fecha3,resultado3,fecha2,resultado2,fecha1,resultado1,TituloPrueba,categoria);
					$(function () {
						$('#GraficaResultados').highcharts(options);
					});
					
					$('g.highcharts-legend').attr('transform','translate(217,55)'); //Cambiando de lugar el cuadro de explicación de la gráfica
				}//response
			});//ajax
}//Flexibilidad


function ObtenerOptions(fecha3,resultado3,fecha2,resultado2,fecha1,resultado1,TituloPrueba,categoria)
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
                categories: [categoria],
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
                name: fecha1,
                data: [parseInt(resultado1)]
            }, {
                name: fecha2,
                data: [parseInt(resultado2)]
            }, {
                name: fecha3,
                data: [parseInt(resultado3)]
            }]	
			};
			return options;	
} //optoins


//Función que redirije a la prueba 2, la de peso.
function Prueba2(id_cliente)
{
		var confirmacion = confirm('¿Está seguro que desea pasar a la siguiente prueba?');
		if(confirmacion == true){ window.location='index.php?nav=Peso&id='+id_cliente;}
}

function Prueba3(id_cliente)
{
	var confirmacion = confirm('¿Está seguro que desea pasar a la siguiente prueba?');
		if(confirmacion == true){
		
			window.location='index.php?nav=IMC&id='+id_cliente;		
		}//if
}//prueba3


function Prueba4(id_cliente)
{
	var confirmacion = confirm('¿Está seguro que desea pasar a la siguiente prueba?');
		if(confirmacion == true){window.location='index.php?nav=Masa&id='+id_cliente;}
}//Prueba4

function Prueba6(id_cliente)
{
	var confirmacion = confirm('¿Está seguro que desea pasar a la siguiente prueba?');
		if(confirmacion == true){window.location='index.php?nav=Fuerza&id='+id_cliente;}
}

function Prueba7(id_cliente)
{
	var confirmacion = confirm('¿Está seguro que desea pasar a la siguiente prueba?');
		if(confirmacion == true){window.location='index.php?nav=Resistencia&id='+id_cliente;}
}

function Prueba8(id_cliente)
{
	var confirmacion = confirm('¿Está seguro que desea pasar a la siguiente prueba?');
		if(confirmacion == true){window.location='index.php?nav=Flexibilidad&id='+id_cliente;}
}

function Resultados(id_cliente)
{
	var confirmacion = confirm('¿Está seguro que desea Enviar los resultados?');
		if(confirmacion == true){
			EnviarResultadosBiotest();				
		}
}//Resultados

function EnviarResultadosBiotest()
{
	
	$("#pleaseWaitDialog").modal('show');
	//Creando el array de objetos para mandarlo al Controller Funciones
	var Arr = new Object();	
	Arr['Id_Cliente']		  = Id_Cliente;
	Arr['Accion']			  = "CrearPdf";
	console.log(Arr);
	var Params= JSON.stringify(Arr);
	
	//Enviar los datos de las imágenes y del cliente al apartado del PDF
	$.ajax("modulos/Biotest/CrearPdf.php?Params="+Params).then(function(response)
	{	
		$("#pleaseWaitDialog").modal("hide");
		window.location = "index.php?nav=BioTest_Resultado&id_cliente="+Id_Cliente;
	})//ajax
}//EnviarResultadosBiotest



//Esta función se dejó por si acaso s enecesitaba tomar algo de código.
function EnviarResultadosBiotest2()
{
	
	//Creando el array de objetos para mandarlo al Controller Funciones
	var Arr = new Object();	
	Arr['Id_Cliente']		  = Id_Cliente;
	Arr['Accion']			  = "CrearPdf";
	console.log(Arr);
	var Params= JSON.stringify(Arr);
	
	//Enviar los datos de las imágenes y del cliente al apartado del PDF
	$.ajax("modulos/Biotest/pdf/htmle.php?Params="+Params).then(function(response)
	{	
		Params = 0;
		//Se hace en dos pasos para que la llamada  aservidor no sea tan larga 
		var objJSON = eval("(function(){return " + response + ";})()");
		//Tomando los datos y mandándolos al controller del mailing
		pdf_name 		= objJSON.pdf_name;
		de_email  		= objJSON.de_email;
		nombre_completo = objJSON.nombre_completo;
		var Arr2 = new Object();	
		Arr2['pdf_name']	    = pdf_name;
		Arr2['de_email']	  	= de_email;
		Arr2['nombre_completo'] = nombre_completo;
		Arr2['Accion']		    = "EnviarResultados";
		var Params= JSON.stringify(Arr2);
		
		$.ajax("modulos/Biotest/pdf/htmle.php?Params="+Params).then(function(response)
		{
			//Cerrando el modal y redirigiendo
			$("#pleaseWaitDialog").modal('hide');
			window.location='index.php?nav=BioTest_Resultado';	
		})//ajax
		
	})//ajax
	
}//EnviarResultadosBiotest

</script>
<script src="js/charts/highcharts.js"></script>
<script src="js/charts/exporting.js"></script>