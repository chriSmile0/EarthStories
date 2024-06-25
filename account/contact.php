<?php
require('../inc/header.php');
$nom = $prenom = $email = $mdp = "";
$nomErr = $prenomErr = $pseudoErr = $emailErr = $textAreaErr =  $MdpErr = "";

/**
 * [BRIEF]	Sanitize input element
 * @param 	$data	the data was in the input fields
 * @example test_input22("'=1 ' Hello")
 * @author	chriSmile0
 * @return	array|string	the content return by the htmlspecialchars 
*/
function test_input2($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function validate_textarea(string $textarea) {
	$textarea_ = test_input2($textarea);
	if(!preg_match("/^[0-9a-zA-Z- é]{1,1000}$/",$textarea)) {
		$GLOBALS['textAreaErr'] = "Espace et tiret autorisés ainsi que les majuscules 1000 caractères par étape max"; 
		return FALSE;
	}
	return $textarea_;
}


function validate_email(string $email) {
	$mail = test_input2($email);
	if(!filter_var($mail,FILTER_VALIDATE_EMAIL)) {
		$GLOBALS['emailErr'] = "nom_prenom@gmail.com est un example d'adresse email valide";
		return FALSE;
	}
	return $mail;
}

function validate_name(string $name, string $type) {
	$nom = test_input2($name);
	if(!preg_match("/^[a-zA-Z- é]{1,50}$/",$nom)) {
		switch($type) {
			case "prenom":
				$GLOBALS['prenomErr'] = "Espace et tiret autorisés ainsi que les majuscules";  
				break;
			case "nom":
				$GLOBALS['nomErr'] = "Espace et tiret autorisés ainsi que les majuscules";  
				break;
			case "pseudo":
				$GLOBALS['pseudoErr'] = "Espace et tiret autorisés ainsi que les majuscules";  
				break;
			default:
				break;
			}
		return FALSE;
	} 
	return $nom;
}

function validate_pass(string $pass) {
	$pass_ = test_input2($pass);
	if(!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{10,}$/",$pass_)) {
		$GLOBALS['MdpErr'] = "Des lettres minuscules ET majuscules, au moins un caractère spécial, des chiffres, minimum 10 caractères";
		return FALSE;
	}
	return $pass_;
}



function create_accounts_db_table() {
	try {
		$bdd = new PDO('sqlite:' . dirname(__FILE__) . '/database.db');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE TABLE IF NOT EXISTS Accounts (
				id INTEGER PRIMARY KEY AUTOINCREMENT ,
				name VARCHAR(40) NOT NULL,
				firstname VARCHAR(50) NOT NULL,
				pseudo VARCHAR(40) NOT NULL,
				email VARCHAR(50) UNIQUE NOT NULL,
				pass TEXT UNIQUE NOT NULL
			)";
		$bdd->exec($sql);
		$bdd = null;
	}
	catch (PDOException $e) {
		var_dump($e->getMessage());
	}
}

/*
function argon2idHash($plaintext, $password, $encoding = null) {
    $plaintextsecured = hash_hmac("sha256", $plaintext, $password);
    return $encoding == "hex" ? bin2hex(password_hash($plaintextsecured, PASSWORD_ARGON2ID)) : ($encoding == "base64" ? base64_encode(password_hash($plaintextsecured, PASSWORD_ARGON2ID)) : password_hash($plaintextsecured, PASSWORD_ARGON2ID));
}

function argon2idHashVerify($plaintext, $password, $hash, $encoding = null) {
    $plaintextsecured = hash_hmac("sha256", $plaintext, $password);
    return password_verify($plaintextsecured, $encoding == "hex" ? hex2bin($hash) : ($encoding == "base64" ? base64_decode($hash) : $hash)) ? true : false;
}

$salt = "LALALA";
argon2idHash($clearvalue, $salt, "hex"); // with encoding
argon2idHash($clearvalue, $salt); // without encoding

$salt = "LALALA";
argon2idHashVerify($clearvalue, $salt, $hashtoverify, "hex") ? "match" : "dont match"; // with encoding
argon2idHashVerify($clearvalue, $salt, $hashtoverify) ? "match" : "dont match"; // without encoding
*/

/*function authUser($id, $password) {
	$userInfo = $this->getUser($id);

	// Do you have old, turbo-legacy, non-crypt hashes?
	if( strpos( $userInfo['password'], '$' ) !== 0 ) {
		printf("%s::legacy_hash\n", __METHOD__);
		$res = $userInfo['password'] === md5($password . $userInfo['salt']);
	} else {
		printf("%s::password_verify\n", __METHOD__);
		$res = password_verify($password, $userInfo['password']);
	}

	// once we've passed validation we can check if the hash needs updating.
	if( $res && password_needs_rehash($userInfo['password'], PASSWORD_DEFAULT) ) {
		printf("%s::rehash\n", __METHOD__);
		$stmt = $this->dbh->prepare('UPDATE users SET pass = ? WHERE user_id = ?');
		$stmt->execute([password_hash($password, PASSWORD_DEFAULT), $id]);
	}

	return $res;
}*/

function hash_pass(string $pass) {
	return password_hash($pass, PASSWORD_BCRYPT);// PASSWORD_ARGON2ID better with big cost -> ARGON2ID not enable on php 8.0.28 IDK WHY
}

function hash_pass_verify(string $pass, string $hash) {
	if(password_verify($pass,$hash)) {
		if(password_needs_rehash($hash, PASSWORD_BCRYPT)) 
			return password_hash($pass, PASSWORD_BCRYPT);
		return true;
	}
	else {
		return false;
	} 
}

function auth_user_pass($id, string $pass, string $hash) {
	return (($res=hash_pass_verify($pass,$hash)) === FALSE) ? "ERROR_PASS" : (($res === TRUE) ? "OK_PASS" : ((update_pass_db_table($id,$res)) ? "UPDATE_PASS" : "ERROR_UPDATE_PASS"));
}

function auth_user(string $email, string $pass) {
	$infos = select_account_db_table($email);
	if(!empty($infos)) {
		if(auth_user_pass($infos['id'],$pass,$infos['pass'])==="OK_PASS") {
			$_SESSION['userName'] = $infos['pseudo'];
			$_SESSION['email'] = $infos['email'];
			return "OK_PASS";
		}
	}
	return "USER_NOT_FOUND";
}

function select_account_db_table($email) : array {
	$mail = test_input2($email); // to comment if use this only with php
	if(!validate_email($mail))
		return array(); // NOT VALIDE EMAIL 
	try {
		$bdd = new PDO('sqlite:' . dirname(__FILE__) . '/database.db');
		$sql = "SELECT * from Accounts WHERE email = :e ";
		$stmt = $bdd->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
		$stmt->execute([':e'=> $mail]);
		$res = $stmt->fetchAll();
		if(sizeof($res) == 1) 
			return $res[0];
		
	}
	catch (PDOException $e) {
		var_dump($e->getMessage());
	}
	return array();
}

function update_pass_db_table($id, string $pass) {
	try {
		$bdd = new PDO('sqlite:' . dirname(__FILE__) . '/database.db');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE Accounts SET pass = :p WHERE id = :i";
		$stmt = $bdd->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
		$stmt->execute([':p'=> $pass,':i'=> $id]);
	}
	catch (PDOException $e) {
		var_dump($e->getMessage());
	}
}

function insert_accounts_db_table(array $elems) {
	$v = (($elems[0] = validate_name($elems[0],"nom")) && ($elems[1] = validate_name($elems[1],"prenom")) && ($elems[2] = validate_name($elems[2],"pseudo")) && ($elems[3] = validate_email($elems[3])) && ($elems[4] = ($p=validate_pass($elems[4])) ? hash_pass($p) : FALSE)); 
	if(!$v)
		return FALSE;
	try {
		$bdd = new PDO('sqlite:' . dirname(__FILE__) . '/database.db');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO Accounts (name,firstname,pseudo,email,pass) 
				VALUES (:n,:f,:ps,:e,:p)";
		$stmt = $bdd->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
		$stmt->execute([':n'=> $elems[0],':f'=> $elems[1],':ps'=> $elems[2],':e'=> $elems[3],':p'=> $elems[4]]);
	}
	catch (PDOException $e) {
		var_dump($e->getMessage());
	}
}

function account_connexion(string $email, string $pass) {
	return auth_user($email,$pass);
}


if(isset($_POST['submitcrea'])) { #On a cliqué sur le premier bouton
	insert_accounts_db_table(array($_POST['nom'],$_POST['prenom'],$_POST['pseudo'],$_POST['email'],$_POST['pass'])); // VALIDATE 
}

if(isset($_POST['submitident'])) {
	$a_c_res = account_connexion($_POST['email'],$_POST['pass']); // VALIDATE 
	if($a_c_res === "OK_PASS") 
		header('Location: ../home/');
	
}


//---	OK FUNCTIONS ---

//create_accounts_db_table();
/*$to_add_in_table = array("nom","prenom","Dolphin","chr@gmail.com","123#lopMAyy");
insert_accounts_db_table($to_add_in_table); // VALIDATE
//var_dump(account_connexion("chr@gmail.com","123#lopMAyy"));*/ // VALIDATE 

//---	END OK FUNCTIONS ---

//session_destroy();

?> 