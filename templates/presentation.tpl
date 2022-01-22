<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Affichage de la collection</title>
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">
	<link rel="stylesheet" type="text/css" media="screen" href="../styles/presentation.css">
	<link rel="stylesheet" type="text/css" href="../styles/globale.css">
</head>
<body>
	<div id="Corps">
		<h1>{$MesCams}</h1>;
		<div id="cadre">
				{foreach from=$TabApp item=infos}
					<div class="case">
						<p><a href="affiche.php?Cle={$infos.cle}&amp;TypePage={$Choix}&amp;LeNom={$infos.NOM}"><img src="../images/dossier.gif" alt="Dossier"></a></p>
						<p><a href="affiche.php?Cle={$infos.cle}&amp;TypePage={$Choix}&amp;LeNom={$infos.NOM}">{$infos.NOM}</a></p>
					</div>
				{/foreach}
		</div>
		<div id="Formulaire">
			<p>{$DisplayOrdered} :</p>
			<form name="form1" method="GET" action="">
				<div id="questions">
					<p><input type="radio" name="Tri" value="1" checked>{$KindCam}</p>
					<p><input type="radio" name="Tri" value="2">{$PeriodeC}</p>
					<p><input type="radio" name="Tri" value="3">{$BrandDev}</p>
				</div>	
				<p><input type="submit" value="{$Display}"></p>
			</form>
		</div>	
		<p><a href="{$CheminIndex}">{$Retour}</a></p>
	</div>
	<footer>
		<p>Gestion collection mat&eacute;riel photographique version :{$VersionNum}</p>
		<p>Copyright &copy; 2018 Editiel 98, Guillaume Cregut</p>
		<p>Moteur utilis&eacute; : MySQL.</p>
		<p><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-html401-blue"  alt="Valid HTML 4.01 Transitional" height="31" width="88"></a></p>
	</footer>
</body>
</html>	