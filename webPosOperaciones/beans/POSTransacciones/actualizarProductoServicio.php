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
    $pdo->beginTransaction();

    $sql4="UPDATE dct_pos_tbl_factura_detalle
            SET fdt_cantidad = :fdt_cantidad,fdt_fecha_modificacion=now(),
            fdt_usuario_modificacion = :fdt_usuario_modificacion,
            fdt_ip_modificacion = :fdt_ip_modificacion
            WHERE fdt_id_factura_detalle = :fdt_id_factura_detalle;";
    $query4=$pdo->prepare($sql4);
    $query4->bindValue(':fdt_id_factura_detalle',cleanData("noLimite",0,"noMayuscula",$_POST["fdt_id_factura_detalle"]),PDO::PARAM_INT);
    $query4->bindValue(':fdt_cantidad',cleanData("noLimite",0,"noMayuscula",$_POST["fdt_cantidad_tbl"]),PDO::PARAM_INT);
    $query4->bindValue(':fdt_usuario_modificacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
    $query4->bindValue(':fdt_ip_modificacion',getRealIP(),PDO::PARAM_STR);
    $query4->execute();
      
    if($query4) {
      $pdo->commit();
      $data_result["message"] = "saveOK";
      echo json_encode($data_result);
    }
    else {
      $pdo->rollBack();
      $data_result["message"] = "saveError";
      echo json_encode($data_result);
    } 
      
  } catch (\PDOException $e) {
      throw $e;
      echo $e->getMessage();
  }
?>