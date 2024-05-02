function changeWindow() {
	ThemeMode(localStorage.getItem("Theme"));
}
window.addEventListener('load',changeWindow,false);

document.onreadystatechange = function () {
	if (document.readyState !== "complete") {
		console.log("not loaded");
	}
	else {
		console.log("loaded");
		changeIconConnexion();
		ThemeMode(localStorage.getItem("Theme"));
		(document.getElementById("BThemeMode")).addEventListener("click",ThemeMode,false);
		(document.getElementById("BConnexion")).addEventListener("click",connexion,false);
	}
};

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
	document.getElementById("ThemeIcon").innerHTML =  "brightness_low";
	document.getElementById("ThemeIcon").style.color = "black";
	document.getElementById("test").style.backgroundColor = "rgb(150, 155, 150)";
	document.getElementsByTagName("body")[0].style.backgroundColor = "rgb(212, 155, 81)";
}

function darkMode() {
	document.getElementById("BThemeMode").value = "dark";
	document.getElementById("BThemeMode").style.backgroundColor = "black";
	document.getElementById("ThemeIcon").style.color = "white";
	document.getElementById("ThemeIcon").innerHTML = "brightness_high";
	document.getElementById("test").style.backgroundColor = "black";
	document.getElementsByTagName("body")[0].style.backgroundColor = "black";
}

function changeIconConnexion() {
	pathname = window.location.pathname;
	if(pathname == "/earth_stories/connexion.php")
		document.getElementById("ConnexionIcon").innerHTML = "home";
	else 
		document.getElementById("ConnexionIcon").innerHTML = "perm_identity";
}

function connexion() {
	const save = document.getElementById("BThemeMode");
	if(save.value == "light") 
	  localStorage.setItem("Theme", "light");
	else 
	  localStorage.setItem("Theme", "dark");
	console.log(window.location.pathname);
	if(window.location.pathname == '/earth_stories/index.php')
		window.location.href = "connexion.php";
	else 
		window.location.href = "index.php";
}