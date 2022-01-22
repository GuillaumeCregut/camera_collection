<?php
/*
  Version  : 1.2 R3
  Date de modification : 21 Mai 2018.
  Validé fonctionnelle : oui
  Validé W3C : Oui
  Nom : stats3.php
  Fonction : Fonction affichage es stats.
*/
  include_once ("graph/jpgraph.php");
  include_once ("graph/jpgraph_pie.php");
  include_once ("graph/jpgraph_pie3d.php");
  include_once ("graph/jpgraph_bar.php");
  if(!defined('MATERIEL'))
  {
	define ("MATERIEL", 0);
  }
  if(!defined('APPAREIL'))
  {
	define ("APPAREIL", 1);
  }
  if(!defined('FORMAT'))
  {
	define ("FORMAT", 2);
  }
  if(!defined('MONTURE'))
  {
	define ("MONTURE", 3);
  }
  if(!defined('OBTU'))
  {
	define ("OBTU", 4);
  }
  if(!defined('MARQUE'))
  {
	define ("MARQUE", 5);
  }
  if(!defined('FILM'))
  {
	define ("FILM", 6);
  }
  if(!defined('PERIODE'))
  {
	define ("PERIODE", 7);
  }
  function Dessine_Camembert($TypeGraph,$Donnees)
  {
    //Creation des tableaux de valeurs
    $Valeurs=array();
    $Legendes=array();
    $i=0;
    foreach ($Donnees as $Key)
    {
      $infos = explode(";", $Key);
      $Valeurs[$i]=$infos[1];
      $Legendes[$i]=$infos[0].' - '.$infos[1];
     // echo "<p>'$Legendes[$i]'=>'$Valeurs[$i]'</p>\n";
      $i++;
    }
    switch ($TypeGraph)
    {
      case MATERIEL : $Chemin="../exports/images/materiel.jpg";
                      $Titre="par materiel / by hardware";
                      break;
      case APPAREIL : $Chemin="../exports/images/appareil.jpg";
                      $Titre="par appareil / by camera";
                      break;
      case FORMAT   : $Chemin="../exports/images/format.jpg";
                      $Titre="par format / by format";
                      break;
      case MONTURE  : $Chemin="../exports/images/monture.jpg";
                      $Titre="par monture / by lens";
                      break;
      case OBTU     : $Chemin="../exports/images/obtu.jpg";
                      $Titre="par obturateur / by shutter";
                      break;
      case MARQUE   : $Chemin="../exports/images/marque.jpg";
                      $Titre="par marque / by brand";
                      break;
      case FILM     : $Chemin="../exports/images/film.jpg";
                      $Titre="par film / By film";
                      break;
    }
//Utilisation du cache : Si l'image est déjà en mémoire et a moins d'une journée
    /*if (file_exists($Chemin))
    {    
		@unlink($Chemin);
    }*/
//For begug mode, don't create file if exist
    //if (!file_exists($Chemin))
    //{
    //Creation du graphique
      $graph = new PieGraph(800,600,"auto");
      $graph-> img-> SetImgFormat( "jpeg");
      $graph->SetScale('textlin');
      $graph->SetShadow();
      $graph->title->Set($Titre);
      $graph->title->SetFont(FF_VERDANA,FS_BOLD,16);
      $graph->title->SetColor("darkblue");
      $graph->legend->SetAbsPos(10,25, 'left', 'top');
    //Creation du camembert
      $p1 = new PiePlot3d($Valeurs);
      $p1->SetTheme("pastel");
      $p1->SetCenter(0.5,0.7);
      $p1->SetAngle(30);
      $p1->SetSize(0.4);
      $p1->value->SetFont(FF_ARIAL,FS_NORMAL,10);
      $p1->SetLegends($Legendes);
      $graph->Add($p1);
    //Enregiste le graphique
      $graph->Stroke($Chemin);
   // }
    //Retourne le chemin du graphique.
    return $Chemin;
  }
  function Dessine_Barre($TypeGraph,$Donnees)
  {
   // echo "<pre>";
  //  print_r($Donnees);
	$Valeurs=array();
    $Legendes=array();
    $i=0;
    foreach ($Donnees as $Key)
    {
       $infos = explode(";", $Key);
	  // print($infos[0]);
       $Valeurs[$i]=$infos[1];
       $Legendes[$i]=$infos[0];
       $i++;
    }
  // echo "<pre>";
  //  print_r($Valeurs);
    $Chemin="../exports/images/periode.jpg";
    //Utilisation du cache : Si l'image est déjà en mémoire et a moins d'une journée
    if (file_exists($Chemin))
    {
       $ModifTime=filemtime($Chemin);
       $Unjour=$ModifTime+(60*60*24); //Date de création + 1 jour
       $Maintenant=time();
       if ($Unjour>$Maintenant)
       {
         return $Chemin;
         exit;
       }
     }
    $graph = new Graph(800,400,"auto");
    $graph->img->SetMargin(30,10,20,80);
    $graph->SetScale("textlin");
    $graph->SetMarginColor("lightblue");
    $graph->SetShadow();
    $graph->title->Set("par période / by period");
    $graph->title->SetFont(FF_VERDANA,FS_NORMAL,12);
    $graph->title->SetColor("darkred");
    // Setup font for axis
    $graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,10);
    $graph->yaxis->SetFont(FF_VERDANA,FS_NORMAL,10);
    // Show 0 label on Y-axis (default is not to show)
    $graph->yscale->ticks->SupressZeroLabel(false);
	//$graph->yaxis->SetTickPositions(array(0,30,60,90,120,150), array(15,45,75,105,135));   ///
    // Setup X-axis labels
    $graph->xaxis->SetTickLabels($Legendes);
    $graph->xaxis->SetLabelAngle(50);
    // Create the bar pot
//Ici ?	
    $bplot = new BarPlot($Valeurs);
    $bplot->SetWidth(0.4);
    // Setup color for gradient fill style
    $bplot->SetFillGradient("navy","#EEEEEE",GRAD_LEFT_REFLECTION);
    // Set color for the frame of each bar
    $bplot->SetColor("white");
    $graph->Add($bplot);
    $graph->Stroke($Chemin);
    return $Chemin;
  }
?>