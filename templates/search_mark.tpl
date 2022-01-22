<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Identification des marques/Brand identification</title>
	<link rel="stylesheet" type="text/css" href="../styles/search.css">
	<link rel="stylesheet" type="text/css" href="../styles/globale.css">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">
</head>
<body>
	<div id="Corps">
		<h1>{$ResultRechMark}</h1>
		<div id="Bloc">
			{if isset($liste_marque)}
			{foreach from=$liste_marque item=infos}
			<div class="case">
				<p><a href="voir.php?CleAff={$infos.PK_MARQUE}&amp;TypePage=9&amp;Lan={$Langue}"><img src="../images/{$infos.Icone_View}" alt=""></a></p>
				<p><a href="voir.php?CleAff={$infos.PK_MARQUE}&amp;TypePage=9&amp;Lan={$Langue}">{$infos.NOM_MARQUE}</a></p>
			</div>
			{/foreach}
			{else}
			<p> - {$AucunRes}</p>
			{/if}
		</div>
		<p><a href="marque.php">{$Retour}</a></p>
	</div>
	<footer>
		<p>Gestion collection mat&eacute;riel photographique version :{$VersionNum}</p>
		<p>Copyright &copy; 2018 Editiel 98, Guillaume Cregut</p>
		<p>Moteur utilis&eacute; : MySQL.</p>
		<p><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-html401-blue"  alt="Valid HTML 4.01 Transitional" height="31" width="88"></a></p>
	</footer>
</body>
</html>	