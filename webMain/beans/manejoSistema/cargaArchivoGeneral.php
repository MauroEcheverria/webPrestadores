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
		$pdo->beginTransaction();

		if(isset($_FILES['file']['name'])){
		  /*
			1 MB-> BIT =  1048576
			2 MB-> BIT =  2097152
			3 MB-> BIT =  3145728
			4 MB-> BIT =  4194304
			5 MB-> BIT =  5242880
		  */
		 	if ($_FILES["file"]["size"] <= 3145728) {
		 		$valid_extensions = array("jpg","jpeg","png","pdf");
		 		$imageFileType = strtolower(pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION));
			  if(in_array(strtolower($imageFileType), $valid_extensions)) {

  				$filename = $fechaActual_3."_".$_POST["usr_cod_usuario"].".".$imageFileType;
  				$location = __DIR__."../../../uploadFile/".$filename;

			    $sql_1 = "SELECT arc_id_user_archivo , arc_nombre_file
			              FROM dct_sistema_tbl_usuario_archivo
			              WHERE usr_cod_usuario = :usr_cod_usuario
			              AND arc_estado = 'A'";
			    $query_1=$pdo->prepare($sql_1);
			    $query_1->bindValue(':usr_cod_usuario',cleanData("siLimite",13,"noMayuscula",$_POST["usr_cod_usuario"]));
			    $query_1->execute();
			    $row_1 = $query_1->fetch(\PDO::FETCH_ASSOC);

			    $sql_crt="SELECT pa.crt_valor_1 
			  	FROM dct_parametro_tbl_criterio pa 
			  	WHERE pa.crt_cod_criterio =:crt_cod_criterio
			  	AND crt_estado = 'A'";
			    $query_crt=$pdo->prepare($sql_crt);
			    $query_crt->bindValue(':crt_cod_criterio','ARC_MEDICO_ING'); 
			    $query_crt->execute();
			    $row_crt = $query_crt->fetch(\PDO::FETCH_ASSOC);

			    if ($query_1->rowCount() < $row_crt["crt_valor_1"]) {
			    	$sql_up="INSERT INTO dct_sistema_tbl_usuario_archivo(usr_cod_usuario, arc_nombre_file, arc_estado, arc_usuario_creacion, arc_fecha_creacion, arc_ip_creacion)
							    	VALUES (:usr_cod_usuario, :arc_nombre_file, :arc_estado, :arc_usuario_creacion, now(), :arc_ip_creacion)";
				    $query_up=$pdo->prepare($sql_up);
				    $query_up->bindValue(':usr_cod_usuario',cleanData("siLimite",13,"noMayuscula",$_POST["usr_cod_usuario"])); 
				    $query_up->bindValue(':arc_nombre_file',$filename);
				    $query_up->bindValue(':arc_estado','A');
				    $query_up->bindValue(':arc_usuario_creacion', cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]));
				    $query_up->bindValue(':arc_ip_creacion', getRealIP());
				    $query_up->execute();

						if($query_up) {

							if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
								$pdo->commit();
				        $data_result["message"] = "saveOK";
								$data_result["dataModal_1"] = '<img src="../../../dist/img/visto.png" width="30px" heigth="20px">';
					      $data_result["dataModal_2"] = 'Información';
					      $data_result["dataModal_3"] = 'Su información se ha subido de manera correcta.';
					      $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
								echo json_encode($data_result);
				      }
				      else {
				      	$pdo->rollBack();
								$data_result["message"] = "noUpload";
								$data_result["dataModal_1"] = '<img src="../../../dist/img/visto.png" width="30px" heigth="20px">';
					      $data_result["dataModal_2"] = 'Información';
					      $data_result["dataModal_3"] = 'Tuvimos un error al subir su información, inténtelo nuevamente.';
					      $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
								echo json_encode($data_result);
				      }

						}
						else {
							$pdo->rollBack();
							$data_result["message"] = "saveError";
							$data_result["dataModal_1"] = '<img src="../../../dist/img/visto.png" width="30px" heigth="20px">';
				      $data_result["dataModal_2"] = 'Información';
				      $data_result["dataModal_3"] = 'Tuvimos un error al guardar su información, inténtelo nuevamente.';
				      $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
							echo json_encode($data_result);
						}
			    }
			    else {
			    	$pdo->rollBack();
			    	$data_result["message"] = "limiteAlcanzado";
			    	$data_result["dataModal_1"] = '<img src="../../../dist/img/visto.png" width="30px" heigth="20px">';
			      $data_result["dataModal_2"] = 'Información';
			      $data_result["dataModal_3"] = 'Ha alcanzado el máximo de archivos permitidos, elimine alguno para poder proseguir.';
			      $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
						echo json_encode($data_result);
			    }
		   	}
		   	else {
		   		$data_result["message"] = "errorExtensionNo";
		   		$data_result["dataModal_1"] = '<img src="../../../dist/img/visto.png" width="30px" heigth="20px">';
		      $data_result["dataModal_2"] = 'Información';
		      $data_result["dataModal_3"] = 'La extensión de su archivo no está permitida.';
		      $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
					echo json_encode($data_result);
		   	}
			}
			else {
				$data_result["message"] = "errorSize";
				$data_result["dataModal_1"] = '<img src="../../../dist/img/visto.png" width="30px" heigth="20px">';
	      $data_result["dataModal_2"] = 'Información';
	      $data_result["dataModal_3"] = 'El tamaño de su archivo ha excedido el permitido.';
	      $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
				echo json_encode($data_result);
			} 
		}
		else {
			$data_result["message"] = "errorNoFile";
			$data_result["dataModal_1"] = '<img src="../../../dist/img/visto.png" width="30px" heigth="20px">';
      $data_result["dataModal_2"] = 'Información';
      $data_result["dataModal_3"] = 'Debe proporcionar un archivo para poder guardarlo.';
      $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
			echo json_encode($data_result);
		}

	} catch (\PDOException $e) {
	    echo $e->getMessage();
	}

?>