<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Gestion de collection-Collection manager</title>
	<link rel="stylesheet" type="text/css" href="../styles/globale.css">
	<link rel="stylesheet" type="text/css" href="../styles/stats.css">
</head>
<body>
	<div id="Corps">
		<h1 >{$TitreStat}  : {$DateJour}</h1>
		<p><span id="souli">{$NbreAppTotal} :</span> <span class="rouge">{$nbreApp}</span></p>
		<p>{$Thereis} <span class="rouge">{$Nbre_7}</span> {$Val7}</p>
		<p>{$Thereis} <span class="rouge">{$Nbre_8}</span> {$Val8}</p>
		<p>{$Thereis} <span class="rouge">{$Nbre_9}</span> {$Val9}</p>
		<p>{$Thereis} <span class="rouge">{$Nbre_10}</span> {$Val10}</p>
		<p>{$Thereis} <span class="rouge">{$Nbre_11}</span> {$Val11}</p>
		<p>{$Thereis} <span class="rouge">{$Nbre_12}</span> {$Val12}</p>
		<p>{$Thereis} <span class="rouge">{$Nbre_13}</span> {$Val13}</p>
		<p>{$Thereis} <span class="rouge">{$Nbre_14}</span> {$Val14}</p>
		<p>{$Thereis} <span class="rouge">{$Nbre_17}</span> {$Val17}</p>
		{if isset($ValeurCollec)}
		<h2>{$ValeurCollec}</h2>
		<p>{$ValEstim} <span class="rouge">{$CoutTotal}</span> euros</p>
		{/if}
		<h2>{$ClassCat} :</h2>
		{foreach from=$liste_graf item=infos}
		<p><img src="{$infos}" alt="statistiques"></p>
		{/foreach}
		<p><img src="{$BarGraf}" alt="statistiques"></p>
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