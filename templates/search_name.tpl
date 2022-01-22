<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Recherche/Search</title>
	<link rel="stylesheet" type="text/css" href="../styles/globale.css">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">
</head>
<body>
	<div id="Corps">
		<form name="Cherche_nom" action="result_search.php" method="post">
			<h1>{$SearchFor}</h1>
			<input type="hidden" Name="Lan" value="{$Langue}">
			<input type="hidden" Name="NumPage" value="{$TypePage}">
			<h2>{$TitreRech}</h2>
			<p>{$LeNom}: <input type="text" name="nom_rech"></p>
			<p><input type="submit" value="{$Search}"></p>
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