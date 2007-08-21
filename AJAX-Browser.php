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

require ('./.AJAX-B/Language.php');
require ('./.AJAX-B/scripts/PHPTools.php');
require ('./.AJAX-B/scripts/ExploreTools.php');
require ('./.AJAX-B/scripts/ArchiveTools.php');
require ('./.AJAX-B/scripts/SessionTools.php');
require ('./.AJAX-B/scripts/ManageSuperGlobales.php');

$StartPhpScripte = microtime_float();

if (strpos($mode,'request')!==false)
{
	require ('./.AJAX-B/scripts/Command.php');
	exit();
}
else
{
	if (strpos($mode,'gallerie')!==false)
	{
		$ChangeMode=array('current'=>'gallerie','next'=>'arborescence', 'change'=>$ABS[12]);
		require ('./.AJAX-B/scripts/InitHTML.php');
		require ('./.AJAX-B/scripts/GallerieAddon.php');
		require ('./.AJAX-B/scripts/Gallerie.php');
	}
	elseif (strpos($mode,'arborescence')!==false)
	{
		$ChangeMode=array('current'=>'arborescence','next'=>'gallerie', 'change'=>$ABS[13]);
		require ('./.AJAX-B/scripts/InitHTML.php');
		require ('./.AJAX-B/scripts/ArborescenceAddon.php');
		require ('./.AJAX-B/scripts/Arborescence.php');
	}
	else exit ();
	require ('./.AJAX-B/scripts/CloseHTML.php');
}
?>