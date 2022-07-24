<?php
	require_once("../../../controller/funcionesCore.php");
	require_once("../../../dctDatabase/Connection.php");
	require_once("../../../dctDatabase/Parameter.php");
	app_error_reporting($app_error_reporting);
	try {
		$ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
		$sql_can = "SELECT DISTINCT dvp_codigo_canton, dvp_canton
						FROM dct_parametro_tbl_div_politica
						WHERE dvp_codigo_provincia = :codigo_provincia 
						ORDER BY 1;" ;
		$query_can=$pdo->prepare($sql_can);
		$query_can->bindValue(':codigo_provincia', $_POST["adi_provincia"]);
    $query_can->execute();
    $row_can = $query_can->fetchAll();
    $rpta="<option value=''>Seleccione una opción</option>";
    foreach ($row_can as $row_can) {
    	$rpta.="<option value='".$row_can["dvp_codigo_canton"]."'>".$row_can["dvp_canton"]."</option>";
    }
		echo json_encode(array('message'=>"saveOK",'rpta'=>$rpta));
	}
	catch(SoapFault $exception){
	    echo $exception->getMessage();  
	}
?>