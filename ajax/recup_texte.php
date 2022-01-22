<?php
 /*
  Version  : 1.2 R2
  Date de modification : 15 mai 2018.
  Validé fonctionnelle : oui
  Validé W3C : non
  Nom : dodouble.php
  Fonction : renvoi le contenu du fichier donner dans chemin.
*/
if (isset($_POST["chemin"]))
{
$Contenu=$_POST["chemin"];
$Rien="Rien à voir";
$fd = @fopen ($Contenu, "r");
     $buffer="";
     if ($fd)
     {
        while (!feof($fd))
        {
          $buffer = $buffer.fgets($fd, 4096);
        }
        fclose ($fd);
     }
     else
     {
        $buffer=$Rien;
     }
    // $buffer=nl2br($buffer);
}
else
{
	$buffer="Rien à voir";
}
	 $buffer=utf8_encode($buffer);
	 echo $buffer;
?>