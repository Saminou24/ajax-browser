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

foreach($_POST as $key=>$val)
	${$key}=$val;
foreach($_GET as $key=>$val)
	${$key}=$val;

$InstallDir = './AJAX-B/';

require ($InstallDir . 'scripts/PHPTools.php');
require ($InstallDir . 'scripts/ExploreTools.php');
require ($InstallDir . 'scripts/ArchiveTools.php');

// require ($InstallDir . 'Language.php');

require ($InstallDir . 'scripts/SessionTools.php');
require ($InstallDir . 'scripts/ManageSuperGlobales.php');

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
?>

