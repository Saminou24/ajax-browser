<?php
require("connect.php");



if ($CONNEXION) 
{
			$MaRequeteAnnee="select DISTINCT annee from projet order by annee";
      $MaRequeteTheme="select DISTINCT id_theme from porter_sur order by id_theme";
      $CurseurAnnee=mysql_query($MaRequeteAnnee,$CONNEXION) or die('error: <br/>'.mysql_error());
      $CurseurTheme=mysql_query($MaRequeteTheme,$CONNEXION) or die('error: <br/>'.mysql_error());


		$MaRequeteEncadrant = 'SELECT DISTINCT id_encadrant FROM encadrant ORDER BY nom_encadrant, pren_encadrant';
		$CurseurEncadrant = mysql_query($MaRequeteEncadrant, $CONNEXION) or die('error: <br/>'.mysql_error());
		$MaRequeteTuteur = 'SELECT DISTINCT id_tuteur FROM tuteur ORDER BY nom_tuteur, pren_tuteur';
		$CurseurTuteur = mysql_query($MaRequeteTuteur, $CONNEXION) or die('error: <br/>'.mysql_error());
		$MaRequeteEtudiant = 'SELECT DISTINCT no_etud FROM etudiant  ORDER BY nom_etud, pren_etud';
		$CurseurEtudiant = mysql_query($MaRequeteEtudiant, $CONNEXION) or die('error: <br/>'.mysql_error());



 /*--------------------------------------------------------------------------------------------------*/
 /*------------RECHERCHE DES PROJETS SELECTIONNES A PARTIR DES DONNES DU FORMULAIRE------------------*/
 /*--------------------------------------------------------------------------------------------------*/
$b = 0 ; /*initialisation de la variable indiquant si l'on a déjà posé une condition ou non*/


/*debut de la construction de la requete principale*/
/*$requete = " select* from projet";*/

$requete = " select distinct no_projet, titre, projet.type, annee, resume, descriptif, chrono, id_encadrant_ from projet, porter_sur, travailler, suivre, etablabo, univentr ";


/*-------condition type de projet------------*/
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
	if  ($_POST['type'] == "3")
	{
	$b=1;
	$requete .= " where type='Transpromo' ";
	}
/*AUTRE FACON:
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


/*-------condition annee universitaire------------*/
	$i=1;
	while ($tabannee=mysql_fetch_array($CurseurAnnee))
// foreach($_SESSION['curseurannee'] as $tabannee)
//	while ($tabannee=$_SESSION['curseurannee'])
	{	
		if ($_POST['annee'] == $i)
		{
			if ($b==1)
				$requete .= " and annee=".$tabannee['annee'];
				else
				$requete .= " where annee=".$tabannee['annee'];
			
		$i++;
		}
	}

/*requete sur la table porter_sur:*/
	$i=1;


	while ($tabtheme=mysql_fetch_array($CurseurTheme))
	{	
		if ($_POST['theme'] == $i)
		{
			if ($b==1)
			{$requete .= " and projet.no_projet=porter_sur.no_projet_ and porter_sur.id_theme='".mysql_real_escape_string($tabtheme['id_theme'])."';";}
			else
			{$requete .= " where projet.no_projet=porter_sur.no_projet_ and porter_sur.id_theme='".mysql_real_escape_string($tabtheme['id_theme'])."';";}
		}
	$i++;

	}



/*requête sur le type d'encadrant: appartenant à une entreprise ou bien à un laboratoire universitaire. remettre les checkbox*/















/* Encore par Me, Moi, etc. Pour effectuer une recherche à critères :*/



$i=1;
echo "<br/>before boucle : ".$requete;
var_dump($_POST['encadrant']);
	while ($tabencadrant=mysql_fetch_array($CurseurEncadrant))
	{	
		if ($_POST['encadrant'] == $i)
		{
			if ($b==1)
			$requete .= " and id_encadrant_=".$tabencadrant['id_encadrant'];
			else
			$requete .= " where id_encadrant_=".$tabencadrant['id_encadrant'];
		$i=$i+1;
		}
echo "<br/>fin boucle : ".$requete;
	}
echo "<br/>post boucle : ".$requete;


/*
$i=1;
echo "<br/>before boucle : ".$requete;
var_dump($_POST['tuteur']);
	while ($tabtuteur=mysql_fetch_array($CurseurTuteur))
	{	
		if ($_POST['tuteur'] == $i)
		{
			if ($b==1)
			$requete .= " and suivre.id_tuteur_=".$tabtuteur['id_tuteur'];
			else
			$requete .= " where suivre.id_tuteur_=".$tabtuteur['id_tuteur'];
		$i=$i+1;
		}
echo "<br/>fin boucle : ".$requete;
	}
echo "<br/>post boucle : ".$requete;

$i=1;
	while ($tabetudiant=mysql_fetch_array($CurseurEtudiant))
	{	
		if ($_POST['etudiant'] == $i)
		{
			if ($b==1)
			$requete .= " and travailler.no_etud_='".$tabetudiant['no_etud'];
			else
			$requete .= " where travailler.no_etud_='".$tabetudiant['no_etud'];
		$i=$i+1;
		}
	}
*/














/*strtolower(str_replace(' ', '', $prenom))*/
	
$MaRequeteProjet=$requete; /*." order by annee;"*/
/*fin de la construction de la requete principale*/

$CurseurProjet=mysql_query($MaRequeteProjet,$CONNEXION) or die('error: <br/>'.mysql_error());
echo $MaRequeteProjet;

 /*--------------------------------------------------------------------------------------------------*/
 /*-------------------------------------AFFICHAGE DES PROJETS----------------------------------------*/
 /*--------------------------------------------------------------------------------------------------*/


$i=0;/*initialisation de i, indice du tableau contenant tous les projets sélectionnés*/
while ($tabprojet=mysql_fetch_array($CurseurProjet))
{
	$projets[]=$tabprojet;

echo 
"
<div id='content' class = data>

<table>
<tr>
	<td>Ann&eacute;e universitaire : ".$projets[$i]['annee']."</td>
	<td>Type de projet : ".$projets[$i]['type']."</td>
</tr>
<tr>
	<td colspan='2' id='titre'>Titre du projet : ".htmlentities($projets[$i]['titre'])."</td>
</tr>
<tr>

	<td>Etudiants : <br/>
";

	$MaRequeteEtudiant="SELECT nom_etud, pren_etud FROM projet, etudiant, travailler WHERE projet.no_projet=travailler.no_projet_ AND etudiant.no_etud=travailler.no_etud_ AND travailler.no_projet_='".$projets[$i]['no_projet']."';";
/*echo $MaRequeteEtudiant;*/
	$CurseurEtudiant=mysql_query($MaRequeteEtudiant) or die('ERROR: '.mysql_error());
	$j=0;
	while ($tabetudiant=mysql_fetch_array($CurseurEtudiant))
	{
	$etudiants[]=$tabetudiant;
	echo "&nbsp;&nbsp;".$etudiants[$j]['pren_etud']." ".$etudiants[$j]['nom_etud']."<br/>";
	$j++;
	}
	unset($etudiants);


echo "
	</td>
	<td>Tuteurs :<br/>
";		

	$MaRequeteTuteur="SELECT nom_tuteur, pren_tuteur FROM projet, tuteur, suivre WHERE id_tuteur_=id_tuteur AND no_projet_=no_projet AND no_projet=".$projets[$i]['no_projet'];


/*echo $MaRequeteEtudiant;*/
	$j=0;
	$CurseurTuteur=mysql_query($MaRequeteTuteur) or die('ERROR: '.mysql_error());
	while ($tabtuteur=mysql_fetch_array($CurseurTuteur))
	{
	$tuteurs[]=$tabtuteur ;
	echo "&nbsp;&nbsp;".$tuteurs[$j]['pren_tuteur']." ".$tuteurs[$j]['nom_tuteur']."<br/>";

	$j++;
	}
	unset($tuteurs);

echo 
"	
	</td>
</tr>
<tr>
	<td colspan='2'>Abstract : <br/>&nbsp;&nbsp;".htmlentities($projets[$i]['resume'])."</br></td>
</tr>
<tr>
	<td colspan='2'>Pr&eacute;sentation : <br/>&nbsp;&nbsp;".htmlentities($projets[$i]['descriptif'])."</br></td>
</tr>
<tr>
	<td colspan='2'>Chronologie : <br/>&nbsp;&nbsp;".htmlentities($projets[$i]['chrono'])."</br></td>
</tr>
<tr>
	<td colspan='2'>Collaboration :<br/>
";

if ($projets[$i]['id_encadrant_']!=null) /*test si le projet a été suivi par un encadrant*/
{


/*recherche de l'encadrant du projet, et de l'entreprise qu'il représente*/
	/*$MaRequeteEncadrant="SELECT nom_encadrant, pren_encadrant FROM projet, encadrant WHERE 
	projet.id_encadrant_=encadrant.id_encadrant
 	AND projet.no_projet='".$projets[$i]['no_projet']."';";*/

	/*$MaRequeteEncadrant="SELECT nom_encadrant, pren_encadrant, nom_etablabo, adr_etablabo, nom_univentr, adr_univentr
FROM projet, encadrant, etablabo, univentr
WHERE projet.no_projet = '2'
AND etablabo.id_univentr_ = univentr.id_univentr
AND encadrant.no_etablabo_=etablabo.no_etablabo";*/

	$MaRequeteEncadrant="SELECT nom_encadrant, pren_encadrant, nom_etablabo, adr_etablabo, site_univentr FROM projet, encadrant, etablabo, univentr WHERE 
	projet.id_encadrant_=encadrant.id_encadrant and
	encadrant.no_etablabo_=etablabo.no_etablabo and
	etablabo.id_univentr_=univentr.id_univentr
 	AND projet.no_projet='".$projets[$i]['no_projet']."';";

	
	$CurseurEncadrant=mysql_query($MaRequeteEncadrant) or die('ERROR: '.mysql_error()) ;
	$j=0;
	while ($tabencadrant=mysql_fetch_array($CurseurEncadrant))
	{
	$encadrants[]=$tabencadrant ;
	echo "&nbsp;&nbsp;".$encadrants[$j]['pren_encadrant']." ".$encadrants[$j]['nom_encadrant'].
"<br/>".$encadrants[$j]['nom_etablabo'].
"<br/>".$encadrants[$j]['adr_etablabo'].
"<br/>".$encadrants[$j]['site_univentr'];
	$j++;
	}
	
	

	unset($encadrants);
}
;


echo
"
	</td>
</tr>
</table>
</div>
";




$i++; /*on passe au projet suivant*/
}

/*
function show_tableau($projets) 
    {
     foreach ($projets as $projet) 
        {
         if (is_array($projet)) 
          {
            show_tableau($projet);
          } else 
          { 
            echo $projet . '<br/>';
          } 
        } 
       } 
//show_tableau($projets);
*/

}
?>



</body>
</html>