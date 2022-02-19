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
   	$sql="SELECT usp_id_user_perfil, usp_nombre_file, usp_fecha_creacion, usp_descripcion, usp_formacion, usp_dir_consultorio
		FROM dct_sistema_tbl_usuario_perfil
		WHERE usr_cod_usuario = :usr_cod_usuario;";
    $query=$pdo->prepare($sql);
    $query->bindValue(':usr_cod_usuario',cleanData("siLimite",13,"noMayuscula",$_POST["usr_cod_usuario"]));
    $query->execute();
    $row = $query->fetchAll();
    $return_array = array();
    $return= array();
    $usp_descripcion="";
    $usp_formacion="";
    $usp_dir_consultorio="";

    if ($query->rowCount() >= 1) {
      foreach ($row as $row) {
        $usp_descripcion = $row["usp_descripcion"];
        $usp_formacion = $row["usp_formacion"];
        $usp_dir_consultorio = $row["usp_dir_consultorio"];
        if ($row["usp_nombre_file"] != "") {
          $return_array[0] = $row["usp_id_user_perfil"];
          $return_array[1] = $row["usp_nombre_file"];
          $return_array[2] = $row["usp_fecha_creacion"];
          $return_array[3] = null;
          array_push($return,$return_array);
          $return = array(
            "recordsTotal"    => $query->rowCount(),
            "recordsFiltered" => $query->rowCount(),
            "usp_descripcion" => $usp_descripcion,
            "usp_formacion" => $usp_formacion,
            "usp_dir_consultorio" => $usp_dir_consultorio,
            "data"            => $return
          );  
        }
        else {
          $return_array[0] = null;
          $return_array[1] = null;
          $return_array[2] = null;
          $return_array[3] = null;
          array_push($return,$return_array);
          $return = array(
            "recordsTotal"    => 0,
            "recordsFiltered" => 0,
            "usp_descripcion" => $usp_descripcion,
            "usp_formacion" => $usp_formacion,
            "usp_dir_consultorio" => $usp_dir_consultorio,
            "data"            => []
          );  
        } 
      }
    }
    else {
      $return_array[0] = null;
      $return_array[1] = null;
      $return_array[2] = null;
      $return_array[3] = null;
      array_push($return,$return_array);
      $return = array(
        "recordsTotal"    => 0,
        "recordsFiltered" => 0,
        "usp_descripcion" => $usp_descripcion,
        "usp_formacion" => $usp_formacion,
        "usp_dir_consultorio" => $usp_dir_consultorio,
        "data"            => []
      );
    }
    echo json_encode($return);
  } catch (\PDOException $e) {
      echo $e->getMessage();
  }
?>