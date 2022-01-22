<?
 /*
  Version  : 1.1 R1
  Date de modification : 19 décembre 2008.
  Validé fonctionnelle : Oui
  Validé W3C : oui
  Nom : result_search.php
  Fonction : affiche les resultats par rapport a search_name.
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
<title>Recherche/Search</title>
<link rel="stylesheet" type="text/css" href="../include/search.css">
</head>
<body>
<?php
  $Langue=$_POST["Lan"];
  $LaPage=$_POST["NumPage"];
  $LeNomRech=$_POST["nom_rech"];
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  switch ($Langue)
  {
    case "F" : include "../include/LangueFR.inc.php";
               break;
    case "E" : include "../include/LangueEN.inc.php";
               break;
  }
  switch ($LaPage)
  {
    case 1 :  $TitreRech=$Pays;
              break;
    case 2 :  $TitreRech=$TypeSupp;
              break;
    case 3 :  $TitreRech=$Perio;
              break;
    case 4 :  $TitreRech=$Forma;
              break;
    case 5 :  $TitreRech=$TypeMat;
              break;
    case 6 :  $TitreRech=$Obtu;
              break;
    case 7 :  $TitreRech=$Montu;
              break;
    case 8 :  $TitreRech=$TypeApp;
              break;
    case 9 :  $TitreRech=$Mark;
              break;
    case 10 : $TitreRech=$Appar;
              break;
  }
  echo "<h1>$ResultRech_Gen $TitreRech</h1>\n";
  if ($LeNomRech<>"")
  {
      $LeNomRech=strtoupper($LeNomRech);
      switch ($LaPage)
      {
        case 1 :  $SQLS="SELECT  PK_PAYS AS PK_GEN, NOM_PAYS AS NOM_GEN FROM t_pays WHERE UPPER(NOM_PAYS) LIKE '%$LeNomRech%' ORDER BY NOM_PAYS";; //PAYS
                  break;
        case 2 :  $SQLS="SELECT  PK_FILM AS PK_GEN, NOM_FILM AS NOM_GEN FROM t_film WHERE UPPER(NOM_FILM) LIKE '%$LeNomRech%' ORDER BY NOM_FILM";//FILM
                  break;
        case 3 :  $SQLS="SELECT  PK_PERIODE AS PK_GEN, NOM_PERIODE AS NOM_GEN FROM t_periode WHERE UPPER(NOM_PERIODE) LIKE '%$LeNomRech%' ORDER BY NOM_PERIODE"; //PERIODE
                  break;
        case 4 :  $SQLS="SELECT  PK_FORMAT AS PK_GEN, NOM_FORMAT AS NOM_GEN FROM t_format WHERE UPPER(NOM_FORMAT) LIKE '%$LeNomRech%' ORDER BY NOM_FORMAT";//FORMAT
                  break;
        case 5 :  $SQLS="SELECT  PK_TMAT AS PK_GEN, NOM_MAT AS NOM_GEN FROM t_materiel WHERE UPPER(NOM_MAT) LIKE '%$LeNomRech%' ORDER BY NOM_MAT"; //TYPE MAT
                  break;
        case 6 :  $SQLS="SELECT  PK_OBTU AS PK_GEN, NOM_OBTU AS NOM_GEN FROM t_obturateur WHERE UPPER(NOM_OBTU) LIKE '%$LeNomRech%' ORDER BY NOM_OBTU"; //Obturateur
                  break;
        case 7 :  $SQLS="SELECT  PK_MONTURE AS PK_GEN, NOM_MONTURE AS NOM_GEN FROM t_monture WHERE UPPER(NOM_MONTURE) LIKE '%$LeNomRech%' ORDER BY NOM_MONTURE";  //Monture
                  break;
        case 8 :  $SQLS="SELECT  PK_APPAREIL AS PK_GEN, NOM_TAPP AS NOM_GEN FROM t_appareil WHERE UPPER(NOM_APPAREIL) LIKE '%$LeNomRech%' ORDER BY NOM_APPAREIL"; //Appareil
                  break;
        case 9 :  $SQLS="SELECT  PK_MARQUE AS PK_GEN, NOM_MARQUE AS NOM_GEN FROM t_marque WHERE UPPER(NOM_MARQUE) LIKE '%$LeNomRech%' ORDER BY NOM_MARQUE";  //Marque
                  break;
        case 10 : $SQLS="SELECT  REF_INV AS PK_GEN, NOM_ITEM AS NOM_GEN FROM t_item WHERE UPPER(NOM_ITEM) LIKE '%$LeNomRech%' ORDER BY NOM_ITEM";   //Item
                  break;
      }
    //echo "<p>SQLS : $SQLS</p>\n";
    $connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName,$BaseType);
    if ($BaseType==0)
    {
      $dbconn=connect_base($DBName,$connecter);
    }
    $query=requete_base($SQLS,$connecter,$BaseType);
    while ($row=get_Objet($query,$BaseType))
    {
      $LeNomAfficher=$row->NOM_GEN;
      $LaCleAfficher=$row->PK_GEN;
      if ($LeNomAfficher=="")
      {
        $VraimentAfficher="&nbsp;";
      }
      else
      {
        $VraimentAfficher="<a href=\"voir.php?CleAff=$LaCleAfficher&amp;TypePage=$LaPage&amp;Lan=$Langue\" target=\"_blank\">$LeNomAfficher</a>";
      }
      echo "<p>- $VraimentAfficher</p>\n";
  }
  }
  else
    echo "<p>Aucun nom</p>";

//
  echo "<p><a href=\"search_name.php?Language=$Langue&amp;NumPage=$LaPage\">$Retour</a></p>";
  echo "<p><a href=\"$CheminIndex\">$LIndex</a></p>";
  include "../include/footer.php";
?>