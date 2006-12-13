<?php
if (!isset($_GET['lst']))
{
echo "You can use this <b><i>\"php install maker\"</i></b> with 3 parameters :<br />
<b><i>lst :</i></b> is a list of relative 'FileUrl' or 'FolderUrl' of file separate by ','.<br />
<b><i>dest :</i></b> is the first part name of the result file.<br />
<b><i>version :</i></b> is the second part name of the result file.<br />
<i><b>EX :</b> http://localhost/MakeInstalleur.php?dest=Auto-extract&version=O.1.3&lst=./index.php,./image/truc.png</i><br />
<i><b>EX :</b> http://localhost/MakeInstalleur.php?lst=./index.php,./image/</i>";
exit ();
}
$list = explode(',',$_GET['lst']);
$str = "";
while ($value = DirUrl(array_shift($list)))
{
	if (is_file($value) && $value{strlen($value)-1}!='~')
	{
		$str .= "'".$value."' => '".base64_encode(file_get_contents($value))."',\n";
	}
	elseif (is_dir($value))
	{
		$array = DirSort($value, "all", $value);
		$list = array_merge ($list, is_array($array)?$array:array());
	}
}
$InstallerScript = "<?
if (isset(\$_GET['version']))
{
	echo '".$_GET['version']."';
	exit ();
}
elseif (isset(\$_GET['download']))
{
	header('Content-Type: application/force-download');
	header('Content-Disposition: attachment;');
	readfile('./LastVersion.php');
	if (\$handle = @fopen('./MiseAJour.txt', 'a'))
	{
		@fwrite(\$handle, '".$_GET['version']." => '.\$_SERVER['SERVER_NAME'].'/AJAX-Browser.php\n');
		@fclose(\$handle);
	}
	exit ();
}?>
<html><head>
		<meta content='text/html; charset=UTF-8' http-equiv='content-type'>
		<title>AJAX-Browser : Gestionnaire de site WEB par protocole http</title>
	</head>
	<style type='text/css'>
		.fail {font-size:10px;width:100%;text-align:right;}
		.fail:after {content:'FAIL';color:red;font-weight:bold;margin-left:30px;}

		.skip {font-size:10px;width:100%;text-align:right;}
		.skip:after {content:'SKIP';color:blue;font-weight:bold;margin-left:30px;}

		.install {text-align:right;font-size:10px;width:100%;}
		.install:after {content:'OK';color:green;font-weight:bold;margin-left:38px;}
	</style>
	<body>
<?php
// The array named 'lst64' is all AJAX-B dir and files encode by \"base64_encode()\"
// To install AJAX-B run this php script on web serveur, all file will make and next run 'AJAX-B.php'...
/**-------------------------------------------------
 | Email bugs/suggestions to alban.lopez@gmail.com
 +--------------------------------------------------
 | This script has been created and released under
 | the GNU GPL and is free to use and redistribute
 | only if this copyright statement is not removed
 +--------------------------------------------------*/
\$NoReplace = array('*.png','*.var','*.gif');
\$lst64 = array(".$str.");
if (\$_SERVER['DOCUMENT_ROOT']!=realpath('./'))
{
	chdir(\$_SERVER['DOCUMENT_ROOT']);
	echo 'AJAX-Browser a etait installe dans la racine du domaine '.realpath('./').', car c\'est indispancable à son bon fonctionnement...<br><br>';
}
?>
<table width='100%'>
<colgroup><col width='70%'><width='30%'></colgroup>
<tr>
<td style='vertical-align:top;'>
	<a href='http://<?=\$_SERVER['SERVER_NAME']?>/AJAX-Browser.php?login=Admin_Installer'>./AJAX-Browser.php</a><br>
	<a href='http://sctfic.free.fr/Documentation/index.php'>Documentation Officielle</a><br>
	<a href='http://groups.google.com/group/ajax-browser/'>Google Groups (en construction)</a><br>
	<a href='http://code.google.com/p/ajax-browser/'>Depot SVN subversion (en construction)</a><br>
	<a href='mailto:alban.lopez@gmail.com'>Contact by mail</a><br>
</td><td width='100px'>
<?
	if (!function_exists('posix_getpwuid')) echo '<div class=\'fail\'>posix_getpwuid() => Erreur, vous ne pourrez connaitre les UID (Proprietaire) des fichiers</div>\n';
	if (!function_exists('posix_getgrgid')) echo '<div class=\'fail\'>posix_getgrgid() => Erreur, vous ne pourrez connaitre les GID (Groupe) des fichiers</div>\n';
	if (!function_exists('rmdir')) echo '<div class=\'fail\'>rmdir() => Erreur, vous ne pourrez supprimer les dossiers</div>\n';
	if (!function_exists('rename')) echo '<div class=\'fail\'>rename() => Erreur, vous ne pourrez rien renomer ou deplacer</div>\n';
	if (!function_exists('imagejpeg')) echo '<div class=\'fail\'>GD() => Erreur, vous ne pourrez gerer les images (et les miniatures). Vous devriez intaller la bibliothèque PHP-GD</div>\n';
	if (!function_exists('gzwrite')) echo '<div class=\'fail\'>ZLIB() => Erreur, vous ne pourrez generer de fichier *.zip ou *.gz pour le téléchargement de dossier. Vous devriez intaller la bibliothèque ZLIB</div>\n';
	if (!function_exists('bzwrite')) echo '<div class=\'fail\'>BZIP2() => Erreur, vous ne pourrez generer de fichier *.bz2 pour le téléchargement de dossier. Vous devriez intaller la bibliothèque BZIP2</div>\n';
	\$ERROR = false;
foreach (\$lst64 as \$key => \$data)
{
	if (!is_dir(dirname(\$key)))
	{
		\$newDir='';
		foreach(explode('/',dirname(\$key)) as \$dirPart)
			if (!empty(\$dirPart) && !is_dir(\$newDir=\$newDir.\$dirPart.'/')) mkdir(\$newDir);
	}
	if (!file_exists(\$key) || !ArrayFMatch(\$NoReplace, \$key))
	{
		if (\$handle = @fopen(\$key, 'w'))
		{
			\$result = @fwrite(\$handle, base64_decode(\$data));
			@fclose(\$handle);
			if (\$result) echo '<div class=\'install\'>'.basename(\$key).'</div>\n';
			else
			{
				echo '<div class=\'fail\'>'.basename(\$key).'</div>\n';
				\$ERROR = true;
			}
		}
	}
	else echo '<div class=\'skip\'>'.basename(\$key).'</div>\n';
}
	if (!\$ERROR) echo '<br>Installation Terminée avec succés.<br><br>';
	else echo '<br>Echec de l instalation !<br>Verrifier les droits d\'ecriture du domaine...<br>';
@mail(
	'alban.lopez@gmail.com',
	'New Domaine User to : AJAX-Browser V".$_GET['version']."',
	trim('\nSERVER_NAME : '.\$_SERVER['SERVER_NAME'].'/AJAX-Browser.php\n\nHTTP_USER_AGENT : '.\$_SERVER['HTTP_USER_AGENT']),
	'From:  <>\nMIME-Version: 1.0'
);
function ArrayFMatch (\$ArrayMask, \$str)
{
	foreach (\$ArrayMask as \$mask)
		if (fnmatch(\$mask, \$str)) return true;
	return false;
}
?></td></tr></table>
	</body>
</html>";
if ($handle = fopen($file=((isset($_GET['dest']) && isset($_GET['version']))?$_GET['dest'].$_GET['version'].".php":"./Installeur.php"), "w"))
{
	$result = fwrite($handle, $InstallerScript);
	copy($file, dirname($file)."/LastVersion.php");
	fclose($handle);
}
echo "Taille de $file : ".SizeConvert (filesize($file));

function SizeConvert ($Size)
{
	$UnitArray = array("Oct","Ko","Mo","Go","To");
	$Unit=0;
	while ($Size/pow(1024, $Unit)>1024) $Unit++;
	return round($Size/pow(1024, $Unit), $Unit)." ".$UnitArray[$Unit];
}
function DirUrl($Dir)
{
	if (ereg ("/$", $Dir))
		return $Dir;
	elseif (is_dir($Dir)) return $Dir."/";
	else return $Dir;
}
function DirSort ($rep, $t='all', $Prefixe='')
{
	$type = array( "dir" =>  true , "dossier" =>  true, "folder" =>  true , "files" => false , "file" => false , "fichier" => false , "fichiers" => false);
	$Lst = false;
	if ($t=='all')
	{
		$Lst1 = DirSort ($rep, "dir", $Prefixe);		// cree une liste ordonnee des repertoires
		$Lst2 = DirSort ($rep, "file", $Prefixe);		// cree une liste ordonnee des fichiers
		if ($Lst2 || $Lst1)				// si l'un des 2 n'est pas vide...
			return array_merge( $Lst1 ? $Lst1 : array(), $Lst2 ? $Lst2 : array() );       // alors on renvois la concatenation des 2 string
		else return false;				// resultat d'un dossier vide
	}
	elseif (is_readable($rep) && $dh = opendir($rep))
	{
		while (($f = readdir($dh)) !== false)	// parcoure le contenu de Rep
		{
			if ($f != "." && $f != "..")		// ignore les dossiers '.' et '..'
			{
				$ext = pathinfo($rep.$f, PATHINFO_EXTENSION);	// identifie l'extension du fichier
				if (!is_array($t))	// si on a demander tous le contenu (fichiers ou dossiers)
				{
					if ($type[$t]==is_dir($rep.$f))
						$Lst[] = $Prefixe.$f;	// Liste un type de contenu (repertoires ou fichiers)
				}
				elseif ( in_array(strtolower ($ext),$t) && is_file($rep.$f) )
					$Lst[] = $Prefixe.$f;       // Liste un type de contenu (fichier de d'extension demander)
			}
		}
		closedir($dh);
	}
	if (is_array($Lst))        // si la liste n'est pas vide
	{
		natcasesort($Lst);       //classe le contenu
		return array_values($Lst);   // pour que les clef soit dans l'ordre...
	}
	else return false;
}
?>