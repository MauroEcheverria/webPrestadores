<?php
	require_once("../../../controller/funcionesCore.php");
	require_once("../../../dctDatabase/Connection.php");
	require_once("../../../dctDatabase/Parameter.php");
	app_error_reporting($app_error_reporting);
	try {
		$ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
		$sql_par = "SELECT DISTINCT dvp_codigo_parroquia, dvp_parroquia
						FROM dct_parametro_tbl_div_politica
						WHERE dvp_codigo_provincia = :codigo_provincia 
						AND dvp_codigo_canton = :codigo_canton
						ORDER BY 1;" ;
		$query_par=$pdo->prepare($sql_par);
		$query_par->bindValue(':codigo_provincia',$_POST["adi_provincia"],PDO::PARAM_STR);
		$query_par->bindValue(':codigo_canton',$_POST["adi_canton"],PDO::PARAM_STR);
    $query_par->execute();
    $row_par = $query_par->fetchAll();
    $rpta="<option value=''>Seleccione una opción</option>";
    foreach ($row_par as $row_par) {
    	$rpta.="<option value='".$row_par["dvp_codigo_parroquia"]."'>".$row_par["dvp_parroquia"]."</option>";
    }

    $data_result["rpta"] = $rpta;
    $data_result["message"] = "saveOK";

    if (isset($_POST["adi_parroquia"])) {
    	$data_result["adi_parroquia"] = $_POST["adi_parroquia"];
    }
    
    $data_result["numLineaCodigo"] = __LINE__;
	echo json_encode($data_result);
	}
	catch (Exception $ex) {
		$data_result["message"] = "salidaExcepcionCatch";
		$data_result["codError"] = $ex->getCode();
		$data_result["msjError"] = $ex->getMessage();
		$data_result["numLineaCodigo"] = __LINE__;
		echo json_encode($data_result);
	}
?>