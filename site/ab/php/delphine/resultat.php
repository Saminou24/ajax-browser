	<?php
	require_once 'connect.php';
// ==========================================================================================
// PARTIE DÉFINITION DES FONCTIONS
// ==========================================================================================
function add_contraintes()
{// Série de contraintes à appliquer à la vue
	global $CurseurType, $CurseurTheme, $Curseurentreprise, $CurseurLabo, $CurseurAnnee, $CurseurEncadrant, $CurseurTuteur, $CurseurEtudiant;
	$_POST = array_map('mysql_real_escape_string', $_POST); // parcours le tableau et protège les valeurs pour SQL

	$contraintes = ' 1'; // pour que le WHERE soit vrai si aucune contrainte n'est donné
	if ($_POST['projet']!='-1')
	{// type de projet
		$valeurs = query2dropdown($CurseurType, FALSE);
		$contraintes .= "\n AND type='".$valeurs[$_POST['projet']]."' ";
	}
	if ($_POST['theme']!='-1')
	{// theme du projet
		$valeurs = query2dropdown($CurseurTheme, FALSE);
		$contraintes .= "\n AND id_theme='".$valeurs[$_POST['theme']]."' ";
	}
	if ($_POST['entreprise']!='-1')
	{// entreprise collaboratrice
		$valeurs = query2dropdown($Curseurentreprise, FALSE);
		$contraintes .= "\n AND nom_univentr='".$valeurs[$_POST['entreprise']]."' ";
	}
	if ($_POST['labo']!='-1')
	{// laboratoire collaborateur
		$valeurs = query2dropdown($CurseurLabo, FALSE);
		$contraintes .= "\n AND no_etablabo='".$valeurs[$_POST['labo']]."' ";
	}
	if ($_POST['annee_universitaire']!='-1')
	{// annee_universitaire du projet
		$valeurs = query2dropdown($CurseurAnnee, FALSE);
		$contraintes .= "\n AND annee='".$valeurs[$_POST['annee_universitaire']]."' ";
	}
	if ($_POST['encadrant']!='-1')
	{// encadrant externe
		$valeurs = query2dropdown($CurseurEncadrant, FALSE);
		$contraintes .= "\n AND nom_encadrant='".$valeurs[$_POST['encadrant']]."' ";
	}
	if ($_POST['tuteur']!='-1')
	{ // tuteur (IdC)
		$valeurs = query2dropdown($CurseurTuteur, FALSE);
		$contraintes .= "\n AND nom_tuteur='".$valeurs[$_POST['tuteur']]."' ";
	}
	if ($_POST['etudiant']!='-1')
	{// etudiant(s) impliqué(s)
		$valeurs = query2dropdown($CurseurEtudiant, FALSE);
		$contraintes .= "\n AND nom_etud='".$valeurs[$_POST['etudiant']]."' ";
	}
	return $contraintes;
}
function fetch_array($requete)
{// retourne sous forme de tableau PHP les resultats d'une requete SQL
// 	var_dump($requete);
	$RequeteResultat = mysql_query($requete) or die('error: <br/>'.mysql_error().' @ line:'.__LINE__.' in '.__FUNCTION__.'()');
// 	echo mysql_num_rows(mysql_query($RequeteResultat));
// echo $requete.'<br/>';
	$result = NULL;
	while ($row = mysql_fetch_assoc($RequeteResultat))
	{
		$result[] = $row;
	}
	return $result;
}

// ==========================================================================================
// PARTIE EXECUTION
// ==========================================================================================
// création d'une vue 'joinall'
$RequeteVue = "CREATE OR REPLACE VIEW joinall AS SELECT no_projet, nom_encadrant, pren_encadrant, mail, fonction_encadrant, no_etablabo, nom_etablabo, adr_etablabo, no_etud, nom_etud, pren_etud, promo, origine_scol, id_theme, type, annee, titre, resume, descriptif, chrono, nom_tuteur, pren_tuteur, fonction_tuteur, nom_univentr, adr_univentr, site_univentr, 'univ/entr(0/1)'
FROM
(((((((
		travailler INNER JOIN etudiant ON travailler.no_etud_=etudiant.no_etud
		) INNER JOIN projet ON projet.no_projet=travailler.no_projet_
			) INNER JOIN suivre ON projet.no_projet=suivre.no_projet_
				) INNER JOIN tuteur ON tuteur.id_tuteur=suivre.id_tuteur_
					) INNER JOIN encadrant ON encadrant.id_encadrant=projet.id_encadrant_
						) INNER JOIN etablabo ON etablabo.no_etablabo=encadrant.no_etablabo_
							) INNER JOIN porter_sur ON porter_sur.no_projet_=projet.no_projet
								) INNER JOIN univentr ON univentr.id_univentr=etablabo.id_univentr_;";

$RequeteVue = mysql_query($RequeteVue, $CONNEXION) or die('error: <br/>'.mysql_error().' @ line:'.__LINE__.' in '.__FUNCTION__.'()');
	$Contraintes = add_contraintes();

function getData($select = array('*'), $Curseur)
{// execute des sous-requetes avec contrainte et group by. Et retourne le tableau PHP associé
// 	global $Contraintes;// accès à la variable globale
	$RequeteSurVue = 'SELECT '.implode(', ', $select).' FROM joinall WHERE no_projet='.$Curseur;
	if ($select==array('*'))
	{
		$groupby = '1';
	} else
	{
		$groupby = implode(', ', $select);// valeur vraie?
	}
	$RequeteGroupBy = $RequeteSurVue.' GROUP BY '.$groupby;
// 	echo '<br/>@getData:'.$RequeteGroupBy.'<br/>';
	return fetch_array($RequeteGroupBy);
}
function IdResultat()
{
	global $Contraintes;// accès à la variable globale
	$Resultat = 'SELECT no_projet FROM joinall WHERE '.$Contraintes.' GROUP BY no_projet';
// 	echo $Resultat;
	$IdResultat = fetch_array($Resultat);
	return $IdResultat;
}

function array2string($tableau)
{
// 	echo '<br/>@array2string:<br/>';
// 	print_r($tableau);
	foreach ($tableau as $line)
	{
			$Lignes[] = implode(' ', $line); // réuni les case d'une ligne
	}
	$result = trim(implode(', ', $Lignes));
	if (empty($result)==TRUE)
	{
		$result = "<span class='inc'>inconnu</span>";
	}
// 	echo '<br/>';
	return $result;
}
function parcours_resultats($IdResultat)
{
	for ($i=0; $i<count($IdResultat); $i++)
	{// pour tous les résultats ont va faire des sous requete pour récupérer les données
// 		$IdResultat = SousRequete(array('no_projet'));
// var_dump($IdResultat);
		$numP = $IdResultat[$i]['no_projet'];
		$encadrant = array2string(getData(array('nom_encadrant', 'pren_encadrant'), $numP));
// 		var_dump($encadrant);
		// $Courant['mail']
		// $Courant['fonction_encadrant']
		$labo = array2string(getData( array('nom_etablabo'), $numP));
		// $Courant['adr_etablabo']
		// $Courant['no_etud']
// 		$etudiant = $Courant['pren_etud'].' '.$Courant['nom_etud'];
		$etudiants = array2string(getData( array('nom_etud', 'pren_etud'), $numP));
		// $Courant['promo']
		// $Courant['origine_scol']
// 		$theme = $Courant['id_theme'];
		$theme = array2string(getData( array('id_theme'), $numP));
		$type = array2string(getData( array('type'), $numP));
		$annee = array2string(getData( array('annee'), $numP));
		$titre = array2string(getData( array('titre'), $numP));
		$abstract = nl2br(array2string(getData( array('resume'), $numP)));
		$descriptif = nl2br(array2string(getData( array('descriptif'), $numP)));
		$chronologie = nl2br(array2string(getData( array('chrono'), $numP)));
		$tuteurs = array2string(getData( array('nom_tuteur', 'pren_tuteur'), $numP));
		$hebergeur = array2string(getData( array('nom_univentr'), $numP));


// 		$descriptif = $Courant['descriptif'];
// 		var_dump($descriptif);
// 		$chronologie = $Courant['chrono'];
// 		$tuteur = $Courant['pren_tuteur'].' '.$Courant['nom_tuteur'];
// 		var_dump($tuteur);
		// $Courant['fonction_tuteur']
		$hebergeur = array2string(getData( array('nom_univentr'), $numP));
		// $Courant['adr_univentr']
		// $Courant['site_univentr']
		// $Courant['univ/entr(0/1)']

	echo <<<RESULT
		<h3 class='legend'>{$titre}</h3>
		<div class='resultat'>
			<table>
				<tr>
					<td><span class='attr'>Année universitaire&thinsp;:</span><span class='val'>{$annee}</span></td>
					<td><span class='attr'>Type de projet&thinsp;:</span><span class='val'>{$type}</span></td>
				</tr>
				<tr>
					<td colspan='2'><span class='attr'>Titre du Projet&thinsp;:</span><span class='val'>{$titre}</span></td>
				</tr>
				<tr>
					<td><span class='attr'><span class='attr'>Tuteur&thinsp;:</span></span><span class='val'>{$tuteurs}</span></td>
			<td><span class='attr'>Etudiants&thinsp;:</span><span class='val'>{$etudiants}</span> </td>
		</tr>
		<tr>
			<td colspan='2'><span class='attr'>Abstract&thinsp;:</span><span class='val'>{$abstract}</span></td>
		</tr>
		<tr>
			<td colspan='2'><span class='attr'>Présentation&thinsp;:</span><div class='val'>{$descriptif}</div></td>
		</tr>
		<tr>
			<td colspan='2'><span class='attr'>Chronologie&thinsp;:</span><div class='val'>{$chronologie}</div></td>
		</tr>
		<tr>
			<td colspan='2'><span class='attr'>Encadrant&thinsp;:</span><span class='val'>{$encadrant}</span></td>
		</tr>
		</table>
		</div>
RESULT;
	}
}

//combien de resultats ?
// on parcours les resultat
// pour chacun on agrèges les données -> pleins de requetes
$IdResultat = IdResultat();
$NbResultat = count($IdResultat);
// var_dump($IdResultat);
if ($NbResultat==0)
{
	echo <<<ERROR
	<h2 class='legend'>Résultat(s) de la recherche</h2>
	<div class='resultat'>
		<p><em class='b'>Aucun résultats</em> n'a été trouvé pour votre recheche.
		Veuillez ré-essayer avec moins de contraintes.</p>
	</div>
ERROR;
} else
{
echo <<<RES
<div id='resultat'>
	<h2 class='legend'>Résultat(s) de la recherche</h2>
	<div class='resultat yes'>
		<p><span class='bigred'>{$NbResultat}</span> résultats ont été trouvé pour votre recheche.</p>
	</div>
RES;

	$Courant = parcours_resultats($IdResultat);
// 	$Resultat = fetch_array($RequeteSurVue);
// 	foreach ($Resultat as $Courant)
// 	{

// 	}
	echo "</div>";
}

	?>
<!-- 	</div> -->