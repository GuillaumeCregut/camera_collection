<?php
/*
  Version  : 1.2 R3
  Date de modification : 21 Mai 2018.
  Valid� fonctionnelle : Oui
  Valid� W3C : Oui
  Nom : search_app.php
  Fonction : affiche les les resultats de le recherche par critere
*/

//Importation des infos
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  require("../include/Smarty.class.php");
  $Langue=$Langue_Sys;;
  if (isset($_POST["chRef"]))
  {
  $CBRef=$_POST["chRef"];
   }
  else
  {
	  $CBRef='';
  }
  if (isset($_POST["CodeInv"]))
  {
  $ERef=$_POST["CodeInv"];
   }
  else
  {
	  $ERef='';
  }
  if (isset($_POST["chMat"]))
  {
  $CBMat=$_POST["chMat"];
   }
  else
  {
	  $CBMat='';
  }
  if (isset($_POST["SorteMat"]))
  {
  $EMat=$_POST["SorteMat"];
   }
  else
  {
	  $EMat='';
  }
  if (isset($_POST["chNom"]))
  {
  $CBNom=$_POST["chNom"];
   }
  else
  {
	  $CBNom='';
  }
  if (isset($_POST["NomMat"]))
  {
  $ENom=$_POST["NomMat"];
   }
  else
  {
	  $ENom='';
  }
  if (isset($_POST["chMark"]))
  {
  $CBMark=$_POST["chMark"];
   }
  else
  {
	  $CBMark='';
  }
  if (isset($_POST["NumMarque"]))
  {
  $EMark=$_POST["NumMarque"];
   }
  else
  {
	  $EMark='';
  }
  if (isset($_POST["chType"]))
  {
  $CBType=$_POST["chType"];
   }
  else
  {
	  $CBType='';
  }
  if (isset($_POST["NumCate"]))
  {
  $EType=$_POST["NumCate"];
   }
  else
  {
	  $EType='';
  }
  if (isset($_POST["chForm"]))
  {
  $CBForm=$_POST["chForm"];
   }
  else
  {
	  $CBForm='';
  }
  if (isset($_POST["NumFormat"]))
  {
  $EForm=$_POST["NumFormat"];
   }
  else
  {
	  $EForm='';
  }
  if (isset($_POST["chFilm"]))
  {
  $CBFilm=$_POST["chFilm"];
   }
  else
  {
	  $CBFilm='';
  }
  if (isset($_POST["NumSupp"]))
  {
  $EFilm=$_POST["NumSupp"];
   }
  else
  {
	  $EFilm='';
  }
  if (isset($_POST["chPer"]))
  {
  $CBPeriode=$_POST["chPer"];
   }
  else
  {
	  $CBPeriode='';
  }
  if (isset($_POST["NumPeriode"]))
  {
  $EPeriode=$_POST["NumPeriode"];
   }
  else
  {
	  $EPeriode='';
  }
  if (isset($_POST["chObt"]))
  {
  $CBObt=$_POST["chObt"];
   }
  else
  {
	  $CBObt='';
  }
  if (isset($_POST["NumShutter"]))
  {
  $EObt=$_POST["NumShutter"];
   }
  else
  {
	  $EObt='';
  }
  if (isset($_POST["chMon"]))
  {
  $CBMont=$_POST["chMon"];
   }
  else
  {
	  $CBMont='';
  }
  if (isset($_POST["NumLens"]))
  {
  $EMont=$_POST["NumLens"];
   }
  else
  {
	  $EMont='';
  }
  if (isset($_POST["chStat"]))
  {
  $CBEtat=$_POST["chStat"];
   }
  else
  {
	  $CBEtat='';
  }
  if (isset($_POST["EtatCam"]))
  {
  $EEtat=$_POST["EtatCam"];
   }
  else
  {
	  $EEtat='';
  }
  switch ($Langue)
  {
    case "F" : include "../include/LangueFR.inc.php";
               break;
    case "E" : include "../include/LangueEN.inc.php";
               break;
  }
//Debug
 /* echo "<p>CBRef=$CBRef</p>";
  echo "<p>ERef=$ERef</p>";
  echo "<p>CBMat=$CBMat</p>";
  echo "<p>EMat=$EMat</p>";
  echo "<p>CBNom=$CBNom</p>";
  echo "<p>ENom=$ENom</p>";
  echo "<p>CBMark=$CBMark--</p>";
  echo "<p>EMark=$EMark--</p>";
  echo "<p>CBType=$CBType--</p>";
  echo "<p>EType=$EType--</p>";
  echo "<p>CBForm=$CBForm--</p>";
  echo "<p>EForm=$EForm--</p>";
  echo "<p>CBFilm=$CBFilm--</p>";
  echo "<p>EFilm=$EFilm--</p>";
  echo "<p>CBPer=$CBPeriode--</p>";
  echo "<p>EPer=$EPeriode--</p>";
  echo "<p>CBObt=$CBObt--</p>";
  echo "<p>EObt=$EObt--</p>";
  echo "<p>CBMo=$CBMont</p>";
  echo "<p>EMo=$EMont</p>";
  echo "<p>CBEtat=$CBEtat</p>";
  echo "<p>EEtat=$EEtat</p>";   */
//Fin debug
  $SQLS1="SELECT NOM_ITEM, REF_INV, PHOTOS FROM t_item WHERE ";
  $First=True;
  if ($CBRef==2)
  {
    $SQLS1=$SQLS1."REF_INV='$ERef'";
    $First=False;
  }
  if ($CBMat==2)
  {
    if ($First)
    {
      $SQLS1=$SQLS1."FK_MAT=$EMat";
    }
    else
    {
       $SQLS1=$SQLS1." AND FK_MAT=$EMat";
    }
    $First=False;
  }  //FAIT
  if ($CBNom==2)
  {
    if ($First)
    {
      $SQLS1=$SQLS1."NOM_ITEM='$ENom'";
    }
    else
    {
       $SQLS1=$SQLS1." AND NOM_ITEM='$ENom'";
    }
    $First=False;
  } //FAIT
  if ($CBMark==2)
  {
    if ($First)
    {
      $SQLS1=$SQLS1."FK_MARQUE=$EMark";
    }
    else
    {
       $SQLS1=$SQLS1." AND FK_MARQUE=$EMark";
    }
    $First=False;
  }//Fait
  if ($CBType==2)
  {
    if ($First)
    {
      $SQLS1=$SQLS1."FK_APP=$EType";
    }
    else
    {
       $SQLS1=$SQLS1." AND FK_APP=$EType";
    }
    $First=False;
  }//Fait
  if ($CBForm==2)
  {
    if ($First)
    {
      $SQLS1=$SQLS1."FK_FORMAT=$EForm";
    }
    else
    {
       $SQLS1=$SQLS1." AND FK_FORMAT=$EForm";
    }
    $First=False;
  }//Fait
  if ($CBFilm==2)
  {
    if ($First)
    {
      $SQLS1=$SQLS1."FK_FILM=$EFilm";
    }
    else
    {
       $SQLS1=$SQLS1." AND FK_FILM=$EFilm";
    }
    $First=False;
  }//Fait
  if ($CBPeriode==2)
  {
    if ($First)
    {
      $SQLS1=$SQLS1."FK_PERIODE=$EPeriode";
    }
    else
    {
       $SQLS1=$SQLS1." AND FK_PERIODE=$EPeriode";
    }
    $First=False;
  } //FAIT
  if ($CBObt==2)
  {
    if ($First)
    {
      $SQLS1=$SQLS1."FK_OBTU=$EObt";
    }
    else
    {
       $SQLS1=$SQLS1." AND FK_OBTU=$EObt";
    }
    $First=False;
  }//FAIT
  if ($CBMont==2)
  {
    if ($First)
    {
      $SQLS1=$SQLS1."FK_MONTURE=$EMont";
    }
    else
    {
       $SQLS1=$SQLS1." AND FK_MONTURE=$EMont";
    }
    $First=False;
  }//FAIT
  if ($CBEtat==2)
  {
    if ($First)
    {
      $SQLS1=$SQLS1."ETAT=$EEtat";
    }
    else
    {
       $SQLS1=$SQLS1." AND ETAT=$EEtat";
    }
    $First=False;
  }
  //Debug
  //echo "<p>$SQLS1</p>\n";
  //Fin debug
 //Connexion � la base de donn�es
  $connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName);
//Execution de la requete
  if (!$connecter)
  {
    //Redirection vers page d'erreur******************************************************************************
	$template->assign('Erreur_Base',$Erreur_db_Connexion);
	$template->assign('CheminIndex',$CheminIndex);
	$template->assign('VersionNum',$VersionNum);
	$template->assign('LIndex',$LIndex);
	$template->display($CheminTpl.'erreur_base.tpl');	
	exit();	
	//fin redirection*********************************************************************************************
  }
  $template=new Smarty(); 
  $CheminTpl='../templates/';
  $template->assign('ResultRechApp',$ResultRechApp);
  if (!$First)
  {
    $sth=$connecter->prepare($SQLS1);
	$sth->execute();
	$tabresult= $sth->fetchAll();
	$i=0;
	foreach($tabresult as $row)
	{
		$TabItem[$i]['REF_INV']=$row['REF_INV'];
		$TabItem[$i]['NOM_ITEM']=$row['NOM_ITEM'];
		$LaPhoto=$row["PHOTOS"];
		$pos = strpos($LaPhoto, ';');
		$BasePhoto="../photos/";
		$LaPhoto=substr($LaPhoto,$pos+1,200);
		$CheminPhoto=$BasePhoto.$LaPhoto;
		if (!file_exists($CheminPhoto."mini.jpg"))
		{
			$CheminPhoto="../images/noimg-";
		}
		$TabItem[$i]['PHOTOS']=$CheminPhoto;
		$i++;
	}
	if (isset($TabItem))
		$template->assign('liste_app',$TabItem);
  }
  else
  {
    $template->assign('NoChoiceMade',$NoChoiceMade);
  }
  $template->assign('Retour',$Retour);
  $template->assign("VersionNum",$VersionNum);
  $template->display($CheminTpl.'search_app.tpl');
?>