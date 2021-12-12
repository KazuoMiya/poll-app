<?php 
namespace db;

require_once SOURCE_BASE.'db/datasource.php';
use db\DataSource;
use model\UserModel;

class UserQuery {
    public static function fetchById($id){
        $db = new DataSource;
        $sql = 'select * from users where id = :id';
        $db->selectOne($sql, [
            ':id' => $id
        ], DataSource::CLS, UserModel::class);
    }
}