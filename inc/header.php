<?php 
session_start();
$_SESSION['id'] = session_id();

function no_script(string $add_path) : string {
	return "<noscript id=\"js-check-container\">
	<meta http-equiv=\"refresh\" content=\"0; url=$add_path"."../inc/LOVE_JS.html\" />
	</noscript>\n";
}

function header_head(string $add_path) {
	return "<!DOCTYPE html>
	<html lang=\"fr\">
	<head>
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
		<meta name=\"author\" content=\"chriSmile0\">
		<meta name=\"description\" content=\"EarthStories\">
		<meta charset=\"UTF-8\">
		<link href=\"../styles/style.css\" rel=\"stylesheet\"/>
		<link href=\"https://fonts.googleapis.com/icon?family=Material+Icons\" 
			  rel=\"stylesheet\">
		<title>EarthStories</title>
		<script src=\"$add_path" ."../inc/common.js\"></script>
	</head>";
}

function header_common() {
	$name_session = (key_exists('userName',$_SESSION)) ? $_SESSION['userName'] : NULL;
	$style="";
	$class_i="material-icons";
	$content = "perm_identity";
	if($name_session!==NULL) {
		if(strlen($name_session) > 5) 
			$name_session = substr($name_session,0,5) . "..."; // IN JS 
		$class_i = "latin";
		$content = $name_session;
	}
	return "<div class=\"heads_buttons\" id=\"Connexion\">
					<button id=\"BConnexion\" name=\"connexion\" style=\"text-align:center;\" type=\"button\" value=\"light\" >
						<i id=\"ConnexionIcon\" class=\"$class_i\" style=\"$style\">".$content."</i>
					</button>
				</div>
				<div class=\"heads_buttons\" id=\"ThemeMode\">
					<button id=\"BThemeMode\"  name=\"theme\" type=\"submit\" value=\"light\" title=\"Toggle dark/lighe mode\">
						<i id=\"ThemeIcon\" class=\"material-icons\">brightness_low</i>
					</button>
				</div>";
}

if(isset($_POST['session'])) {
	if($_POST['session'] === "info") {
		$rt = (key_exists('userName',$_SESSION)) ? json_encode($_SESSION['userName']) : json_encode(NULL);
		echo $rt;
	}
}

?>