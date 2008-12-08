<html style="padding:0px;margin:0px;">
<body>
<?php
// script inspired by Evrard Ludovic (Web-Creator.be) 2008

// 	ini_set('upload_tmp_dir','./'); //    * upload_tmp_dir
// 	ini_set('file_uploads','true'); //    * file_uploads
// 	ini_set('max_execution_time','3600'); //    * max_execution_time
// 	ini_set('max_input_time','3600'); //    * max_input_time
// 	ini_set('memory_limit','1044M'); //    * memory_limit
// 	ini_set('post_max_size','1034M'); //    * post_max_size
// 	ini_set('upload_max_filesize','1024M'); //    * upload_max_filesize

if($_POST['send'] == 'true')
{
	$img = INSTAL_DIR."icones/CloseX.png";
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
						if ($_SESSION['AJAX-B']['spy']['action'])
						{
							file_put_contents ($_SESSION['AJAX-B']['spy_dir'].'/upload.spy', $_SESSION['AJAX-B']['login'].' ['.date ("d/m/y H:i:s",time()).'] > '.$DestFile.' ('.SizeConvert(filesize ($DestFile)).")\n", FILE_APPEND);
						}
						$title = $DestFile.' > Complet ('.SizeConvert(filesize ($DestFile)).')';
						$img = INSTAL_DIR."icones/Download.png";
						$ok="parent.document.getElementById('send'+parent.f).value = 'false';";
					}
					else $title = $ABS[801].$DestFile." - ".$ABS[802].' '.decode64($dest);
				}
				else $title = $ABS[803];
			}
			else $title = $ABS[804]." : ".$_FILES['file']['name'];
		}
		else $title = $ABS[805];
	}
?>
	<script language="JavaScript" type="text/javascript">
	parent.document.getElementById('file'+parent.f).src="<?php echo $img;?>";
	parent.document.getElementById('file'+parent.f).title="<?php echo $title;?>";
	parent.document.getElementById('progress1').style.width=Math.round((parent.f)/(parent.i-1)*100)+"%";
	parent.document.getElementById('box').innerHTML = Math.round((parent.f)/(parent.i-1)*100) + "%";
	<?php echo $ok;?>
	(parent.f)++;
	parent.jsUpload();
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
		font-size:12px;
		padding:0px;margin:0px;border:0px;
		background-image: url("http://ajaxbrowser.free.fr/logo.png");
		background-position: bottom right;
		background-repeat:no-repeat;
	}
	div {
		font-size:12px;
		font-family:sans-serif;
		padding:3px 0px;
		margin:0px;
	}
	span {
		font-size:12px;
		font-family:sans-serif;
		padding:0px;
		margin:0px;
	}
	.barre {
		border-top:1px solid gray;
		border-bottom:1px solid gray;
		padding:0px;
		margin:0px;
		width:100%;
	}
	.progress{
 		background-color:rgb(120,130,255);
		border-spacing:0px;
		padding:3px 0px;
		margin:1px 0px;
		width:0%;
	}
	table, tr {
		font-size:12px;
		width:100%;
	}
	button, form, input {
		padding:0px;
		margin:0px;
		text-align:center;
	}
	td {
		font-size:12px;
		vertical-align:middle;
		padding:0px;
		margin:0px;
	}
	}
	.center{
		text-align:center;
		width:100%;
	}
	img {
		padding:0px;
		margin:0px 0px -3px 0px;
		cursor:pointer;
	}
	.zero {
		padding:0px;
		margin:0px;
		border:0px;
	}
	#waitFile {
		margin:5px;
	}
	</style>
<span class='center'><?php echo decode64($dest);?></span>
<div class='barre'><div id='progress1' class='progress'></div></div>
<table>
<colgroup> <col width='50%'><col width='50%'></colgroup>
<tbody>
	<tr class="green">
		<td>
			<div id="waitFile">
			</div>
		</td>
		<td id='box' class='center'>
		</td>
	</tr>
	<tr>
		<td colspan=2>
			<hr />
		</td>
	</tr>
	<tr>
		<td id="uploadContent">
		</td>
		<td style="text-align:center;" id="action">
			<= <?php echo $ABS[807];?>
		</td>
	</tr>
</tbody>
</table>
<div id='iframe'></div>
<?php
}
?>
</body>
<script language="JavaScript" type="text/javascript">

var dest = "<?php echo $dest;?>";
var i = 1;
var f = 1;
createNewUpload();

function createNewUpload()
{
	document.getElementById('iframe').innerHTML += '<iframe class="zero" frameborder="0" height="15" width="100%" style="display:none;" id="iframe'+i+'" name="iframe'+i+'"></iframe>';
	newform=document.createElement("div");
	newform.setAttribute("id", "uploadContent"+i);
	newform.setAttribute("title", "");
	newform.setAttribute("class", "zero");
	document.getElementById('uploadContent').appendChild(newform);
	document.getElementById('uploadContent'+i).innerHTML = '<form action="" id="form'+i+'" method="post" target="iframe'+i+'" enctype="multipart/form-data"><input type="hidden" id="dest" name="dest" value="'+dest+'" /><input type="hidden" name="send" id="send'+i+'" value="true" /><input type="file" name="file" id="file" onChange="i++;AddWait(this);createNewUpload();" /></form>';
}
function AddWait (ptrThis)
{
	if (ptrThis.value != undefined)
	{
		ptrThis.parentNode.style.display='none';
		document.getElementById('waitFile').innerHTML += '<IMG id="file'+(i-1)+'" num="'+(i-1)+'" onclick="toggle('+(i-1)+');" value="'+ptrThis.value+'" src="<?php echo INSTAL_DIR; ?>icones/Upload.png" title="<?php echo $ABS[206];?>"/> - '+ptrThis.value+'<br>';
	}
	document.getElementById('action').innerHTML = '<button onclick="jsUpload();"><?php echo $ABS[806];?></button><button onclick="location.href=location.href;"><?php echo $ABS[40];?></button>';
}
function toggle (num)
{
	sendPtr=document.getElementById('send'+num);
	if (sendPtr.value=="true")
	{
		sendPtr.value = false;
		document.getElementById('file'+num).src="<?php echo INSTAL_DIR;?>icones/Sup.png";
	}
	else
	{
		sendPtr.value = true;
		document.getElementById('file'+num).src="<?php echo INSTAL_DIR;?>icones/Upload.png";
	}
}
function jsUpload ()
{
	while (document.getElementById('send'+f).value != "true" && f<i)
	{
		f++;
	}
	if (document.getElementById('form'+f) && document.getElementById('file'+(f)))
	{
		pct = Math.round((f-0.5)/(i-1)*100)+"%";
		document.getElementById('progress1').style.width = pct;
		document.getElementById('box').innerHTML = pct;
		document.getElementById('file'+(f)).src="<?php echo INSTAL_DIR; ?>icones/Loading.gif";
		document.getElementById('form'+f).submit();
	}
	else
	{
		document.getElementById('progress1').style.width="100%";
		document.getElementById('box').innerHTML = "100%";
		f=1;
	}
}
</script>
</html>