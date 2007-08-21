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
				if (is_file($DestFile))
				{
					echo $DestFile.' » Complet ('.SizeConvert(filesize ($DestFile)).')<br>';
					if ($_SESSION['AJAX-B']['spy']['action'])
						WriteInFile ($_SESSION['AJAX-B']['spy_dir'].'/upload.spy', $_SESSION['AJAX-B']['login'].' ['.date ("d/m/y H:i:s",time()).'] » '.$DestFile.' ('.SizeConvert(filesize ($DestFile)).")\n", "add");
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
else
{
echo '	<body style="font-size:10px;padding:0px;margin:0px;">
		<form METHOD="post" action="" enctype="multipart/form-data" style="padding:0px;margin:0px;">
			<input type="hidden" name="dest" value="'.$dest.'">
			<input type="file" name="aFile" style="text-align:center;margin-top:1px;" onchange="this.parentNode.submit();">
		</form>';
}
/*function subirFichero($origen, $destinoDir, $ftemporal)
{
	$origen = strtolower(basename($origen));
	$destinoFull = $destinoDir.$origen;
	$frand = $origen;
	$i = 1;
	while (file_exists( $destinoFull ))
	{
		$file_name = substr($origen, 0, strlen($origen)-4);
		$file_extension = substr($origen, strlen($origen)-4, strlen($origen));
		$frand = $file_name."[$i]".$file_extension;
		$destinoFull = $destinoDir.$frand;
		$i++;
	}
	if (move_uploaded_file($ftemporal, $destinoFull))
		return $frand;
	else
		return "0";
}*/
/*function NewFile($New,$mode=false) // NewFile($New,($_SESSION['level']>2?true:false))
{
	list($folder,$file,$ext) = array_values(pathinfo($New));
	if(strlen($ext))
	{
		$ext = ".".$ext;
		$file = substr($file,0,strlen($file)-strlen($ext));
	}
	if ($mode && file_exists($OldName = $folder."/".$file.$Count.$ext))
	{
		rename($OldName,$Old = NewFile($folder."/".$file." - Old".$ext)); // l'ancien fichier est renomé (conservation de meta-données)
		copy($Old,$OldName); // mais il est aussi restitué sous sont non d'orrigine pour les cas ou il est utilisé comme source
		return $New;
	}
	$Count = "";
	while (file_exists($NewName = $folder."/".$file.$Count.$ext))
	{
		$NewName;
		$Count++ ;
	}
	return $NewName;
}*/
?>
	</body>
</html>