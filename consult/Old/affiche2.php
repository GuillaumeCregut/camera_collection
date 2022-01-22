<?php
/*
  Version  : 1.2 R1
  Date de modification : 20 avril 2018.
  Validé fonctionnelle : Oui
  Validé W3C : Oui
  Nom : affiche.php
  Fonction : Affiche le sous dossier provenant de presentation.php.
*/
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  $Lang=$_GET["Lan"];
  switch ($Lang)
  {
    case "F" : include "../include/LangueFR.inc.php";
               break;
    case "E" : include "../include/LangueEN.inc.php";
               break;
    default :  include "../include/LangueFR.inc.php";
               $Lang="F";
  }
  $TypeRech=$_GET["TypePage"];
  $CleRech=$_GET["Cle"];
  $NomAff=$_GET["LeNom"];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
  <title>Affichage de la collection</title>
  <link rel="stylesheet" type="text/css" media="screen" href="../include/presentation.css">
  </head>
  <body>
<?php
  echo "<h1>$DisplayOf $NomAff</h1>";
  $CleRech=(int)$CleRech;
  $SQLS="SELECT REF_INV AS REFERENCE,NOM_ITEM AS NOM,PHOTOS FROM t_item WHERE ";
  if (isset($TypeRech))
  {
     switch ($TypeRech)
     {
       case 1 : $SQLS2="FK_APP=$CleRech";
                break;
       case 2 : $SQLS2="FK_PERIODE=$CleRech";
                break;
       case 3 : $SQLS2="FK_MARQUE=$CleRech";
                break;
       default : Die('Il y a une erreur de selection');
     }
  }
  $SQLS.=$SQLS2;
//Connexion a la base de données
//Connexion à la base de données
  $OK=FALSE;
  $connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName,$BaseType);
  

//
  echo '<div id="cadre">';
  echo '<div id="innercadre">';
  $MaxCol=4;
  $Compte=0;
  $Nombre=0;
//
  foreach($connecter->query($SQLS) as $row)
  {
  //A mettre au bon endroit
    $LaCle=$row["REFERENCE"];
    $LaPhoto=$row["PHOTOS"];
    $pos = strpos($LaPhoto, ';');
    $LaPhoto=substr($LaPhoto,$pos+1,200);
    //$LaPhoto.="mini.jpg";
    $BasePhoto="../photos/";
    $CheminPhoto=$BasePhoto.$LaPhoto;
    //On essai de voir si le fichier mini existe
    if (!file_exists($CheminPhoto."mini.jpg"))
    {
      //Sinon on la crée.
      if (file_exists($CheminPhoto."1.jpg"))
      {
        $ImageMini=imagecreatefromjpeg($CheminPhoto."1.jpg");
        $size=getimagesize($CheminPhoto."1.jpg");
        $Larg=$size[0];
        $Long=$size[1];
        $Larg=$Larg*20/100;
        $Long=$Long*20/100;
        $imgdest = imagecreatetruecolor($Larg,$Long);
        $copy=imagecopyresampled($imgdest,$ImageMini,0,0,0,0,$Larg,$Long,$size[0],$size[1]);
        imagejpeg($imgdest,$CheminPhoto."mini.jpg");
        imagedestroy($imgdest);
        imagedestroy($ImageMini);
      }
      else
      {
        $CheminPhoto="../include/images/noimg-"; 
      }
    }
    $CheminPhoto.="mini.jpg";
    $Lien="voir.php?CleAff=$LaCle&amp;TypePage=10&amp;Lan=$Lang";
    if ($Compte==0)
    {
      echo "<div class=\"enligne\">\n";
    }
    $Compte++;
    echo "<div class=\"case\"><a href=\"$Lien\" target=\"_blank\"><img src=\"$CheminPhoto\" alt=\"photo de l'appareil\"></a><br>\n";
    echo "<a href=\"$Lien\" target=\"_blank\">".$row["NOM"]."</a></div>\n";
    if ($Compte==$MaxCol)
    {
      echo "</div>\n";
      $Compte=0;
    }
    $Nombre++;
  }
  //
  if (($Compte!=0) AND ($Compte!=$MaxCol))
  {
     echo '</div>';
  }
  if ($Nombre==0)
  {
    echo "<div class=\"enligne\">$AucunRes</div>\n";
  }
//Fin traitement
  echo "</div>\n";
  echo "</div>\n";
  //
  echo '<p><a href="presentation.php?Lan='.$Lang.'&amp;Tri='.$TypeRech.'">'.$Retour.'</a></p>';
  include ("../include/footer.php");
?>

