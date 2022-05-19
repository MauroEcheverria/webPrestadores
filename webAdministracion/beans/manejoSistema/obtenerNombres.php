<?php
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  require_once("../../../controller/funcionesCore.php");
  app_error_reporting($app_error_reporting);
  try {
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $sql="SELECT *
          FROM dct_sistema_tbl_usuario
          WHERE usr_cod_usuario = :usr_cod_usuario;";
    $query=$pdo->prepare($sql);
    $query->bindValue(':usr_cod_usuario',cleanData("siLimite",13,"noMayuscula",$_POST["id_dt_cedula"]),PDO::PARAM_INT); 
    $query->execute();
    $row = $query->fetchAll();
		$data_result["data_row"] = $row;
    echo json_encode($data_result);
  } catch (\PDOException $e) {
    echo $e->getMessage();
  }
?> 