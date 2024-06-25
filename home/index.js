import { moreStory } from '../inc/display_elements.js';

window.onload = function() {MoveRight();MoveLeft();ScrollRight();};
window.onresize = function() {MoveRight();MoveLeft();ScrollRight();};
window.addEventListener('onscroll',function(){MoveLeft();MoveRight();ScrollRight()},false); // TO COMBINE WITH AFFICHER_REMONTER() OF COMMON.JS

document.getElementById('SVG_div').onscroll = function() {MoveRight();MoveLeft();ScrollRight();};

document.getElementById('right').addEventListener('click',function() {
  var elem = document.getElementById('SVG_div');
  elem.scrollTo(elem.scrollLeft+300,0);
});

document.getElementById('left').addEventListener('click',function() {
  var elem = document.getElementById('SVG_div');
  elem.scrollTo(elem.scrollLeft-300,0);
});

function MoveRight() {
  if(document.body.clientWidth < 1000) {
    document.getElementById('right').style.display = "block";
    document.getElementById('right_a').style.display = "block";
  } 
  else {
    document.getElementById('right').style.display = "none";
    document.getElementById('right_a').style.display = "none";
  }
}

function MoveLeft() {
  if (document.getElementById('SVG_div').scrollLeft > 50) {
      document.getElementById('left').style.display = "block";
      document.getElementById('left_a').style.display = "block";
  } 
  else {
    document.getElementById('left').style.display = "none";
    document.getElementById('left_a').style.display = "none";
  }
}

function ScrollRight() {
  if (document.getElementById('SVG_div').scrollLeft + document.body.clientWidth < 1000) {
      document.getElementById('right').style.display = "block";
      document.getElementById('right_a').style.display = "block";
  } 
  else {
    document.getElementById('right').style.display = "none";
    document.getElementById('right_a').style.display = "none";
  }
}

function afficheTitle() {
  const tar = this.getAttribute("title");
  document.getElementById("search").value = tar;
  document.getElementById("research").style.marginLeft = 10+window.scrollX+"px";
}


const paths = document.getElementsByTagName("path");
for (var i = 0; i < paths.length; i++) 
  paths[i].addEventListener('click',afficheTitle,false);

function searchArticle() {
  let i = 0;
  var search_value = document.getElementById("search").value;
  while(search_value != paths[i].getAttribute("title"))
    i++;
  let found = paths[i].id;
  document.getElementById(found).style.display = "block";
  document.getElementById(found).scrollIntoView();

}

(document.getElementById("btn")).addEventListener("click",searchArticle,false);

function as(title,contenu,index) {
  let asid = document.createElement("aside");
  var h = document.createElement("h3");
  h.innerHTML = title;
  asid.appendChild(h);
  var p = document.createElement("div");
  p.innerHTML = contenu;
  asid.appendChild(p);
  var button = document.createElement("button");
  button.setAttribute("id","a"+index);
  button.addEventListener('click',moreStory,false);
  button.classList.add('as_account');
  button.innerHTML = "+";
  asid.appendChild(button);
  return asid;
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
        if((elem.childElementCount > 0) && ((reponse[0]) != elem.firstChild.id)) 
          elem.removeChild(elem.firstElementChild);
        
        var div = document.createElement("div");
        var h2 = document.createElement("h2");
        h2.classList.add("no_background_color");
        var flex_div = document.createElement("div");
        flex_div.className = "div_flex";
        var infos = ["Géographie","Culture","Voyages","Sciences","Récits","Célébrités"];
        var index = 0;
        infos.forEach(function(item) {
          flex_div.appendChild(as(item,reponse[index+2],index+1));
          index++;
        });
        h2.innerHTML = reponse[1];
        div.appendChild(h2);
        div.appendChild(flex_div);
        div.id = "L"+reponse[0];
        (document.getElementsByTagName("section"))[0].appendChild(div);
        stories();
        document.getElementsByTagName("aside").item(0).scrollIntoView({behavior:"smooth"});
      }
    };
  }
  xmlhttp.open("POST","i_map.php",true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("q="+recup_info);
}

(document.getElementById("btn")).addEventListener("click", track, false);