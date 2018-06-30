function menuResponsive() {
	var x = document.getElementById("myMenu");
	if (x.className === "Menu") {
		x.className += " responsive";
	} 
	else {
		x.className = "Menu";
	}
}