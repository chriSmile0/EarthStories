import * as f_chk from '../inc/forms_checks.js';

function veriform_crea(form) {
  console.log(form.name);
  var vN  = (f_chk.verifNom(form.nom));
  var vP  = (f_chk.verifPrenom(form.prenom));
  var vPs = (f_chk.verifPrenom(form.pseudo));
  var vE  = (f_chk.verifEmail(form.email));
  var vM  = (f_chk.verifMdp(form.pass));

  if(vN && vP && vPs && vE && vM) 
    return true;
  return false;
}

function veriform_ident(form) {
  var vE  = (f_chk.verifEmail(form.emaili));
  var vM  = (f_chk.verifMdp(form.passi));

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
