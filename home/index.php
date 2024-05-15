<?php include 'map.php'; ?>
<?php require '../inc/header.php';?>
<?php echo header_head("");?>


<body style="visibility: hidden;">
	<!--<div class="container">
		<div class="row">
			<div class="item sticky">STICKY ROW 1</div>
			<div class="item">1</div>
			<div class="item">2</div>
			<div class="item">3</div>
			<div class="item">4</div>
			<div class="item">5</div>
			<div class="item">6</div>
			<div class="item">7</div>
			<div class="item">8</div>
			<div class="item">9</div>
			<div class="item">10</div>
		</div>
		<div class="row">
			<div class="item sticky">STICKY ROW 2</div>
			<div class="item">1</div>
			<div class="item">2</div>
			<div class="item">3</div>
			<div class="item">4</div>
			<div class="item">5</div>
			<div class="item">6</div>
			<div class="item">7</div>
			<div class="item">8</div>
			<div class="item">9</div>
			<div class="item">10</div>
		</div>
		<div class="row">
			<div class="item sticky">STICKY ROW 3</div>
			<div class="item">1</div>
			<div class="item">2</div>
			<div class="item">3</div>
			<div class="item">4</div>
			<div class="item">5</div>
			<div class="item">6</div>
			<div class="item">7</div>
			<div class="item">8</div>
			<div class="item">9</div>
			<div class="item">10</div>
		</div>
	</div>-->
	<header id="HTOP">
		<h1>EarthStories : Des histoires à perte de vue</h1>
	</header>

	<article>
		<div id="global">
			<div id="research">
				<label class="no_background_color" id="lresearch" for="town_or_country">Recherche : </label>
				<input  id="search" 
						type="text" 
						name="town_or_country" 
						aria-labelledby="yes">
				<button id="btn" name="submit" type="submit" value="">Entrer</button>
			</div>
			<?php echo header_common();?>
			<div id="SVG">
				<div id="SVG_div">
					<?php include '../dev/final_map2'; ?>
				</div>
				<div class="block" id="block_1">
					<div class="direction">
						<div id="left">
							<a id="left_a" href="#HLEFT">
								<i id="left_a_i" class="material-icons" title="Go to left"><</i>
							</a>
						</div>
					</div>
				</div>
				<div class="block" id="block_2">
					<div class="direction">
						<div id="right">
							<a id="right_a" href="#HRIGHT">
								<i id="right_a_i" class="material-icons" title="Go to right">></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>

	<section></section>

	<div id="top">
        <a id="top_a" href="#HTOP">
            <i id="top_a_i" class="material-icons" title="Return to Top">^</i>
        </a>
    </div>

	<footer id="F"></footer>
	<script src="index.js"></script>
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