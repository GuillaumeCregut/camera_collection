<?php
 //include files
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  $SQLS="SELECT ref_inv FROM T_Item";
  $connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName,$BaseType);
  if ($BaseType==0)
  {
    $dbconn=connect_base($DBName,$connecter);
  }
  $query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
  while ($row=get_Objet($query,$BaseType))
  {
    echo "<p><input type=\"checkbox\" name=\"dfsd\" value=\"sfs\"> <font color=\"red\">$row->REF_INV</font></p>\n";
  }
?>