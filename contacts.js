//Mon JS
var regexEmail = /^[a-zA-Z0-9-_.]+@[a-z0-9-_.]+\.[a-z]{2,}$/;
var regexNomPrenom =  /^[a-zA-Z- ]{1,50}$/;
var regexMessage = /^[a-zA-Z0-9 '",áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ.-]{0,}$/;

let nomErr = "Entrer un nom valide";
let prenomErr = "Entrer un prenom valide";
let emailErr = "Entrer un email de la forme nom_Prenom@operateur.dom";


function colorError(champ,error) {
	if (error)
		champ.style.backgroundColor = "tomato";
	else 
		champ.style.backgroundColor = "";
}

//Verif Nom
function verifNom(champNom) {
	if (!regexNomPrenom.test(champNom.value)) {
		colorError(champNom,true);
		document.getElementById('errorNom').innerHTML = nomErr;
		return false;
	}
	else {
		colorError(champNom,false);
		return true;
	}
}
//verif Prenom
function verifPrenom(champPrenom){
	if (!regexNomPrenom.test(champPrenom.value)) {
		colorError(champPrenom,true);
		document.getElementById('errorPrenom').innerHTML = prenomErr;
		return false;
	}
	else {
		colorError(champPrenom,false);
		return true;
	}
}

//verif email
function verifEmail(champEmail) {
	if (!regexEmail.test(champEmail.value)) {
		colorError(champEmail,true);
		document.getElementById('errorEmail').innerHTML = emailErr;
		return false;
	}
	else {
		colorError(champEmail,false);
		return true;
	}
}


 //Verif form contatcs
function verifform(form) {
    var verifname = verifNom(form.nom)
    var veriffname = verifPrenom(form.prenom)
    var verifmessage = verifMessage(form.message)
    var verifemail = verifEmail(form.email)
    if (document.getElementById('Yes').checked) {
        verifname = true;
        veriffname = true;
        verifemail = true;
    } 
    else {  
        if(veriffname && verifname && verifmessage && verifemail)
            return true;  
        else    
             return false;
    }
}

function identify() {
	console.log("identifty");
}

function creation() {
	console.log("creation");
}

document.getElementById("ident").addEventListener("click",identify,false);
document.getElementById("creation").addEventListener("click",creation,false);