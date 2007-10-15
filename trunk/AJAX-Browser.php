<?php
/**-------------------------------------------------
 | AJAX-Browser  -  by Alban LOPEZ
 | Copyright (c) 2007 Alban LOPEZ
 | Email bugs/suggestions to alban.lopez@gmail.com
 +--------------------------------------------------
 | This script has been created and released under
 | the GNU GPL and is free to use and redistribute
 | only if this copyright statement is not removed
 +--------------------------------------------------*/
/*chown(,);
chgrp(,);
chmod(,);
*/
foreach($_POST as $key=>$val)
	${$key}=$val;
foreach($_GET as $key=>$val)
	${$key}=$val;

$version="0.9.26-Improve_Archves_method";

$InstallDir = './AJAX-B/'; // define("INSTALL_DIR", "./AJAX-B/");

require ($InstallDir . 'scripts/PHPTools.php');		// always loaded
require ($InstallDir . 'scripts/ExploreTools.php');	// always loaded
	require ($InstallDir . 'Language.php');			// always loaded
require ($InstallDir . 'scripts/SessionTools.php');	// always loaded

if (isset($_SESSION['AJAX-B']['language_file']) && is_file($InstallDir . $_SESSION['AJAX-B']['language_file']))
	require ($InstallDir . $_SESSION['AJAX-B']['language_file']);

$StartPhpScripte = microtime_float();

if (strpos($mode,'request')!==false)
{
	require ($InstallDir . 'scripts/Command.php');
	exit();
}
else
{
	if (strpos($mode,'gallerie')!==false)
	{
		$ChangeMode=array('current'=>'gallerie','next'=>'arborescence', 'change'=>$ABS[12]);
		require ($InstallDir . 'scripts/InitHTML.php');
		require ($InstallDir . 'scripts/GallerieAddon.php');
		require ($InstallDir . 'scripts/Gallerie.php');
	}
	elseif (strpos($mode,'arborescence')!==false)
	{
		$ChangeMode=array('current'=>'arborescence','next'=>'gallerie', 'change'=>$ABS[13]);
		require ($InstallDir . 'scripts/InitHTML.php');
		require ($InstallDir . 'scripts/ArborescenceAddon.php');
		require ($InstallDir . 'scripts/Arborescence.php');
	}
	else exit ();
	require ($InstallDir . 'scripts/CloseHTML.php');
}
if (is_file('./MakeInstallClass.php'))
{?>
<a class="bottomleft" href="./MakeInstallClass.php?version=<? echo $version;?>">NewSave V<?echo $version;?></a>
<a class="bottomleft" href="https://www.google.com/analytics/home/?hl=fr">stat google</a>
<?php } ?>