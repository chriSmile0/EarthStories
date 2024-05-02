<?php
setcookie("rememberMe","true",time()+(365*2*3600),'/');
$_COOKIE["rememberMe"];

$nom = $prenom = $email = "";
$nomErr = $prenomErr = $emailErr = "";

function test_input($data) {
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['submitcrea'])) { #On a cliqué sur le premier bouton
	if (empty($_POST['nom']))
		$nom = "No";
	else {
		$nom = test_input($_POST['nom']);
		if(!preg_match("/^[a-zA-Z- é]{1,50}$/",$nom))
			$nomErr = "Espace et tiret autorités ainsi que les majuscules";   
	}

	if (empty($_POST['prenom']))
		$prenom = "No";
	else {
		$prenom = test_input($_POST['prenom']);
		if(!preg_match("/^[a-zA-Z-é ]{1,50}$/",$prenom))
			$prenomErr = "Espace et tiret autorités ainsi que les majuscules";
	}

    if (empty($_POST['mdp']))
		$prenom = "No";
	else {
		$prenom = test_input($_POST['prenom']);
		if(!preg_match("/^[a-zA-Z-é ]{1,50}$/",$prenom))
			$prenomErr = "Espace et tiret autorités ainsi que les majuscules";
	}

	if (empty($_POST['email']))
		$email = "No";
	else {
		$email = test_input($_POST['email']);
		if(!filter_var($email,FILTER_VALIDATE_EMAIL))
			$emailErr = "Format d'email invalide"; 
	}
    
    try {
        $bdd = new PDO('sqlite:' . dirname(__FILE__) . '/database.db');
        $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
        $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        echo "connected";
        $sql = "CREATE TABLE IF NOT EXISTS Contacts (
            id INTEGER PRIMARY KEY AUTOINCREMENT ,
            nom VARCHAR(30) NOT NULL,
            prenom VARCHAR(30) NOT NULL,
            email VARCHAR(50)
            )";
            
        $bdd->exec($sql);
        echo "creation ok";
    }
    catch (PDOException $e){
        var_dump($e->getMessage());
    }
    try {
        $sql = "INSERT INTO Contacts (nom, prenom, email)
        VALUES ('$nom','$prenom','$email')";
        //Reqûete préparer ici avec .prepare();
        $bdd->exec($sql);
        echo "insertion ok ";
    }
    catch (PDOException $e) {
        var_dump($e->getMessage());
    }

    try {
        $sql = "SELECT nom,prenom,email from Contacts 
        WHERE id IN (SELECT max(id) FROM Contacts)";
        //Requête préparer ici aussi avec .prepare();
        $result  = $bdd->query($sql);
        $row = $result->fetch();
        $YourInput = "<h4>Vos données de contacts</h4>" ;
        $nom_donnees = "Nom : " . $row['nom'] . "<br>";
        $prenom_donnees = "Prenom : " . $row['prenom'] . "<br>";
        $email_donnees = "Email : " . $row['email'] . "<br>";
    }
    catch(PDOEXCEPTION $e){
        var_dump($e->getMessage());
    }

    $bdd = null;
}
?> 