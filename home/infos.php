<?php 

if (isset($_REQUEST['q'])) {
	//$myJSON = json_encode('{"result":true, "count":42}', JSON_FORCE_OBJECT);
	$myArr = array('John', 'Mary', 'Peter', 'Sally');
  
	$myJSON = json_encode($myArr);
	echo $myJSON;
	//header("Content-type: application/json");
	//echo $myJSON;
  }

?>