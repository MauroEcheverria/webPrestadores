<?php
  class ConnectionDB {
    private static $conn;
    public function connect() {
      $host = 'localhost';
      
      $database = 'bd_prestadores';
      $user = 'root';
      $password = 'Dreconstec2022';
      
      /*
      $database = 'dreconst_prestadores_iess';
      $user = 'dreconst_admin';
      $password = 'D%#(#74hT3cf4#';
      */
      
      $charset = 'utf8mb4';
      $dsn = "mysql:host=$host;dbname=$database;port=3306;charset=$charset;options='--client_encoding=UTF8'";
      $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true
      ];
      try {
        $pdo = new \PDO($dsn, $user, $password, $options);
        return $pdo;
      } catch (\PDOException $e) {
        $data_result["message"] = "salidaExcepcionCatch";
        $data_result["codError"] = $ex->getCode();
        $data_result["msjError"] = $ex->getMessage();
        echo json_encode($data_result);
      }
    }
  }
?>