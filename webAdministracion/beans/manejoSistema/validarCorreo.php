<?php
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    if ($_POST["tipo_val"] == "PAS") {
      $sql="SELECT usr_correo FROM dct_sistema_tbl_usuario WHERE usr_cod_usuario <> :usr_cod_usuario;";
      $query=$pdo->prepare($sql);
      $query->bindValue(':usr_cod_usuario',cleanData("siLimite",13,"noMayuscula",$_POST["usr_cod_usuario"]),PDO::PARAM_STR);
      $query->execute();
      $row = $query->fetchAll();
    }
    else {
      $sql="SELECT usr_correo FROM dct_sistema_tbl_usuario;";
      $query=$pdo->prepare($sql);
      $query->execute();
      $row = $query->fetchAll();
    }
    $cont=0;
		foreach ($row as $row) {
			if ($row["usr_correo"] == $_POST["usr_correo"]) {$cont++;}
		}
		if($cont==0) {		
      $data_result["message"] = "userOK";
      echo json_encode($data_result);
		}
		else {
      $data_result["message"] = "userError";
      echo json_encode($data_result);
		}	
  } catch (\PDOException $e) {
      echo $e->getMessage();
  }
?> 