<html style="padding:0px;margin:0px;">
<?php
/*
	ini_set('upload_tmp_dir','./'); //    * upload_tmp_dir
	ini_set('file_uploads','true'); //    * file_uploads
	ini_set('max_execution_time','3600'); //    * max_execution_time
	ini_set('max_input_time','3600'); //    * max_input_time
	ini_set('memory_limit','1044M'); //    * memory_limit
	ini_set('post_max_size','1034M'); //    * post_max_size
	ini_set('upload_max_filesize','1024M'); //    * upload_max_filesize
*/
if (!empty($_FILES))
{
	echo '<body style="font-size:10px;padding:0px;margin:0px;" onload="top.RequestLoad(\''.$dest.'\',true);">';
	if (!empty($_FILES['aFile']))
	{
		if (!$Error)
		{
			if ((ArrayMatch($_SESSION['AJAX-B']['always_mask'],$_FILES['aFile']['name'] ) && $_SESSION['AJAX-B']['droits']['UPLOAD']=='OnlyAlways')
			 || (!ArrayMatch($_SESSION['AJAX-B']['restrict_mask'], $_FILES['aFile']['name']) && $_SESSION['AJAX-B']['droits']['UPLOAD']=='ExceptRestrict')
			 ||  $_SESSION['AJAX-B']['droits']['UPLOAD']=='ALL')
			{
				$DestFile = decode64($dest).$_FILES['aFile']['name'];
				move_uploaded_file($_FILES['aFile']['tmp_name'], $DestFile);
				if (empty($_SESSION['AJAX-B']['upload_tmp_dir']) || is_file($_FILES['aFile']['tmp_name']))
					$_SESSION['AJAX-B']['upload_tmp_dir'] = $GLOBALS['AJAX-Var']['global']['upload_tmp_dir'] = dirname($_FILES['aFile']['tmp_name']).'/';
				file_put_contents($file_globalconf, var_export($GLOBALS['AJAX-Var']['global'], true));
				if (is_file($DestFile))
				{
					echo $DestFile.' > Complet ('.SizeConvert(filesize ($DestFile)).')<br>';
					if ($_SESSION['AJAX-B']['spy']['action'])
						file_put_contents ($_SESSION['AJAX-B']['spy_dir'].'/upload.spy', $_SESSION['AJAX-B']['login'].' ['.date ("d/m/y H:i:s",time()).'] > '.$DestFile.' ('.SizeConvert(filesize ($DestFile)).")\n", FILE_APPEND);
				}
				else
					echo $ABS[801].$_FILES['aFile']['name']."<br>".$ABS[802].' '.$dest;
			}
			else echo  $ABS[803];
		}
		else echo $ABS[804]." : \"".$DestFile."\"<br />";
	}
	else echo $ABS[805];
}
elseif ($upload == 'progress')
{
	if (!empty($_SESSION['AJAX-B']['upload_tmp_dir']) && is_dir($_SESSION['AJAX-B']['upload_tmp_dir']))
	{
		$size = 0;
		$lst = glob ($_SESSION['AJAX-B']['upload_tmp_dir'].'php*');
		foreach ($lst as $file)
			$size += filesize ($file);
		echo microtime(true)."\t".$size;
	}
}
else
{
echo '	<body style="font-size:10px;padding:0px;margin:0px;"><img src="'.$InstallDir.'icones/loader-2.gif" style="display:none;">
		<form METHOD="post" action="" enctype="multipart/form-data" style="padding:0px;margin:0px;">
			<input type="hidden" name="dest" value="'.$dest.'">
			<input type="file" name="aFile" style="text-align:center;margin-top:1px;" onchange="this.parentNode.parentNode.firstChild.style.display=\'block\';this.parentNode.submit();">
		</form>';
}
?>
	</body>
</html>