<?php
  require_once("../../../controller/funcionesCore.php");
	require_once("../../../dctDatabase/Connection.php");
	require_once("../../../dctDatabase/Parameter.php");
	require_once("../../../controller/sesion.class.php");
  app_error_reporting($app_error_reporting);
  try {
  	$sesion = new sesion();
  	$dataSesion = $sesion->get('dataSesion');
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $pdo->beginTransaction();

    if ($_POST["cli_identificacion"] == "9999999999") {
    	$sql="SELECT cli_id_cliente, cli_tipo_identificacion, cli_identificacion, 
						    	 CONCAT(IFNULL(cli_nombre_1,''),' ',IFNULL(cli_nombre_2,''),' ',IFNULL(cli_apellido_1,''),' ',IFNULL(cli_apellido_2,'')) cli_nombres, 
						    	cli_correo, cli_direccion, cli_telefono, cli_placa
          FROM dct_pos_tbl_cientes
          WHERE cli_identificacion = :cli_identificacion;";
      $query=$pdo->prepare($sql);
	    $query->bindValue(':cli_identificacion',cleanData("siLimite",13,"noMayuscula",$_POST["cli_identificacion"]),PDO::PARAM_INT);
	    $query->execute();
	    $row = $query->fetch(\PDO::FETCH_ASSOC);
    }
    else {
    	$sql="SELECT cli_id_cliente, cli_tipo_identificacion, cli_identificacion, 
			    	CONCAT(IFNULL(cli_nombre_1,''),' ',IFNULL(cli_nombre_2,''),' ',IFNULL(cli_apellido_1,''),' ',IFNULL(cli_apellido_2,'')) cli_nombres, 
			    	cli_correo, cli_direccion, cli_telefono, cli_placa
          FROM dct_pos_tbl_cientes
          WHERE cli_identificacion = :cli_identificacion
          AND emp_id_empresa = :usr_id_empresa;";
      $query=$pdo->prepare($sql);
	    $query->bindValue(':cli_identificacion',cleanData("siLimite",13,"noMayuscula",$_POST["cli_identificacion"]),PDO::PARAM_INT);
	    $query->bindValue(':usr_id_empresa',cleanData("noLimite",0,"noMayuscula",$dataSesion["usr_id_empresa"]),PDO::PARAM_INT); 
	    $query->execute();
	    $row = $query->fetch(\PDO::FETCH_ASSOC);
    }  	

    if($query->rowCount() == 1) {		
    	$data_result["msmData"] = "siData";
      $data_result["data_row"] = $row;
	    $sql_2="UPDATE dct_pos_tbl_factura_transaccion 
							SET cli_id_cliente = :cli_id_cliente,
							ftr_usuario_modificacion = :ftr_usuario_modificacion,
							ftr_fecha_modificacion = now(),
							ftr_ip_modificacion = :ftr_ip_modificacion
							WHERE ftr_id_factura_transaccion = :ftr_id_factura_transaccion";
	    $query_2=$pdo->prepare($sql_2);          
	    $query_2->bindValue(':ftr_id_factura_transaccion',$_SESSION["id_factura_transaccion"],PDO::PARAM_INT);
	    $query_2->bindValue(':cli_id_cliente',$row["cli_id_cliente"],PDO::PARAM_INT); 
	    $query_2->bindValue(':ftr_usuario_modificacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
	    $query_2->bindValue(':ftr_ip_modificacion',getRealIP(),PDO::PARAM_STR);
	    $query_2->execute();
	    if($query_2) {
				$pdo->commit();
				$data_result["message"] = "saveOK";
				$data_result["numLineaCodigo"] = __LINE__;
			}
			else {
				$pdo->rollBack();
				$data_result["message"] = "saveError";
				$data_result["numLineaCodigo"] = __LINE__;
			}
		}
		else {
      $data_result["msmData"] = "noData";
      $data_result["numLineaCodigo"] = __LINE__;
		}	
		echo json_encode($data_result);

  } catch (Exception $ex) {
    $data_result["message"] = "salidaExcepcionCatch";
    $data_result["codError"] = $ex->getCode();
    $data_result["msjError"] = $ex->getMessage();
    $data_result["numLineaCodigo"] = __LINE__;
    echo json_encode($data_result);
  }
?> 