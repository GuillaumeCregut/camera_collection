<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
<title>Collection appareils photos</title>
<script language="JavaScript">
<!-- JavaScript
 function Do_That(The_Action)
 {
   document.gest_tables.faire.value=The_Action;
   document.gest_tables.submit();
 }
// - JavaScript - -->
</script>
</head>
<body bgcolor="lightblue" text="black" link="blue" vlink="purple" alink="red">
<?php
  //inclue files
  include "config.inc.php";
  include "function.inc.php";
  $Type_Page=$_GET["NumPage"];
  include "typepage$Type_Page.php";
  echo "<input type=\"hidden\" Name=\"Type_Page\" value=\"$Type_Page\">\n";
  echo "<H1>$TitrePage</H1>\n";
?>
<form name="gest_tables" action="squelette-do1.php" method="POST">
<input type="hidden" name="faire" value="0">
<table border="0">
    <tr>
        <td width="484">
	<p>D&eacute;j&agrave; existant:</p>
            <table border="1" bgcolor="white">
                <tr>
                    <td width="474">
<?php
    //ici on liste les items présents
    $SQLS=$RequeteSelect;
$OK=FALSE;
    $connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName,$BaseType);
    if ($BaseType==0)
    {
      $dbconn=connect_base($DBName,$connecter);
    }
    $query=requete_base($SQLS,$connecter,$BaseType);
    if (!$query)
    {
       echo "<br>Erreur<br>";
       echo "<p>Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
       echo "SQLS = $SQLS .";
       die("un probleme de requete a eu lieu, veuillez contacter l'administrateur du systeme");
    }
    while ($row=get_Objet($query,$BaseType))
      {
        echo "<input type=\"radio\" name=\"TheItem\" value=\"$row->PK_GEN\">$row->NOM_GEN<br>\n";
      }
    echo "</p>\n";
?>
                    </td>
                </tr>
            </table>
        </td>
        <td width="484" valign="top">
                <p>NOM : <input type="text" name="Nom_Item"></p>
                <p>Pays : <select name="NumPays" size="1">
<?php

?>
                </select></p>
                <p>Informations $Mot1 $LeItemPage : <br>
                <textarea name="LasDesc" rows="5" cols="60"></textarea></p>
        </td>
    </tr>
    <tr>
        <td width="974" colspan="2">
            <table border="0">
                <tr>
                    <td width="317" align="center">
                        <p>&nbsp;<input type="button" value="Supprimer" OnClick="Do_That(3)"></p>
                    </td>
                    <td width="317" align="center">
                        <p>&nbsp;<input type="button" value="Modifier" OnClick="Do_That(2)"></p>
                    </td>
                    <td width="317" align="center">
                        <p>&nbsp;<input type="button" value="Ajouter" OnClick="Do_That(1)"></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</form>
</body>

</html>
