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


<body id="b">
	<header id="HTOP">
		<h1>EarthStories : S'identifier pour partager</h1>
	</header>
	<article id="formulaire">
		<div id="test">
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

			<div id="create_or_log">
				<div><button id="ident">S'identifier</button></div>
				<div><button id="creation">Créer un compte</button></div>
			</div>


			<form id="formulaire_creation" method="POST">
				<fieldset>
					<div class="fdiv" id="Nom">
						<label for="nom">Nom</label>
						<input id="nom"
							type="text"
							name="nom"
							aria-labelledby="nom">
						<span class="error" id="errorNom"></span>
						<span class="error"> <?php echo $nomErr;?></span>
					</div>
					<div class="fdiv" id="Prenom">
						<label for="prenom">Prenom</label>
						<input id="prenom"
							type="text"
							name="prenom"
							aria-labelledby="prenom">
						<span class="error" id="errorPrenom"></span>
						<span class="error"> <?php echo $prenomErr;?></span>
					</div>
					<div class="fdiv" id="Email">
						<label for="email">Mail</label>
						<input id="email"
							type="text"
							name="email"
							aria-labelledby="email">
						<span class="error" id="errorEmail"></span>
						<span class="error"> <?php echo $emailErr;?></span>
					</div>
					<div class="fdiv" id="pass">
						<label for="pass">Mot de passe </label>
						<input id="pass"
							type="password"
							name="pass"
							aria-labelledby="pass">
						<span class="error" id="errorMdp"></span>
						<span class="error"> <?php echo $MdpErr;?></span>
					</div>
					<button name="submitcrea"
							type="submit" value="Creation">Création du compte</button>
				</fieldset>
			</form>

			<!--<form id="formulaire_ident">
				<fieldset>
					<div class="fdiv" id="id_">
						<label for="Id_">Identifiant</label>
						<input id="Id_"
							type="text"
							name="Id_"
							aria-labelledby="Id_">
						<span class="error" id="errorId"></span>
						<span class="error"> <?php echo $IdErr;?></span>
					</div>
					<div class="fdiv" id="mdp">
						<label for="mdp">Mot de passe</label>
						<input id="mdp"
							type="password"
							name="mdp"
							aria-labelledby="mdp">
						<span class="error" id="errorMdp"></span>
						<span class="error"> <?php echo $Mdp2Err;?></span>
					</div>
					<button name="submitident"
							type="submit" value="Identification">Identification</button>
				</fieldset>
			</form>-->
		</div>
	</article>
	<footer id="F"></footer>
</body>
</html>