<?php
class User{
    public $id;
    public $name;
    public $email;
    
    public static function db(){
        define('_MYSQL_HOST','127.0.0.1');
        define('_MYSQL_PORT',3306);
        define('_MYSQL_DBNAME','dbtest');
        define('_MYSQL_USER','root');
        define('_MYSQL_PASSWORD','');

        $connectionString = "mysql:host=". _MYSQL_HOST;

        if(defined('_MYSQL_PORT'))
            $connectionString .= ";port=". _MYSQL_PORT;

        $connectionString .= ";dbname=" . _MYSQL_DBNAME;
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' );

        try {
            $pdo = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD,$options);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $erreur) {
                echo 'Erreur : '.$erreur->getMessage();
        }
        return $pdo;
    }

    public static function getAllUsers(){
        $pdo = static::db();
        $st = $pdo->query("SELECT * FROM users");
        $st->execute();
        $st->setFetchMode(PDO::FETCH_CLASS,get_called_class());
        return $st;
    }

    public static function showAllUsersAsTable(){    
        $users = static::getAllUsers();
        echo '<h1>Users</h1><ul>';
        echo '<table border="1">';
        echo '<tr>
                <td>ID</td>
                <td>Name</td>
                <td>Email</td>
            </tr>';
            foreach($users as $user){
                echo $user->toHtml();
            }
        echo "</table>";


    }

    public function toHtml(){
        echo "<tr>
            <td>{$this->id}</td>
            <td>{$this->name}</td>
            <td>{$this->email}</td>
         </tr>";
    }


}
?>

<?php
	User::showAllUsersAsTable();
?>