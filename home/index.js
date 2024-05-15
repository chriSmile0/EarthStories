window.onload = function() {MoveRight();MoveLeft();ScrollRight();};
window.onresize = function() {MoveRight();MoveLeft();ScrollRight();};
window.onscroll = function() {AfficherRemonter();MoveLeft();MoveRight();ScrollRight();};

document.getElementById('SVG_div').onscroll = function() {MoveRight();MoveLeft();ScrollRight();};

document.getElementById('right').addEventListener('click',function() {
  var elem = document.getElementById('SVG_div');
  elem.scrollTo(elem.scrollLeft+300,0);
});

document.getElementById('left').addEventListener('click',function() {
  var elem = document.getElementById('SVG_div');
  elem.scrollTo(elem.scrollLeft-300,0);
});


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

function MoveRight() {
  if(document.body.clientWidth < 1000) {
    document.getElementById('right').style.display = "block";
    document.getElementById('right_a').style.display = "block";
    console.log( document.getElementById('right'));
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
  console.log(tar);
  document.getElementById("search").value = tar;
  document.getElementById("research").style.marginLeft = 10+window.scrollX+"px";
}


const paths = document.getElementsByTagName("path");
for (var i = 0; i < paths.length; i++) 
  paths[i].addEventListener('click',afficheTitle,false);

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
  var p = document.createElement("div");
  p.innerHTML = contenu;
  asid.appendChild(p);
  var button = document.createElement("button");
  button.setAttribute("id","a1");
  button.addEventListener('click',moreStory,false);
  button.classList.add('as_account');
  button.innerHTML = "+";
  asid.appendChild(button);
}

function as2(asid,contenu) {
  var h = document.createElement("h3");
  h.innerHTML = "Culture";
  asid.appendChild(h);
  var p = document.createElement("p");
  p.innerHTML = contenu;
  asid.appendChild(p);
  var button = document.createElement("button");
  button.setAttribute("id","a2");
  button.classList.add('as_account');
  button.innerHTML = "+";
  asid.appendChild(button);
}

function as3(asid,contenu) {
  var h = document.createElement("h3");
  h.innerHTML = "Voyages";
  asid.appendChild(h);
  var p = document.createElement("p");
  p.innerHTML = contenu;
  asid.appendChild(p);
  var button = document.createElement("button");
  button.setAttribute("id","a3");
  button.classList.add('as_account');
  button.innerHTML = "+";
  asid.appendChild(button);
}

function as4(asid,contenu) {
  var h = document.createElement("h3");
  h.innerHTML = "Sciences";
  asid.appendChild(h);
  var p = document.createElement("p");
  p.innerHTML = contenu;
  asid.appendChild(p);
  var button = document.createElement("button");
  button.setAttribute("id","a4");
  button.classList.add('as_account');
  button.innerHTML = "+";
  asid.appendChild(button);
}

function as5(asid,contenu) {
  var h = document.createElement("h3");
  h.innerHTML = "Récits";
  asid.appendChild(h);
  var p = document.createElement("p");
  p.innerHTML = contenu;
  asid.appendChild(p);
  var button = document.createElement("button");
  button.setAttribute("id","a5");
  button.classList.add('as_account');
  button.innerHTML = "+";
  asid.appendChild(button);
}

function as6(asid,contenu) {
  var h = document.createElement("h3");
  h.innerHTML = "Célébrités";
  asid.appendChild(h);
  var p = document.createElement("p");
  p.innerHTML = contenu;
  asid.appendChild(p);
  var button = document.createElement("button");
  button.setAttribute("id","a6");
  button.classList.add('as_account');
  button.innerHTML = "+";
  asid.appendChild(button);
}

function aside_restriction(index_aside, r_or_not) {
  var elem = document.getElementsByTagName("aside").item(index_aside); // aside we select ?/6
  var internal_div = elem.childNodes.item(1);
  var divs_in_div = internal_div.childNodes;
  for(var i = 1; i < divs_in_div.length ; i++) 
    divs_in_div.item(i).style.display = "none";
  
  if(r_or_not) {
    elem.childNodes.item(2).style.display = "block";
  }
  
}

function stories() {	
  let asides = document.getElementsByTagName("aside");
  var len = asides.length;
  for(var i = 0; i < len ; i++) 
    asides.item(i).childNodes.forEach(function(item) {
      if(item.nodeName === "DIV") 
        if(item.childNodes.length > 1) 
          aside_restriction(i,true);
        else 
          aside_restriction(i,false);
    });
}


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
  console.log(elems);
  for(var i = 1 ; i < elems.length ; i++) {
    home_toggle_display(elems.item(i),"block","none");
    elems.item(i).style.backgroundColor = "blue";
    if(elems.item(i).style.display === "none")
      this.innerHTML = "+";
    else 
      this.innerHTML = "-";
  }
  
}

/*let as_account_btn = document.getElementsByClassName('as_account');
console.log(as_account_btn);
for (var i = 0; i < as_account_btn.length; i++) 
  as_account_btn[i].addEventListener('click',moreStory,false);*/

function track(e) {
  e.preventDefault();
  e.stopPropagation();
  var recup_info = document.getElementById("search").value;
  let xmlhttp=new XMLHttpRequest()
  xmlhttp.onreadystatechange = function() {
    if((this.readyState === XMLHttpRequest.DONE) && (this.status === 200)) {
      console.log(this.responseText)
      const reponse = JSON.parse(this.responseText);
      if(reponse[0] != "Error") {
        var elem = (document.getElementsByTagName("section"))[0];
        if((elem.childElementCount > 0) && ((reponse[0]) != elem.firstChild.id)) 
          elem.removeChild(elem.firstElementChild);
        
        var div = document.createElement("div");
        var h2 = document.createElement("h2");
        h2.classList.add("no_background_color");
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
        flex_div.className = "div_flex";
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
        stories();
        var val = document.getElementsByTagName("h2").item(0).getBoundingClientRect().top;
        window.scrollTo({left:0,top:val,behavior:"smooth"});//document.getElementsByTagName("h2").item(0).getBoundingClientRect.bottom,);
      }
      else {
        console.log("Error");
      }
    };
  }
  xmlhttp.open("GET","i_map.php?q="+recup_info,true);
  xmlhttp.send();
}

(document.getElementById("btn")).addEventListener("click", track, false);

console.log("HIHI");