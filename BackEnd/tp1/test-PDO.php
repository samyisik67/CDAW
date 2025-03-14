<?php
    // initialise une variable $pdo connecté à la base locale
	require_once("initPDO.php");    // cf. doc / cours

	$request = $pdo->prepare("SELECT * FROM users");
    $request->execute();
    // à vous de compléter...
    $data = $request->fetch(PDO::FETCH_OBJ);
    // afficher un tableau HTML avec les donnéees en utilisant fetch(PDO::FETCH_OBJ)
    echo '<h1>Users</h1><ul>';
    echo '<table>';
        echo '<tr>
                <td>ID</td>
                <td>Nom</td>
                <td>Email</td>
            </tr>';
        while(!empty($data)){
        echo '<tr> 
                <li>
                <td>'  .$data->id. '</td>
                <td>' .$data->name.'</td>
                <td>'.$data->email.'</td>
                </li>
            </tr>';
            $data = $request->fetch(PDO::FETCH_OBJ);
        }
    '</table>';        
    
    /*** close the database connection ***/
    $pdo = null;
?>