<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Gestion de collection-Collection manager</title>
	<link rel="stylesheet" type="text/css" href="../styles/add_app.css">
	<link rel="stylesheet" type="text/css" href="../styles/globale.css">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">
	<script type="text/javascript">
		<!-- JavaScript
		function Fenetre(Lien)
		{
			page=Lien;
			window.open(page,'Informations','width=400,height=200,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,copyhistory=no,resizable=no');
		}
		function SetOld(OldFile1,OldFile2)
		{
			document.gest_tables.AncienFichier1.value=OldFile1;
			document.gest_tables.AncienFichier2.value=OldFile2;
		}
		// - JavaScript - -->
	</script>
</head>
<body>
	<div id="Corps">
		<h1>{$ModifApp}</h1>
		{if isset($Error)}
		<p>{$Erreur}</p>
		<p>{$Error_msg}</p>
		<p>SQL : {$SQLS}</p>
		{/if}
		<form name="gest_tables" action="doappareil.php" method="post">
			<input type="hidden" Name="OldApp" value="{$valeur}">
			<input type="hidden" Name="faire" value="2">
			<input type="hidden" Name="AncienFichier1" value="">
			<input type="hidden" Name="AncienFichier2" value="">
			{if isset($PrivateUse)}
			<p>{$RefInv} : <input type="text" name="CodeInv" value="{$valeur}"></p>
			{/if}
			<p>{$KindMat} : <select name="SorteMat" size="1">
			{foreach from=$TabMat item=infos}
			<option value="{$infos.PK_TMAT}" {$infos.IsChecked}>{$infos.NOM_MAT}</option>
			{/foreach}
			</select></p>
			<p>{$NameDev} : <input type="text" name="NomMat" value="{$LeNom}">&nbsp;&nbsp;<a href="{$Lapagedemande}?Lan={$Langue}" target="_blank">{$ExisteIl}</a></p>
			<p>{$BrandDev} : <select name="NumMarque" size="1">
			{foreach from=$TabMarque item=infos}
			<option value="{$infos.PK_MARQUE}" {$infos.IsChecked}>{$infos.NOM_MARQUE}</option>
			{/foreach}
			</select></p>
			<p>{$KindCam} : <select name="NumCate" size="1">
			{foreach from=$TabTapp item=infos}
			<option value="{$infos.PK_APPAREIL}" {$infos.IsChecked}>{$infos.NOM_TAPP}</option>
			{/foreach}
			</select></p>
			<p>{$FormatCam} : <select name="NumFormat" size="1">
			{foreach from=$TabFormat item=infos}
			<option value="{$infos.PK_FORMAT}" {$infos.IsChecked}>{$infos.NOM_FORMAT}</option>
			{/foreach}
			</select></p>
			<p>{$KindFilm} : <select name="NumSupp" size="1">
			{foreach from=$TabFilm item=infos}
			<option value="{$infos.PK_FILM}" {$infos.IsChecked}>{$infos.NOM_FILM}</option>
			{/foreach}
			</select></p>
			<p>{$YearConst} : <input type="text" name="AnneeConst" value="{$AnneProd}"></p>
			<p>{$PeriodeC} : <select name="NumPeriode" size="1">
			{foreach from=$TabPeriode item=infos}
			<option value="{$infos.PK_PERIODE}" {$infos.IsChecked}>{$infos.NOM_PERIODE}</option>
			{/foreach}
			</select></p>
			<p>{$ShutterCam} : <select name="NumShutter" size="1">
			{foreach from=$TabObtu item=infos}
			<option value="{$infos.PK_OBTU}" {$infos.IsChecked}>{$infos.NOM_OBTU}</option>
			{/foreach}
			</select></p>
			<p>{$LensMount} : <select name="NumLens" size="1">
			{foreach from=$TabMonture item=infos}
			<option value="{$infos.PK_MONTURE}" {$infos.IsChecked}>{$infos.NOM_MONTURE}</option>
			{/foreach}
			</select></p>
			<p>{$PhotoCam} : <input type="text" name="PhotoCam" value="{$LesPhotos}"></p>
			{if isset($PrivateUse)}
			<p>{$BuyPrice} : <input type="text" name="PrixAchat" value="{$lePrix}"> Euros</p>
			<p>{$StateCam} : </p>
			<ul>
			{foreach from=$TabEtat item=infos}
			<li><input type="radio" name="etatapp" value="{$infos.cle}" {$infos.IsChecked}>{$infos.donneeTab}</li>
			{/foreach}
			</ul></p>
			<p>{$PersNote} :</p>
			<p><textarea name="NotePers" rows="5" cols="60">{$fp2}</textarea></p>
			{/if}
			<p>{$InfoCam} : </p>
			<p><textarea name="InfoApp" rows="5" cols="60">{$fp1}</textarea></p>
			<p><input type="submit" value="{$BoutonMod}"></p>
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