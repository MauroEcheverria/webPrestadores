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
		 		$valid_extensions = array("png","jpg","jpeg");
		 		$imageFileType = strtolower(pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION));
			  if(in_array(strtolower($imageFileType), $valid_extensions)) {

  				$filename = $_POST["usr_cod_usuario"].".".$imageFileType;
  				$location = __DIR__."../../../uploadFile/".$filename;

			    $sql_1 = "SELECT usp_id_user_perfil, usp_nombre_file
			              FROM dct_sistema_tbl_usuario_perfil
			              WHERE usr_cod_usuario = :usr_cod_usuario";
			    $query_1=$pdo->prepare($sql_1);
			    $query_1->bindValue(':usr_cod_usuario',cleanData("siLimite",13,"noMayuscula",$_POST["usr_cod_usuario"]));
			    $query_1->execute();
			    $row_1 = $query_1->fetch(\PDO::FETCH_ASSOC);

			    if ($query_1->rowCount() == 0) {
			    	$sql_up="INSERT INTO dct_sistema_tbl_usuario_perfil(usr_cod_usuario, usp_nombre_file, usp_descripcion, usp_formacion, usp_dir_consultorio, usp_usuario_creacion, usp_fecha_creacion, usp_ip_creacion, usp_estado)
							    	VALUES (:usr_cod_usuario, :usp_nombre_file, :usp_descripcion, :usp_formacion, :usp_dir_consultorio, :usp_usuario_creacion, now(), :usp_ip_creacion, 'A')";
				    $query_up=$pdo->prepare($sql_up);
				    $query_up->bindValue(':usr_cod_usuario',cleanData("siLimite",13,"noMayuscula",$_POST["usr_cod_usuario"])); 
				    $query_up->bindValue(':usp_nombre_file',$filename);
				    $query_up->bindValue(':usp_descripcion',cleanData("siLimite",3000,"noMayuscula",$_POST["usp_descripcion"])); 
				    $query_up->bindValue(':usp_formacion',cleanData("siLimite",3000,"noMayuscula",$_POST["usp_formacion"]));
				    $query_up->bindValue(':usp_dir_consultorio',cleanData("siLimite",150,"noMayuscula",$_POST["usp_dir_consultorio"]));
				    $query_up->bindValue(':usp_usuario_creacion', cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]));
				    $query_up->bindValue(':usp_ip_creacion', getRealIP());
				    $query_up->execute();
			    }
			    else {

			    	if ($row_1["usp_nombre_file"] != "") {
			    		$location_1 = __DIR__."../../../uploadFile/".$row_1["usp_nombre_file"];
							unlink($location_1);
			    	}	
			    	$sql_up="UPDATE dct_sistema_tbl_usuario_perfil
							SET usp_nombre_file=:usp_nombre_file,usp_dir_consultorio=:usp_dir_consultorio,
							usp_descripcion=:usp_descripcion,usp_formacion=:usp_formacion,
							usp_usuario_modificacion=:usp_usuario_modificacion,usp_estado='A',
							usp_fecha_modificacion=now(),usp_ip_modificacion=:usp_ip_modificacion
							WHERE usp_id_user_perfil = :usp_id_user_perfil";
				    $query_up=$pdo->prepare($sql_up);
				    $query_up->bindValue(':usp_nombre_file',$filename);
				    $query_up->bindValue(':usp_id_user_perfil',$row_1["usp_id_user_perfil"]);
				    $query_up->bindValue(':usp_descripcion',cleanData("siLimite",3000,"noMayuscula",$_POST["usp_descripcion"])); 
				    $query_up->bindValue(':usp_formacion',cleanData("siLimite",3000,"noMayuscula",$_POST["usp_formacion"]));
				    $query_up->bindValue(':usp_dir_consultorio',cleanData("siLimite",150,"noMayuscula",$_POST["usp_dir_consultorio"]));
				    $query_up->bindValue(':usp_usuario_modificacion', cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]));
				    $query_up->bindValue(':usp_ip_modificacion', getRealIP());
				    $query_up->execute();
			    	
			    } 

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
							$data_result["dataModal_1"] = '<img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">';
				      $data_result["dataModal_2"] = 'Información';
				      $data_result["dataModal_3"] = 'Tuvimos un error al subir su información, inténtelo nuevamente.';
				      $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
							echo json_encode($data_result);
			      }

					}
					else {
						$pdo->rollBack();
						$data_result["message"] = "saveError";
						$data_result["dataModal_1"] = '<img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">';
			      $data_result["dataModal_2"] = 'Información';
			      $data_result["dataModal_3"] = 'Tuvimos un error al guardar su información, inténtelo nuevamente.';
			      $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
						echo json_encode($data_result);
					}

		   	}
		   	else {
		   		$data_result["message"] = "errorExtensionNo";
		   		$data_result["dataModal_1"] = '<img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">';
		      $data_result["dataModal_2"] = 'Información';
		      $data_result["dataModal_3"] = 'La extensión de su archivo no está permitida.';
		      $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
					echo json_encode($data_result);
		   	}
			}
			else {
				$data_result["message"] = "errorSize";
				$data_result["dataModal_1"] = '<img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">';
	      $data_result["dataModal_2"] = 'Información';
	      $data_result["dataModal_3"] = 'El tamaño de su archivo ha excedido el permitido.';
	      $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
				echo json_encode($data_result);
			} 
		}
		else {
			$sql_1 = "SELECT usp_id_user_perfil, usp_nombre_file
	              FROM dct_sistema_tbl_usuario_perfil
	              WHERE usr_cod_usuario = :usr_cod_usuario";
	    $query_1=$pdo->prepare($sql_1);
	    $query_1->bindValue(':usr_cod_usuario',cleanData("siLimite",13,"noMayuscula",$_POST["usr_cod_usuario"]));
	    $query_1->execute();
	    $row_1 = $query_1->fetch(\PDO::FETCH_ASSOC);

	    if ($query_1->rowCount() == 0) {
	    	$sql_up="INSERT INTO dct_sistema_tbl_usuario_perfil(usr_cod_usuario, usp_descripcion, usp_formacion, usp_dir_consultorio, usp_usuario_creacion, usp_fecha_creacion, usp_ip_creacion,usp_estado)
					    	VALUES (:usr_cod_usuario, :usp_descripcion, :usp_formacion, :usp_dir_consultorio, :usp_usuario_creacion, now(), :usp_ip_creacion,'A')";
		    $query_up=$pdo->prepare($sql_up);
		    $query_up->bindValue(':usr_cod_usuario',cleanData("siLimite",13,"noMayuscula",$_POST["usr_cod_usuario"])); 
		    $query_up->bindValue(':usp_descripcion',cleanData("siLimite",3000,"noMayuscula",$_POST["usp_descripcion"])); 
		    $query_up->bindValue(':usp_formacion',cleanData("siLimite",3000,"noMayuscula",$_POST["usp_formacion"]));
		    $query_up->bindValue(':usp_dir_consultorio',cleanData("siLimite",150,"noMayuscula",$_POST["usp_dir_consultorio"]));
		    $query_up->bindValue(':usp_usuario_creacion', cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]));
		    $query_up->bindValue(':usp_ip_creacion', getRealIP());
		    $query_up->execute();
	    }
	    else {
	    	$sql_up="UPDATE dct_sistema_tbl_usuario_perfil
					SET usp_descripcion=:usp_descripcion,usp_formacion=:usp_formacion,
					usp_usuario_modificacion=:usp_usuario_modificacion,
					usp_dir_consultorio=:usp_dir_consultorio,usp_estado='A',
					usp_fecha_modificacion=now(),usp_ip_modificacion=:usp_ip_modificacion
					WHERE usp_id_user_perfil = :usp_id_user_perfil";
		    $query_up=$pdo->prepare($sql_up);
		    $query_up->bindValue(':usp_id_user_perfil',$row_1["usp_id_user_perfil"]);
		    $query_up->bindValue(':usp_descripcion',cleanData("siLimite",3000,"noMayuscula",$_POST["usp_descripcion"])); 
		    $query_up->bindValue(':usp_formacion',cleanData("siLimite",3000,"noMayuscula",$_POST["usp_formacion"])); 
		    $query_up->bindValue(':usp_dir_consultorio',cleanData("siLimite",150,"noMayuscula",$_POST["usp_dir_consultorio"]));
		    $query_up->bindValue(':usp_usuario_modificacion', cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]));
		    $query_up->bindValue(':usp_ip_modificacion', getRealIP());
		    $query_up->execute();
	    	
	    } 
			if($query_up){
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
				$data_result["message"] = "saveError";
				$data_result["dataModal_1"] = '<img src="../../../dist/img/visto.png" width="30px" heigth="20px">';
	      $data_result["dataModal_2"] = 'Información';
	      $data_result["dataModal_3"] = 'Tuvimos un error al guardar su información, inténtelo nuevamente.';
	      $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
				echo json_encode($data_result);
      }
		}

	} catch (\PDOException $e) {
	    echo $e->getMessage();
	}

?>