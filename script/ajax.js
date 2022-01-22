function getXhr()
{
	var xhr = null; 
	if(window.XMLHttpRequest) // Firefox et autres
	   xhr = new XMLHttpRequest(); 
	else if(window.ActiveXObject){ // Internet Explorer 
	   try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
	}
	else { // XMLHttpRequest non supporté par le navigateur 
	   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
	   xhr = false; 
	}
	return xhr;
}

function ChargeTexte(chemin)
{
	if (chemin!="")
	{ //Si on a choisi un fichier
		var xhr=getXhr();
		xhr.onreadystatechange=function()
		{
			if(xhr.readyState==4 && xhr.status==200)
			{
				reponse=xhr.responseText;
				//alert(reponse);
				document.gest_tables.LasDesc.value=reponse;
			}
		}
		xhr.open("POST","../ajax/recup_texte.php",true); //on appelle la page avec la méthode post en asychrone
		xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xhr.send("chemin="+chemin);  	
	}
}