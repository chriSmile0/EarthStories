<?php include 'map.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="...">
	<meta name="description" content="EarthStories">
	<meta charset="UTF-8">
	<link href="style.css" rel="stylesheet"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" 
          rel="stylesheet">
	<title>EarthStories</title>
	<script src="common.js"></script>
</head>

<body>
	<header id="HTOP">
		<h1>EarthStories : Des histoires à perte de vue</h1>
	</header>

	<article>
		<div id="test">
			<div id="research">
				<label id="lresearch" for="town_or_country">Recherche : </label>
				<input  id="search" 
						type="text" 
						name="town_or_country" 
						aria-labelledby="yes">
				<button id="btn" name="submit" type="submit" value="">Entrer</button>
			</div>
			<div id="Connexion">
				<button id="BConnexion" value="light">
					<i id="ConnexionIcon" class="material-icons">perm_identity</i>
				</button>
			</div>
			<div id="ThemeMode">
				<button id="BThemeMode" value="light">
					<i id="ThemeIcon" class="material-icons">brightness_low</i>
				</button>
			</div>
			<div id="SVG">
				<?php include 'final_map'; ?>
			</div>
		</div>
	</article>

	<section>
	</section>

	<div id="top">
        <a id="top_a" href="#HTOP">
            <i id="top_a_i" class="material-icons">^</i>
        </a>
    </div>

	<footer id="F"></footer>
	<script src="index.js"></script>
	<p id="demo" ><?php echo $myJSON;?></p>
</body>
</html>



<!-----------------------BROUILLON--------------------->
<!--
<figure id="earth">
	<div style="background-color:red">
		<svg id="b">
			<polygon points="200,0 200,200 0,200"
				style="stroke:purple;stroke-width:1"/>
		</svg>
	</div>
	<div>
		<svg id="c"><polygon points="0,0 0,200 200,200"
			style="stroke:purple;stroke-width:1"/>
		</svg>
	</div>
	<div>
		<svg id="d"><polygon points="200,0 0,0 200,200"
			style="stroke:purple;stroke-width:1"/>
		</svg>
	</div>
	<div>
		<svg id="e"><polygon points="0,0 0,200 200,0"
			style="stroke:purple;stroke-width:1"/>
		</svg>
	</div>
</figure>
-->