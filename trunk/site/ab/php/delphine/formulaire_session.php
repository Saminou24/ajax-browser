<?php Session_start(); ?>
<html>
<head><title>Recherche</title></head>
<body>



<?php
Echo session_id();
require("connect.php");

if ($CONNEXION) 
{
	$MaRequeteAnnee="select DISTINCT annee from projet order by annee";
	$MaRequeteTheme="select DISTINCT id_theme from porter_sur order by id_theme";


	$CurseurAnnee=mysql_query($MaRequeteAnnee,$CONNEXION) or die('error: <br/>'.mysql_error());
	//var_dump($CurseurAnnee);
	$CurseurTheme=mysql_query($MaRequeteTheme,$CONNEXION) or die('error: <br/>'.mysql_error());
	//var_dump($CurseurTheme);
//	$_SESSION['curseurannee']=$CurseurAnnee;
//	$_SESSION['curseurtheme']=$CurseurTheme;


//       $_SESSION['curseurannee']=mysql_fetch_array($CurseurAnnee);
//       $_SESSION['curseurtheme']=mysql_fetch_array($CurseurTheme);

var_dump($_SESSION['curseurannee']);
//mysql_close($CONNEXION);
}
?>

  <form method="post" action="affichageprojets.php">
  <h1>Crit&egrave;res de recherche</h1>
	<p><class = question>Type de projet :</class></p>
   <select name="type" >
    <option selected value=-1>-- Indiff&eacute;rent --
		<option value=1>Transdisciplinaire 1&egrave;re ann&eacute;e;
		<option value=2>Transdisciplinaire 2&egrave;me ann&eacute;e;
		<option value=3>Transpromotion;
   </select>
	
	<p><class = question>En quelle ann&eacute;e ?</class></p>
	<select name="annee universitaire" >
    <option selected value=-1>-- Indiff&eacute;rent --


<?php
var_dump($CurseurAnnee);
  $i=1;
	while ($tabannee=mysql_fetch_array($CurseurAnnee))
	{
//		$_SESSION['curseurannee'][] = $tabannee;
//	echo "++++";
		echo '<option value='.$i.'>'.$tabannee['annee'].'</option>';
		$i=$i+1;
	}


?>


  </select>
	<p><class = question>Sur quel th&egrave;me ?</class></p>
	<select name="theme" >
  	<option selected value=-1>-- Indiff&eacute;rent --
<?php

//	var_dump($_SESSION['curseurannee']);
	$i=0;
	while ($tabtheme=mysql_fetch_array($CurseurTheme))
  {
//		$_SESSION['curseurtheme'][] = $tabtheme;
//		echo "++++";
		echo '<option value='.$i.'>'.$tabtheme['id_theme'].'</option>';
		$i=$i+1;
	}	
?>

   </select> 
	
	<p><class = question>En collaboration avec :</class></p>
	<INPUT TYPE="checkbox" NAME="entreprise">Entreprises</INPUT['annee']>
	<INPUT TYPE="checkbox" NAME="laboratoire">Laboratoires</INPUT> 
	
	<p><class = question>Suivi par le tuteur :</class><br></p>
  <input type="text" name="tuteur" size="50">
	
	<p><class = question>Men&eacute; par l'&eacute;tudiant :</class><br></p>
  <input type="text" name="etudiant" size="50">

	<p><input type="submit" name="Submit" value="Envoyer"></p>
	</form>

</body>
</html>