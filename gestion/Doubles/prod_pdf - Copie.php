<?php
  require('../include/lepdf.inc.php');
  include "../include/LangueFR.inc.php";
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  include "../include/typepage10.php";
//Initialisation de la récupération
  $Langue='F';
  //Connexion à la base de données
  $connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName,$BaseType);
  $SQLS=substr($RequeteAffiche,0,-18);
  if (isset($_POST['Choix_Tri']))
  {
    $LeChoix=$_POST['Choix_Tri'];
    switch ($LeChoix)
    {
       case 0 : $SQLS_Tri="ORDER BY TMa.NOM_MARQUE ASC";
                break;
       case 1 : $SQLS_Tri="ORDER BY TP.PK_PERIODE";
                break;
       case 2 : $SQLS_Tri="ORDER BY TI.NOM_ITEM ASC";
                break;
       case 3 : $SQLS_Tri="ORDER BY TA.PK_APPAREIL";
                break;
       case 4 : $SQLS_Tri="ORDER BY TI.REF_INV";
                break;
       default : $SQLS_Tri="ORDER BY TMa.NOM_MARQUE ASC";
                break;
    }
  }
  $SQLS.=$SQLS_Tri;
  $pdf=new PDF();
  $pdf->AliasNBPages();
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',22);/********************************************************/
  $query=requete_base($SQLS,$connecter,$BaseType);
  foreach($connecter->query($SQLS) as $row)
  {
    $fd =@fopen ($EnteteRep.$NomRepItem.$row["HIST_ITEM"].".txt", "r");
    $LeTexte_Info="";
    if ($fd)
    {
      while (!feof($fd))
      {
        $LeTexte_Info = $LeTexte_Info.fgets($fd, 4096)."<br>";
      }
      fclose ($fd);
    }
    else
    {
      $LeTexte_Info="";
    }
    $LeTexte_Info=str_ireplace('<br>',"\n",$LeTexte_Info);
    //$LeTexte_Perso
    $fd = @fopen ($EnteteRep.$NomRepItem.$row["NOTES_PERSO"].".txt", "r");
    $LeTexte_Perso="";
    if ($fd)
    {
      while (!feof($fd))
      {
        $LeTexte_Perso = $LeTexte_Perso.fgets($fd, 4096)."<br>";
      }
      fclose ($fd);
    }
    else
    {
      $LeTexte_Perso="";
    }
    $LeTexte_Perso=str_ireplace('<br>',"\n",$LeTexte_Perso);
  //Traitement de l'état
    $Etat='';
    switch($row["ETAT"])
    {
      case 1 :  $Etat='Neuf';
                break;
      case 2 :  $Etat='Bon';
                break;
      case 3 :  $Etat="Necessite une révision";
                break;
      case 4 :  $Etat='A restaurer';
                break;
      case 5 :  $Etat='Epave';
                break;
     }
     $LaMarque=$row["NOM_MARQUE"];
     //Traitement des photos.
     $MesPhotos=$row["PHOTOS"];
     $ArrayPhoto=explode(';',$MesPhotos);
     $Nombrephoto=(int) $ArrayPhoto[0];
     $CheminBase= "../photos/".$ArrayPhoto[1];
  //Repartition des données
    $LeNom=utf8_decode($row["NOM_ITEM"]);
    $LeTypeMat=utf8_decode($row["NOM_MAT"]);
    $LeObj=utf8_decode($row["NOM_MONTURE"]);
    $LeObtu=utf8_decode($row["NOM_OBTU"]);
    $Surf=utf8_decode($row["NOM_FILM"]);
    $LeApp=utf8_decode($row["NOM_TAPP"]);
    $LeForm=utf8_decode($row["NOM_FORMAT"]);
    $LePrix=utf8_decode($row["PRIX_ACHAT"]);
    $LaPer=utf8_decode($row["NOM_PERIODE"]);
    $LAnnCons=substr($row["ANNEE_PROD"],0,4);
    $RefInv=$row["REF_INV"];
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',22);
    $pdf->SetTextColor(220,50,50);
    $pdf->Cell(0,5,$LaMarque.' '.$LeNom,0,1,'C');  //Titre
    $Limage=$CheminBase.'1.jpg';
    if (file_exists($Limage))
    {
      $pdf->Image($Limage,70,20,0,50);
      //Saut de ligne
      $pdf->Ln(10);
    }
    $pdf->setY(80);
    $pdf->SetFont('Arial','B',14);
    $DeuxiemeLigne=0;
//Début de ligne double
  //Type et année de production
    $pdf->AddLigne('Type de matériel : ','Année de production : ',$LeTypeMat,$LAnnCons);
 //Marque et  période
    $pdf->AddLigne('Marque : ','Période : ',$LaMarque,$LaPer);
  //Type app et  format
    $pdf->AddLigne('Type d\'appareil : ','Format : ',$LeApp,$LeForm);
  //Type objectif et  obturateur
    $pdf->AddLigne('Monture - Objectif : ','Obturateur : ',$LeObj,$LeObtu);
 //Surface sensible et Ref Inventaire
    $pdf->AddLigne('Type de pellicule : ','Ref. Inv. : ',$Surf,$RefInv);
 //Prix et Etat
    $pdf->AddLigne('Prix d\'achat : ','Etat. : ',$LePrix.' euros',$Etat);
 //Infos appareil
    $pdf->ln(10);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(100,10,'Informations sur l\'appareil',0,0,'C');
    $pdf->Cell(100,10,'Notes personnelles',0,1,'C');
    $HautCadre=$pdf->getY();
    $pdf->SetFillColor(200);
    $pdf->SetFont('Arial','B',8);
    $pdf->multicell(90,3,"\n".$LeTexte_Info,0,'J',1);
    $pdf->setXY(105,$HautCadre);
    $pdf->multicell(100,3,"\n".$LeTexte_Perso,0,'J',1);
  }
  $pdf->Output('doc.pdf','I');
?>