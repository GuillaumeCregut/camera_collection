<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Identification des appareils photos/Camera identification</title>
	<link rel="stylesheet" type="text/css" href="../styles/globale.css">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">
</head>
<body>
	<div id="Corps">
		<h1>{$RechApp}</h1>
		<form name="Cherche_appareil" action="search_app.php" method="POST">
			<p>{$HowUseIt}</p>
			{if isset($RefInv)}
			<p><input type="checkbox" name="chRef" value="2"> {$RefInv} : <input type="text" name="CodeInv"></p>
			{/if}
			<p><input type="checkbox" name="chMat" value="2"> {$KindMat} : <select name="SorteMat" size="1">
			{foreach from=$list_mat item=infos}
			<option value="{$infos.PK_TMAT}">{$infos.NOM_MAT}</option>
			{/foreach}
			</select></p>
			<p><input type="checkbox" name="chNom" value="2"> {$NameDev} : <input type="text" name="NomMat"></p>
			<p><input type="checkbox" name="chMark" value="2"> {$BrandDev} : <select name="NumMarque" size="1">
			{foreach from=$list_marque item=infos}
			<option value="{$infos.PK_MARQUE}">{$infos.NOM_MARQUE}</option>
			{/foreach}
			</select></p>
			<p><input type="checkbox" name="chType" value="2">{$KindCam} : <select name="NumCate" size="1">
			{foreach from=$list_kind item=infos}
			<option value="{$infos.PK_APPAREIL}">{$infos.NOM_TAPP}</option>
			{/foreach}
			</select></p>
			<p><input type="checkbox" name="chForm" value="2"> {$FormatCam} : <select name="NumFormat" size="1">
			{foreach from=$list_format item=infos}
			<option value="{$infos.PK_FORMAT}">{$infos.NOM_FORMAT}</option>
			{/foreach}
			</select></p>
			<p><input type="checkbox" name="chFilm" value="2"> {$KindFilm} : <select name="NumSupp" size="1">
			{foreach from=$list_film item=infos}
			<option value="{$infos.PK_FILM}">{$infos.NOM_FILM}</option>
			{/foreach}
			</select></p>
			<p><input type="checkbox" name="chPer" value="2"> {$PeriodeC} : <select name="NumPeriode" size="1">
			{foreach from=$list_periode item=infos}
			<option value="{$infos.PK_PERIODE}">{$infos.NOM_PERIODE}</option>
			{/foreach}
			</select></p>
			<p><input type="checkbox" name="chObt" value="2"> {$ShutterCam} : <select name="NumShutter" size="1">
			{foreach from=$list_obtu item=infos}
			<option value="{$infos.PK_OBTU}">{$infos.NOM_OBTU}</option>
			{/foreach}
			</select></p>
			<p><input type="checkbox" name="chMon" value="2"> {$LensMount} : <select name="NumLens" size="1">
			{foreach from=$list_mount item=infos}
			<option value="{$infos.PK_MONTURE}">{$infos.NOM_MONTURE}</option>
			{/foreach}
			</select></p>
			{if isset($StateCam)}
			<p><input type="checkbox" name="chStat" value="2"> {$StateCam} : <select name="EtatCam">
			<option value="1">{$Mint}</option>
			<option value="2">{$Good}</option>
			<option value="3">{$CLA}</option>
			<option value="4">{$Restore}</option>
			<option value="5">{$Wretch}</option>
			</select>
			{/if}
			<p><input type="submit" value="{$Search}"></p>
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