<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Gestion de collection-Collection manager</title>
	<script src="../script/ajax.js"></script>
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
		function Fenetre(Lien)
		{
			page=Lien;
			window.open(page,'Informations','width=400,height=200,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,copyhistory=no,resizable=no');
		}
		function SetOld(OldFile)
		{
			document.gest_tables.AncienFichier.value=OldFile;
			ChargeTexte(OldFile);
		}
		// - JavaScript - -->
	</script>
</head>
<body>
	<div id="Corps">
		<h1>{$Mgmt} {$TitreMarques}</h1>
		<form name="gest_tables" action="domarque.php" method="post">
			<input type="hidden" Name="AncienFichier" value="">
			<input type="hidden" name="faire" value="0">
			<p>{$StyleExist}</p>
			<div id="existant">
				{if isset($TabItem)}
				{foreach from=$TabItem item=infos}
				<p><input type="radio" name="TheItem" value="{$infos.PK_MARQUE}" onclick="SetOld('{$infos.chemin}')"><a href="javascript:Fenetre('{$infos.chemin}')">{$infos.NOM_MARQUE}</a>-{$infos.NOM_PAYS}</p>
				{/foreach}
				{else}
				<p>Aucune info</p>
				{/if}
			</div>
			<div id="new_item">
				<p>{$LeNom} : <input type="text" name="Nom_Item"></p>
				<p>{$LePaysMarque} : <select name="NumPays" size="1">
				{foreach from=$TabPays item=infosP}
				<option value="{$infosP.PK_PAYS}">{$infosP.NOM_PAYS}</option>
				{/foreach}
				</select>
				<p>Informations {$Mot1} {$LeMarquePage} : <br>
				<textarea name="LasDesc" rows="5" cols="60"></textarea></p>
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