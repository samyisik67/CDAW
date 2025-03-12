<?php
    // initialise une variable $pdo connecté à la base locale
	require_once("initPDO.php");    // cf. doc / cours

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);

        $stmt = $pdo->prepare("INSERT INTO users  VALUES (0, :name, :email)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    };  

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

                <td>' .$data->id. '</td>
                <td>' .$data->name.'</td>
                <td>'.$data->email.'</td>
            
            </tr>';
            $data = $request->fetch(PDO::FETCH_OBJ);
        }
    '</table>';        
    
    echo '<form method="POST" action="test-PDO-post.php">';
    echo '<label for="name">Votre Nom :</label>';
    echo '<input type="text" id="name" name="name" required>';
    echo '<br>';
    echo '<label for="email">Votre email :</label>';
    echo '<input type="text" id="email" name="email" required>';
    echo '<br>';
    echo '<input type="submit" "name=ok" value="ok">';
    echo '<br>';
    echo '</form>';
    
    
    /*** close the database connection ***/
    $pdo = null;
?>