<?php
	require_once("../../../controller/misFunciones.php");
	require_once("../../../dctDatabase/Connection.php");
	require_once("../../../dctDatabase/Parameter.php");
	app_error_reporting($app_error_reporting);
	try {
		$ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
		$sql = "SELECT usr_cod_usuario, usr_nom_completos 
			FROM dct_sistema_tbl_usuario 
			WHERE usr_id_rol = 4
			AND usr_estado = 1" ;
		$query=$pdo->prepare($sql);
    $query->execute();
    $row = $query->fetchAll();
    $rpta="<option value=''>Seleccione una opción</option>";
    foreach ($row as $row) {
    	$rpta.="<option value='".$row["usr_cod_usuario"]."'>".$row["usr_nom_completos"]."</option>";
    }
		echo json_encode(array('message'=>"saveOK",'rpta'=>$rpta));
	}
	catch(SoapFault $exception){
	    echo $exception->getMessage();  
	}
?>