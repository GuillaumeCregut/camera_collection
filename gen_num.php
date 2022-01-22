<html>

<head>
 <script type="text/javascript">
<!-- JavaScript
  function verif_form()
  {
    A=document.form1.Annee.value;
    B=document.form1.mois.value;
    C=document.form1.TypeA.value;
    D=document.form1.Moyen.value;
    E=document.form1.NumSeq.value;
    Resultat=A+B+C+D+E;
    document.form1.valeur.value=Resultat;
  }
// - JavaScript - -->
  </script>

<title>Sans titre</title>
</head>

<body>
<p>G&eacute;n&eacute;rateur de num&eacute;ro d'inventaire :</p>
 <form name="form1">
<table>
    <tr>
        <td>
            <p>Ann&eacute;e</p>
        </td>
        <td>
            <p>Mois</p>
        </td>
        <td>
            <p>Type</p>
        </td>
        <td>
            <p>Moyen d'obtention</p>
        </td>
        <td>
            <p>Num&eacute;ro de suivi</p>
        </td>
    </tr>
    <tr>
        <td>
                <p><select name="Annee" size="1">
                <option value="09">2009</option>
                <option value="10">2010</option>
                <option value="11">2011</option>
                <option value="12">2012</option>
                <option value="13">2013</option>
                <option value="14">2014</option>
                <option value="15">2015</option>
                </select></p>
        </td>
        <td>
                <p><select name="mois" size="1">
                <option value="01">Janvier</option>
                <option value="02">Fevrier</option>
                <option value="03">Mars</option>
                <option value="04">Avril</option>
                <option value="05">Mai</option>
                <option value="06">Juin</option>
                <option value="07">Juillet</option>
                <option value="08">Aout</option>
                <option value="09">Septembre</option>
                <option value="10">Octobre</option>
                <option value="11">Novembre</option>
                <option value="12">D&eacute;cembre</option>
                </select></p>
        </td>
        <td>
                <p><select name="TypeA" size="1">
                <option value="001">Chambre</option>
                <option value="002">Reflex SLR</option>
                <option value="003">T&eacute;l&eacute;m&eacute;trique</option>
                <option value="004">Box</option>
                <option value="005">Compact</option>
                <option value="006">Reflex TLR</option>
                <option value="007">D&eacute;tective</option>
                <option value="008">Folding</option>
                <option value="009">Gadget</option>
                <option value="010">Cam&eacute;ra</option>
                <option value="011">St&eacute;r&eacute;o</option>
                <option value="012">Jumelles</option>
                </select></p>
        </td>
        <td>
                <p><select name="Moyen" size="1">
                <option value="01">Enchere/Ebay</option>
                <option value="02">Vide grenier / Brocante</option>
                <option value="03">Don / Heristage</option>
                <option value="04">Foire</option>
                <option value="05">Trouv&eacute;</option>
                <option value="06">Achat neuf / occas</option>
                </select></p>
        </td>
        <td>
                <p><input type="text" name="NumSeq" maxlength="4" size="4"></p>
        </td>
    </tr>
</table>
    <p><input type="button" name="Calculer" value="Calculer" onclick="verif_form()"></p>
    <p>R&eacute;sultat : <input type="text" name="valeur"></p>
</form>
</body>

</html>
