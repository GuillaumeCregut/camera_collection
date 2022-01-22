<hr>
<?php
/*
  Version  : 1.2 R1
  Date de modification : 20 avril 2018.
*/
  include "config.inc.php";
  echo "<p>Gestion collection mat&eacute;riel photographique version :$VersionNum</p>\n";
  echo "<p>Copyright &copy; 2018 Editiel 98, Guillaume Cregut</p>\n";
  switch($BaseType)
  {
    case 0 : $BaseUtilisee="MySQL";
             break;
    case 1 : $BaseUtilisee="Interbase/Firebird";
             break;
  }
  echo "<p>Moteur utilis&eacute; : $BaseUtilisee.</p>\n";
  echo '<p>';
    echo '<a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-html401-blue"  alt="Valid HTML 4.01 Transitional" height="31" width="88"></a>';
  echo "</p>";
?>
</body>
</html>