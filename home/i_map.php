<?php 
include '../account/inputs.php';

$hint = "";
$myJSON = "";

if (isset($_REQUEST['q'])) {
	//$myJSON = json_encode('{"result":true, "count":42}', JSON_FORCE_OBJECT);
	$myArr = array();
	$contenus_ = $GLOBALS['contenus'];
	$search = $_REQUEST['q'];
	$i = 0;
	$len = count($ar_titles);
	while($i < $len) {
		if($search === $ar_titles[$i])
		break;
		$i++;
	}
	if($i == 256)
		array_push($myArr,"Error");
	else {
		array_push($myArr,$ar_id[$i]);
		array_push($myArr,$ar_titles[$i]);//Pas obligatoire on peut 
		foreach($contenus as $key => $c) {  // On peut mettre sous une fonction -> array_merge fonctionne je pense
			array_push($myArr,display_story_by_cat_and_country($ar_titles[$i],$key));
		}
		

		//la récup directement de la value de l'input.
	}
	//var_dump($myArr);
	//$myArr = array("John", "Mary", "Peter", "Sally");
	//var_dump($myArr);
	//$myJSON = json_encode('{"result":true}'); -> thats work
	//$myJSON = json_encode('["John","Mary"]'); -> thats work
	$myJSON = json_encode($myArr);
	echo $myJSON;
}


?>