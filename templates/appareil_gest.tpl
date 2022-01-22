<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Gestion de collection-Collection manager</title>
	<link rel="stylesheet" type="text/css" href="../styles/globale.css">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">
	<link rel="stylesheet" type="text/css" href="../styles/add_app.css">
	<script type="text/javascript">
		<!-- JavaScript
		 function Do_That(The_Action)
		 {
		   if (The_Action!=2)
		   {
			 document.gest_tables.faire.value=The_Action;
			 document.gest_tables.submit();
		   }
		   else
		   {
			 var toto;
			 toto=document.gest_tables.OldApp.value;
			 document.change_app.ref_app.value=toto;
			 document.change_app.submit();
		   }
		 }
		 function Fenetre(Lien)
		 {
		   page=Lien;
		   window.open(page,'Informations','width=400,height=200,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,copyhistory=no,resizable=no');
		 }
		 function SetOld(OldFile1,OldFile2)
		 {
		   document.gest_tables.AncienFichier1.value=OldFile1;
		   destinationF=document.getElementById('CadreInfo');
		   ChargeTexte(OldFile1, destinationF);
		   document.gest_tables.AncienFichier2.value=OldFile2;
		   destinationF=document.getElementById('CadreNote');
		   ChargeTexte(OldFile2, destinationF);
		 }
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

		function ChargeTexte(chemin, destination)
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
						destination.value=reponse;
					}
				}
				xhr.open("POST","../ajax/recup_texte.php",true); //on appelle la page avec la méthode post en asychrone
				xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				xhr.send("chemin="+chemin);  	
			}
		}
		// - JavaScript - -->
	</script>
</head>
<body>
	<div id="Corps">
		<h1>{$Mgmt} {$TitreAppareils}</h1>
		<form name="change_app" action="mod_app.php" method="post">
			<input type="hidden" name="ref_app" value="-1">
		</form>
		<form name="gest_tables" action="doappareil.php" method="post">
			<input type="hidden" Name="faire" value="0">
			<input type="hidden" Name="AncienFichier1" value="">
			<input type="hidden" Name="AncienFichier2" value="">
			<p>{$StyleExist}</p>
			<div id="existant">
				{if isset($TabApp)}
				<select Name="OldApp" size="10">
				{foreach from=$TabApp item=infos}
				<option value="{$infos.REF_INV}" onclick="SetOld('{$infos.CheminComplet1}','{$infos.CheminComplet2}')">{$infos.NOM_ITEM}</option>
				{/foreach}
				</select></p>
				{else}
				<p>Aucune info</p>
				{/if}
			</div>
			<div id="new_item">
				{if isset($Private_Use)}
				<p>{$RefInv} : <input type="text" name="CodeInv">&nbsp;&nbsp;&nbsp;&nbsp;<a href="../gen_num.php" target="_blank">{$GenID}</a></p>
				{/if}
				<p>{$KindMat} : <select name="SorteMat" size="1">
					{foreach from=$TabMat item=infos}
					<option value="{$infos.PK_TMAT}">{$infos.NOM_MAT}</option>
					{/foreach}
				</select></p>
				<p>{$NameDev} : <input type="text" name="NomMat">&nbsp;&nbsp;<a href="{$Lapagedemande}?Lan={$Langue}" target="_blank">{$ExisteIl}</a></p>
				<p>{$BrandDev} : <select name="NumMarque" size="1">
					{foreach from=$TabMarque item=infos}
					<option value="{$infos.PK_MARQUE}">{$infos.NOM_MARQUE}</option>
					{/foreach}
				</select></p>
				<p>{$KindCam} : <select name="NumCate" size="1">
					{foreach from=$TabCat item=infos}
					<option value="{$infos.PK_APPAREIL}">{$infos.NOM_TAPP}</option>
					{/foreach}
				</select></p>
				<p>{$FormatCam} : <select name="NumFormat" size="1">
					{foreach from=$TabForm item=infos}
					<option value="{$infos.PK_FORMAT}">{$infos.NOM_FORMAT}</option>
					{/foreach}
				</select></p>
				<p>{$KindFilm} : <select name="NumSupp" size="1">
					{foreach from=$TabFilm item=infos}
					<option value="{$infos.PK_FILM}">{$infos.NOM_FILM}</option>
					{/foreach}
				</select></p>
				<p>{$YearConst} : <input type="text" name="AnneeConst"></p>
				<p>{$PeriodeC} : <select name="NumPeriode" size="1">
					{foreach from=$TabPeriode item=infos}
					<option value="{$infos.PK_PERIODE}">{$infos.NOM_PERIODE}</option>
					{/foreach}
				</select></p>
				<p>{$ShutterCam} : <select name="NumShutter" size="1">
					{foreach from=$TabObtu item=infos}
					<option value="{$infos.PK_OBTU}">{$infos.NOM_OBTU}</option>
					{/foreach}
				</select></p>
				<p>{$LensMount} : <select name="NumLens" size="1">
					{foreach from=$TabMont item=infos}
					<option value="{$infos.PK_MONTURE}">{$infos.NOM_MONTURE}</option>
					{/foreach}
				</select></p>
				<p>{$PhotoCam} : <input type="text" name="PhotoCam"></p>
				{if isset($Private_Use)}
				<p>{$BuyPrice} : <input type="text" name="PrixAchat"> Euros</p>
				<p>{$StateCam} : </p>
				<ul>
					<li><input type="radio" name="etatapp" value="1">{$Mint}</li>
					<li><input type="radio" name="etatapp" value="2">{$Good}</li>
					<li><input type="radio" name="etatapp" value="3">{$CLA}</li>
					<li><input type="radio" name="etatapp" value="4">{$Restore}</li>
					<li><input type="radio" name="etatapp" value="5">{$Wretch}</li>
				</ul>
				{/if}
				<p>{$InfoCam} : </p>
				<p><textarea name="InfoApp" rows="5" cols="60" id="CadreInfo"></textarea></p>
				{if isset($Private_Use)}
				<p>{$PersNote} :</p>
				<p><textarea name="NotePers" rows="5" cols="60" id="CadreNote"></textarea></p>
				{/if}
			</div>
			<p id="boutons"><input type="button" value="{$BoutonSupp}" OnClick="Do_That(3)">
			<input type="button" value="{$BoutonMod}" OnClick="Do_That(2)">
			<input type="button" value="{$BoutonAdd}" OnClick="Do_That(1)"></p>
		</form>
		<p><a href="{$CheminIndex}">{$LIndex}</a></p>
	</div>
	<footer>
		<p>Gestion collection mat&eacute;riel photographique version :{$VersionNum}</p>
		<p>Copyright &copy; 2018 Editiel 98, Guillaume Cregut</p>
		<p>Moteur utilis&eacute; : MySQL.</p>
		<p><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-html401-blue"  alt="Valid HTML 4.01 Transitional" height="31" width="88"></a></p>
	</footer>
</body>
</html>