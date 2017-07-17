<?php 
	class clientsModel
	{
		function _ConsultarClientes()
		{
			$query='
				SELECT
				clientes.id,
				clientes.nb_cliente,
				clientes.nb_apellidos,
				clientes.de_email,
				clientes.num_celular,
				usuarios.nb_nombre as "Ins_nombre", 
				usuarios.nb_apellidos as "Ins_apellido" 
				FROM sgclientes clientes
				left join sgusuarios  usuarios on clientes.id_usuario_registro=usuarios.id
				where clientes.sn_activo=1
				ORDER BY clientes.id ASC
			
			';
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetAll($query);
			return $response;
		}//_ConsultarClientes

		function _ConsultarClientesPorId($id)
		{
			$query='
				SELECT
				clientes.id as id_cliente,
				clientes.nb_cliente,
				clientes.nb_apellidos,
				clientes.de_email,
				clientes.num_celular,
				clientes.de_genero,
				clientes.fh_nacimiento,
				usuarios.nb_nombre as "Ins_nombre", 
				usuarios.nb_apellidos as "Ins_apellido",
			    TIMESTAMPDIFF(YEAR, clientes.fh_nacimiento, CURDATE()) AS num_edad  
				FROM sgclientes clientes
				inner join sgusuarios  usuarios on clientes.id_usuario_registro=usuarios.id
				where clientes.sn_activo=1 and clientes.id=?
			';
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetRowOneParam($query,$id);
			return $response;
		}

		function _ConsultarClientesPorIdDet($id)
		{
			$query = 'SELECT 
			cliente.id,
			cliente.nb_cliente,
			cliente.nb_apellidos,
			cliente.de_genero,
			cliente.de_email,
			cliente.num_telefono,
			cliente.num_celular,
			cliente.de_colonia,
			cliente.de_domicilio,
			cliente.num_codigopostal,
			cuerpo.id as id_cuerpo,
			cuerpo.nb_cuerpo,
			SPLIT_STR(fh_nacimiento, "-", 1) as birth_year,
			SPLIT_STR(fh_nacimiento, "-", 2) as birth_month,
			SPLIT_STR(fh_nacimiento, "-", 3) as birth_day
			FROM sgclientes cliente
			LEFT JOIN sgtipocuerpo cuerpo
			ON cliente.id_tipocuerpo = cuerpo.id
			where cliente.id= ?';
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetRowOneParam($query,$id);
			return $response;
		}

		function _ConsultarClientesFormulario()
		{
			$query='
				SELECT
				clientes.id,
				clientes.nb_cliente,
				clientes.nb_apellidos,
				clientes.de_email,
				clientes.num_celular,
				usuarios.nb_nombre as "Ins_nombre", 
				usuarios.nb_apellidos as "Ins_apellido" 
				FROM sgclientes clientes
				inner join sgusuarios  usuarios on clientes.id_usuario_registro=usuarios.id
				inner join sgformulario form
				on clientes.id=form.id_cliente
				where clientes.sn_activo=1		
			';
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetAll($query);
			return $response;
		}

		function _ConsultarInfoClienteRutinaId($id)
		{
			$query='
				select 
				/* Datos de sg_rutinasclientes*/
				RUT.id,

				/* Datos de sg_clientes*/
				Clie.nb_cliente,
				Clie.nb_apellidos,
				Clie.de_email,
				Clie.id as id_cliente

				from sgrutinasclientes RUT
				INNER JOIN sgclientes Clie
				ON Clie.id=RUT.id_cliente

				where Rut.id=?
			';	
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetRowOneParam($query,$id);
			return $response;
		}

		function _ConsultarClientInfoFormReport($id)
		{
			// Original name _ConsultarInformacionClienteReporteFormulario
			$query=' 
			select 	DISTINCT
			Clie.id,
			Clie.nb_cliente,
			Clie.nb_apellidos,
			/* información de sg_formulario*/
			Form.id as id_form,
			cantidad_cigarros,
			desayuno_diario,
			comida_diaria,
			cena_diaria,
			entrecomida_diaria,
			frecuencia_entrecomida,
			plan_alimenticio,
			intensidad_ejercicio,
			intensidad_ejercicio2,
			intensidad_ejercicio3,
			intensidad_ejercicio4,
			intensidad_ejercicio5,
			actividades_deseables,
			actividades_indeseables,
			deporte_frecuente,
			minutos_dia,
			dias_semana,
			resultado_ejercicio,
			condicion_cardiaca,
			condicion_pecho,
			condicion_pechoreciente,
			condicion_balance,
			lesion_fisica,
			medicamentos_corazon,
			impedimento_entrenamiento,
			lecturas_anormales,
			cirujia_bypass,
			dificultad_respirar,
			enfermedades_renales,
			arritmia,
			colesterol,
			presion_alta,
			molestias_articulaciones,
			molestias_espalda,
			programa_ejercicio
			
			FROM sgformulario Form
			INNER JOIN sgclientes Clie
			ON Clie.id=Form.id_cliente where Form.id_cliente = ? 	
		';	
		$Utilities = new Utilities();
			$response = $Utilities->QueryGetRowOneParam($query,$id);
			return $response;
		}

		function _ConsultarclientForm($id)
		{
			//nombre original _ConsultarSiClienteHizoElFormulario
			$query='
				select count(id) as amount  from sgformulario where id_cliente = ?
			';
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetRowOneParam($query,$id);
			return $response;
		}

		function _ConsultarClientInfoRoutine($id)
		{
			//original name _ConsultarInformacionClientesRutinaPorIdCliente
			
			$query='SELECT
				Form.dias_semana,
				Form.minutos_dia,
				Form.resultado_ejercicio,
				clie.nb_cliente,
				clie.nb_apellidos
				
				FROM
				sgformulario Form
				
				INNER JOIN sgclientes clie
				on Form.id_cliente=clie.id

				WHERE clie.id=?';
				$Utilities = new Utilities();
			$response = $Utilities->QueryGetRowOneParam($query,$id);
			return $response;
		}
	}
 ?>