<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
<title>Index</title>
<link rel="stylesheet" type="text/css" href="styles/index.css">
<link rel="stylesheet" type="text/css" href="styles/globale.css">
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
</head>
<body>
<div id="Corps">
	<div id="Essai">
	<header>
		<div id="Entete">
			<img src="images/collec.gif" alt="">  
			<h1>{$LIndex}</h1>
		</div>
	</header>
	</div>
<nav>
	<div id="Navigation">
		<ul class="Menus">
			<li>
				<div class="DivMenu">
					<h2><a href="#">{$HomeTitle}</a></h2>
					<ul class="subMenu">
						<li><a href="gestion/config.php">{$ConfSys}</a></li>
						<li><a href="gestion/index.php">{$GestionColl}</a></li>
						
					</ul>	
				</div>
			</li>
			<li>
				<div class="DivMenu">
					<h2><a href="consult/index.php">{$Display}</a></h2>
					<ul class="subMenu">
						<li><a href="consult/view.php?NumPage=6">{$Obtu}</a></li>
						<li><a href="consult/view.php?NumPage=7">{$Montu}</a></li>
						<li><a href="consult/view.php?NumPage=8">{$TypeApp}</a></li>
						<li><a href="consult/view.php?NumPage=9">{$Mark}</a></li>
						<li><a href="consult/presentation.php">{$Appar}</a></li>
					</ul>
				</div>
			</li>
			<li>
				<div class="DivMenu">
					<h2><a href="consult/search.php">{$Recherche}</a></h2>
					<ul class="subMenu">
						<li><a href="consult/appareil.php">{$Appar}</a></li>
						<li><a href="consult/marque.php">{$TitreMarques} / {$Pays}</a></li>
						<li><a href="consult/search_name.php?NumPage=6">{$Obtu}</a></li>
						<li><a href="consult/search_name.php?NumPage=7">{$Montu}</a></li>
						<li><a href="consult/search_name.php?NumPage=9">{$Mark}</a></li>
						<li><a href="consult/search_name.php?NumPage=10">{$Appar}</a></li>
					</ul>
				</div>
			<li>
			<li>
				<div class="DivMenu">
					<h2><a href="disconnect.php">{$Diconnect}</a></h2>	
				</div>
			</li>
		</ul>	
	</div>
</nav>
<section>
	<h2>Collection</h2>
	{$Presentation}
</section>
<footer>
	<p>Gestion collection mat&eacute;riel photographique version :{$VersionNum}</p>
	<p>Copyright &copy; 2018 Editiel 98, Guillaume Cregut</p>
	<p>Moteur utilis&eacute; : MySQL.</p>
	<p><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-html401-blue"  alt="Valid HTML 4.01 Transitional" height="31" width="88"></a></p>
</footer>
</div>
</body>
</html>