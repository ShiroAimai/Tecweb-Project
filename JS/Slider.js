var indice = 0;
showSlides();
function showSlides() {
	var i;
	var slides = document.getElementsByClassName("slide");
	var punti = document.getElementsByClassName("punto");
	for (i = 0; i < slides.length; i++) {
	   slides[i].style.display = "none";  
	}
	indice++;
	if (indice > slides.length) {
		indice = 1;
	}
	for (i = 0; i < punti.length; i++) {
		punti[i].className = punti[i].className.replace(" active", "");
	}
	slides[indice-1].style.display = "block";  
	punti[indice-1].className += " active";
	setTimeout(showSlides, 5000);
}