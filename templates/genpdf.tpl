<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../styles/globale.css">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">
  <title>G&eacute;n&eacute;ration du catalogue de la collection</title>
</head>
<body>
	<div id="Corps">
		<h1>G&eacute;n&eacute;ration du catalogue de la collection</h1>
		<form name="do_pdf" method="post" action="prod_pdf.php">
		<p>Tri par :</p>
		<p><input value="0" checked type="radio" name="Choix_Tri">&nbsp;Marque</p>
		<p><input value="1" type="radio" name="Choix_Tri">&nbsp;Epoque</p>
		<p><input value="2" type="radio" name="Choix_Tri">&nbsp;Nom de l'appareil</p>
		<p><input value="3" type="radio" name="Choix_Tri">&nbsp;Type d'appareil</p>
		<p><input value="4" type="radio" name="Choix_Tri">&nbsp;Num&eacute;ro d'inventaire</p>
		<p>Afficher :</p>
		<p><input type="checkbox" name="Aff_">&nbsp;La date</p>
		<p><input type="checkbox" name="Aff_">&nbsp;L'ordre du tri</p>
		<p><input type="checkbox" name="Aff_">&nbsp;Statistiques</p>
		<p><input value="Valider" type="submit" name="Bouton"></p>
		</form>
		<p><a href="index.php">Retour</a></p>
	</div>
	<footer>
		<p>Gestion collection mat&eacute;riel photographique version :{$VersionNum}</p>
		<p>Copyright &copy; 2018 Editiel 98, Guillaume Cregut</p>
		<p>Moteur utilis&eacute; : MySQL.</p>
		<p><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-html401-blue"  alt="Valid HTML 4.01 Transitional" height="31" width="88"></a></p>
	</footer>
</body>
</html>	