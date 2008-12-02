<html style="padding:0px;margin:0px;">
<body>
<?php
// script by Evrard Ludovic (Web-Creator.be) 2008

// 	ini_set('upload_tmp_dir','./'); //    * upload_tmp_dir
// 	ini_set('file_uploads','true'); //    * file_uploads
// 	ini_set('max_execution_time','3600'); //    * max_execution_time
// 	ini_set('max_input_time','3600'); //    * max_input_time
// 	ini_set('memory_limit','1044M'); //    * memory_limit
// 	ini_set('post_max_size','1034M'); //    * post_max_size
// 	ini_set('upload_max_filesize','1024M'); //    * upload_max_filesize

if($_POST['send'] == 'true')
{
	print_r($_FILES);
	if (!empty($_FILES))
	{
		if (!empty($_FILES['file']))
		{
			if (!$_FILES['file']['error'])
			{
				if (FileTypeApprover($_FILES['file']['name']))
				{
					$DestFile = decode64($dest).$_FILES['file']['name'];
					if (move_uploaded_file($_FILES['file']['tmp_name'], $DestFile))
					{
						echo $DestFile.' > Complet ('.SizeConvert(filesize ($DestFile)).')<br>';
						if ($_SESSION['AJAX-B']['spy']['action'])
						      file_put_contents ($_SESSION['AJAX-B']['spy_dir'].'/upload.spy', $_SESSION['AJAX-B']['login'].' ['.date ("d/m/y H:i:s",time()).'] > '.$DestFile.' ('.SizeConvert(filesize ($DestFile)).")\n", FILE_APPEND);
					}
					else echo $ABS[801].$DestFile."<br>".$ABS[802].' '.decode64($dest)."<br />";
				}
				else echo $ABS[803]."<br />";
			}
			else echo $ABS[804]." : \"".$_FILES['file']['name']."\"<br />";
		}
		else echo $ABS[805]."<br />";
	}
?>
	<script language="JavaScript" type="text/javascript">
	var parDoc = window.parent.document;
	var par = parent;
	var next = par.alreadySend+1;
// 	alert(par.currentFile.length);
	if(par.currentFile.length != par.alreadySend)
	{
		par.jsUpload(next);
// 		alert('Encore...');
	}
	else
	{
		parDoc.getElementById("uploadMessage").innerHTML = "T&eacute;l&eacute;chargement termin&eacute;";
// 		parDoc.getElementById("titleWaitFile").display = 'none';
		parDoc.getElementById("waitFile").display = 'none';
		par.deleteUpload('parent1');
	}
// 	delete par.currentDisplayFile[0];
	par.currentDisplayFile.splice(0,1);
	par.modifyDisplayWait();
	</script>
<?php
	exit();
}
else
{
?>
	<style>
	BODY {
		width:100%;height:100%;
		padding:0px;margin:0px;border:0px;
		background-image: url("http://ajaxbrowser.free.fr/logo.png");
		background-position: bottom right;
		background-repeat:no-repeat;}
	div {
/* 		width:100%; */
	}
	.ChoseBox {
/* 		display:none; */
		margin: 0px;
		padding: 2px 5px;
/* 		width:100%; */
/* 		border : solid gray 1px; */
/* 		background: rgb(220,230,255); */
	}
	.ChoseBox over {
/* 		background: rgb(220,230,255); */
	}
	#barre {
		background-color:rgb(220,230,255);
		border-top:1px solid gray;
		border-bottom:1px solid gray;
		border-spacing:0px;
		padding:2px;
		margin:0px 0px;
		width:100%;
	}
	table {
		width:100%;
	}
	.box {
		background-color:rgb(230,250,210);
		border:1px solid gray;
		
	}
	</style>
<br>
<div id='barre'></div>



<table>
<colgroup> <col width='50%'><col width='50%'><col></colgroup>
<tbody>
	<tr>
		<td>
<h3 class="ChoseBox" id="titleWaitFile">h3</h3>
<div id="waitFile">
</div>
		</td>
		<td class='box'>
		</td>
	</tr>
	<tr>
		<td>
	<div id="uploadContent">
		<span class="ChoseBox" id="uploadMessage">T&eacute;l&eacute;chargement en cours</span>
		<span id="parent1">chargement</span>
	</div>
			
		</td>
		<td>
			<button href="javascript:jsUpload(1);"><?php echo $ABS[806];?></button>
		</td>
	</tr>
</tbody>
</table>



	<script type="text/javascript" src="<?php echo INSTAL_DIR; ?>scripts/Dom-Upload.js"></script>
	<IMG src="<?php echo INSTAL_DIR; ?>icones/Download.png" title="<?php echo $ABS[204];?>"/>
	<IMG src="<?php echo INSTAL_DIR; ?>icones/Upload.png" title="<?php echo $ABS[206];?>"/>
<?php
}
?>

</body>
</html>


<?php
// 
// echo '<body style="font-size:10px;padding:0px;margin:0px;" onload=""><img src="'.INSTAL_DIR.'icones/loader-2.gif" style="display:none;">';
// if (!empty($_FILES))
// {
// }
// if (isset($ultradownload) && strpos($ultradownload, '://')!=0)
// {
// 	echo $GetFile = $ultradownload;
// 	echo $start = microtime_float();
// 	$New = file_get_contents($GetFile);
// 	file_put_contents (decode64($dest).UTF8basename($GetFile), $New);
// 	$end = microtime_float();
// 	if (is_file($New))
// 	{
// 		echo SizeConvert(filesize($version)).' > '.$end-$start." sec\n";
// 		if ($_SESSION['AJAX-B']['spy']['action'] && filesize(decode64($dest).UTF8basename($GetFile)) == strlen($New))
// 			file_put_contents ($_SESSION['AJAX-B']['spy_dir'].'/ultraDownload.spy', $_SESSION['AJAX-B']['login'].' ['.date ("d/m/y H:i:s",time()).'] > '.$GetFile.' > '.SizeConvert(filesize($New)).' > '.$end-$start." sec\n", FILE_APPEND);
// 	}
// }
// else
// {
// 	echo $ABS[804]." : \"".$_FILES['aFile']['name']."\"<br />";
// }
// echo "Destination : ".decode64($dest)." ";?>
<!--		<form METHOD="post" action="" enctype="multipart/form-data" style="padding:0px;margin:0px;">
			<input type="hidden" name="dest" value="< ?php echo $dest;?>">
			<label>Ultra Download (Web to Web)</label><br/>
			<input type="input" name="ultradownload" value=""><input type="submit" onclick="this.parentNode.parentNode.firstChild.style.display='block';this.parentNode.style.display='none';" value="<?php echo $ABS[10];?>"><br/>
		</form>
		<form METHOD="post" action="" enctype="multipart/form-data" style="padding:0px;margin:0px;">
			<input type="hidden" name="dest" value="< ?php echo $dest;?>">
			<label>Upload (Your file to Web)</label><br/>
			<input type="file" name="aFile" style="" onchange="this.parentNode.parentNode.firstChild.style.display='block';this.parentNode.style.display='none';this.parentNode.submit();">
		</form>
	</body>
</html>-->