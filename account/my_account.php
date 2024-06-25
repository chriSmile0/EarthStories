<?php include 'inputs.php'; ?>
<?php echo header_head("");?>

<?php echo no_script(""); ?>

<body style="visibility: hidden;">
	<header id="HTOP">
		<h1>L'espace de <?php echo $_SESSION['userName']?></h1>
	</header>
	<article>
		<div id="global">
			<?php echo header_common();?>
			<div class="choices" id="profile_choices">
				<button id="story_crea" type="button">Créer une histoire</button>
				<button id="see_stories" type="button">Vos histoires</button>
			</div>

			<form name="submitstory" id="crea_story" method="POST" enctype="multipart/form-data">
				<fieldset>
					<?php echo choice_country();?>
					<div class="error">
                    	<span id="countryerror"></span>
                    	<?php echo $countryErr;?>
                	</div>
					<div class="fdiv fdiv__story">
						<label for="categorie">Categorie de l'histoire</label>
						<select id="categorie" name="categorie" aria-labelledby="categorie">
							<option value="geographie">La Géographie</option>
							<option value="culture">La Culture</option>
							<option value="voyages">Les Voyages</option>
							<option value="sciences">Les Sciences</option>
							<option value="recits">Les Récits</option>
							<option value="celebrity">Les Célébrités </option>
						</select>
					</div>
					<div class="error">
                    	<span id="categorieerror"></span>
                    	<?php echo $categoryErr;?>
                	</div>
					<div class="fdiv fdiv__story">
						<label for="story">Votre histoire</label>
						<textarea id="story" name="story"></textarea>
					</div>
					<div class="error">
                    	<span id="storyerror"></span>
                    	<?php echo $storyErr;?>
                	</div>
					<button id="create_story" name="submitstory"
							type="submit" value="creation_story">Création de l'histoire</button>
				</fieldset>
			</form>
			<div id="inputs">
				<?php echo your_inputs2($_SESSION['userName']); ?>
			</div>
		</div>
	</article>
	<div id="top">
        <a id="top_a" href="#HTOP">
            <i id="top_a_i" class="material-icons" title="Return to Top">^</i>
        </a>
    </div>
	<script type="module" src="account.js"></script>
</body>
</html>