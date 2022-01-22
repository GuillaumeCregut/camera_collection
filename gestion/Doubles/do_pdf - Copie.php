<?php
  include_once ('../include/template.inc.php');
  $Lemoteur=new template('../templates/');
  $Lemoteur->set_file('index','genpdf.tpl');
  $Lemoteur->pparse('resultat','index');