<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Collection appareils photos /Camera collection</title>
  <link rel="stylesheet" type="text/css" href="../styles/globale.css">
  <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">
  <link rel="stylesheet" type="text/css" media="screen" href="../styles/appareil.css">
</head>
<body>
<div id="Corps">
	<h1>{$Titre_Page}</h1>
	<div id="infogen">
		<h2>{$Gen_Info}</h2>
		<div class="BlocInfo">
			<p><span  class="definition">{$Type_Mat} :</span> <span class="valeur"><a href="voir.php?TypePage=5&amp;Lan={$Langue}&amp;CleAff={$Cle_Type}" target="_blank"> {$Info_Mat}</a></span></p>
			<p><span  class="definition">{$Nom_M}  :</span> <span class="valeur">{$Info_Nom}</span></p>
			<p><span  class="definition">{$Marques} :</span> <span class="valeur"><a href="voir.php?TypePage=9&amp;Lan={$Langue}&amp;CleAff={$Cle_Marque}"  target="_blank"> {$Info_Marque}</a></span></p>
			<p><span  class="definition">{$Annee_Const} :</span> <span class="valeur">{$Info_Date}</span></p>
			<p><span  class="definition">{$Periode} :</span> <span class="valeur"><a href="voir.php?TypePage=3&amp;Lan={$Langue}&amp;CleAff={$Cle_Per}" target="_blank"> {$Periode_M}</a></span></p>
		</div>
	</div>
	<div id="infotech">
		<h2>{$Tech_Info}</h2>
		<div class="BlocInfo">
			<p><span  class="definition">{$Type_App} :</span><span class="valeur"><a href="voir.php?TypePage=8&amp;Lan={$Langue}&amp;CleAff={$Cle_App}" target="_blank"> {$Info_App}</a></span></p>
			<p><span  class="definition">{$Mont} :</span><span class="valeur"><a href="voir.php?TypePage=7&amp;Lan={$Langue}&amp;CleAff={$Cle_Mont}" target="_blank"> {$Info_Mont}</a></span></p>
			<p><span  class="definition">{$Obtu} :</span><span class="valeur"><a href="voir.php?TypePage=6&amp;Lan={$Langue}&amp;CleAff={$Cle_Obt}" target="_blank"> {$Info_Obtu}</a></span></p>
			<p><span  class="definition">{$Format} :</span><span class="valeur"><a href="voir.php?TypePage=4&amp;Lan={$Langue}&amp;CleAff={$Cle_Form}" target="_blank"> {$Info_Format}</a></span></p>
			<p><span  class="definition">{$Type_Film} :</span><span class="valeur"><a href="voir.php?TypePage=2&amp;Lan={$Langue}&amp;CleAff={$Cle_Film}" target="_blank"> {$Info_Film}</a></span></p>
			<p><span  class="definition">{$Camera_Data} :</span></p>
			<p class="texte">{$Info_H}</p>
		</div>
	</div>
	<h2>{$Photos}</h2>
	{$lesphotos}
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