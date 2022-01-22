<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Collection appareils photos /Camera collection</title>
	<link rel="stylesheet" type="text/css" href="../styles/globale.css">
	<link rel="stylesheet" type="text/css" href="../styles/view.css">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">
</head>
<body>
<div id="Corps">
	<h1>{$DisplayOf} {$Titre1Page}</h1>
	<div id="centre">
		<ul id="liste">
		{foreach from=$liste_infos item=infos}
		<li class="info"><img src="../images/{$Icone_View}" alt=""><a href="voir.php?CleAff={$infos.PK_GEN}&amp;TypePage={$Type_Page}">{$infos.NOM_GEN}</a></li>
		{/foreach}
		</ul>
	</div>
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