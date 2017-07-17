<?php 
	class MachinesModel
	{
		function _ConsultarMaquinas()
		{
			$query = '
					SELECT 
					maq.id,
					maq.desc_maquina,
					maq.nb_maquina,
					maq.num_maquina,
					cat.nb_categoriamaquina
					FROM sgmaquinas maq
					LEFT JOIN sgcategoriamaquina cat
					ON maq.id_CategoriaMaquina = cat.id
					where maq.sn_activo =1 ORDER BY id ASC
			    	';
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetAll($query);
			return $response;
		}

		function _BuscarMaquinaId($id)
		{
			$query = 'SELECT * FROM sgmaquinas where id = ?';
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetRowOneParam($query,$id);
			return $response;
		}

		function _BuscarMaquinaPorCategoria($id)
		{
			$filtro = "";
			if($id != "Todas"){$filtro = "maq.id_categoriamaquina=? and";}	
			$query = '
			 SELECT
			  maq.id,
			  maq.nb_maquina,
			  maq.desc_maquina,
			  maq.num_maquina,
			  cat.nb_CategoriaMaquina
			  FROM sgmaquinas maq
			  LEFT JOIN sgcategoriamaquina cat
			  on maq.id_categoriamaquina = cat.id
			  where '.$filtro.' maq.sn_activo=1 ORDER BY maq.id ASC';
			  $Utilities = new Utilities();
			  if($id != "Todas")
			  {
			  	$response = $Utilities->QueryGetAllOneParam($query,$id);
			  }else{
				$response = $Utilities->QueryGetAll($query);
			  }
			return $response;
		}
	}
 ?>