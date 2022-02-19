<?php
  require_once("../../../controller/misFunciones.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  require_once("../../../controller/sesion.class.php");
  app_error_reporting($app_error_reporting);
  try {
    $sesion = new sesion();
    $dataSesion = $sesion->get('dataSesion');
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
   	$sql="SELECT arc_id_user_archivo, arc_nombre_file, arc_fecha_creacion
		FROM dct_sistema_tbl_usuario_archivo
		WHERE usr_cod_usuario = :usr_cod_usuario
		AND arc_estado = :arc_estado;";
    $query=$pdo->prepare($sql);
    $query->bindValue(':usr_cod_usuario',cleanData("siLimite",13,"noMayuscula",$_POST["usr_cod_usuario"]));
    $query->bindValue(':arc_estado', "A");
    $query->execute();
    $row = $query->fetchAll();
    $return_array = array();
    $return= array();
    foreach ($row as $row) {
      $return_array[0] = $row["arc_id_user_archivo"];
      $return_array[1] = $row["arc_nombre_file"];
      $return_array[2] = $row["arc_fecha_creacion"];
      $return_array[3] = null;
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