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
$InstallerScript = "<html><head>
		<meta content='text/html; charset=UTF-8' http-equiv='content-type'>
		<title>AJAX-Browser : Gestionnaire de site WEB par protocole http</title>
	</head><body>
<?php
// The array named 'lst64' is all AJAX-B dir and files encode by \"base64_encode()\"
// To install AJAX-B run this php script on web serveur, all file will make and next run 'AJAX-B.php'...
/**-------------------------------------------------
 | Email bugs/suggestions to alban.lopez@gmail.com
 +--------------------------------------------------
 | This script has been created and released under
 | the GNU GPL.
 +--------------------------------------------------*/
\$NoReplace = array('".$_GET["NoReplace"]."');
\$lst64 = array(".$str.");
if (\$_SERVER['DOCUMENT_ROOT']!=realpath('./'))
{
	chdir(\$_SERVER['DOCUMENT_ROOT']);
	echo 'AJAX-Browser a etait installe dans la racine du domaine '.realpath('./').', car c\'est indispancable a sont bon fonctionnement...<br><br>';
}
foreach (\$lst64 as \$key => \$data)
{
	if (!is_dir(dirname(\$key)))
	{
		\$newDir='';
		foreach(explode('/',dirname(\$key)) as \$dirPart)
			if (!empty(\$dirPart) && !is_dir(\$newDir=\$newDir.\$dirPart.'/')) mkdir(\$newDir);
	}
	if (!file_exists(\$key) || !in_array(\$key, \$NoReplace))
	{
		if (\$handle = @fopen(\$key, 'w'))
		{
			\$result = @fwrite(\$handle, base64_decode(\$data));
			@fclose(\$handle);
		}
	}
	else echo 'Le fichier '.\$key.' existe déja et n\'as pas etes remplacé<br>';
	if (!\$result) echo 'ERROR '.\$key.' n\'as pue etre decompresse<br>';
}
	if (!function_exists('posix_getpwuid')) echo 'posix_getpwuid() => Erreur, vous ne pourez connaitre les UID (Proprietaire) des fichiers<br>';
	if (!function_exists('posix_getgrgid')) echo 'posix_getgrgid() => Erreur, vous ne pourez connaitre les GID (Groupe) des fichiers<br>';
	if (!function_exists('rmdir')) echo 'rmdir() => Erreur, vous ne pourez supprimer les dossiers<br>';
	if (!function_exists('rename')) echo 'rename() => Erreur, vous ne pourez rien renomer ou deplacer<br>';
	if (!function_exists('imagejpeg')) echo 'GD() => Erreur, vous ne pourez gerer les images (et les miniatures). Vous devriez intaller  PHP-GD<br>';
	echo '<br>Installation reussi.<br><br>';
?>
	<a href='http://<?=\$_SERVER['SERVER_NAME']?>/AJAX-Browser.php?login=Admin_Installer'>./AJAX-Browser.php</a><br>
	<a href='http://sctfic.free.fr/Documentation/index.html'>Documentation Officielle</a><br>
	<a href='http://groups.google.com/group/ajax-browser/'>Google Groups (en construction)</a><br>
	<a href='http://code.google.com/p/ajax-browser/'>Depot SVN subversion (en construction)</a><br>
	<a href='mailto:alban.lopez@gmail.com'>Contact by mail</a><br>
<?
mail(
	'alban.lopez@gmail.com',
	'New Domaine User to : AJAX-Browser V".$_GET['version']."',
	'\nSERVER_NAME : '.\$_SERVER['SERVER_NAME'].'/AJAX-Browser.php\n\nHTTP_USER_AGENT : '.\$_SERVER['HTTP_USER_AGENT'].'\n\nApache Version : '.@apache_get_version(),
	'From:  <>\nMIME-Version: 1.0'
);
?>
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
