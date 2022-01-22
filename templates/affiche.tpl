<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Affichage de la collection</title>
  <link rel="stylesheet" type="text/css" media="screen" href="../styles/presentation.css">
  <link rel="stylesheet" type="text/css" href="../styles/globale.css">
  <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">
</head>
<body>
<div id="Corps">
	<h1>{$DisplayOf} {$NomAff}</h1>
	<div id="cadre">
			{if isset($liste_infos)}
			 {foreach from=$liste_infos item=infos}
			  <div class="case">
				<p><a href="voir.php?CleAff={$infos.cle}&amp;TypePage={$infos.type}"><img src="{$infos.chemin}" alt="photo de l'appareil"></a></p>
				<p><a href="voir.php?CleAff={$infos.cle}&amp;TypePage={$infos.type}">{$infos.nom}</a></p>
			  </div>
			{/foreach}
			{else}  
			<div class="enligne">{$AucunRes}</div>
			{/if}
	</div>
	<p><a href="presentation.php?Tri={$TypeRech}">{$Retour}</a></p>
</div>
<footer>
	<p>Gestion collection mat&eacute;riel photographique version :{$VersionNum}</p>
	<p>Copyright &copy; 2018 Editiel 98, Guillaume Cregut</p>
	<p>Moteur utilis&eacute; : MySQL.</p>
	<p><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-html401-blue"  alt="Valid HTML 4.01 Transitional" height="31" width="88"></a></p>
</footer>
</body>
</html>	

 