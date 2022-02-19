<?php
  require_once("../../../controller/misFunciones.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $sql="SELECT usr_correo FROM dct_sistema_tbl_usuario;";
    $query=$pdo->prepare($sql);
    $query->execute();
    $row = $query->fetchAll();
    $cont=0;
		foreach ($row as $row) {
			if ($row["usr_correo"] == $_POST["cedula"]) {$cont++;}
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