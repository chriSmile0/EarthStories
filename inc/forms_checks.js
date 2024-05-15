

var regexNomPrenom =  /^[a-zA-Z- ]{1,30}$/;
var regexMessage = /^[a-zA-Z0-9 ,áàçéèÁÀÇÉÈÍÌÚÙ.-]{1,}$/;
var regexEmail = /^[A-Za-z0-9_!#$%&'*+\/=?`{|}~^.-]+@[A-Za-z0-9.-]+$/;
var regexMdp = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{10,}$/
let messageErr = "Espace et tiret autorisés ainsi que les majuscules";
let categoryErr = "geographie-culture-voyages-sciences-recits-celebrity";
let countryErr = "Pays dans la liste des propositions";
let nomErr = "Espace et tiret autorisés ainsi que les majuscules (30 caractères max)";
let emailErr = "Entrer un email de la forme nom_Prenom@operateur.dom";
let MdpErr= "Des lettres minuscules ET majuscules, au moins un caractère spécial, des chiffres, minimum 10 caractères";


/**
 * @brief Write an error in the html render 
 * @param { champ }     a form field 
 * @param { error }     true if display error false for hide error
 * @param { textError } The text to write in the champ.id+error field
 * @return / 
*/
export function writeError(champ,error,textError) {
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
export function writeErrorv2(id,error,textError) {
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
export function verifNom(champNom) {
  var rtn = regexNomPrenom.test(champNom.value);
  writeError(champNom,!rtn,nomErr);
  return rtn;
}

/**
 * @brief Check of the content of champPrenom target
 * @param { champPrenom }  input field to check
 * @return / 
*/
export function verifPrenom(champPrenom) {
  var rtn = regexNomPrenom.test(champPrenom.value);
  writeError(champPrenom,!rtn,nomErr);
  return rtn;
}

/**
 * @brief Check of the content of champPrenom target
 * @param { champPrenom }  input field to check
 * @return / 
*/
export function verifPseudo(champPseudo) {
  var rtn = regexNomPrenom.test(champPseudo.value);
  writeError(champPseudo,!rtn,nomErr);
  return rtn;
}

/**
 * @brief Check of the content of champEmail target
 * @param { champEmail }  input field to check
 * @return / 
*/
export function verifEmail(champEmail) {
  var rtn = regexEmail.test(champEmail.value);
  writeError(champEmail,!rtn,emailErr);
  return rtn;
}

/**
 * @brief Check of the content of champMessage target
 * @param { champMessage }  textarea field to check
 * @return / 
*/
export function verifMessage(champMessage) {
  var rtn = regexMessage.test(champMessage.value);
  writeError(champMessage,!rtn,messageErr);
  return rtn;
}

/**
 * @brief Check of the content of champMdp target
 * @param { champMdp }  Mdp field to check
 * @return / 
*/
export function verifMdp(champMdp) {
  var rtn = regexMdp.test(champMdp.value);
  writeError(champMdp,!rtn,MdpErr);
  return rtn;
}