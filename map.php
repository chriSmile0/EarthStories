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

/*
$tab_map = array("Country"=>"Center");
function true_push(&$tab, $new) {
  $tab = array_merge($tab,$new);
}

true_push($tab_map, ["France"=>"123,456"]);

foreach($tab_map as $x => $x_value) {
  echo "Key=" . $x . ", Value=" . $x_value;
  echo "<br>";
}*/


function readlines($filename) {
  $chksize = 1024;
  /*$file = fopen($filename,"r");
  $save_line = "";
  $array_line = array();
  $buffer = "";
  while(!feof($file)) {
    $buffer = fread($file,$chksize);
    $cur = $buffer;
    $index = findEndLineHome($cur);
    while($index > -1) {
      $tmp = substr($cur,0,$index);
      $save_line = $save_line . $tmp;
      //array_push($array_line,$save_line);
      $save_line = "";
      $cur = substr($cur,$index+1);
      $index = findEndLineHome($cur);
    }
    $save_line = $save_line . $cur;
    $index = "";
  }
  if($save_line != "") 
    array_push($array_line,$save_line);*/
  $str = file_get_contents($filename); /// -> more simple
  return explode("\n",$str);
  //return $array_line;
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

$ar_id = readlines("extract_ids.txt");
$ar_titles = readlines("extract_name_fr.txt");

/*$ar_path = readlines("extract_path.txt");

function createallpaths(array $paths_and_countries,array $title_countries ,string $style) {
  $retour = "";
  $cpt = 0;
  foreach($paths_and_countries as $c => $p) {
    $retour = $retour .  html_a(html_path($p,$style,$title_countries[$cpt],$c));
    $cpt++;
  }
  return html_svg($retour);
}*/


//$merging = combine_tab($ar_id,$ar_path);
//$map = createallpaths($merging,$ar_titles,$style);


$hint = "";
$myJSON = "";

if (isset($_REQUEST['q'])) {
  //$myJSON = json_encode('{"result":true, "count":42}', JSON_FORCE_OBJECT);
  $myArr = array();
  $contenus = array("La Géographie","La culture","Les Voyages","Les Sciences"
                    ,"Les Récits","Les Célébrités");
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
    foreach($contenus as $c) //On peut mettre sous une fonction -> array_merge fonctionne je pense
      array_push($myArr,$c);

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

// Output "no suggestion" if no hint was found or output correct values
//echo $hint === "" ? "no suggestion" : $hint;
?>

