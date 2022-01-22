<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>{$Page_Titre}</title>
	<link rel="stylesheet" type="text/css" href="../styles/globale.css">
	<link rel="stylesheet" type="text/css" href="../styles/config.css">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">
</head>
<body>
	<div id="Corps">
		<h1>{$Ppal_Titre}</h1>
		{if isset($Traitement_Message)}
		<p>-{$Le_Message}.</p>
		{/if}
		<form name="formulaire" method="post" action="#">
			<fieldset>
			<legend>{$TitreSQL}</legend>
				<p><label for="NomUtilisateur">{$NomUser} : </label><input type="text" id="NomUtilisateur" name="NomUtilisateur" value="{$ValUser}"></p>
				<p><label for="MotPasse">{$MotPasse} : </label><input type="text" id="MotPasse" name="MotPasse" value="{$ValPass}"></p>
				<p><label for="Nom_Serveur">{$Serveur} : </label><input type="text" id="Nom_Serveur" name="Nom_Serveur" value="{$ValServ}"></p>
				<p><label for="Nom_Base">{$Base} : </label><input type="text" id="Nom_Base" name="Nom_Base" value="{$ValBase}"></p>
			</fieldset>
			<fieldset>
			<legend>{$TitreLogin}</legend>
				<p><label for="Gest_User">{$NomUser} : </label><input type="text" id="Gest_User" name="Gest_User" value="{$User_Gest}"></p>
				<p><label for="Gest_Pass">{$MotPasse} : </label><input type="password" id="Gest_Pass" name="Gest_Pass" value="{$Pass_Gest}"></p>
				<p>{$Langue_Used} : <br>
				<label for="Gest_Langue1">{$Langue1} : </label><input type="radio" id="Gest_Langue1" name="Gest_Langue" value="F" {$Checked1}><br>
				<label for="Gest_Langue2">{$Langue2} : </label><input type="radio" id="Gest_Langue2" name="Gest_Langue" value="E" {$Checked2}></p>
			</fieldset>
			<p><input name="submit" value="{$TitreBouton}" type="submit"></p>
			<input type="hidden" name="ConfDone" value="true">
			<input type="hidden" name="Lan" value="{$Lan}">
		</form>
		<p><a href="{$CheminIndex}">{$LIndex}</a></p>
		<footer>
			<p>Gestion collection mat&eacute;riel photographique version :{$VersionNum}</p>
			<p>Copyright &copy; 2018 Editiel 98, Guillaume Cregut</p>
			<p>Moteur utilis&eacute; : MySQL.</p>
			<p><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-html401-blue"  alt="Valid HTML 4.01 Transitional" height="31" width="88"></a></p>
		</footer>
	</div>
</body>
</html>	