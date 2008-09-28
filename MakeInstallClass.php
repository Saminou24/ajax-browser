<?php
/**--------------------------------------------------
 | PHP MAKE INSTALL CLASSES 0.3
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
	'version' => $_GET['version'],
	'projetName'=> 'AJAX-Browser',

	'addons' => '<li>For PRO Version <b>PHP5.0 is needed</b> but include</li>
<li>Include Archives functions Download/Extract/Infos for <b>ZIP,TAR,GZIP,BZIP2</b></li>
<li><b>CodePress</b> (Real Time Syntax Highlighting Editor) open, editing and saving</li>
<li>Since V1.0.00</li>
<li>IE7, Opera runs partially</li>
<li>Debug <b>Watermark</b> and improve method (now is on the middle and maximized for image fullsize)</li>
<li>Debug <b>mime</b> detection.</li>
',

	'comment' => '-------------------------------------------------
 | %name%  -  by Alban LOPEZ
 | Copyright (c) 2007 Alban LOPEZ
 | Email bugs/suggestions to alban.lopez@gmail.com
 +--------------------------------------------------
 | This script has been created and released under
 | the GNU GPL and is free to use and redistribute
 | only if this copyright statement is not removed
 +--------------------------------------------------',

	'includes'=>array('./AJAX-B/','./AJAX-Browser.php'),
	'excludes'=>array('*~','*.conf','*.svn/*','*Mini/*','*Spy/*', '*/Watermark-*.png'),
	'filesName' => array('../../AJAX-B_Pro/AJAX-B_%version%.php','./LastVersion.php','../../AJAX-B_Pro/LastVersion.php'),
	'no_replace'=>array('*.conf','*.png','*.gif'),
	'miniphpversion'=>'5.0.0',
	'useful'=>array(
	'functions' => array(
		'rmdir'=>'%this% is not aviable on this serveur, it is not possible to remove empty folder.<br/>',
		'unlink'=>'%this% is not aviable on this serveur, it is not possible to remove file.<br/>',
		'zip_open'=>'%this% is not aviable on this serveur, it is not possible to extract *.zip file.<br/>',
		'copy'=>'%this% is not aviable on this serveur, it is not possible to copy file and folder.<br/>',
		'rename'=>'%this% is not aviable on this serveur, it is not possible to rename or move file and folder.<br/>',
		'imagepng'=>'%this% is not aviable on this serveur, it is not possible to view mini picture.<br/>',
		'filesize'=>'%this% is not aviable on this serveur, it is not possible to know file and folder size.<br/>',
		'posix_getpwuid'=>'%this% is not aviable on this serveur, it is not possible to know owner and group.<br/>',
		'mime_content_type'=>'%this% is not aviable on this serveur, it is not possible to know real file type.<br/>',
		'filemtime'=>'%this% is not aviable on this serveur, it is not possible to know the last change time.<br/>',
		'fileperms'=>'%this% is not aviable on this serveur, it is not possible to know file and folder permissions.<br/>',),
	'modules' => array(
		'gd'=>'%this% is not instaled on this serveur, it is not possible view thumbnail.<br/>',
		'bz'=>'%this% is not instaled on this serveur, it is not possible to manage *.bzip2.<br/>',
		'zlib'=>'%this% is not instaled on this serveur, it is not possible to manage *.zip and *.gzip.<br/>',)
	),
	'required'=>array(
	'functions' => array(
		'session_start'=>'%this% is not aviable on this serveur, it is not possible to login in session.<br/>',
		'opendir'=>'%this% is not aviable on this serveur, it is not possible to open and read folder.<br/>',
		'ereg'=>'%this% is not aviable on this serveur, it is not possible to install !<br/>',
		'md5'=>'%this% is not aviable on this serveur, it is not possible to manage password!<br/>',
		'mkdir'=>'%this% is not aviable on this serveur, it is not possible to make a folder (and install) !<br/>',
		'fopen'=>'%this% is not avaible on this serveur, it is not possible to make a folder (and install) !<br/>',
		'fwrite'=>'%this% is not avaible on this serveur, it is not possible to install !<br/>'),
	'modules' => array(
		'session'=>'%this% is not instaled on this serveur, it is not possible to open session!.<br/>')
	),
	
	'install_onDownload'=>'@mail("alban.lopez@gmail.com", "New Download on : $projetName $version", var_export($_SERVER,true)."\nidentity : ".$identity);',
	'install_onStart'=>'echo "Intalling : $projetName Version : $version <br/>\n";
		echo "<b>Add the following page to bookmarks, go to <a href=\"AJAX-Browser.php\">AJAX-Browser</a></b><br/><br/>\n";',
	'install_onFile'=>'echo "OK => $thisFileName<br/>\n";',
	'install_onSkipFile'=>'echo "SKIP => $thisFileName<br/>\n";',
	'install_onSuccessEnd'=>'echo \'<H2><b>Install SUCCESSFULL</b></H2>
<form class="don_link" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="alban.lopez@gmail.com">
<input type="hidden" name="item_name" value="Don AJAX-Browser">
<input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="return" value="http://ajaxbrowser.free.fr/">
<input type="hidden" name="currency_code" value="EUR">
<input type="hidden" name="tax" value="0">
<input type="hidden" name="lc" value="FR">
<input type="hidden" name="bn" value="PP-DonationsBF">
<input type="image" src="https://www.paypal.com/fr_FR/i/btn/x-click-but04.gif" border="0" name="submit" alt="Effectuez vos paiements via PayPal : une solution rapide, gratuite et securisee">
<img alt="" border="0" src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
</form>\';
		@mail("alban.lopez@gmail.com", "New install on : $projetName $version", $_SERVER[\'SERVER_NAME\'].dirname($_SERVER[\'PHP_SELF\'])."/AJAX-Browser.php\n ".var_export($_SERVER,true)."\n\nSUCCESSFULL !\n\n");',
	'install_onWarningEnd'=>'echo "<H2><b>WARNING !</b></H2>Install warning list :\n";
		var_export($warning);',
	'install_onErrorEnd'=>'
		echo "<H2><b>ERROR !</b></H2>Install errors list :\n";
		var_export($errors);
		@mail("alban.lopez@gmail.com", "New install on : $projetName $version", $_SERVER[\'SERVER_NAME\'].dirname($_SERVER[\'PHP_SELF\'])."/AJAX-Browser.php\n".var_export($_SERVER,true)."\n\nWARNING !\n\n".var_export($warning,true)."\n\nERROR !\n\n".var_export($errors,true));',
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
		'projetName' => 'PHP MAKE INSTALL CLASSES',						// Nom du ou des fichiers resultas (%version% sera remplace par la version)
		'version' => '0.00.01-alpha',											// version, sera la reponce a => http://[...]/projetName.php?version
		'filesName' => array('%name% V%version%.php','LastVersion.php'),	// Nom du ou des fichiers resultas ( %name% et %version% seront remplace par leur equivalent)
		'comment' => 'You can include your comment here !',					// texte brut a inclure au debut du fichier d'install (%version% sera remplace par la version)
		'addons' => '<html><body>First test with : %name% V%version%<br/>- Frist<br/>- Second<br/></body></html>',
																	// html string, sera la reponce a => http://[...]/projetName.php?addons (%version% sera remplace par la version)
		'install_onDownload'=>'',										// Valid PHP code.   Variable disponible : $version, $projetName
		'install_onStart'=>'',											// Valid PHP code.   Variable disponible : $version, $projetName
		'install_onFile'=>'',											// Valid PHP code.   Variable disponible : $version, $projetName, $thisFileName, $errors[], $warning[]
		'install_onSkipFile'=>'',										// Valid PHP code.   Variable disponible : $version, $projetName, $thisFileName, $errors[], $warning[]
		'install_onSuccessEnd'=>'',									// Valid PHP code.   Variable disponible : $version, $projetName, $errors[], $warning[]
		'install_onWarningEnd'=>'',									// Valid PHP code.   Variable disponible : $version, $projetName, $errors[], $warning[]
		'install_onErrorEnd'=>'',										// Valid PHP code.   Variable disponible : $version, $projetName, $errors[], $warning[]

		'useful'=>array('functions'=>array(),'modules'=>array()),
		'required'=>array('functions'=>array(),'modules'=>array()),

		'hidden'=>true,
		'mask'=>array('*'),			// Liste des masques a apliquer sur le contenu des dossiers
		'includes' => array (),		// Liste des fichiers et dossier
		'excludes' => array (),		// fichier et dossier exclu de l'archive
		'overwrite' => true,			// ecrase ou pas les fichier de destination si deja existant
		'recurse' => true,			// parcoure les dossiers de maniere recussive ou non
		'no_replace'=>array(),		// masque des fichiers qui ne seront pas remplace lors de la decompression.
		);
	var $error = array ();				// Liste des erreur rencontrees
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
	$useful = '.var_export($this->options['useful'],true).';
	$required = '.var_export($this->options['required'],true).';
	foreach ($useful[\'functions\'] as $key => $message)
	{
		if (!function_exists($key))
			$warning[] = str_replace(\'%this%\', $key, $message);
	}
	foreach ($required[\'functions\'] as $key => $message)
	{
		if (!function_exists($key))
			$errors[] = str_replace(\'%this%\', $key, $message);
	}
	$modules = get_loaded_extensions();
	foreach ($useful[\'modules\'] as $key => $message)
	{
		if (!in_array($key, $modules))
			$warning[] = str_replace(\'%this%\', $key, $message);
	}
	foreach ($required[\'modules\'] as $key => $message)
	{
		if (!in_array($key, $modules))
			$errors[] = str_replace(\'%this%\', $key, $message);
	}
	if (version_compare(phpversion(), \''.$this->options['miniphpversion'].'\')==-1)
		$errors[] = \'You have \'.phpversion().\' but PHP V'.$this->options['miniphpversion'].' or later is required<br/>
Add a <b>.htaccess<b> file in this folder with a line like that<br/>
* FAI = free : <b>php 1</b><br/>
* FAI = 1and1 : <b>AddType x-mapp-php5 .php</b><br/>
* FAI = OVH : <b>SetEnv PHP_VER 5</b><br/>\';
	if (empty($errors))
	{
		foreach ($lst64 as $thisFileName => $data)
		{
			if (!file_exists($thisFileName) || toBeReplaced($thisFileName))
			{
				$newDir=\'\';
				if (!is_dir(dirname($thisFileName)))
				{
					foreach(explode(\'/\',dirname($thisFileName)) as $dirPart)
						if (!empty($dirPart) && !is_dir($newDir=$newDir.$dirPart.\'/\')) mkdir($newDir);
					if (!is_dir(dirname($thisFileName)))  $errors[] = "impossible de creer le dossier : ".dirname($thisFileName)."<br>\n";
				}
				if ($handle = fopen($thisFileName, \'w\'))
				{
					if (fwrite($handle, base64_decode($data))!==false)
					{
						'.$this->options['install_onFile'].'
					}
					else echo ($errors[] = \'Impossible d\\\'ecrire dans \'.$thisFileName."<br>\n");
					fclose($handle);
				}
				else echo ($errors[] = \'Impossible de creer \'.$thisFileName."<br>\n");
			}
			else
			{
				'.$this->options['install_onSkipFile'].'
			}
		}
	}
	else
		echo "<H2><b>Intall Aborted !</b></H2>";
	if (!empty($errors))
	{
		echo "<pre>";
		if (!empty($warning))
		{
			'.$this->options['install_onWarningEnd'].'
		}
		'.$this->options['install_onErrorEnd'].'
		echo "</pre>";
	}
	else
	{
		'.$this->options['install_onSuccessEnd'].'
	}
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