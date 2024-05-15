<?php include 'contact.php'; ?>
<?php echo header_head("");?>


<body style="visibility: hidden;">
	<header id="HTOP">
		<h1>EarthStories : S'identifier pour partager</h1>
	</header>
	<article id="formulaire">
		<div id="global">
			<?php echo header_common();?>

			<div class="choices" id="create_or_log">
				<button id="ident" type="button">S'identifier</button>
				<button id="creation" type="button">Créer un compte</button>
			</div>


			<form name="submitcrea" id="formulaire_creation" method="POST" enctype="multipart/form-data">
				<fieldset>
					<div class="fdiv" id="Nom">
						<label for="nom">Nom</label>
						<input id="nom"
							type="text"
							name="nom"
							aria-labelledby="nom">
					</div>
					<div class="error">
                    	<span id="nomerror"></span>
                    	<?php echo $nomErr;?>
                	</div>
					<div class="fdiv" id="Prenom">
						<label for="prenom">Prenom</label>
						<input id="prenom"
							type="text"
							name="prenom"
							aria-labelledby="prenom">
					</div>
					<div class="error">
                    	<span id="prenomerror"></span>
                    	<?php echo $prenomErr;?>
                	</div>
					<div class="fdiv" id="Prenom">
						<label for="pseudo">Pseudo</label>
						<input id="pseudo"
							type="text"
							name="pseudo"
							aria-labelledby="pseudo">
					</div>
					<div class="error">
                    	<span id="pseudoerror"></span>
                    	<?php echo $pseudoErr;?>
                	</div>
					<div class="fdiv" id="Email">
						<label for="email">Email</label>
						<input id="email"
							type="text"
							name="email"
							aria-labelledby="email">
					</div>
					<div class="error">
                    	<span id="emailerror"></span>
                    	<?php echo $emailErr?>
                	</div>
					<div class="fdiv" id="pass">
						<label for="pass">Mot de passe</label>
						<input id="pass"
							type="password"
							name="pass"
							aria-labelledby="pass">
					</div>
					<div class="error">
                    	<span id="passerror"></span>
                    	<?php echo $MdpErr;?>
                	</div>
					<button id="crea_btn" name="submitcrea"
							type="submit" value="Creation">Création du compte</button>
				</fieldset>
			</form>

			<form name="submitident" id="formulaire_ident" method="POST" enctype="multipart/form-data">
				<fieldset>
					<div class="fdiv" id="Email">
						<label for="email">Email</label>
						<input id="emaili"
							type="text"
							name="email"
							aria-labelledby="email">
					</div>
					<div class="error">
                    	<span id="emailierror"></span>
                    	<?php echo $emailErr;?>
                	</div>
					<div class="fdiv" id="mdp">
						<label for="pass">Mot de passe</label>
						<input id="passi"
							type="password"
							name="pass"
							aria-labelledby="pass">
					</div>
					<div class="error">
                    	<span id="passierror"></span>
                    	<?php echo $MdpErr;?>
                	</div>
					<button id="ident_btn" name="submitident"
							type="submit" value="Identification">Identification</button>
				</fieldset>
			</form>
		</div>
	</article>
	<footer id="F"></footer>
	<script src="contact.js"></script>
</body>
</html>