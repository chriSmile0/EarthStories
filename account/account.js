
var regexMessage = /^[a-zA-Z0-9 ,áàçéèÁÀÇÉÈÍÌÚÙ.-]{1,}$/;
let messageErr = "Espace et tiret autorisés ainsi que les majuscules";
let categoryErr = "geographie-culture-voyages-sciences-recits-celebrity";
let countryErr = "Pays dans la liste des propositions";

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
 * @brief Check of the content of champMessage target
 * @param { champMessage }  textarea field to check
 * @return / 
*/
function verifCategory(champCategory) {
  var v = champCategory.value;
  var rtn = (v === 'voyages' || v === 'recits' ||  
              v === 'culture' || v === 'celebrity' || 
              v === 'geographie' || v === 'sciences');
  writeError(champCategory,!rtn,categoryErr);
  return rtn;
}

/**
 * @brief Check of the content of champMessage target
 * @param { champMessage }  textarea field to check
 * @return / 
*/
function verifCountry(champCountry) {
  var elems = document.getElementById('countryList');
  var childs = elems.childNodes;
  var rtn = false;
  childs.forEach(function(item) {
    if(item.value === champCountry.value)
      rtn = true;
  },rtn);
  writeError(champCountry,!rtn,countryErr);
  return rtn;
}

function country_display() {
  var val = document.getElementById('country').value;
  var countries = document.getElementById('countryList');
  if(val.length > 2) {
    let xmlhttp=new XMLHttpRequest()
    xmlhttp.onreadystatechange = function() {
      if((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)) {
        const reponse = JSON.parse(this.responseText);
        countries.innerHTML = reponse;
      }
    }
    xmlhttp.open("POST","inputs.php");
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("listing="+val);
  }
  else {
    countries.innerHTML = "";
  }
}

function aside_restriction(index_aside, r_or_not) {
  var elem = document.getElementsByTagName("aside").item(index_aside); // aside we select ?/6
  var internal_div = elem.childNodes.item(1);
  var divs_in_div = internal_div.childNodes;
  for(var i = 3; i < divs_in_div.length ; i++) 
    divs_in_div.item(i).style.display = "none";
  
  if(r_or_not) 
    elem.childNodes.item(2).style.display = "block";
  
}

function stories() {	
  document.getElementById('crea_story').style.display = "none";
  document.getElementById('story_crea').style.visibility = "visible";
  document.getElementById('see_stories').style.visibility = "hidden";
  document.getElementById('stories_sec').style.display = "block";
  let asides = document.getElementsByTagName("aside");
  var len = asides.length;
  for(var i = 0; i < len ; i++) 
    asides.item(i).childNodes.forEach(function(item) {
      if(item.nodeName === "DIV") 
        if(item.childNodes.length > 3) 
          aside_restriction(i,true);
        else 
          aside_restriction(i,false);
    });
}

function creation() {
  document.getElementById('see_stories').style.visibility = "visible";
  document.getElementById('story_crea').style.visibility = "hidden";
  document.getElementById('crea_story').style.display = "block";
  document.getElementById('stories_sec').style.display = "none";
}

function veriform_crea_s(form) {
  var vCo = (verifCountry(form.country));
  var vCa  = (verifCategory(form.categorie));
  var vS  = (verifMessage(form.story));

  if(vCo && vCa && vS) 
    return true;
  return false;
}

document.getElementById("see_stories").addEventListener("click",stories,false);
document.getElementById("story_crea").addEventListener("click",creation,false);



document.onload = function() {country_display()};

document.getElementById('country').oninput = function() {country_display()};

document.getElementById('crea_story').onsubmit = function () {return veriform_crea_s(document.getElementById('crea_story'))};

function home_toggle_display(elem,t1,t2) {
  /*if(elem.classList.contains("toggle_aside"))
    elem.classList.remove("toggle_aside");
  else 
    elem.classList.add("toggle_aside");*/
  if(elem.style.display === t1)
    elem.style.display = t2;
  else 
    elem.style.display = t1;
}

function moreStory() {
  console.log(this.id);
  var numb = (this.id).match(/\d/g);
  numb = numb.join("");
  console.log(numb);
  var elems = document.getElementsByTagName("aside").item(numb-1).childNodes.item(1).childNodes;
  for(var i = 3 ; i < elems.length ; i++) {
    home_toggle_display(elems.item(i),"block","none");
    if(elems.item(i).style.display === "none")
      this.innerHTML = "+";
    else 
      this.innerHTML = "-";
  }
  
}

let as_account_btn = document.getElementsByClassName('as_account');
console.log(as_account_btn);
for (var i = 0; i < as_account_btn.length; i++) 
  as_account_btn[i].addEventListener('click',moreStory,false);