<?php
/**-------------------------------------------------
 | AJAX-Browser  -  by Alban LOPEZ
 | Copyright (c) 2006 Alban LOPEZ
 | Email bugs/suggestions to alban.lopez@gmail.com
 +--------------------------------------------------
 | This script has been created and released under
 | the GNU GPL and is free to use and redistribute
 | only if this copyright statement is not removed
 +--------------------------------------------------*/
	$FileObj = $_GET['infos'];
	$infos = array();
	$nom = "title='Nom de ce fichier'><td style='text-align:center;' colspan=3>".basename($FileObj)."</td></";									// name
	$url = "title='Adresse complete de cet element'><td style='text-align:center;border-bottom:1px solid gray;' colspan=3>".$FileObj."</td></";					// dirname
	$infos[] = "<tr title='Taille de cet element seul (dossier sans leur contenu)'><td>Taille :</td><td>".SizeConvert($tmp=@filesize ($FileObj))." (".$tmp." Oct)</td></tr>";	// size
	$infos[] = "<tr title='Date de derniere modification'><td>Modifié :</td><td>".date ("d/m/y H:i:s",@filemtime($FileObj))."</td></tr>";						// date
	$infos[] = "<tr><td>Droits :</td><td>".Permission ($FileObj)."</td></tr>";													// perm

	$usr = function_exists("posix_getpwuid") ? @posix_getpwuid(fileowner($FileObj)) : array("name" => "?", "uid" => "posix_getpwuid()");
		$infos[] = "<tr title='Appartenance a cet utilisateur'><td>Owner : </td><td>".$usr['name']." (".$usr['uid'].")</td></tr>";						// uid
	$grp = function_exists("posix_getgrgid") ? @posix_getgrgid (filegroup($FileObj)) : array("name" => "?", "gid" => "posix_getgrgid()");
		$infos[] = "<tr title=\"Appartenance à ce groupe d'utilisateur\"><td>Group :</td><td>".$grp['name']." (".$grp['gid'].")</td></tr>";					// gid

echo "\n	<table>
		<tr $nom tr>
		<tr $url tr>";

	if (@getimagesize($FileObj))
	{
		list ($L, $H) = getimagesize($FileObj);
		echo "		<tr>
			<td style='vertical-align:middle;text-align:center;padding:5px;' rowspan='7'>
				<img style='max-width:150px;max-height:150px;' src='".CreatMini($FileObj, './.AJAX-Mini/', $_SESSION['mini-size'])."'/>
			</td>
		</tr>
		".implode("\n",$infos)."
		<tr title='Dimention de limage en pixel (Largeur x Hauteur)'><td>Dimensions :</td><td>[X:".$L."px * Y:".$H."px]</td></tr>";
	}
	elseif (is_dir($FileObj))
		echo implode("\n",$infos)."
		<tr><td colspan='2'><center>".(($tmp=DirSort ($FileObj.'/','dir')) ? count ($tmp) : 0)." Dossier(s), ".(($tmp=DirSort ($FileObj.'/','file')) ? count ($tmp) : 0)." Fichier(s)</center></td></tr>
		<tr>
			<td title='Taille totale du contenue de ce dossier'>Soit :</td>
			<td onclick=\"RequestInfosSize (this,'".$FileObj."');\">
				<span class='button'>Calcul Now!</span>
			</td>
		</tr>\n";
	else
		echo implode("\n",$infos);
echo "	</table>\n";
?>