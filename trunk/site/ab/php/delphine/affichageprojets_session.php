<?php Session_start(); ?>

<html><head><title> R&eacute;sultats de la recherche </title></head>
<body>
<img src="Projetidclogo.jpg">

<?php
Echo session_id();
Echo session_name();
require("connect.php");



if ($CONNEXION) {
/*       $
			MaRequeteAnnee="select DISTINCT annee from projet order by annee";
      $MaRequeteTheme="select DISTINCT id_theme from porter_sur order by id_theme";

       $CurseurAnnee=mysql_query($MaRequeteAnnee,$CONNEXION) or die('error: <br/>'.mysql_error());
       //var_dump($CurseurAnnee);
       $CurseurTheme=mysql_query($MaRequeteTheme,$CONNEXION) or die('error: <br/>'.mysql_error());
       //var_dump($CurseurTheme);
	//	$_SESSION['curseurannee']=$CurseurAnnee;
	//	$_SESSION['curseurtheme']=$CurseurTheme;


//       $_SESSION['curseurannee']=mysql_fetch_array($CurseurAnnee);
//       $_SESSION['curseurtheme']=mysql_fetch_array($CurseurTheme);
//	mysql_close($CONNEXION);
*/


//------Affichage des variables (test)------//
var_dump($_SESSION['curseurannee']);
//printf($_SESSION['curseurannee']);
	echo '['.count($_SESSION['curseurannee']).']';


$b = 0 ; 
$requete = " select * from projet ";

	if ($_POST['type'] == "1") 
	{
	$b=1 ;
	$requete .= " where type='Transdisciplinaire 1A' ";
	}		
	if ($_POST['type'] == "2")
	{
	$b=1;
	$requete .= " where type='Transdisciplinaire 2A' ";
	}
	if ($_POST['type'] == "3")
	{
	$b=1;
	$requete .= " where type='Transpromotion' ";
	}



/*
	$requete = " select * from projet " ;
	switch($_POST['type'])
	{
		case '1':
			$requete = $requete." where type=Transdisciplinaire 1A ";
			$b = TRUE;
		break;
		case '2':
			$requete = $requete." where type=Transdisciplinaire 2A ";
			$b = TRUE;
		break;
		case '3':
			$requete = $requete." where type=Transpromotion";
			$b = TRUE;
		break;
		default:
			$b = FALSE;
	}
*/	

	


/*

	$i=1;
	while ($tabannee=mysql_fetch_array($_SESSION['curseurannee']))
// foreach($_SESSION['curseurannee'] as $tabannee)
//	while ($tabannee=$_SESSION['curseurannee'])
	{	
		if ($_POST['annee'] == $i)
		{
			if ($b==1)
				$requete .= " and annee=".$tabannee['annee'];
				else
				$requete .= " where annee=".$tabannee['annee'];
			
		$i=$i+1;
		}
	}

*/

/*

	$i=1;
	while ($tabtheme=mysql_fetch_array($_SESSION['curseurtheme']))
//	while ($tabtheme=$_SESSION['curseurtheme'])
	{	
		if ($_POST['theme'] == $i)
		{
			if ($b==1)
			$requete .= " and theme=".$tabtheme['id_theme'];
			else
			$requete .= " where theme=".$tabtheme['id_theme'];
		$i=$i+1;
		}
	}

	}
*/
	
$MaRequeteProjet=$requete." order by annee;";
$CurseurProjet=mysql_query($MaRequeteProjet,$CONNEXION);
echo $MaRequeteProjet;

?>
</body>
</html>