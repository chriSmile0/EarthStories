<?php 
include '../account/inputs.php';

if(isset($_POST['q'])) {
	$myArr = array();
	$contenus_ = $GLOBALS['contenus'];
	$search = $_POST['q'];
	$i = 0;
	$len = count($ar_titles);
	while($i < $len) {
		if($search === $ar_titles[$i])
			break;
		$i++;
	}
	if($i == 256) {
		array_push($myArr,"Error");
	}
	else {
		array_push($myArr,$ar_id[$i]);
		array_push($myArr,$ar_titles[$i]);//Pas obligatoire on peut 
		foreach($contenus as $key => $c) {  // On peut mettre sous une fonction -> array_merge fonctionne je pense
			array_push($myArr,display_story_by_cat_and_country($ar_titles[$i],$key));
		}
	}
	$myJSON = json_encode($myArr);
	echo $myJSON;
}
?>