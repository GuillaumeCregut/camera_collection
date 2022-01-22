<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
<title>Statistiques</title>
</head>
<body>
<?php
  include "../include/config.inc.php";
  include "../include/function.inc.php";
//Essai de page de statistique:
//Page en francais pour le moment.
//Connexion à la base de données.
  $connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName,$BaseType);
  if ($BaseType==0)
  {
    $dbconn=connect_base($DBName,$connecter);
  }
  echo "<H1>Statistiques de la collection &agrave; la date de : ".date("j M Y")."</H1>\n";
  echo "<H2>Comptes totaux</H2>\n";
  $SQLS="SELECT COUNT (*) AS NBRE FROM T_Appareil";
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
    echo "<p>il y a <font color=\"red\">$row->NBRE</font> type d'appareil enregistr&eacute;s<br>\n";
  }
  $SQLS="SELECT COUNT (*) AS NBRE FROM T_FILM";
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
    echo "il y a <font color=\"red\">$row->NBRE</font> type de film enregistr&eacute;s<br>\n";;
  }
  //
  $SQLS="SELECT COUNT (*) AS NBRE FROM T_FORMAT";
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
    echo "il y a <font color=\"red\">$row->NBRE</font> type de format enregistr&eacute;s<br>\n";;
  }
    $SQLS="SELECT COUNT (*) AS NBRE FROM T_MARQUE";
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
    echo "il y a <font color=\"red\">$row->NBRE</font> marques enregistr&eacute;es<br>\n";;
  }
    $SQLS="SELECT COUNT (*) AS NBRE FROM T_MATERIEL";
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
    echo "il y a <font color=\"red\">$row->NBRE</font> type de mat&eacute;riel enregistr&eacute;s<br>\n";;
  }
    $SQLS="SELECT COUNT (*) AS NBRE FROM T_MONTURE";
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
    echo "il y a <font color=\"red\">$row->NBRE</font> type de d'objectifs enregistr&eacute;s<br>\n";;
  }
    $SQLS="SELECT COUNT (*) AS NBRE FROM T_OBTURATEUR";
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
    echo "il y a <font color=\"red\">$row->NBRE</font> type d'obturateurs enregistr&eacute;s<br>\n";;
  }
    $SQLS="SELECT COUNT (*) AS NBRE FROM T_PAYS";
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
    echo "il y a <font color=\"red\">$row->NBRE</font> pays enregistr&eacute;s<br>\n";;
  }
    $SQLS="SELECT COUNT (*) AS NBRE FROM T_PERIODE";
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
    echo "il y a <font color=\"red\">$row->NBRE</font> p&eacute;riodes enregistr&eacute;es<br>\n";;
  }
    $SQLS="SELECT COUNT (*) AS NBRE FROM T_ITEM";
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
    echo "il y a <font color=\"red\">$row->NBRE</font> appareils enregistr&eacute;s</p>\n";;
  }
  echo "<H2>Valeur de la collection</H2>\n";
  $SQLS="SELECT SUM(t_item.PRIX_ACHAT) AS NBRE FROM t_item";
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
    echo "La collection &agrave une valeur estim&eacute;e &agrave; <font color=\"red\">$row->NBRE</font> euros</p>\n";
  }
  echo "<H2>R&eacute;partition des appareils en fonctions de :</H2>\n";
  echo "<p><u>La p&eacute;riode :</u><p>\n";
  $SQLS="SELECT count(t_item.nom_item) AS NBRE, t_periode.NOM_PERIODE FROM t_item inner join t_periode on t_periode.pk_periode=t_item.fk_periode GROUP BY t_periode.nom_periode";
  $query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
  echo "<table border=\"1\"><TR><TD>P&eacute;riode</TD><TD>Nombre</TD></TR>\n";
   while ($row=get_Objet($query,$BaseType))
  {
    echo "<TR><TD>$row->NOM_PERIODE</TD><TD>$row->NBRE</TD></TR>\n";;
  }
  echo "</TABLE>\n";
  echo "<p><u>La marque :</u><p>\n";
  $SQLS="SELECT count(t_item.nom_item) AS NBRE, t_marque.NOM_MARQUE FROM t_item inner join t_marque on t_marque.pk_marque=t_item.fk_marque GROUP BY t_marque.nom_marque";
  $query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
  echo "<table border=\"1\"><TR><TD>Marque</TD><TD>Nombre</TD></TR>\n";
   while ($row=get_Objet($query,$BaseType))
  {
    echo "<TR><TD>$row->NOM_MARQUE</TD><TD>$row->NBRE</TD></TR>\n";;
  }
  echo "</TABLE>\n";
?>
</body>
</html>
