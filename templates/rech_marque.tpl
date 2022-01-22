<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Identification des marques/Brand identification</title>
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">
	<link rel="stylesheet" type="text/css" href="../styles/globale.css">
</head>
<body>
	<div id="Corps">
		<form name="Cherche_mark" action="search_mark.php" method="post">
		<h1>{$RechMark}</h1>
		<p>{$Pays} : <select name="SortePays" size="1">
		{foreach from=$liste_pays item=infos}
		<option value="{$infos.PK_PAYS}">{$infos.NOM_PAYS}</option>
		{/foreach}
		</select></p>
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