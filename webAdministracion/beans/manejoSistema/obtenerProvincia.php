<?php
	require_once("../../../controller/sesion.class.php");
	require_once("../../../controller/funcionesCore.php");
	require_once("../../../dctDatabase/Connection.php");
	require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
	try {
		$sesion = new sesion();
    $dataSesion = $sesion->get('dataSesion');
		$ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();

    $sql="SELECT *
          FROM dct_sistema_tbl_usuario_adicional
          WHERE usr_cod_usuario = :usr_cod_usuario;";
    $query=$pdo->prepare($sql);
    $query->bindValue(':usr_cod_usuario',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(\PDO::FETCH_ASSOC);

		$sql_pro = "SELECT DISTINCT dvp_codigo_provincia, dvp_provincia
              FROM dct_parametro_tbl_div_politica
              ORDER BY 1" ;
		$query_pro=$pdo->prepare($sql_pro);
    $query_pro->execute();
    $row_pro = $query_pro->fetchAll();

    $rpta="<option value=''>Seleccione una opción</option>";
    foreach ($row_pro as $row_pro) {
    	$rpta.="<option value='".$row_pro["dvp_codigo_provincia"]."'>".$row_pro["dvp_provincia"]."</option>";
    }
    $data_result["rpta"] = $rpta;
    $data_result["data_count"] = $query->rowCount();
    $data_result["data_row"] = $row;
    echo json_encode($data_result);
	}
	catch(SoapFault $exception){
	    echo $exception->getMessage();  
	}
?>