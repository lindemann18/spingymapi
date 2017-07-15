angular.module('AppClientes',['ngRoute','angularUtils.directives.dirPagination','Methods','ngCookies'])

.controller('Clientes',function($scope,$http,$location,$methodsService){
//Variables 
$scope.currentPage     = 1; // Página actual, para paginación
$scope.pageSize 	   = 5;   // Tamaño de la página, para paginación.
$scope.mostrarbuscando = true;	
$scope.mostrarcontent  = false;	
$scope.showfilter      = false;
$scope.clitr           = 0;

//Funciones
$scope.AplicarBiotest = function(id)
{
	
		bootbox.confirm("Desea aplicar el biotest a este cliente?", function(result) {
		console.log(result);
	  	if(result==true)
	  	{
	  		$scope.$apply(function(){
	  			$location.path('/BiotestMenu').search({Cliente:id});
	  		});
	  	}//if
	});
	
}//AplicarBiotest

$scope.RutinaCliente = function(id)
{
	bootbox.confirm("Desea ir al apartado de rutinas para clientes?", function(result) {
		console.log(result);
	  	if(result==true)
	  	{
	  		$scope.$apply(function(){
	  			$location.path('/ClientesRutina').search({id:id});
	  		});
	  	}//if
	});
}//RutinaCliente

$scope.Selecciontr = function(tr)
{
	//Verificando que no se le hizo click al mismo tr
	if(tr.cli.id == $scope.clitr)
	{
		//Si es el mismo tr se le asigna un 0.
		$scope.clitr = 0;
		idtr = "#table"+tr.cli.id;
		$(idtr).removeClass("bg-blue");
		console.log($scope.clitr);
	}//if
	else
	{
		$("tr").removeClass("bg-blue");
		$scope.clitr = tr.cli.id;
		idtr          = "#table"+tr.cli.id;
		$(idtr).addClass("bg-blue");
		console.log($scope.clitr);
	}
	
	//añadiendo la clase al tr
}//Selecciontr

$scope.Agregar = function()
{
	bootbox.confirm("Desea Agregar un Cliente?", function(result) {
		console.log(result);
	  	if(result==true)
	  	{
	  		$scope.$apply(function(){
	  			$location.path('/AgregarCliente').search({});
	  		});
	  	}//if
	});
}//Agregar

$scope.Editar = function()
{	
	if($scope.clitr!=0)
	{
		bootbox.confirm("Desea Editar este Cliente?", function(result) {
		console.log(result);
	  	if(result==true)
	  	{
	  		$scope.$apply(function(){
	  			$location.path('/EditarCliente').search({cliente:$scope.clitr});
	  		});
	  	}//if
	});
	}//if
	else{$methodsService.alerta(2,"Favor de seleccionar un Cliente");}
}//Agregar

$scope.Eliminar = function()
{
	if($scope.clitr!=0)
	{
		bootbox.confirm("Desea Editar este Cliente?", function(result) {
		console.log(result);
	  	if(result==true)
	  	{
	  		$scope.$apply(function(){
	  			params = $methodsService.Json("EliminarCliente",$scope.clitr);
	  			//Enviando por ajax la peetición
	  			var url = 'modulos/Clientes/Funciones.php';
				 $http({method: "post",url: url,data: $.param({Params:params}), 
				  headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
				})
				 .success(function(data, status, headers, config) 
				 {          	
				   		exito    = data.exito;
				   		exitocli = data.exitocli;
			         	
			         	switch(true)
			         	{
			         		case exito==1 && exitocli==1:
			         			$scope.clientes = data.clientes;
			         			$methodsService.alerta(1,"Cliente Eliminado");
			         		break;

			         		case exito!=1 && exitocli!=1:
			         			$methodsService.alerta(2,"algo falló, disculpe las molestias");
			         		break;
			         	}//switch
				  })  
				 .error(function(data, status, headers, config){
				 	$methodsService.alerta(2,"algo falló, disculpe las molestias");
				 });
	  		});
	  	}//if
	});
	}//if
	else{$methodsService.alerta(2,"Favor de seleccionar un Cliente");}
}//Eliminar

$scope.Filtrar = function()
{
	params = $methodsService.Json("FiltrarClientes",$scope.cliente.opcion);
	//Filtrando los clientes.
	var url = 'modulos/Clientes/Funciones.php';
				 $http({method: "post",url: url,data: $.param({Params:params}), 
				  headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
				})
				 .success(function(data, status, headers, config) 
				 {          	
				   		exito = data.exito;
				   		if(exito==1)
				   		{
				   			$scope.clientes = data.clientes;
				   			$methodsService.alerta(1,"Clientes Filtrados!");
				   		}//if
				   		else{$methodsService.alerta(2,"algo falló, disculpe las molestias");}
				  })  
				 .error(function(data, status, headers, config){
				 	$methodsService.alerta(2,"algo falló, disculpe las molestias");
				 });
}//Filtrar

$scope.form = function(cliente)
{
	bootbox.confirm("Desea realizar el formulario a este cliente?", function(result) {
		console.log(result);
	  	if(result==true)
	  	{
	  		$scope.$apply(function(){
	  			$location.path('/Formulario').search({cliente:cliente});
	  		});
	  	}//if
	});
}

//Buscando los clientes
//Buscando las pruebas por la número 1, condición física
params = $methodsService.Json("Clientes",1);
var url = 'modulos/Clientes/Funciones.php';
     $http({method: "post",url: url,data: $.param({Params:params}), 
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    })
     .success(function(data, status, headers, config) 
     {          	
       		exito    = data.exito;
       		exitoent = data.exito;

       		switch(true)
       		{
       			case exito==1 && exitoent==1:
       				$scope.clientes        = data.clientes;
       				$scope.entrenadores    = data.entrenadores;
	       			$scope.mostrarbuscando = false;	
					$scope.mostrarcontent  = true;
					console.log($scope.entrenadores);
       			break;

       			case exito!=1 && exitoent!=1:
       				$methodsService.alerta(2,"algo falló, disculpe las molestias");
       			break;
       		}//switch
       		if(exito==1)
       		{
       			
	
       		}//if
       		else{$methodsService.alerta(2,"algo falló, disculpe las molestias");}
       		
      })  
     .error(function(data, status, headers, config){
     	$methodsService.alerta(2,"algo falló, disculpe las molestias");
     });
})//Clientes


.controller('ClientesAgregar',function($scope,$http,$location,$methodsService){

	//Generando los datos para el formulario

	//Días
	$scope.dias = $methodsService.dias();
	
	//meses
	$scope.meses =$methodsService.meses();

	//años
	$scope.years = $methodsService.years();
	
	//Variable para desactivar el botón de agregar
	$scope.btnen = true;

	//funciones
	$scope.Agregar = function()	
	{
		//verificando el tipo de cuerpo
		if($scope.cliente.id_cuerpo==	undefined)
		{
			bootbox.confirm("Favor de elegir un tipo de cuerpo", function(result) {}); //bootbox
		}
		else
		{
			bootbox.confirm("Desea Agregar un tipo de rutina?", function(result) {
			console.log(result);
		  	if(result==true)
		  	{
		  		$scope.btnen = false;
				//Mandando la petición AJAX al controller.
				$scope.cliente.Accion = "AgregarCliente";
				params  = JSON.stringify($scope.cliente);
	  			var url = 'modulos/Clientes/Funciones.php';
		         $http({method: "post",url: url,data: $.param({Params:params}), 
		          headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
		        })
		         .success(function(data, status, headers, config) 
		         {          	
		         	exito = data.exito;
		         	if(exito==1)
		         	{
		         		$methodsService.alerta(1,"Cliente Agregado!");
		         		$scope.cliente = {};
		         		$scope.btnen = true;
		         	}else{$methodsService.alerta(2,"algo falló, disculpe las molestias");}
		          })  
		         .error(function(data, status, headers, config){
		         	$methodsService.alerta(2,"algo falló, disculpe las molestias");
		         });
	     	}//if
	     });//botbox
		}//else
	}//Agregar

	$scope.modal = function()
	{
		$("#ModalCuerpo").modal("show");
	}//modal

	$scope.Redirigir = function(direccion)
	{
		$methodsService.Redirigir(direccion);
	}//Redirigir

})

.controller('ClientesEditar',function($scope,$http,$location,$methodsService,$routeParams){
//Variables
//Días
$scope.dias = $methodsService.dias();
//meses
$scope.meses =$methodsService.meses();
//años
$scope.years = $methodsService.years();
//Variable para desactivar el botón de agregar
$scope.btnen = true;
//Funciones
$scope.modal = function()
{
	$("#ModalCuerpo").modal("show");
}//modal

$scope.Editar = function()
{
	bootbox.confirm("Desea Editar este cliente?", function(result) {
		console.log(result);
	  	if(result==true)
	  	{
	  		$scope.btnen 		  = false;
	  		$scope.cliente.Accion = "Editarcliente";
	  		params   			  = JSON.stringify($scope.cliente);
	  		var url = 'modulos/Clientes/Funciones.php';
		         $http({method: "post",url: url,data: $.param({Params:params}), 
		          headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
		        })
		         .success(function(data, status, headers, config) 
		         {          	
			         	exito = data.exito;
			         	if(exito==1)
			         	{
			         		$methodsService.alerta(1,"Cliente Editado");
			         		$scope.btnen = true;
			         	}else{$methodsService.alerta(2,"algo falló, disculpe las molestias");}
		          })  
		         .error(function(data, status, headers, config){
		         	$methodsService.alerta(2,"algo falló, disculpe las molestias");
		         });
	  	}//if
	});//bootbox
}//Editar

$scope.Redirigir = function(direccion)
	{
		$methodsService.Redirigir(direccion);
	}//Redirigir

$scope.id = $routeParams.cliente;
params    = $methodsService.Json("InfoCliente",$scope.id);
//Mandando por ajax el ejercicio a eliminar
  		var url = 'modulos/Clientes/Funciones.php';
	     $http({method: "post",url: url,data: $.param({Params:params}), 
	      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
	    })
	     .success(function(data, status, headers, config) 
	     {          	
	       		exito = data.exito;
	       		if(exito==1)
	       		{
	       			$scope.cliente = data.cliente;
	       			console.log($scope.cliente);
	       		}//if
	       		else{$methodsService.alerta(2,"algo falló, disculpe las molestias");}
	      })  
	     .error(function(data, status, headers, config){
	     	$methodsService.alerta(2,"algo falló, disculpe las molestias");
	     });
})//ClientesEditar

.controller('formcontroller',function($scope,$http,$location,$methodsService,$routeParams,respservice,$cookies){
//Variables
$scope.cliente = $routeParams.cliente;
params    = $methodsService.Json("InfoFormulario",$scope.cliente);
$scope.mostrarbuscando = true;
$scope.mostrarcontent  = false;

//Mandando por ajax el ejercicio a eliminar
  		var url = 'modulos/Clientes/Funciones.php';
	     $http({method: "post",url: url,data: $.param({Params:params}), 
	      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
	    })
	     .success(function(data, status, headers, config) 
	     {          	
	       		exito = data.respuestas;
	       		if(exito!="Error")
	       		{
	       			$scope.resp = data.respuestas;
	       			console.log($scope.resp);
	       			$scope.mostrarbuscando = false;
					$scope.mostrarcontent  = true;
	       		}//if
	       		else{$methodsService.alerta(2,"algo falló, disculpe las molestias");}
	      })  
	     .error(function(data, status, headers, config){
	     	$methodsService.alerta(2,"algo falló, disculpe las molestias");
	     });

$scope.SiguienteForm = function()	     
{
	bootbox.confirm("Desea pasar al siguiente formulario?", function(result) {
		console.log(result);
	  	if(result==true)
	  	{	$scope.$apply(function(){
	  			var resps = JSON.stringify($scope.resp);
	  			$cookies.put('resp', resps)
	  			$location.path('/Formulario2').search({});
	  		});//apply
	  	}
	  });
}//SiguienteForm

$scope.Redirigir = function(direccion)
{
	$methodsService.Redirigir(direccion);
}//Redirigir

})//formcontroller

.controller('formcontroller2',function($scope,$http,$location,$methodsService,$routeParams,respservice,$cookies){
	$scope.resp = JSON.parse($cookies.get('resp'));
	console.log($scope.resp);

//funciones
$scope.Redirigir = function(direccion)
{
	$methodsService.Redirigir(direccion);
}//Redirigir

$scope.RegistrarForm = function()	
{
	bootbox.confirm("Desea pasar al siguiente formulario?", function(result) {
		console.log(result);
	  	if(result==true)
	  	{	$scope.$apply(function(){
	  			$scope.resp.Accion = "RegistrarForm";
	  			//Enviadno los datos por ajax.
	  			params   			  = JSON.stringify($scope.resp);
		  		var url = 'modulos/Clientes/Funciones.php';
			         $http({method: "post",url: url,data: $.param({Params:params}), 
			          headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
			        })
			         .success(function(data, status, headers, config) 
			         {          	
				         exito = data.exito;
				         if(exito==1)
				         {
				         	$methodsService.alerta(1,"Datos Guardados!");
				         	$cookies.remove("resp");
				         }//if
				         else
				         {
				         	$methodsService.alerta(2,"algo falló, disculpe las molestias");
				         }
			          })  
			         .error(function(data, status, headers, config){
			         	$methodsService.alerta(2,"algo falló, disculpe las molestias");
			         });
	  		});//apply
	  	}//if
	  });//botbox

}//RegistrarForm

})

.controller('RutinaClientes',function($scope,$http,$location,$methodsService,$routeParams){
$scope.id_cliente = $routeParams.id;
$params = $methodsService.Json("InfoClienteRutinas",$scope.id_cliente);
$scope.currentPage     = 1; // Página actual, para paginación
$scope.pageSize 	   = 5;   // Tamaño de la página, para paginación.
//Funciones
$scope.CrearRutina = function(id)
{
	bootbox.confirm("Desea crear una rutina a este cliente?", function(result) {
		console.log(result);
	  	if(result==true)
	  	{	$scope.$apply(function(){
	  			$location.path('/Rutinas_Registrar').search({Cliente:$scope.id_cliente});
	  		});//apply
	  	}//if
	  });//botbox
}//CrearRutina

$scope.InfoRutina = function(id)
{
	bootbox.confirm("Desea ver la rutina de este cliente?", function(result) {
		console.log(result);
	  	if(result==true)
	  	{	$scope.$apply(function(){
	  			var params = $methodsService.Json("ObtenerRutinaPorCliente",$scope.id_cliente);
	  			var url = 'modulos/Biotest/Funciones.php';
				 $http({method: "post",url: url,data: $.param({Params:params}), 
				  headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
				})
				 .success(function(data, status, headers, config) 
				 {          	
				   		rutina = data.rutina;
				   		$location.path('/RutinaOrdenC').search({Rut:rutina,Cliente:$scope.id_cliente});
				  })  
				 .error(function(data, status, headers, config){$methodsService.alerta(2,"algo falló, disculpe las molestias");});
	  		});//apply
	  	}//if
	  });//botbox
}//InfoRutina

$scope.RedirigirRutina = function(id)
{
	bootbox.confirm("Desea asignar una rutina a este cliente?", function(result) {
		console.log(result);
	  	if(result==true)
	  	{	$scope.$apply(function(){
	  			$location.path('/RutinasAsignar').search({id:id});
	  		});//apply
	  	}//if
	  });//botbox
}//RedirigirRutina

var url = 'modulos/Clientes/Funciones.php';
 $http({method: "post",url: url,data: $.param({Params:params}), 
  headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
})
 .success(function(data, status, headers, config) 
 {          	
   		exito = data.exito;
   		if(exito==1)
   		{
   			$scope.datos = data.resultado;
   		}//if
  })  
 .error(function(data, status, headers, config){$methodsService.alerta(2,"algo falló, disculpe las molestias");});
})//RutinaClientes

.controller('AsignarRutinas',function($scope,$http,$location,$methodsService,$routeParams){
$scope.currentPage     = 1; // Página actual, para paginación
$scope.pageSize 	   = 5;   // Tamaño de la página, para paginación.
$scope.id 			   = $routeParams.id;
$scope.showfilter      = false;
$scope.disablebtn      = false;
$scope.rutina          = {entrenador:"",tipo_rutina:"",genero:"",Accion:""};
$scope.mostrarbuscando = false;
$scope.mostrarcontent  = true;
// Verificando que el cliente no tenga rutnia asignada.
//Buscando las rutinas
params = $methodsService.Json("ExisteRutinaCliente",$scope.id);
var url = 'modulos/Clientes/Funciones.php';
     $http({method: "post",url: url,data: $.param({Params:params}), 
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    })
     .success(function(data, status, headers, config) 
     {          	
       		cantidad = data.cantidad;
       		if(cantidad>0)
       		{
       			pagina = 1;
       		}//if
       		else{pagina = 0;}
       		
       		$scope.obtenerdir(pagina);
       		console.log($scope.url);
			
      })  
     .error(function(data, status, headers, config){
     	$methodsService.alerta(2,"algo falló, disculpe las molestias");
     });

$scope.FiltrarRutinas = function()
{
	$scope.rutina.Accion = "FiltrarRutinas";
	params   			 = JSON.stringify($scope.rutina);
	$scope.disablebtn    = true;
	var url = 'modulos/Rutinas/Funciones.php';
     $http({method: "post",url: url,data: $.param({Params:params}), 
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    })
     .success(function(data, status, headers, config) 
     {          	
       		$scope.disablebtn = false;
       		exito  		      = data.exito;
       		if(exito==1)
       		{
       			cantidad = data.cantidad;
       			if(cantidad>0)
       			{
       				$methodsService.alerta(1,"Rutinas Filtradas");
       				$scope.rutinas = data.rutinas;
       			}//if
       			else{$methodsService.alerta(2,"No existen rutinas con estos criterios");}
       		}
       		else
       		{
       			$methodsService.alerta(2,"algo falló, disculpe las molestias");
       		}
       		
      })  
     .error(function(data, status, headers, config){
     	$methodsService.alerta(2,"algo falló, disculpe las molestias");
     });
}//FiltrarRutinas


$scope.CategoriasporEnt = function()
{
	if($scope.rutina.entrenador!=undefined)
	{
		//Buscando las catgegorias
	params = $methodsService.Json("BuscarCategoriasPorEntrenador",$scope.rutina.entrenador);
	var url = 'modulos/Rutinas/Funciones.php';
     $http({method: "post",url: url,data: $.param({Params:params}), 
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    })
     .success(function(data, status, headers, config) 
     {          	
       		exito  = data.exito;
       		exitog = data.exitog;
       		if(exito==1)
       		{
       			$scope.tipos_rut = data.tipos_rut;
       			$scope.generos   = data.generos;
       		}//if
       		
      })  
     .error(function(data, status, headers, config){
     	$methodsService.alerta(2,"algo falló, disculpe las molestias");
     });
	}//if
	
}//CategoriasporEnt

$scope.AsignarRutina = function(id)
{
	bootbox.confirm("Desea asignar la rutina a este cliente?", function(result) {
		console.log(result);
	  	if(result==true)
	  	{
	  		$scope.$apply(function(){
	  			$scope.rutina.Accion    = "AsignarRutinaCliente";
	  			$scope.mostrarbuscando  = true;
	  			$scope.mostrarcontent   = false;
	  			$scope.rutina.Cliente   = $scope.id;
	  			$scope.rutina.id_rutina = id;
	  			console.log($scope.rutina);
	  			params = JSON.stringify($scope.rutina); var url = 'modulos/Clientes/Funciones.php';
			     $http({method: "post",url: url,data: $.param({Params:params}), 
			      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
			    })
			     .success(function(data, status, headers, config) 
			     {          	
			       		exito = data.exito;
			       		if(exito==1)
			       		{
			       			var id_rutina = data.id_rutinacliente;
			       			$location.path('/RutinaOrdenC').search({Rut:id_rutina,Cliente:$scope.id});
			       		}//if
			      }) .error(function(data, status, headers, config){$methodsService.alerta(2,"algo falló, disculpe las molestias");});
	  		});
	  	}//if
	});
}//AsignarRutina

$scope.ContinuarR = function()
{
	bootbox.confirm("Desea eliminar la rutina del cliente?.", function(result) {
		console.log(result);
	  	if(result==true)
	  	{
	  		$scope.$apply(function(){
	  			params = $methodsService.Json("DesactivarRutina",$scope.id); var url = 'modulos/Clientes/Funciones.php';
			     $http({method: "post",url: url,data: $.param({Params:params}), 
			      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
			    })
			     .success(function(data, status, headers, config) 
			     {          	
		       		exito = data.exito;
		       		if(exito==1)
		       		{
		       			$location.path('/ClientesRutina').search({id:$scope.id});
		       		}//if
		       		
		      }) .error(function(data, status, headers, config){$methodsService.alerta(2,"algo falló, disculpe las molestias");});
	  		});
	  	}//if
	});
}//ContinuarR

$scope.CancelarR = function()
{
	bootbox.confirm("Desea cancelar la operación?.", function(result) {
		console.log(result);
	  	if(result==true)
	  	{
	  		$scope.$apply(function(){
	  			$location.path('/Clientes').search({});
	  		});
	  	}//if
	});
}//CancelarR

$scope.obtenerdir = function(pagina)
{
	var direccion="";
	switch(pagina)
	{
		case 0:
			direccion = 'modulos/Clientes/paginas/rutinas_asignas.html';
			//Buscando la información
			//Buscando las rutinas
			params = $methodsService.Json("Rutinas",1); var url = 'modulos/Rutinas/Funciones.php';
			     $http({method: "post",url: url,data: $.param({Params:params}), 
			      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
			    })
			     .success(function(data, status, headers, config) 
			     {          	
			       		exito    = data.exito;
			       		exitot   = data.exitot;
			       		exitog   = data.exitog;
			       		exitoe   = data.exitoe;

			       		switch(true)
			       		{
			       			case exito==1 && exitot==1 && exitog==1 && exitoe==1:
			       			console.log(data);
			       				$scope.rutinas         = data.rutinas;
			       				$scope.entrenadores    = data.entrenadores;
			       				$scope.mostrarbuscando = false;	
								$scope.mostrarcontent  = true;
			       				$scope.url = 'modulos/Clientes/paginas/rutinas_asignas.html';
			       			break;

			       			case exito!=1 || exitot!=1 || exitog!=1 || exitoe!=1:
			       				$methodsService.alerta(2,"algo falló, disculpe las molestias");
			       			break;
			       		}//switch
			       		if(exito==1)
			       		{
			       			
				
			       		}//if
			       		else{$methodsService.alerta(2,"algo falló, disculpe las molestias");}
			       		
			      }) .error(function(data, status, headers, config){$methodsService.alerta(2,"algo falló, disculpe las molestias");});
		break;

		case 1:
			$scope.url = 'modulos/Clientes/paginas/rutinas_desasignar.html';
		break;
	}//switch

	return direccion;
}//obtenerdir

})//AsignarRutinas

.controller('RutinaOrdenC',function($scope,$http,$location,$methodsService,$routeParams){
//Contenedores de los ejercicios de cada dia.
$scope.lunes     = [];
$scope.martes    = [];
$scope.miercoles = [];
$scope.jueves    = [];
$scope.viernes   = [];
$scope.sabado    = [];
$scope.domingo   = [];

//Funciones
 $scope.CambiarDia = function(id_par,dia_semana)
    {
        //Obtener el tr que está encima
        var idJquery = "#"+id;
        var Padre = $(idJquery).prev()[0];
        var son = $(idJquery).next()[0];
        
        id = parseInt(id_par);

        //Situación en la que el ejercicio que se ha movido no tiene un nodo padre.
        if(Padre == undefined) 
        {
          var id_Padre       = 0;
          var AccionCambio   = "SinPadre";
        }else {id_Padre = Padre.id;}
        
        //Situación en la que el ejercicio que se ha movido no tiene un nodo hijo.
        if(son == undefined) 
        {
          var id_Hijo        = 0;
          var AccionCambio   = "SinHijo";
        }else {id_Hijo = son.id;}

        if(Padre != undefined && son !=undefined)
    {
      var id_Padre   = Padre.id;
      var id_Hijo    = son.id;
      
      //verificando si se bajó o subió posiciones
      // 1) si el padre es mayor, es por que se bajó la posición
      if(id_Padre>id)
      {
        var AccionCambio   = "ConAmbosBajoPosicion";
        var Cantidad_Puestos = id_Padre - id; 
      }//if
      
      if(id_Padre<id)
      {
        AccionCambio   = "ConAmbosSubioPosicion";
        var Cantidad_Puestos = id - id_Hijo;
      }//if
    }//if

        // Escenarios posibles del cambio de lugar
    
        // 1) Cuando no se tiene padre -> Esto significa que se movió al primer puesto de la lista

        if (id_Padre == 0)
        {
          //Tomar la cantidad de puestos que se movió
          var Cantidad_Puestos = id-id_Hijo;
        } // id_Padre == 0

        if (id_Hijo == 0)
        {
          Cantidad_Puestos = id_Padre-id;
        }

        //Tomando los valores para mandarlos al controller
        $scope.valores = 
        {
          id_rutina: $scope.id_rutina,
          id_cambio: id,
          id_Hijo:   id_Hijo,
          id_Padre: id_Padre,
          Cantidad_Puestos: Cantidad_Puestos,
          AccionCambio: AccionCambio,
          Accion: "CambioLugarEjercicio"           
        };
        console.log($scope.valores);
        var Params= JSON.stringify($scope.valores);

        //Validación, si el hijo es mayor por solo 1 o el padre menor por 1
        Cantidad_DiferenciaHijo  = id_Hijo - id; //Diferencia entre id_hijo y el id que fue movido
        Cantidad_DiferenciaPadre = id - id_Padre;
        Actividad_Sola       = 0;
        MismoLugar_Hijo      = 0;
        MismoLugar_Padre     = 0;
        
        console.log(Cantidad_DiferenciaHijo+" diferencia");
        //Verificando, si no tiene ni padre o hijio, es que es una sola actividad
        if(id_Hijo==0 && id_Padre==0 )
        {
          Actividad_Sola = 1;
        }//if

        if(Cantidad_DiferenciaHijo!=1 && Cantidad_DiferenciaPadre!=1 && Actividad_Sola!=1 )
      {
        var url = 'modulos/Clientes/Funciones.php';
         $http({method: "post",url: url,data: $.param({Params:Params}), 
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        })
         .success(function(data, status, headers, config) 
         {            
              exito = data.exito;
              console.log(data);
              if(exito==1)
              {
                var id_diaCambio = data.dia;
                var ejercicios   = data.ejercicios;
                $scope.AsignarEjercicios(id_diaCambio,ejercicios);
              }//if
          }) //success 
         .error(function(data, status, headers, config){
          $methodsService.alerta(2,"algo falló, disculpe las molestias");
         });
        }//if 

    }//CambiarDia

$scope.AsignarEjercicios =  function(dia,ejercicios)
{
    switch(dia)
    {
      case '1':
        $scope.lunes = ejercicios;
         $("#lunesbody").empty();
         $("#lunesbody").css("display","none");
         $scope.AgregarEjerciciosTabla($scope.lunes,"#lunesbody");
         $("#lunesbody").fadeIn(3000);
         $scope.InicializarTablas();
      break;

      case '2':
        $scope.martes = ejercicios;
         $("#martesbody").empty();
         $("#martesbody").css("display","none");
         $scope.AgregarEjerciciosTabla($scope.martes,"#martesbody");
         $("#martesbody").fadeIn(3000);
         $scope.InicializarTablas();
      break;

      case '3':
        $scope.miercoles = ejercicios;
        $("#miercolesbody").css("display","none");
        $("#miercolesbody").empty();
        $scope.AgregarEjerciciosTabla($scope.miercoles,"#miercolesbody");
        $("#miercolesbody").fadeIn(3000);
        $scope.InicializarTablas();
      break;

      case '4':
        $scope.jueves = ejercicios;
         $("#juevesbody").css("display","none");
         $("#juevesbody").empty();
         $scope.AgregarEjerciciosTabla($scope.jueves,"#juevesbody");
         $("#juevesbody").fadeIn(3000);
         $scope.InicializarTablas();
      break;

      case '5':
        $scope.viernes = ejercicios;
        $("#viernesbody").css("display","none");
        $("#viernesbody").empty();
        $scope.AgregarEjerciciosTabla($scope.viernes,"#viernesbody");
        $("#viernesbody").fadeIn(3000);
        $scope.InicializarTablas();
      break;

       case '6':
          $scope.sabado = ejercicios;
          $("#sabadobody").css("display","none");
          $("#sabadobody").empty();
          $scope.AgregarEjerciciosTabla($scope.sabado,"#sabadobody");
          $("#sabadobody").fadeIn(3000);
          $scope.InicializarTablas();
      break;

      case '7':
        $scope.domingo = ejercicios;
        $("#domingobody").css("display","none");
        $("#domingobody").empty();
        $scope.AgregarEjerciciosTabla($scope.domingo,"#domingobody");
        $("#domingobody").fadeIn(3000);
        $scope.InicializarTablas();
      break;
    }//switch
}//AsignarEjercicios

$scope.AgregarEjerciciosTabla = function(ejercicios,tabla)
{
  for(i=0; i<ejercicios.length; i++)
  {
    var eje = ejercicios[i];
    var tr = '<tr class="text-center" id="'+eje.id_posicionejercicio+'"><td>'+eje.id_posicionejercicio+'</td><td>'+eje.nb_ejercicio+'</td><td>'+eje.nb_musculo+'</td></tr>'
    $(tabla).append(tr);
  }//for
  
}//AgregarEjerciciosTabla
$scope.definirEjercicioDia = function(dia,ejercicio)
    {
      switch(dia)
      {
        case '1':
          $scope.lunes.push(ejercicio);
        break;

        case '2':
          $scope.martes.push(ejercicio);
        break;

        case '3':
          $scope.miercoles.push(ejercicio);
        break;

        case '4':
          $scope.jueves.push(ejercicio);
        break;

        case '5':
          $scope.viernes.push(ejercicio);
        break;

        case '6':
          $scope.sabado.push(ejercicio);
        break;

        case '7':
          $scope.domingo.push(ejercicio);
        break;
      }//switch
    }//definirEjercicioDia

    $scope.InicializarTablas = function ()
    {
     
      //Drag and drop table
      $("#table-1").tableDnD();
      $("#table-2").tableDnD();
      $("#table-3").tableDnD();
      $("#table-4").tableDnD();
      $("#table-5").tableDnD();
      $("#table-6").tableDnD();
      $("#table-7").tableDnD();
       //Acciones
       
       // día lunes //
       $('#table-1').tableDnD({
          onDrop: function(table, row) 
         {
            //Tomando los datos del row que se movió
            id       = row.id;
            dia_semana = "Actualiza_Lunes";
            $scope.CambiarDia(id,dia_semana) 
          } //onDrop
      });
      
      // día Martes //
       $('#table-2').tableDnD({
          onDrop: function(table, row) 
          {
            //Tomando los datos del row que se movió
            id = row.id;
            dia_semana = "Actualiza_Martes";
            $scope.CambiarDia(id,dia_semana) 
          } 
      });
      
      // día miércoles//
       $('#table-3').tableDnD({
          onDrop: function(table, row) 
        {
            //Tomando los datos del row que se movió
            id = row.id;
            dia_semana = "Actualiza_Miercoles";
            $scope.CambiarDia(id,dia_semana); 
          } 
      });
      
      // día Jueves//
       $('#table-4').tableDnD({
          onDrop: function(table, row) 
        {
           //Tomando los datos del row que se movió
            id = row.id;
            dia_semana = "Actualiza_Jueves";
            $scope.CambiarDia(id,dia_semana); 
          } 
      });
      
      // día Viernes//
       $('#table-5').tableDnD({
          onDrop: function(table, row) 
        {
          console.log(row);
          //Tomando los datos del row que se movió
          id = row.id;
          dia_semana = "Actualiza_Viernes";
          $scope.CambiarDia(id,dia_semana); 
          } 
      });
      
      // día Sábado//
       $('#table-6').tableDnD({
          onDrop: function(table, row) 
        {
          
          //Tomando los datos del row que se movió
          id = row.id;
          dia_semana = "Actualiza_Sabado";
          $scope.CambiarDia(id,dia_semana) 
          } 
      });
      
      // día Domingo//
       $('#table-7').tableDnD({
          onDrop: function(table, row) 
        {
          
          //Tomando los datos del row que se movió
          id = row.id;
          dia_semana = "Actualiza_Domingo";
          $scope.CambiarDia(id,dia_semana) 
          } 
      });
    }//InicializarTablas

$scope.RutinaPrefinal = function()
{
	bootbox.confirm("Desea ir al final de la rutina?", function(result) {
		console.log(result);
	  	if(result==true)
	  	{
	  		$scope.$apply(function(){
	  			$location.path('/RutinaPrefinalC').search({Rut:$scope.id_rutina,Cliente:$scope.cliente});
	  		});
	  	}//if
	});
}//RutinaPrefinal
   

//Tomadno los datos
$scope.id_rutina     = $routeParams.Rut;
$scope.cliente 		 = $routeParams.Cliente;
var params     		 = $methodsService.Json("InfoRutinaCliente",$scope.id_rutina);

var url = 'modulos/Clientes/Funciones.php';
$http({method: "post",url: url,data: $.param({Params:params}), 
headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
})
.success(function(data, status, headers, config) 
{          	
	//Pegando los datos en las tblas.
	exito = data.exito;
        if(exito==1)
        {
          $scope.ejercicios = data.ejercicios;
          var cantidad      = $scope.ejercicios.length;

          //definiendo los ejercicios por dia.
          for(i=0; i<cantidad; i++)
          {
            var id_dia = $scope.ejercicios[i].id_dia;
            $scope.definirEjercicioDia(id_dia,$scope.ejercicios[i]);
          }//for

          //Pegando los ejercicios para cada lista con jquery.
          for(i=0; i<$scope.lunes.length;i++)
          {
              var eje = $scope.lunes[i];
              var tr = '<tr class="text-center" id="'+eje.id_posicionejercicio+'"><td>'+eje.id_posicionejercicio+'</td><td>'+eje.nb_ejercicio+'</td><td>'+eje.nb_musculo+'</td></tr>'
              $("#lunesbody").append(tr);

          }//for

          for(i=0; i<$scope.martes.length;i++)
          {
              var eje = $scope.martes[i];
              var tr = '<tr class="text-center" id="'+eje.id_posicionejercicio+'"><td>'+eje.id_posicionejercicio+'</td><td>'+eje.nb_ejercicio+'</td><td>'+eje.nb_musculo+'</td></tr>'
              $("#martesbody").append(tr);

          }//for

          for(i=0; i<$scope.miercoles.length;i++)
          {
              var eje = $scope.miercoles[i];
              var tr = '<tr class="text-center" id="'+eje.id_posicionejercicio+'"><td>'+eje.id_posicionejercicio+'</td><td>'+eje.nb_ejercicio+'</td><td>'+eje.nb_musculo+'</td></tr>'
              $("#miercolesbody").append(tr);

          }//for

          for(i=0; i<$scope.jueves.length;i++)
          {
              var eje = $scope.jueves[i];
              var tr = '<tr class="text-center" id="'+eje.id_posicionejercicio+'"><td>'+eje.id_posicionejercicio+'</td><td>'+eje.nb_ejercicio+'</td><td>'+eje.nb_musculo+'</td></tr>'
              $("#juevesbody").append(tr);
          }//for

          for(i=0; i<$scope.viernes.length;i++)
          {
              var eje = $scope.viernes[i];
              var tr = '<tr class="text-center" id="'+eje.id_posicionejercicio+'"><td>'+eje.id_posicionejercicio+'</td><td>'+eje.nb_ejercicio+'</td><td>'+eje.nb_musculo+'</td></tr>'
              $("#viernesbody").append(tr);
          }//for

          for(i=0; i<$scope.sabado.length;i++)
          {
              var eje = $scope.sabado[i];
              var tr = '<tr class="text-center" id="'+eje.id_posicionejercicio+'"><td>'+eje.id_posicionejercicio+'</td><td>'+eje.nb_ejercicio+'</td><td>'+eje.nb_musculo+'</td></tr>'
              $("#sabadobody").append(tr);
          }//for

          for(i=0; i<$scope.domingo.length;i++)
          {
              var eje = $scope.domingo[i];
              var tr = '<tr class="text-center" id="'+eje.id_posicionejercicio+'"><td>'+eje.id_posicionejercicio+'</td><td>'+eje.nb_ejercicio+'</td><td>'+eje.nb_musculo+'</td></tr>'
              $("#domingobody").append(tr);
          }//for

          $scope.InicializarTablas();
        }//if
})  
.error(function(data, status, headers, config){
	$methodsService.alerta(2,"algo falló, disculpe las molestias");
});
})//RutinaOrdenC

.controller('RutinaprefinalC',function($scope,$http,$location,$methodsService,$routeParams){
// Variables
$scope.Rut     = $routeParams.Rut;
$scope.Cliente = $routeParams.Cliente;	

//Funciones

$scope.EnviarRutina = function()
{
	bootbox.confirm("Desea enviar la rutina?", function(result) {
		console.log(result);
	  	if(result==true)
	  	{
	  		$scope.$apply(function(){
	  			alert("hola");
	  			var url = 'modulos/Clientes/CrearPdf.php';
			     $http({method: "post",url: url,data: $.param({id_rutina:$scope.Rut}), 
			      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
			    })
			     .success(function(data, status, headers, config) 
			     {            
			       
			         
			      })  
			     .error(function(data, status, headers, config){
			      $methodsService.alerta(2,"algo falló, disculpe las molestias");
			     });
	  		});
	  	}//if
	});
}//EnviarRutina

$scope.CambioTabla = function(id,newValue)
{
  if($(id2).hasClass("Repeticiones"))
  {
    if($.isNumeric(newValue))
    {
      id_rutina   = $("#id_rutina").val();
      idEjercicio = id.split("Val");
      console.log("el id es: "+idEjercicio[1]+" Las repeticiones son : "+newValue);
      $scope.InsertarRepeticionesBD(idEjercicio[1], newValue,id_rutina);
    }//if
    else
    {
      bootbox.confirm("Favor de ingresar un número válido.", function(result) {});
    }//else
    
  }//If class

  if($(id2).hasClass("Circuitos"))
  {
    if($.isNumeric(newValue))
    {
      id_rutina   = $("#id_rutina").val();
      idEjercicio = id.split("ValRu");
      console.log("el id es: "+idEjercicio[1]+" Los Circuitos son : "+newValue);
      $scope.InsertarCircuitosBD(idEjercicio[1], newValue)
    }
    else
    {
      alert("Favor de ingresar un número válido.");
    }//else
  }//if

  if($(id2).hasClass("Relacion"))
  {
    id_rutina   = $("#id_rutina").val();
    idEjercicio = id.split("ValRe");
    console.log("el id es: "+idEjercicio[1]+" La relación es : "+newValue);
    $scope.InsertarRelacionEjerciciosBD(idEjercicio[1],newValue);
  }//if
}//CambioTabla

$scope.FinalizarRutina = function()
{
	bootbox.confirm("Desea ir al apartado de Clientes?", function(result) {
		console.log(result);
	  	if(result==true)
	  	{
	  		$scope.$apply(function(){
	  			$location.path('/Clientes').search({});
	  		});
	  	}//if
	});
}//FinalizarRutina

$scope.InsertarCircuitosBD = function (id, circuitos,id_rutina)
{
  //Objeto con la información a guardar en la BD
    var Arr=new Object(); 
    Arr['id_rutina']      = id_rutina;
    Arr['id_ejercicio']     = id;
    Arr['num_circuitos']    = circuitos;
    Arr['Accion']       = "AgregarCircuitosEjercicio";
    params                  = JSON.stringify(Arr);
    console.log(params);
  var url = 'modulos/Clientes/Funciones.php';
     $http({method: "post",url: url,data: $.param({Params:params}), 
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    })
     .success(function(data, status, headers, config) 
     {            
       
         
      })  
     .error(function(data, status, headers, config){
      $methodsService.alerta(2,"algo falló, disculpe las molestias");
     });
}

$scope.InsertarRepeticionesBD = function (id, repeticiones,id_rutina)
{
  
    //Objeto con la información a guardar en la BD
    var Arr                 = new Object(); 
    Arr['id_rutina']        = $scope.Rut;
    Arr['id_ejercicio']     = id;
    Arr['num_repeticiones'] = repeticiones;
    Arr['Accion']           = "AgregarRepeticionesEjercicio";
    params                  = JSON.stringify(Arr);
    var url = 'modulos/Clientes/Funciones.php';
     $http({method: "post",url: url,data: $.param({Params:params}), 
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    })
     .success(function(data, status, headers, config) 
     {})  
     .error(function(data, status, headers, config){
      $methodsService.alerta(2,"algo falló, disculpe las molestias");
     });
}//InsertarRepeticionesBD

$scope.InsertarRelacionEjerciciosBD = function (id,relacion)
{
  //Objeto con la información a guardar en la BD
    var Arr=new Object(); 
    Arr['id_ejercicio']   = id;
    Arr['relacion']       = relacion;
    Arr['Accion']         = "AgregarRelacionEjercicio";
    params                  = JSON.stringify(Arr);
    var url = 'modulos/Clientes/Funciones.php';
     $http({method: "post",url: url,data: $.param({Params:params}), 
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    })
     .success(function(data, status, headers, config) 
     {})  
     .error(function(data, status, headers, config){
      $methodsService.alerta(2,"algo falló, disculpe las molestias");
     });
}//InsertarRelacionEjerciciosBD

//Tomando los datos de las rutina del cliente.
params = $methodsService.Json("EjerciciosRutinaOrden",$scope.Rut);
    var url = 'modulos/Clientes/Funciones.php';
     $http({method: "post",url: url,data: $.param({Params:params}), 
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    })
     .success(function(data, status, headers, config) 
     {            
        exito = data.exito;
        if(exito==1)
        {
           $scope.ejercicios = data.ejercicios;
           var cantidad      = $scope.ejercicios.length;

          //definiendo los ejercicios por dia.
          for(i=0; i<cantidad; i++)
          {

            var eje = $scope.ejercicios[i];
            circuitos = (eje.num_circuitos!=null)?eje.num_circuitos:0;
            repet     = (eje.num_repeticiones!=null)?eje.num_repeticiones:0;
            rel       = (eje.ejercicio_relacion!=null)?eje.ejercicio_relacion:"";
            var tr = '<tr class="text-center" id="'+eje.id_rutinacliente+'">';
            tr+='<td>'+eje.id_posicionejercicio+'</td><td>'+eje.nb_rutina+'</td>';
            tr+='<td>'+eje.nb_ejercicio+'</td><td id="Val'+eje.id_ejercicio+'" class="Repeticiones">'+repet+'</td>';
            tr+='<td id="ValRu'+eje.id_ejercicio+'" class="Circuitos">'+circuitos+'</td>';
            tr+='<td>'+eje.nb_dia+'</td><td>'+eje.nb_tiporutina+'</td>';
            tr+='<td>'+eje.nb_musculo+'</td>';
            tr+='<td>'+eje.fh_creacion+'</td>';
            tr+='<td id="ValRe'+eje.id_ejercicio+'" class="Relacion">'+rel+'</td></tr>';
            $("#tablecontent").append(tr);
          }//for
          $('#listados').editableTableWidget();
          $('table td').on('change', function(evt, newValue) {
                id=evt.currentTarget.id;
                id2="#"+id;
                $scope.CambioTabla(id2,newValue);
            });
        }//if
         
      })  
     .error(function(data, status, headers, config){
      $methodsService.alerta(2,"algo falló, disculpe las molestias");
     });

})

.service('respservice', function() {
  var respuestas = [];

  var addresp = function(newObj) {
      respuestas = newObj;
  };

  var getresp = function(){
      return respuestas;
  };

  return {
    addresp: addresp,
    getresp: getresp
  };

});
