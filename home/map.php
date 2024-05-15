<?php

function findEndline(string $line) {
	$pos = strpos($line,"\n");
	return $pos;
}

function findEndLineHome(string $line) {
	$x = 0;
	$len = strlen($line);
	if($line !== "") {
		while(($x < $len) && ($line[$x] != "\n"))
		$x++;
		if($line[$x] === '\n') {
		return $x;
		}
	}
	return -1;
}

function findSpace(string $line) {
	return strpos($line,' ');
}

function readlines($filename) {
	$str = file_get_contents($filename); /// -> more simple
	return explode("\n",$str);
}

$style = "stroke-opacity:1;stroke-width:0.7015748;stroke-miterlimit:4;stroke-dasharray:none;fill-opacity:1";
//$style = "fill:#00785a;stroke:white;stroke-opacity:1;stroke-width:1";
$d = "";


function combine_tab(array $tab1,array $tab2) {
	return array_combine($tab1,$tab2);
}

function html_a(string $contenu) {
	return "<a>$contenu</a>";
}

function html_svg(string $path) {
	$sv = "<svg id=\"mapsection\">";
	$retour = "$sv$path</svg>";
	return $retour;
}

function html_path(string $path,string  $style, string $title, string $id) {
	return "<path d=\"$path\" style=\"$style\" title=\"$title\" id=\"$id\"/>";
}

$ar_id = readlines("../dev/extract_ids.txt");
$ar_titles = readlines("../dev/extract_name_fr.txt");
$ct = array_combine($ar_id,$ar_titles);

/*create_map*/
/*
function create_map() {
	$style = $GLOBALS['style'];
	$all_paths = readlines("../dev/extract_path.txt");
	$i = 0;
	$paths_adds = "";
	foreach($all_paths as $p) {
		$paths_adds .= html_a(html_path($p,$style,$t=$GLOBALS['ar_titles'][$i],$GLOBALS['ar_id'][$i])."<title>$t</title>")."\n";
		$i++;
	}
	return html_svg("\n$paths_adds");
}*/
//echo create_map();
?>