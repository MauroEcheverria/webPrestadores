<?php
  require_once("../../../controller/sesion.class.php");
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {
      //$sesion = new sesion();
      //print_r($sesion->get('dataSesion'));
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $sql="SELECT u.usr_cod_usuario,u.usr_correo,
          r.rol_rol,u.usr_id_empresa,m.emp_empresa,u.usr_id_rol,
          u.usr_estado_contrasenia,
          u.usr_estado,
          CONCAT(usr_nombre_1,' ',usr_nombre_2,' ',usr_apellido_1,' ',usr_apellido_2) usr_nom_completos
          FROM dct_sistema_tbl_usuario u,dct_sistema_tbl_rol r,dct_sistema_tbl_empresa m
          WHERE u.usr_id_rol = r.rol_id_rol
          /*AND u.usr_cod_usuario NOT IN ('0919664854')*/
          AND u.usr_id_empresa = m.emp_id_empresa;";
    $query=$pdo->prepare($sql);
    $query->execute();
    $row = $query->fetchAll();
    $return_array = array();
		$return= array();
		foreach ($row as $row) {
			$return_array[0] = $row["usr_cod_usuario"];
			$return_array[1] = $row["usr_nom_completos"];
			$return_array[2] = $row["usr_correo"];
			$return_array[3] = $row["rol_rol"];
      $return_array[4] = $row["emp_empresa"];
			$return_array[5] = $row["usr_estado"];
      $return_array[6] = $row["usr_estado_contrasenia"];
      $return_array[7] = $row["usr_id_empresa"];
      $return_array[8] = $row["usr_id_rol"];
      $return_array[9] = null;
			array_push($return,$return_array);
		}
		$return = array(
					"recordsTotal"    => $query->rowCount(),
					"recordsFiltered" => $query->rowCount(),
					"data"            => $return
		);	
		echo json_encode($return);
  } catch (\PDOException $e) {
      echo $e->getMessage();
  }
?>