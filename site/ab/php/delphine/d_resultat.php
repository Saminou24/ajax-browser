<div id='resultat' class='content'>
	<h2>Résultats de la recherche</h2>
	<div class = data>
	<?php
	require_once 'connect.php';



	if ($CONNEXION)
	{

				$MaRequeteAnnee='select DISTINCT annee from projet order by annee';
				$MaRequeteTheme='select DISTINCT id_theme from porter_sur order by id_theme';

				/* Par Yassine, M, Moi, Me, Yo, Ego, 33, ... Pour afficher les infos correspondant aux projets trouvés (les 2 requêtes du haut servent aussi) :
				$MaRequeteEncadrant=' select nom_encadrant
															from projet, encadrant
															where etudiant.id_encadrant=encadrant.id_encadrant [and no_projet=...] ';
				$MaRequeteTuteur='select DISTINCT nom_tuteur from suivre [where no_projet=...]';
				$MaRequeteEtudiant='select DISTINCT nom_etudiant from travailler [where no_projet=...] [order by nom_etudiant]';
				MaRequeteEU='select nom_univentr from projet, univentr [where type_univentr=... and no_projet=...] [order by nom_etudiant]';
				*/

				 $CurseurAnnee=mysql_query($MaRequeteAnnee,$CONNEXION) or die('error: <br/>'.mysql_error());
				 $CurseurTheme=mysql_query($MaRequeteTheme,$CONNEXION) or die('error: <br/>'.mysql_error());


	 /*--------------------------------------------------------------------------------------------------*/
	 /*--------------------------------RECHERCHE DES PROJETS SELECTIONNES--------------------------------*/
	 /*--------------------------------------------------------------------------------------------------*/
	$b = 0 ; /*initialisation de la variable indiquant si l'on a déjà posé une condition ou non*/

	/*debut de la construction de la requete principale*/
	/*$requete = ' select no_projet,type,titre,annee,resume,descriptif,chrono,id_encadrant_ from projet, porter_sur '*/;
	$requete = ' select * from projet ';


		if ($_POST['type'] == '1')
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
		$requete .= "where type='Transpromo' ";
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

			$i=$i+1;
			}
		}




	/* Encore par Me, Moi, etc. Pour effectuer une recherche à critères :

	$CurseurEncadrant=mysql_query($MaRequeteEncadrant,$CONNEXION) or die('error: <br/>'.mysql_error());
	$CurseurTuteur=mysql_query($MaRequeteTuteur,$CONNEXION) or die('error: <br/>'.mysql_error());
	$CurseurEtudiant=mysql_query($MaRequeteEtudiant,$CONNEXION) or die('error: <br/>'.mysql_error());

	$i=1;
		while ($tabencadrant=mysql_fetch_array($CurseurEncadrant))
		{
			if ()
			{
				if ($b==1)
				$requete .= " and encadrant=".$tabencadrant['id_encadrant'];
				else
				$requete .= " where encadrant=".$tabencadrant['id_encadrant'];
			$i=$i+1;
			}
		}
																										MANQUE-T-IL L'ACCOLADE DE if(CONNEXION) ????
		}

	$i=1;
		while ($tabtuteur=mysql_fetch_array($CurseurTuteur))
		{
			if ($_POST['tuteur'] == $i)
			{
				if ($b==1)
				$requete .= " and tuteur=".$tabtuteur['id_tuteur'];
				else
				$requete .= " where tuteur=".$tabtuteur['id_tuteur'];
			$i=$i+1;
			}
		}



	*/




	/*requete sur la table porter_sur:   " and projet.no_projet=porter_sur.no_projet and porter_sur.theme=".$tabtheme['id_theme']
		$i=1;
		while ($tabtheme=mysql_fetch_array($CurseurTheme))
		{
			if ($_POST['theme'] == $i)
			{
				if ($b==1)
				{$requete .= " and theme=".$tabtheme['id_theme'];}
				else
				{$requete .= " where theme=".$tabtheme['id_theme'];}
			$i=$i+1;
			}
		}

		}
	*/



	/*requete sur la table porter_sur:   " and projet.no_projet=porter_sur.no_projet and porter_sur.theme=".$tabtheme['id_theme']*/
		$i=1;
		while ($tabtheme=mysql_fetch_array($CurseurTheme))
		{
			if ($_POST['theme'] == $i)
			{
				if ($b==1)
				{$requete .= " and projet.no_projet=porter_sur.no_projet and porter_sur.id_theme=".$tabtheme['id_theme'];}
				else
				{$requete .= " where projet.no_projet=porter_sur.no_projet and porter_sur.id_theme=".$tabtheme['id_theme'];}
			$i=$i+1;
			}
		}




	$MaRequeteProjet=$requete." order by annee;";
	/*fin de la construction de la requete principale*/

	$CurseurProjet=mysql_query($MaRequeteProjet,$CONNEXION);


	 /*--------------------------------------------------------------------------------------------------*/
	 /*-------------------------------------AFFICHAGE DES PROJETS----------------------------------------*/
	 /*--------------------------------------------------------------------------------------------------*/




	/*while ($tabprojet=mysql_fetch_array($CurseurProjet))
	{
		echo $tabprojet['titre'];
		$projets[]=$tabprojet;
	}

	echo $projets[0]['titre'];
	echo $projets[1]['titre'];*/








	$i=0;/*initialisation de i, indice du tableau contenant tous les projets sélectionnés*/
	while ($tabprojet=mysql_fetch_array($CurseurProjet))
	{
		$projets[]=$tabprojet;





	/*
		$MaRequeteEU="SELECT nom_univentr FROM univentr, encadrant, etablabo WHERE encadrant.no_etablabo_=etablabo.no_etablabo AND etablabo.id_univentr_=univentr.id_univentr AND id_encadrant=".$tabencadrant['id_encadrant']."AND no_projet=".$tabprojet['no_projet'];
		$CurseurEU=mysql_query($MaRequeteEU) ;
		while ($tabEU=mysql_fetch_array($CurseurEU))
		{
		$univentr[]=$tabEU ;
		}
	*/
















$HTML_titre = htmlentities($projets[$i]['titre']);
	echo <<<BRES
	<div class=data>
		<table>
			<tr>
				<td>Année universitaire : {$projets[$i]['annee']}</td>
				<td>Type de projet : {$projets[$i]['type']}</td>
			</tr>
			<tr>
				<td colspan='2'>Titre du projet : {$HTML_titre}</td>
			</tr>
			<tr>
				<td>Tuteurs :<br/>
BRES;
		$MaRequeteTuteur="SELECT nom_tuteur, pren_tuteur FROM projet, tuteur, suivre WHERE id_tuteur_=id_tuteur AND no_projet_=no_projet AND no_projet=".$projets[$i]['no_projet'];
	/*echo $MaRequeteEtudiant;*/
		$j=0;
		$CurseurTuteur=mysql_query($MaRequeteTuteur) or die('ERROR: '.mysql_error());
		while ($tabtuteur=mysql_fetch_array($CurseurTuteur))
		{
		$tuteurs[]=$tabtuteur ;
		echo $tuteurs[$j]['pren_tuteur']." ".$tuteurs[$j]['nom_tuteur']."   ";

		$j++;
		}
		unset($tuteurs);

	echo
	"
		</td>
		<td>Etudiants : <br/>
	";

		$MaRequeteEtudiant="SELECT nom_etud, pren_etud FROM projet, etudiant, travailler WHERE projet.no_projet=travailler.no_projet_ AND etudiant.no_etud=travailler.no_etud_ AND travailler.no_projet_='".$projets[$i]['no_projet']."';";
	/*echo $MaRequeteEtudiant;*/
		$CurseurEtudiant=mysql_query($MaRequeteEtudiant) or die('ERROR: '.mysql_error());
		$j=0;
		while ($tabetudiant=mysql_fetch_array($CurseurEtudiant))
		{
		$etudiants[]=$tabetudiant;
		echo $etudiants[$j]['pren_etud']." ".$etudiants[$j]['nom_etud']."<br/>";
		$j++;
		}
		unset($etudiants);


	echo "
		</td>
	</tr>
	<tr>
		<td colspan='2'>Abstract : <br/>".htmlentities($projets[$i]['resume'])."</br></td>
	</tr>
	<tr>
		<td colspan='2'>Présentation : <br/>".htmlentities($projets[$i]['descriptif'])."</br></td>
	</tr>
	<tr>
		<td colspan='2'>Chronologie : <br/>".htmlentities($projets[$i]['chrono'])."</br></td>
	</tr>
	<tr>
		<td colspan='2'>Collaboration :<br/>
	";

	if ($projets[$i]['id_encadrant_']!=null)
	{




		$MaRequeteEncadrant="SELECT nom_encadrant, pren_encadrant, id_encadrant FROM projet, encadrant WHERE projet.id_encadrant_=encadrant.id_encadrant AND projet.no_projet='".$projet[$i]['no_projet']."';";
		echo $MaRequeteEncadrant;
		$CurseurEncadrant=mysql_query($MaRequeteEncadrant) or die('ERROR: '.mysql_error()) ;
		$j=0;
		while ($tabencadrant=mysql_fetch_array($CurseurEncadrant))
		{
		$encadrants[]=$tabencadrant ;
		echo $encadrants[$j]['pren_encadrant']." ".$encadrants[$j]['nom_encadrant']."   ";
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
</div>


</body>
</html>