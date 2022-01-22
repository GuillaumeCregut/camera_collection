<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>{$HomeTitle}</title>
	<link rel="stylesheet" type="text/css" href="../styles/globale.css">
	<link rel="stylesheet" type="text/css" href="../styles/gestion.css">
	<link rel="stylesheet" type="text/css" href="../styles/menu_index.css">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">
</head>
<body>
<div id="Corps">
<!--  Début Integration -->
	<h1>{$HomeTitle}</h1>
	<ul id="Listemenu">
		<li><a href="single.php?NumPage=1">{$Pays}</a></li>
		<li><a href="single.php?NumPage=2">{$TypeSupp}</a></li>
		<li><a href="single.php?NumPage=3">{$Perio}</a></li>
		<li><a href="single.php?NumPage=4">{$Forma}</a></li>
		<li><a href="single.php?NumPage=5">{$TypeMat}</a></li>
		<li><a href="double.php?NumPage=6">{$Obtu}</a></li>
		<li><a href="double.php?NumPage=7">{$Montu}</a></li>
		<li><a href="double.php?NumPage=8">{$TypeApp}</a></li>
		<li><a href="marque.php">{$Mark}</a></li>
		<li><a href="appareil.php">{$Appar}</a></li>
		<li><a href="stats3.php">{$Stats}</a></li>
		<li><a href="export.php">{$ExportDB}</a></li>
		<li><a href="do_pdf.php">{$GenereCat}  (french only for the moment)</a></li>
	</ul>	
<!-- Fin Integration -->
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