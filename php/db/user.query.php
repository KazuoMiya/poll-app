<?php 
namespace db;

require_once SOURCE_BASE.'db/datasource.php';
require_once SOURCE_BASE.'models/user.model.php';

use db\DataSource;
use model\UserModel;

class UserQuery {
    public static function fetchById($id){
        $db = new DataSource;
        $sql = 'select * from users where id = :id';
        $result = $db->selectOne($sql, [
            ':id' => $id
        ], DataSource::CLS, UserModel::class);

        return $result;
    }
}