<?php
require_once 'connect.php';

if ($CONNEXION)
{
	// types de projet
	$MaRequeteType = 'SELECT DISTINCT type FROM projet ORDER BY type';
		$CurseurType = mysql_query($MaRequeteType, $CONNEXION) or die('error: <br/>'.mysql_error());
	// années universitaire
	$MaRequeteAnnee = 'SELECT DISTINCT annee FROM projet ORDER BY annee';
		$CurseurAnnee = mysql_query($MaRequeteAnnee, $CONNEXION) or die('error: <br/>'.mysql_error());
	// themes du projet
	$MaRequeteTheme = 'SELECT DISTINCT id_theme FROM porter_sur ORDER BY id_theme';
		$CurseurTheme = mysql_query($MaRequeteTheme, $CONNEXION) or die('error: <br/>'.mysql_error());
	// entreprises collaboratrices
	$MaRequeteEntreprise = 'SELECT DISTINCT nom_univentr FROM univentr ORDER BY nom_univentr';
		$Curseurentreprise = mysql_query($MaRequeteEntreprise, $CONNEXION) or die('error: <br/>'.mysql_error());
	// labos collaborateurs
	$MaRequeteLabo = 'SELECT DISTINCT nom_etablabo FROM etablabo ORDER BY nom_etablabo';
		$CurseurLabo = mysql_query($MaRequeteLabo, $CONNEXION) or die('error: <br/>'.mysql_error());
	// encadrants externe
	$MaRequeteEncadrant = 'SELECT DISTINCT nom_encadrant, pren_encadrant FROM encadrant ORDER BY nom_encadrant, pren_encadrant';
		$CurseurEncadrant = mysql_query($MaRequeteEncadrant, $CONNEXION) or die('error: <br/>'.mysql_error());
	// tuteurs IdC
	$MaRequeteTuteur = 'SELECT DISTINCT nom_tuteur, pren_tuteur FROM tuteur ORDER BY nom_tuteur, pren_tuteur';
		$CurseurTuteur = mysql_query($MaRequeteTuteur, $CONNEXION) or die('error: <br/>'.mysql_error());
	// etudiants
	$MaRequeteEtudiant = 'SELECT DISTINCT nom_etud, pren_etud FROM etudiant  ORDER BY nom_etud, pren_etud';
		$CurseurEtudiant = mysql_query($MaRequeteEtudiant, $CONNEXION) or die('error: <br/>'.mysql_error());
/*//mysql_close($CONNEXION);  inutile*/
}

function query2dropdown($Result, $affich = TRUE)
{// retourne le résultat d'une requete sous forme HTML (TRUE) ou comme tableau de valeur PHP (FALSE)
	mysql_data_seek($Result, 0); // se replace au début de la ressources! nécessaire pour le 2e appel de lcette fonction
	$i=0;

	while ($tab=mysql_fetch_array($Result, MYSQL_NUM))
	{
		$plus = ((isset($tab[1])==TRUE)? ' ('.$tab[1].')' : '');// operateur ternaire : TEST? SI_VRAI : SI_FAUX
		if ($affich==TRUE)
		{
			if (empty($tab[0])==FALSE)
			{
				echo "<option value='{$i}'>{$tab[0]}{$plus}</option>";
			}
		} else
		{// construit le tableau num_option<->valeur_réelle
			$valeurs[] = mysql_real_escape_string($tab[0]);
		}
		$i++;
	}
	return (($affich==TRUE)? '' : $valeurs);// opérateur ternaire:  TEST ? si_vrai : si_faux
}
?>
<h1>Page de recherche</h1>
<h2>Formulaire de recherche</h2>
<div id='recherche'>
	<a href='#resultat' class='h'>allez aux résultats</a>

	<form method='post' action='?p=recherche&amp;add=resultat#resultat'>
	<p>Veuillez définir vos critères de recherche de projet&thinsp;:</p>
	<div id='col'>
		<div id='coleft'>
			<dl>
				<dt><label for='projet'>Type de projet&thinsp;:</label></dt>
					<dd>
						<select id='projet' name='projet'>
							<option selected='selected' value='-1'>— Indifférent —</option>
							<?php
								query2dropdown($CurseurType);
							?>
					</select>
				</dd>
			<dt><label for='theme'>Thème du projet&thinsp;:</label></dt>
				<dd>
					<select id='theme' name='theme'>
							<option selected='selected' value='-1'>— Indifférent —</option>
							<?php
								query2dropdown($CurseurTheme);
							?>
						</select>
					</dd>
				<dt>En collaboration avec&thinsp;:</dt>
					<dd><label for='entreprise'>Entreprise&thinsp;:</label>
						<select id='entreprise' name='entreprise'>
							<option selected='selected' value='-1'>— Indifférent —</option>
							<?php
								query2dropdown($Curseurentreprise);
							?>
						</select>
					</dd>
					<dd><label for='labo'>Laboratoire&thinsp;:</label>
						<select id='labo' name='labo'>
							<option selected='selected' value='-1'>— Indifférent —</option>
							<?php
								query2dropdown($CurseurLabo);
							?>
						</select>
					</dd>
				</dl>
		</div>

		<div id='colright'>
			<dl>
				<dt><label for='annee'>Année de réalisation&thinsp;:</label></dt>
					<dd>
						<select id='annee' name='annee_universitaire'>
							<option selected='selected' value='-1'>— Indifférent —</option>
							<?php
								query2dropdown($CurseurAnnee);
							?>
						</select >
					</dd>
				<dt><label for='encadrant'>Encadrant externe</label>&thinsp;:</dt>
					<dd>
						<select id='encadrant' name='encadrant'>
							<option selected='selected' value='-1'>— Indifférent —</option>
							<?php
								query2dropdown($CurseurEncadrant);
							?>
						</select >
					</dd>
				<dt><label for='tuteur'>Encadrant interne (<acronym title='Institut de Cognitique'>IdC</acronym>)&thinsp;:</label></dt>
					<dd>
						<select id='tuteur' name='tuteur'>
							<option selected='selected' value='-1'>— Indifférent —</option>
							<?php
								query2dropdown($CurseurTuteur);
							?>
						</select >
					</dd>
				<dt><label for='etudiant'>Étudiant&thinsp;:</label></dt>
					<dd>
						<select id='etudiant' name='etudiant'>
							<option selected='selected' value='-1'>— Indifférent —</option>
							<?php
								query2dropdown($CurseurEtudiant);
							?>
						</select >
					</dd>
			</dl>
		</div>
	</div>

	<div class='submit'><input type='submit' name='Submit' value='Rechercher' /></div>
	</form>
</div>
<?php
	if (isset($_REQUEST['add'])==TRUE && $_REQUEST['add']=='resultat')
	{
		require_once 'resultat.php';
	}
?>
