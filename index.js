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

function afficheTitle() {
    const tar = this.getAttribute("title");
    console.log(tar);
    document.getElementById("search").value = tar;
}

/*
function hover() {
    this.style.fill = "black";
}

function after() {
    this.style.fill = "#00785a";
}*/


const paths = document.getElementsByTagName("path");
console.log(paths[0].getAttribute("fill"));
console.log(paths[0].style.fill);
for (var i = 0; i < paths.length; i++) {
  paths[i].addEventListener('click',afficheTitle,false);
  /*paths[i].addEventListener('mouseover',hover,false);
  paths[i].addEventListener('mouseout',after,false);*/
}



function searchArticle() {
  //search in all paths 
  let i = 0;
  var search_value = document.getElementById("search").value;
  while(search_value != paths[i].getAttribute("title"))
    i++;
  let found = paths[i].id;
  document.getElementById(found).style.display = "block";
  document.getElementById(found).scrollIntoView();

}

(document.getElementById("btn")).addEventListener("click",searchArticle,false);


/*VOIR pour combiner les 6 dans une seules par après avec un tab d'asides*/
function as1(asid,contenu) {
  var h = document.createElement("h3");
  h.innerHTML = "Géorgraphie";
  asid.appendChild(h);
  var p = document.createElement("p");
  p.innerHTML = contenu;
  asid.appendChild(p);
}

function as2(asid,contenu) {
  var h = document.createElement("h3");
  h.innerHTML = "Culture";
  asid.appendChild(h);
  var p = document.createElement("p");
  p.innerHTML = contenu;
  asid.appendChild(p);
}

function as3(asid,contenu) {
  var h = document.createElement("h3");
  h.innerHTML = "Voyages";
  asid.appendChild(h);
  var p = document.createElement("p");
  p.innerHTML = contenu;
  asid.appendChild(p);
}

function as4(asid,contenu) {
  var h = document.createElement("h3");
  h.innerHTML = "Sciences";
  asid.appendChild(h);
  var p = document.createElement("p");
  p.innerHTML = contenu;
  asid.appendChild(p);
}

function as5(asid,contenu) {
  var h = document.createElement("h3");
  h.innerHTML = "Récits";
  asid.appendChild(h);
  var p = document.createElement("p");
  p.innerHTML = contenu;
  asid.appendChild(p);
}

function as6(asid,contenu) {
  var h = document.createElement("h3");
  h.innerHTML = "Célébrités";
  asid.appendChild(h);
  var p = document.createElement("p");
  p.innerHTML = contenu;
  asid.appendChild(p);
}

function track(e) {
  e.preventDefault();
  e.stopPropagation();
  var recup_info = document.getElementById("search").value;
  let xmlhttp=new XMLHttpRequest()
  xmlhttp.onreadystatechange = function() {
    if((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)) {
      const reponse = JSON.parse(this.responseText);
      if(reponse[0] != "Error") {
        var elem = (document.getElementsByTagName("section"))[0];
        if((elem.hasChildNodes) && ((reponse[0]) != elem.firstChild.id)) {
          elem.removeChild(elem.lastChild);
          var div = document.createElement("div");
          var h2 = document.createElement("h2");
          var flex_div = document.createElement("div");
          var a1 = document.createElement("aside");
          var a2 = document.createElement("aside");
          var a3 = document.createElement("aside");
          var a4 = document.createElement("aside");
          var a5 = document.createElement("aside");
          var a6 = document.createElement("aside");
          as1(a1,reponse[2]);
          as2(a2,reponse[3]);
          as3(a3,reponse[4]);
          as4(a4,reponse[5]);
          as5(a5,reponse[6]);
          as6(a6,reponse[7]);
          flex_div.id = "div_flex";
          flex_div.appendChild(a1);
          flex_div.appendChild(a2);
          flex_div.appendChild(a3);
          flex_div.appendChild(a4);
          flex_div.appendChild(a5);
          flex_div.appendChild(a6);
          h2.innerHTML = reponse[1];
          div.appendChild(h2);
          div.appendChild(flex_div);
          div.id = "L"+reponse[0];
          (document.getElementsByTagName("section"))[0].appendChild(div);
        }
      }
      else {
        console.log("Error");
      }
    };
  }
  xmlhttp.open("GET","map.php?q="+recup_info,true);
  xmlhttp.send();
}

(document.getElementById("btn")).addEventListener("click", track, false);