<?php
/**--------------------------------------------------
 | PHP MAKE INSTALL CLASSES 0.2
 | By LOPEZ Alban  -  Copyright (c) 2007
 | Email: alban.lopez+make.install.class@gmail.com
 +--------------------------------------------------
 | This script has been created and released under
 | the GNU GPL and is free to use and redistribute
 | only if this copyright statement is not removed
 +--------------------------------------------------*/

/// ************ My exemple of use *************

$intaller = new MakeIntall (
	array
	(
	'projetName'=> 'AJAX-Browser',
	'version' => $_GET['version'],

	'comment' => '-------------------------------------------------
 | AJAX-Browser  -  by Alban LOPEZ
 | Copyright (c) 2007 Alban LOPEZ
 | Email bugs/suggestions to alban.lopez@gmail.com
 +--------------------------------------------------
 | This script has been created and released under
 | the GNU GPL and is free to use and redistribute
 | only if this copyright statement is not removed
 +--------------------------------------------------',

	'addons' => '<li>Bug corrections</li>
<li>Augmentation de la compatibilité Serveur (remerciment a Dkø)</li>
<li>Amelioration des fonctions rename et MultiRename</li>
<li>Remaniement du code pour la gestion des langues (j\'en appelle aux bilingues, help me...)</li>',

	'includes'=>array('./AJAX-B/','./AJAX-Browser.php'),
	'excludes'=>array('*~','*.var','* ??.php','* es.php','*.svn/*','*Mini/*','*Spy/*'),
	'filesName' => array('../Archives/AJAX-B_%version%.php','../Archives/LastVersion.php'),
	'no_replace'=>array('*.var','*.png','*.gif'),

	'install_onDownload'=>'@mail("alban.lopez@gmail.com", "New Download on : $projetName $version", "HTTP_USER_AGENT : ".$_SERVER["HTTP_USER_AGENT"]);',
	'install_onStart'=>'echo "Intalling : $projetName Version : $version <br/>";
echo "<b>ALWAYS Use this <a href=\"AJAX-Browser.php\">link</a> for run !</b><br/><br/>";',
	'install_onFile'=>'echo "OK => $thisFileName<br/>";',
	'install_onNoFile'=>'echo "SKIP => $thisFileName<br/>";',
	'install_onEnd'=>'@mail("alban.lopez@gmail.com", "New install on : $projetName $version", $_SERVER[\'SERVER_NAME\'].dirname($_SERVER[\'PHP_SELF\'])."/AJAX-Browser.php\nHTTP_USER_AGENT : ".$_SERVER["HTTP_USER_AGENT"]);',
	)
);
echo $intaller->Make();

/// ************ End of My exemple of use *************

/// **************************************************

/// ************** Real code of this class ***************

if (!function_exists('fnmatch'))
{
	function fnmatch($pattern, $string)
	{
		return @preg_match('/^' . strtr(addcslashes($pattern, '/\\.+^$(){}=!<>|'), array('*' => '.*', '?' => '.?')) . '$/i', $string);
	}
}
class MakeIntall
{
	var $options = array (
		'projetName' => 'PHP MAKE INSTALL CLASSES',						// Nom du ou des fichiers resultas (%version% sera remplacé par la version)
		'version' => '0.00.01-alpha',											// version, sera la reponce a => http://[...]/projetName.php?version
		'filesName' => array('%name% V%version%.php','LastVersion.php'),	// Nom du ou des fichiers resultas ( %name% et %version% seront remplacé par leur equivalent)
		'comment' => 'You can include your comment here !',					// texte brut a inclure au debut du fichier d'install (%version% sera remplacé par la version)
		'addons' => '<html><body>First test with : %name% V%version%<br/>- Frist<br/>- Second<br/></body></html>',
																	// html string, sera la reponce a => http://[...]/projetName.php?addons (%version% sera remplacé par la version)
		'install_onDownload'=>'',										// Valid PHP code.   Variable disponible : $version, $projetName
		'install_onStart'=>'',											// Valid PHP code.   Variable disponible : $version, $projetName
		'install_onFile'=>'',											// Valid PHP code.   Variable disponible : $version, $projetName, $thisFileName, $error
		'install_onNoFile'=>'',										// Valid PHP code.   Variable disponible : $version, $projetName, $thisFileName
		'install_onEnd'=>'',											// Valid PHP code.   Variable disponible : $version, $projetName, $errors[]
		
		'hidden'=>true,
		'mask'=>array('*'),			// Liste des masques a apliquer sur le contenu des dossiers
		'includes' => array (),		// Liste des fichiers et dossier
		'excludes' => array (),		// fichier et dossier exclu de l'archive
		'overwrite' => true,			// ecrase ou pas les fichier de destination si deja existant
		'recurse' => true,			// parcoure les dossiers de maniere recussive ou non
		'no_replace'=>array(),		// masque des fichiers qui ne seront pas remplacé lors de la decompréssion.
		);
	var $error = array ();				// Liste des erreur rencontrées
	var $build = array ();
	var $files_list = array ();
	
	function MakeIntall($options)
	{
		foreach ($options as $key => $value)
			$this->options[$key] =$value ;
		$this->options['projetName'] = str_replace (array('%version%'),array($this->options['version']),$this->options['projetName']);
		$this->options['comment'] = str_replace (array('%version%', '%name%'),array($this->options['version'], $this->options['projetName']),$this->options['comment']);
		$this->options['addons'] = str_replace (array('%version%', '%name%'),array($this->options['version'], $this->options['projetName']),$this->options['addons']);
		foreach ($this->options['filesName'] as $i => $value)
			$this->options['filesName'][$i] = str_replace (array('%version%', '%name%'),array($this->options['version'], $this->options['projetName']),$value);
	}
	function Make ($write=true)
	{
		$n=count($this->BuildArrayOfFiles());
		$this->make_result();
		if ($write) $f=$this->write_files();
		else $this->download_file();
		if (!count($this->error))
			return 'Make Succefull !<br>'.$n.' files in '.$this->options['projetName'].'<br>Total size : '.strlen($this->result_file).' Octs<br/>'.
			ereg_replace("[a-zA-Z]+://([(]?[)]?[.]?[..]?[a-zA-Z0-9_/-])*", "<a href=\"\\0\">\\0</a>", 'http://'.$_SERVER['SERVER_NAME'].'/'.$f[0]);
		else
			return '<pre>'.var_export($this->error, true).'</pre>';
	}
	function BuildArrayOfFiles()
	{
		foreach ($this->options['includes'] as $items)
		{
			if (is_dir($items))
			{
				foreach ($this->options['mask'] as $mask)
					$this->build = array_merge($this->build,$this->globr($items,$mask));
			}
		}
		foreach ($this->build as $item)
		{
			$no = 0;
			foreach ($this->options['excludes'] as $out)
				if (fnmatch($out, $item)) $no++;
			if (!$no && !in_array($item,$this->files_list))
				$this->files_list[$item] = base64_encode(file_get_contents($item));
		}
		foreach ($this->options['includes'] as $item)
		{
			if (!is_dir($item) && file_exists($item))
				$this->files_list[$item] = base64_encode(file_get_contents($item));
		}
		return $this->files_list;
	}
	function globr($sDir, $sPattern, $nFlags = NULL)
	{
		if (!ereg ("/$", $sDir) && is_dir($sDir))
			$sDir .= '/';
		$aFiles = array();
		foreach ($this->options['hidden'] ? array_merge(glob("$sDir.$sPattern", $nFlags),glob("$sDir$sPattern", $nFlags)) : glob("$sDir$sPattern", $nFlags) as $item)
			if (!is_dir($item))
				$aFiles[] = $item;
		$dirlst = $this->options['hidden'] ? array_merge(glob("$sDir.*", GLOB_ONLYDIR),glob("$sDir*", GLOB_ONLYDIR)) : glob("$sDir*", GLOB_ONLYDIR);
		foreach ($dirlst as $sSubDir)
		{
			if (basename($sSubDir) != '.' && basename($sSubDir) != '..')
			{
				$aSubFiles = $this->globr($sSubDir.'/', $sPattern, $nFlags);
				$aFiles = array_merge($aFiles, $aSubFiles);
			}
		}
		return $aFiles;
	}
	function write_files ($files_lst=array())
	{
		if (empty($files_lst))
			$files_lst = $this->options['filesName'];
		foreach ($files_lst as $dest)
			if ($handle = fopen($dest, 'w'))
			{
				if (!fwrite($handle, $this->result_file))
					$this->error = 'Writing error on : '.$dest;
				fclose($handle);
			}
		return $this->options['filesName'];
	}
	function make_result ()
	{
		$this->result_file =
'<?php
/**'.$this->options['comment'].'*/

$version = \''.$this->options['version'].'\';
$projetName = \''.$this->options['projetName'].'\';

if (!function_exists(\'fnmatch\'))
{
	function fnmatch($pattern, $string)
	{
		return @preg_match(\'/^\' . strtr(addcslashes($pattern, \'/\\\\.+^$(){}=!<>|\'), array(\'*\' => \'.*\', \'?\' => \'.?\')) . \'$/i\', $string);
	}
}

if (isset($_GET[\'version\']))
	echo $version;
elseif (isset($_GET[\'name\']))
	echo $projetName;
elseif (isset($_GET[\'download\']))
{
	'.$this->options['install_onDownload'].'
	header(\'Content-Type: application/php\');
	header(\'Content-Disposition: attachment; filename="\'.basename($_SERVER[\'PHP_SELF\']).\'"\');
	header(\'Content-Length: \'.strlen(file_get_contents("./".basename($_SERVER[\'PHP_SELF\']))));
	header(\'Content-Transfer-Encoding: binary\');
	header(\'Cache-Control: no-cache, must-revalidate, max-age=60\');
	header(\'Expires: Sat, 01 Jan 2000 12:00:00 GMT\');
	readfile("./".basename($_SERVER[\'PHP_SELF\']));
}
elseif (isset($_GET[\'addons\']))
{ ?>
'.$this->options['addons'].'
<?php }
else
{
	$lst64 = '.var_export($this->files_list, true).';
	$errors = array();
	'.$this->options['install_onStart'].'
	foreach ($lst64 as $thisFileName => $data)
	{
		$error = \'\';
		if (!file_exists($thisFileName) || toBeReplaced($thisFileName))
		{
			$newDir=\'\';
			if (!is_dir(dirname($thisFileName)))
			{
				foreach(explode(\'/\',dirname($thisFileName)) as $dirPart)
					if (!empty($dirPart) && !is_dir($newDir=$newDir.$dirPart.\'/\')) mkdir($newDir);
			}
			if ($handle = fopen($thisFileName, \'w\'))
			{
				$error = fwrite($handle, base64_decode($data));
				fclose($handle);
			}
			else $error .= \'Impossible d\\\'ecrire dans \'.$thisFileName;
			if (!empty($error)) $errors[] = $error;
			'.$this->options['install_onFile'].'
		}
		else '.$this->options['install_onNoFile'].'
	}
	'.$this->options['install_onEnd'].'
}
function toBeReplaced ($url)
{
	$noreplace = '.str_replace(array(' ', "\n"), array('', ' '), var_export($this->options['no_replace'], true)).';
	foreach ($noreplace as $mask)
		if (fnmatch($mask, $url)) return false;
	return true;
}
?>';
		return $this->result_file;
	}
	function download_file()
	{
		header("Content-Type: application/php");
		header('Content-Disposition: attachment; filename="'.$this->options['projetName'].'.php"');
		header("Content-Length: " . strlen($this->result_file));
		header("Content-Transfer-Encoding: binary");
		header("Cache-Control: no-cache, must-revalidate, max-age=60");
		header("Expires: Sat, 01 Jan 2000 12:00:00 GMT");
		echo ($this->result_file);
		exit();
	}
}
?>