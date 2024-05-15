var regexNomPrenom =  /^[a-zA-Z- ]{1,30}$/;
var regexMessage = /^[a-zA-Z0-9 ,áàçéèÁÀÇÉÈÍÌÚÙ.-]{1,}$/;
var regexEmail = /^[A-Za-z0-9_!#$%&'*+\/=?`{|}~^.-]+@[A-Za-z0-9.-]+$/;
var regexMdp = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{10,}$/


let nomErr = "Espace et tiret autorisés ainsi que les majuscules (30 caractères max)";
let messageErr = "Espace et tiret autorisés ainsi que les majuscules";
let emailErr = "Entrer un email de la forme nom_Prenom@operateur.dom";
let MdpErr= "Des lettres minuscules ET majuscules, au moins un caractère spécial, des chiffres, minimum 10 caractères";

/**
 * @brief Write an error in the html render 
 * @param { champ }     a form field 
 * @param { error }     true if display error false for hide error
 * @param { textError } The text to write in the champ.id+error field
 * @return / 
*/
function writeError(champ,error,textError) {
  console.log('champ'+champ.id);
  if(error) {
    var elemn = document.getElementById(champ.id+'error');
    elemn.style.color = "red";
    elemn.innerText = textError;
  }
  else {
    (document.getElementById(champ.id+'error')).innerText = "";
  }
}

/**
 * @brief Write an error in the html render 
 * @param { id }        id of a random element in a page  
 * @param { error }     true if display error false for hide error
 * @param { textError } The text to write in the champ.id+error field
 * @return / 
*/
function writeErrorv2(id,error,textError) {
  if(error) {
    var elemn = document.getElementById(id);
    elemn.style.color = "red";
    elemn.innerText = textError;
  }
  else {
    (document.getElementById(id)).innerText = "";
  }
}


/**
 * @brief Check of the content of champNom target
 * @param { champNom }  input field to check
 * @return / 
*/
function verifNom(champNom) {
  var rtn = regexNomPrenom.test(champNom.value);
  writeError(champNom,!rtn,nomErr);
  return rtn;
}

/**
 * @brief Check of the content of champPrenom target
 * @param { champPrenom }  input field to check
 * @return / 
*/
function verifPrenom(champPrenom) {
  var rtn = regexNomPrenom.test(champPrenom.value);
  writeError(champPrenom,!rtn,nomErr);
  return rtn;
}

/**
 * @brief Check of the content of champPrenom target
 * @param { champPrenom }  input field to check
 * @return / 
*/
function verifPseudo(champPseudo) {
  var rtn = regexNomPrenom.test(champPseudo.value);
  writeError(champPseudo,!rtn,nomErr);
  return rtn;
}

/**
 * @brief Check of the content of champEmail target
 * @param { champEmail }  input field to check
 * @return / 
*/
function verifEmail(champEmail) {
  var rtn = regexEmail.test(champEmail.value);
  writeError(champEmail,!rtn,emailErr);
  return rtn;
}

/**
 * @brief Check of the content of champMessage target
 * @param { champMessage }  textarea field to check
 * @return / 
*/
function verifMessage(champMessage) {
  var rtn = regexMessage.test(champMessage.value);
  writeError(champMessage,!rtn,messageErr);
  return rtn;
}

/**
 * @brief Check of the content of champMdp target
 * @param { champMdp }  Mdp field to check
 * @return / 
*/
function verifMdp(champMdp) {
  var rtn = regexMdp.test(champMdp.value);
  writeError(champMdp,!rtn,MdpErr);
  return rtn;
}


/**
 * @brief Check of the content of the form 
 *        If all it's correct (check to the type not change by a visitor with devtools)
 * @param { form }  the form element
 * @return bool true if all tests are passed, false else
*/
function veriform_crea(form) {
  console.log(form.name);
  var vN  = (verifNom(form.nom));
  var vP  = (verifPrenom(form.prenom));
  var vPs = (verifPrenom(form.pseudo));
  var vE  = (verifEmail(form.email));
  var vM  = (verifMdp(form.pass));

  if(vN && vP && vPs && vE && vM) 
    return true;
  return false;
}

function veriform_ident(form) {
  var vE  = (verifEmail(form.emaili));
  var vM  = (verifMdp(form.passi));

  if(vE && vM) 
    return true;
  return false;
}

function identify() {
	console.log("identifty");
  document.getElementById('formulaire_creation').style.display = "none";
  document.getElementById('creation').style.visibility = "visible";
  document.getElementById('ident').style.visibility = "hidden";
  document.getElementById('formulaire_ident').style.display = "block";
}

function creation() {
	console.log("creation");
  document.getElementById('formulaire_ident').style.display = "none";
  document.getElementById('ident').style.visibility = "visible";
  document.getElementById('creation').style.visibility = "hidden";
  document.getElementById('formulaire_creation').style.display = "block";
}

document.getElementById("ident").addEventListener("click",identify,false);
document.getElementById("creation").addEventListener("click",creation,false);
document.getElementById('formulaire_creation').onsubmit = function () {return veriform_crea(document.getElementById('formulaire_creation'))};
document.getElementById('formulaire_ident').onsubmit = function () {return veriform_ident(document.getElementById('formulaire_ident'))};
  