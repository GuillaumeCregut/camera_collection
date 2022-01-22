<?php
/*
  Version  : 1.2 R2
  Date de modification : 01 Mai 2018.
*/
function connect_serveur($user,$pass, $host,$base)
{
    try
	{
		$titi= new PDO('mysql:host='.$host.';dbname='.$base.';charset=UTF8',$user,$pass,array( PDO::ATTR_PERSISTENT => true,PDO::MYSQL_ATTR_FOUND_ROWS=>TRUE));
		return $titi;
		
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
		return false;
	}
}
function requete_base($LaRequete,$LaConnection,$BaseType)
{
  switch($BaseType)
  {
   
    case 1 : {
                $toto=ibase_query($LaConnection,$LaRequete);
				return $toto;
                break;
             }
  }
  
}
function get_Objet($LaRequete,$BaseType)
{
  switch($BaseType)
  {
    
    case 1 : {
                $toto=ibase_fetch_Object($LaRequete);
                return $toto;
				break;
             }
  }
  
}
function DetruitFichier($NomFichier)
{
 $Done=@unlink($NomFichier);
 return $Done;
}
function CreeFichier($NomFichier, $Contenu)
{
  $Fichier=@fopen($NomFichier,"w");
  if ($Fichier)
  {
     $LeContenu=stripslashes($Contenu);
     fputs($Fichier,$LeContenu);
     fclose($Fichier);
  }
}
?>