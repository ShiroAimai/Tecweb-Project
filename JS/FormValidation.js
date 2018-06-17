function validatePersonalAreaForm() {
	
    //Codice utente
    var Code=document.forms["PersonalAreaForm"]["userCode"].value;
    if (Code!=null && Code=="") {
		alert("Il campo 'codice utente' deve essere compilato");
		return false;
    }
	
	//Password
    var Password=document.forms["PersonalAreaForm"]["pass"].value;
    if (Password!=null && Password=="") {
		alert("Il campo 'password' deve essere compilato");
		return false;
    }
}


function validateUserForm() {
	
    //Codice utente
    var Code=document.forms["userForm"]["userCode"].value;
    if (Code!=null && Code=="") {
		alert("Il campo 'codice utente' deve essere compilato");
		return false;
    }
	
	//Nome utente
    var Name=document.forms["userForm"]["userName"].value;
    if (Name!=null && Name=="") {
		alert("Il campo 'nome' deve essere compilato");
		return false;
    }
	
	//Cognome utente
    var Surname=document.forms["userForm"]["userSurname"].value;
    if (Surname!=null && Surname=="") {
		alert("Il campo 'cognome' deve essere compilato");
		return false;
    }

    //Password
    var Password=document.forms["userForm"]["pass"].value;
	var ConfirmPassword=document.forms["userForm"]["confirmPass"].value;
	var rePassword = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    if (Password!=null && Password=="") {
		alert("Il campo 'password' deve essere compilato");
		return false;
    }
	else if (rePassword.test(Password) == false) {
		alert("La password inserita non è valida, deve essere lunga almeno 8 caratteri e contenere almeno un numero e una lettera");
		return false;
    }
	else if (ConfirmPassword!=null && ConfirmPassword=="") {
		alert("Il campo 'ripeti password' deve essere compilato");
		return false;
    }
	else if (Password != ConfirmPassword) {
        alert("Le password inserite non coincidono");
		return false;
    }

    //Email
    var Email=document.forms["userForm"]["userMail"].value;
    if (Email!=null && Email=="") {
		alert("Il campo 'email' deve essere compilato");
		return false;
    }
	var reEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (reEmail.test(Email) == false) {
		alert("L'email inserita non è valida, deve essere nella forma 'me@example.com'");
		return false;
    }
}


function validateNewsForm() {
	
    //Titolo news
    var Title=document.forms["newsForm"]["newsTitle"].value;
    if (Title!=null && Title=="") {
		alert("Il campo 'titolo news' deve essere compilato");
		return false;
    }
	
	//Immagine news
    var Image=document.forms["newsForm"]["newsImage"].value;
    if (Image!=null && Image=="") {
		alert("Nessuna immagine selezionata");
		return false;
    }
	
	//Descrizione
    var Description=document.forms["newsForm"]["newsDescription"].value;
    if (Description!=null && Description=="") {
		alert("Il campo 'descrizione' deve essere compilato");
		return false;
    }
}


function validateGalleryForm() {
	
	//Titolo album
    var Name=document.forms["galleryForm"]["galleryName"].value;
    if (Name!=null && Name=="") {
		alert("Il campo 'nome album' deve essere compilato");
		return false;
    }
	
	//File galleria
    var Title=document.forms["galleryForm"]["galleryFile"].value;
    if (Title!=null && Title=="") {
		alert("Nessuna immagine selezionata");
		return false;
    }
}