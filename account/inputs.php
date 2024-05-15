<?php

require('contact.php');
require('../home/map.php');

$categoryErr = $storyErr = $countryErr = "";
$contenus = array('geographie'=>"La Géographie",'culture'=>"La culture",
						'voyages'=>"Les Voyages",'sciences'=>"Les Sciences",
						'recits'=>"Les Récits",'celebrity'=>"Les Célébrités");

/**
 * [BRIEF]	Test if the select value is in predifined values
 * @param 	/		$select_elem	the value of elem select
 * @param	array	$values			predifined values
 * @example 
 * @author	chriSmile0
 * @return 	/	The element or NULL
*/
function validate_category($select_elem) {
	$values = ["geographie","culture","voyages","sciences","recits","celebrity"];
	if(in_array($select_elem,$values))
		return $select_elem;
	else {
		$GLOBALS['categoryErr'] = "geographie/culture/voyages/sciences/recits/celebrity" ;
		return FALSE;
	}
}

function validate_country($select_elem) {
	if(in_array($select_elem,$GLOBALS['ar_titles']))
		return $select_elem;
	else {
		$GLOBALS['countryErr'] = "Pays dans la liste des propositions";
		return FALSE;
	}
}

function choice_country() {
	$head = "<div id=\"countries\"class=\"fdiv fdiv__story\"><label for=\"country\">Choix du pays</label><input id=\"country\" type=\"select\" placeholder=\"France\" name=\"country\" aria-labelledby=\"country\" list=\"countryList\"><datalist id=\"countryList\">";
	$content = "";
	/*$ct = array_combine($GLOBALS['ar_id'],$GLOBALS['ar_titles']);
	foreach($ct as $id => $pays) 
			$content .= "<option id=\"$id\" value=\"$pays\">";*/
	$end = "</datalist></div>";
	return $head . $content . $end;
}


if(isset($_POST['listing'])) {
	$arr = array();
	$recv = $_POST['listing'];
	$rt = "";
	foreach($GLOBALS['ct'] as $id => $value) {
		if((strpos($value,$recv)) !== FALSE) {
			$rt .= "<option id=\"$id\" value=\"$value\">";
		}
	}
	array_push($arr,$rt);
	echo json_encode($arr);
}

function create_inputs_db_table() {
	try {
		$bdd = new PDO('sqlite:' . dirname(__FILE__) . '/i_database.db');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE TABLE IF NOT EXISTS Inputs (
				id INTEGER PRIMARY KEY AUTOINCREMENT ,
				email VARCHAR(40) NOT NULL,
				geographie TEXT NOT NULL,
				culture TEXT NOT NULL,
				voyages TEXT NOT NULL,
				sciences TEXT NOT NULL,
				recits TEXT NOT NULL,
				celebrity TEXT NOT NULL
			)"; // FOR THE MOMENT WITH ELEMENT IN EACH TEXT SEPARATE WITH specific character '\n' 
				// for example to parse and display each element in the inputs_display in account
		$bdd->exec($sql);
		$bdd = null;
	}
	catch (PDOException $e) {
		var_dump($e->getMessage());
	}
}

function display_each_category(string $categorie, string $content) {
	$head = "<div class=\"profile_inputs\">\n<h4>$categorie</h4>";
	$content_ = explode("|",$content); 
	$res = "";
	foreach($content_ as $c) {
		$res .= "<p class=\"profile_inputs_p\">$c</p>\n";
	}
	$end = "</div>\n";
	return $head . $res . $end;
}

function insert_inputs_db_table(array $elems) {
	$v = (($elems[0] = validate_country($elems[0])) && ($elems[2] = validate_category($elems[2],["geographie","culture","voyages","sciences","recits","celebrity"])) && ($elems[2] = validate_textarea($elems[2],"pseudo")));
	if(!$v)
		return FALSE;
	try {
		$res = select_inputs_v0($_SESSION['email']);
		$adds_story = "";
		$bdd = new PDO('sqlite:' . dirname(__FILE__) . '/i_database.db');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if($res[0][$elems[1]] !== "") {
			$adds_story .=  $res[0][$elems[1]] . "|" . $elems[2];
			$category = $elems[1];
			$country = $elems[0];
			$content = $elems[2];
			$sql_u = "UPDATE Inputs SET "; // TRIGGER BETTER BUT NOT FOR THE MOMENT 
			$stmt = $bdd->prepare($sql_u, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
			$stmt->execute([':val'=> ($res[0]['visits'])+1]);
		}
		
		/*$sql = "INSERT INTO Inputs (name,firstname,pseudo,email,pass) 
				VALUES (:n,:f,:ps,:e,:p)";
		$stmt = $bdd->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
		$stmt->execute([':n'=> $elems[0],':f'=> $elems[1],':ps'=> $elems[2],':e'=> $elems[3],':p'=> $elems[4]]);*/
	}
	catch (PDOException $e) {
		var_dump($e->getMessage());
	}
}

function select_inputs_v0(string $email) {
	try {
		$bdd = new PDO('sqlite:' . dirname(__FILE__) . '/i_database.db');
		//$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * from Inputs WHERE email = :e ";
		$stmt = $bdd->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
		$stmt->execute([':e'=> $email]);
		$res = $stmt->fetchAll();
		if(sizeof($res) == 1) // RE-CHECK OF EMAIL 
			return $res[0];
		else 
			return "";
	}
	catch (PDOException $e) {}
	return "";
}

function select_inputs(string $email) { 
	try {
		$bdd = new PDO('sqlite:' . dirname(__FILE__) . '/i_database.db');
		$sql = "SELECT * from Inputs WHERE email = :e ";
		$stmt = $bdd->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
		$stmt->execute([':e'=> $email]);
		$res = $stmt->fetchAll();
		if(sizeof($res) == 1) { // RE-CHECK OF EMAIL 
			$r = "";
			$contenus = array("La Géographie","La culture","Les Voyages","Les Sciences"
						,"Les Récits","Les Célébrités");
			for($i = 2; $i < 8; $i++) {
				$r .= display_each_category($contenus[$i-2],$res[$i]);
			}
			return $r;
		}
		else {
			return "<h4>STORIES HERE</h4>";
		}
		
	}
	catch (PDOException $e) {}
	return "<h4>STORIES HERE</h4>";
}

function your_inputs() {
	$mail = test_input2($_SESSION['email']); // to comment if use this only with php
	if(!validate_email($mail))
		return "mail:$mail  //"; // NOT VALIDE EMAIL 
	try {
		$bdd = new PDO('sqlite:' . dirname(__FILE__) . '/database.db');
		$sql = "SELECT * from Accounts WHERE email = :e ";
		$stmt = $bdd->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
		$stmt->execute([':e'=> $mail]);
		$res = $stmt->fetchAll();
		if(sizeof($res) == 1) { // RE-CHECK OF EMAIL 
			return select_inputs($mail);
		}
		
	}
	catch (PDOException $e) {}
	return "/__";
}
/**--------------------------V2 DATABASE SCHEMA --------------------- */
/**
 * AUTHORS: AUTHOR_ID|PSEUDO|
 * STORIES 	STORY_ID|AUTHOR_ID|COUNTRY|STORY
 * 			
 * 
*/

function create_authors_db_table() {
	try {
		$bdd = new PDO('sqlite:' . dirname(__FILE__) . '/i_database.db');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE TABLE IF NOT EXISTS Authors (
				author_id INTEGER PRIMARY KEY,
				pseudo VARCHAR(40) NOT NULL
			)"; // FOR THE MOMENT WITH ELEMENT IN EACH TEXT SEPARATE WITH specific character '\n' 
				// for example to parse and display each element in the inputs_display in account
		$bdd->exec($sql);
		$bdd = null;
	}
	catch (PDOException $e) {
		var_dump($e->getMessage());
	}
}

function create_stories_db_table() {
	try {
		$bdd = new PDO('sqlite:' . dirname(__FILE__) . '/i_database.db');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE TABLE IF NOT EXISTS Stories (
				story_id INTEGER PRIMARY KEY AUTOINCREMENT ,
				author_id INTEGER,
				country VARCHAR(40) NOT NULL,
				category VARCHAR(12) NOT NULL,
				story TEXT NOT NULL,
				CONSTRAINT FK_AUid FOREIGN KEY (author_id) REFERENCES Authors(author_id),
				CONSTRAINT CHK_CAT CHECK(category='geographie' OR category='culture' OR  category='voyages' OR 
											category='sciences' OR  category='recits' OR  category='celebrity') 
			)"; // FOR THE MOMENT WITH ELEMENT IN EACH TEXT SEPARATE WITH specific character '\n' 
				// for example to parse and display each element in the inputs_display in account
		$bdd->exec($sql);
		$bdd = null;
	}
	catch (PDOException $e) {
		var_dump($e->getMessage());
	}
}

function select_author_db_table(string $research_element, $element) {
	if($research_element !== 'author_id' && $research_element !== 'pseudo')
		return "";
	$r = $research_element;
	if($r == 'pseudo')
		$p = validate_name($element,"pseudo");
	else 
		$p = $element;
	try {
		$bdd = new PDO('sqlite:' . dirname(__FILE__) . '/i_database.db');
		$sql = "SELECT * from Authors WHERE $r = :p ";
		$stmt = $bdd->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
		$stmt->execute([':p'=> $p]);
		$res = $stmt->fetchAll();
		if(sizeof($res) == 1) { // RE-CHECK OF EMAIL 
			return $res[0];
		}
		
	}
	catch (PDOException $e) {}
	return "";
}

function insert_author(string $email, string $pseudo) { // $_SESSION['userName'] && $_SESSION['pseudo']
	$v = (($p=validate_name($pseudo,"pseudo")) && ($e = validate_email($email)));
	if(!$v)
		return FALSE;
	try {
		$res = select_account_db_table($e);
		if($res['email']!==$e && ($res['pseudo']!==$p))
			return FALSE;
		$bdd = new PDO('sqlite:' . dirname(__FILE__) . '/i_database.db');
		$sql = "INSERT INTO Authors (author_id,pseudo) 
				VALUES (:a,:p)";
		$stmt = $bdd->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
		$stmt->execute([':a'=> intval($res['id']),':p'=> $p]);
	}
	catch (PDOException $e) {
		var_dump($e->getMessage());
	}
}

function select_story_db_table(int $story_id) {
	try {
		$bdd = new PDO('sqlite:' . dirname(__FILE__) . '/i_database.db');
		$sql = "SELECT * from Stories WHERE story_id = :s ";
		$stmt = $bdd->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
		$stmt->execute([':s'=> $story_id]);
		$res = $stmt->fetchAll();
		if(sizeof($res) == 1) { // RE-CHECK OF EMAIL 
			return $res[0];
		}
		
	}
	catch (PDOException $e) {}
	return "";
}

function insert_story(array $elems) {
	$v = (($elems[0]=validate_name($elems[0],"pseudo")) && ($elems[1] = validate_country($elems[1])) && ($elems[2] = validate_category($elems[2])) && ($elems[3] = validate_textarea($elems[3])));
	if(!$v)
		return FALSE;
	try {
		$res = select_author_db_table('pseudo',$elems[0]);
		if($res['pseudo']!==$elems[0])
			return FALSE;
		$bdd = new PDO('sqlite:' . dirname(__FILE__) . '/i_database.db');
		$sql = "INSERT INTO Stories (author_id,country,category,story) 
				VALUES (:a,:co,:ca,:s)";
		$stmt = $bdd->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
		$stmt->execute([':a'=> intval($res['author_id']),':co'=> $elems[1],':ca'=> $elems[2],':s'=> $elems[3]]);
	}
	catch (PDOException $e) {
		var_dump($e->getMessage());
	}
}

//create_authors_db_table(); // OK 
//create_stories_db_table(); // OK 
//insert_author("chr@gmail.com","Dolphin"); // OK 
//insert_story(array("Dolphin","France","recits","UN RECIT SUR LA FRANCE")); OK 
//var_dump(select_author_db_table('author_id',select_story_db_table(1)['author_id']));

function display_story_v0(string $story) {
	return "<p>$story</p>";
}


function display_story_co(array $story) {
	$head = "<div><h4>".$story['country']."</h4>";
	$content = display_story_v0($story['story']);
	$end = "</div>";
	return $head . $content . $end;
}

function display_story_and_author(array $story_extract) {
	$head = "<div>";
	$content = display_story_v0($story_extract['story']);
	$end = "<h4>".$story_extract['pseudo']."</h4></div>";
	return $head . $content . $end;
}

function display_story_by_cat_and_country(string $country, string $category) {
	$bdd = new PDO('sqlite:' . dirname(__FILE__) . '/i_database.db');
	$sql = "SELECT Stories.story,Authors.pseudo FROM Stories 
			INNER JOIN Authors ON Stories.author_id=Authors.author_id 
			WHERE Stories.category=:ca AND Stories.country=:co 
			ORDER BY Stories.author_id";
	$stmt = $bdd->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
	$stmt->execute([':ca'=> $category, ':co'=>$country]);
	$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
	//var_dump($res);
	$r = "";
	foreach($res as $row) 
		$r .= display_story_and_author($row);
	
	return $r;
}

function your_inputs2(string $author) {
	$res = select_author_db_table("pseudo",$author);
	$bdd = new PDO('sqlite:' . dirname(__FILE__) . '/i_database.db');
	$sql = "SELECT * FROM Stories WHERE author_id = :a ORDER BY category"; 
	$stmt = $bdd->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
	$stmt->execute([':a'=> intval($res['author_id'])]);
	$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$head = "<section id=\"stories_sec\"><div class=\"div_flex\">";
	if(sizeof($res) < 1)
		return "";
	$last_category = $res[0]['category'];
	$n = 1;
	$content = "<div class=\"separate\"></div><aside><h2>".$GLOBALS['contenus'][$last_category]."</h2><div>";
	foreach($res as $row) {
		if($last_category !== $row['category']) {
			$content .= "</div><button class=\"as_account\" id=\"a$n\">+</button></aside><div class=\"separate\"></div><aside><h2>".$GLOBALS['contenus'][$row['category']]."</h2><div>";
			$last_category = $row['category'];
			$n++;
		}
		$content .=  display_story_co($row);
	}
	$end = "</div><button class=\"as_account\" id=\"a$n\">+</button></aside></div></section>";
	return $head . $content . $end;
}

if(isset($_POST['submitstory'])) {
	var_dump("OK");
	var_dump($_POST);
	if(insert_story(array($_SESSION['userName'],$_POST['country'],$_POST['categorie'],$_POST['story'])))
		var_dump("insert OK \n");
	else
		var_dump("ERROR INSERT \n");

}

//var_dump(select_story_db_table(2)); // OK 
//var_dump(display_story_by_cat_and_country("France","geographie")); OK 
?>