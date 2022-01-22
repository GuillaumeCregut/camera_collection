<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Gestion de collection-Collection manager</title>
	<link rel="stylesheet" type="text/css" href="../styles/globale.css">
	<link rel="stylesheet" type="text/css" href="../styles/single.css">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">
	<script type="text/javascript">
		<!-- JavaScript
		 function Do_That(The_Action)
		 {
		   document.gest_tables.faire.value=The_Action;
		   document.gest_tables.submit();
		 }
		// - JavaScript - -->
	</script>
</head>
<body>
	<div id="Corps">
		<h1>{$Mgmt} {$Titre1Page}</h1>
		<form name="gest_tables" action="dosingle.php" method="post">
			<input type="hidden" name="Type_Page" value="{$Type_Page}">
			<input type="hidden" name="faire" value="0">
			<p>{$StyleExist}</p>
			<div id="existant">
				{if isset($liste_item)}
				{foreach from=$liste_item item=infos}
				<p><input type="radio" name="TheItem" value="{$infos.PK_GEN}">{$infos.NOM_GEN}</p>
				{/foreach}
				{else}
				<p>Aucun r&eacute;sultat</p>
				{/if}
			</div>
			<div id="new_item">
				<p>{$LeNom} : <input type="text" name="Nom_Item"></p>
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