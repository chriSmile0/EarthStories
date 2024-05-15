function home_toggle_display(elem,t1,t2) {
	if(elem.style.display === t1)
		elem.style.display = t2;
	else 
		elem.style.display = t1;
}
  
export function moreStory() {
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