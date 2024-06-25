function changeWindow() {
	ThemeMode(localStorage.getItem("Theme"));
}

window.addEventListener('load',changeWindow,false);

document.onreadystatechange = function () {
	if(document.readyState === "complete") {
		document.body.style.visibility = "visible";
		changeIconConnexion();
		ThemeMode(localStorage.getItem("Theme"));
		(document.getElementById("BThemeMode")).addEventListener("click",ThemeMode,false);
		(document.getElementById("BConnexion")).addEventListener("click",connexion,false);
	}
};

window.onscroll = function() {AfficherRemonter()};

function AfficherRemonter() {
  if (document.body.scrollTop > 0 || document.documentElement.scrollTop > 0) {
      document.getElementById('top').style.display = "flex";
      document.getElementById('top_a').style.display = "block";
  } 
  else {
    document.getElementById('top').style.display = "none";
    document.getElementById('top_a').style.display = "none";
  }
}

function ThemeMode(e) {
	if((e == "light" || e == "dark")) {
		if(e == "dark") 
			darkMode();
		else 
			lightMode();
	}
	else {
		let val = document.getElementById("BThemeMode").value;
		let new_val = (val == "light") ? "dark" : "light";
		localStorage.setItem("Theme",new_val);
		if(val == "light") 
			darkMode();
		else 
			lightMode();
	}
}
  
function lightMode() {
	document.getElementById("BThemeMode").value = "light";
	document.getElementById("BThemeMode").style.backgroundColor = "mediumseagreen";
	document.getElementById("BConnexion").style.backgroundColor = "mediumseagreen";
	document.getElementById("ThemeIcon").innerHTML =  "brightness_low";
	var r = document.querySelector(":root");
	r.style.setProperty('--theme-color',"rgb(150, 155, 150)");
	r.style.setProperty('--blk_or_wht',"black");
	r.style.setProperty('--blk_or_org',"rgb(212, 155, 81)");
	document.getElementsByTagName("body")[0].style.backgroundColor = "rgb(212, 155, 81)";
	const paths = document.querySelectorAll('path');
	paths.forEach((path) => {
		path.style.setProperty('--path-background-color', 'black');
	});
}

function darkMode() {
	document.getElementById("BThemeMode").value = "dark";
	document.getElementById("BThemeMode").style.backgroundColor = "black";
	document.getElementById("BConnexion").style.backgroundColor = "black";
	document.getElementById("ThemeIcon").innerHTML = "brightness_high";
	var r = document.querySelector(":root");
	r.style.setProperty('--theme-color',"black");
	r.style.setProperty('--blk_or_wht',"white");
	r.style.setProperty('--blk_or_org',"black");
	document.getElementsByTagName("body")[0].style.backgroundColor = "black";
	const paths = document.querySelectorAll('path');
	paths.forEach((path) => {
		path.style.setProperty('--path-background-color', 'white');
	});
}

function changeIconConnexion() {
	pathname = window.location.pathname;
	if(pathname == "/EarthStories/account/connexion.php") { // toggle effect
		document.getElementById("ConnexionIcon").innerHTML = "home";
		document.getElementById('ConnexionIcon').classList.add('material-icons');
		document.getElementById('ConnexionIcon').classList.remove('latin');
		document.getElementById('ConnexionIcon').style.fontSize = "30px";
		document.getElementById('ConnexionIcon').title = "Home";
	}
	else {
		var f = 0;
		if(f=(document.getElementById("ConnexionIcon").innerHTML !== "perm_identity")) {
			document.getElementById('Connexion').classList.add('connected');
			document.getElementById('ConnexionIcon').style.fontSize = "20px";
			document.getElementById('ConnexionIcon').title = "Mon Compte";
		}
		if(pathname == "/EarthStories/account/my_account.php") { // toggle effect 
			document.getElementById('ConnexionIcon').innerHTML = "home";
			document.getElementById('ConnexionIcon').classList.add('material-icons');
			document.getElementById('ConnexionIcon').classList.remove('latin');
			document.getElementById('Connexion').classList.remove('connected');
			document.getElementById('ConnexionIcon').style.fontSize = "30px";
			document.getElementById('ConnexionIcon').title = "Home";
		}
		else {
			if(!f)
				document.getElementById('ConnexionIcon').title = "Connexion/Identification";
		}
	}
}

function connexion() {
	const save = document.getElementById("BThemeMode");
	if(save.value == "light") 
	  localStorage.setItem("Theme", "light");
	else 
	  localStorage.setItem("Theme", "dark");
	session_info(redirect_usage);
}

function redirect_usage(reponse) {
	var rep = reponse;
	var redirect = '/EarthStories/account/connexion.php';
	if(rep !== null)
		redirect = '/EarthStories/account/my_account.php';

	if(window.location.pathname == '/EarthStories/home/') {
		window.location.assign(redirect);
		setTimeout(() => {},700); // wait loaded next page 
	}
	else {
		window.location.assign("/EarthStories/home/");
		setTimeout(() => {},700); // wait loaded next page
	}
}

function session_info(cinfo) {
	let xmlhttp=new XMLHttpRequest()
	xmlhttp.onreadystatechange = function() {
	  if((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)) {
		const reponse = JSON.parse(this.responseText);
		cinfo(reponse);
	  };
	}
	xmlhttp.open("POST","../inc/header.php");
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("session=info");
}

