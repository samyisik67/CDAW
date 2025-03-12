<?php
require_once("DatabaseConnector.php");

class UserModel
{

    public static function getAllUsers(){
        $pdo = DatabaseConnector::current() ;
        $st = $pdo->query("SELECT * FROM users");
        $st->execute();
        $st->setFetchMode(PDO::FETCH_CLASS,get_called_class());
        return $st;
    }
}