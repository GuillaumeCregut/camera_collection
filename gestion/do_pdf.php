<?php
/*
  Version  : 1.2 R3
  Date de création : 21 Mai 2018.
  Date de modification : 21 Mai 2018.
  Validé fonctionnelle : Oui
  Validé W3C : Oui
  Nom : consult/search.php
  Fonction : Affiche la page permettant la création du catalogue.
*/
  require("../include/Smarty.class.php");
  $CheminTpl='../templates/';
  include "../include/config.inc.php";
  $Lemoteur=new Smarty();
  $Lemoteur->assign('VersionNum',$VersionNum);
  $Lemoteur->display($CheminTpl.'genpdf.tpl');
?>