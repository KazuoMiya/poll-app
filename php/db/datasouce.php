<?php 
namespace db;

use PDO;

class DataSource {

    private $conn;
    private $sqlResult;

    public function __construct($host = 'localhost', $port = '8889', $dbName = 'pollapp', $username = 'test', $userpassword = 'test'){
        $dsn = "mysql:host={$host};port={$port};dbname={$dbName}";
        $this->conn = new PDO($dsn, $username, $userpassword);
        $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
    public function select($sql = '', $params = []){
        $stmt = $this->executeSql($sql, $params);
        return $stmt->fetchAll();
    }

    public function execute($sql = '', $params = []){
        $this->executeSql($sql, $params);
        return $this->sqlResult;
    }

    public function selectOne($sql, $params){
        $result =  $this->select($sql, $params);
        return count($result) > 0 ? $result[0] : false;
    }

    public function begin(){
        $this->conn->beginTransaction();
    }

    public function commit(){
        $this->conn->commit();
    }

    public function rollBack(){
        $this->conn->rollBack();
    }

    // public function update($sql = '', $params = []){
    //     $stmt = $this->conn->prepare($sql);
    //     $reault = $stmt->execute($params);
    //     return $reault;
    // }

    private function executeSql($sql = '', $params = []){
        $stmt = $this->conn->prepare($sql);
        $this->sqlResult = $stmt->execute($params);
        return $stmt;
    }
}