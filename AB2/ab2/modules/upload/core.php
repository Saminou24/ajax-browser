<html style="padding:0px;margin:0px;">
<body>
<?php
function SizeConvert ($Size)
{
	if ($Size<0) return '-';
	$UnitArray = array('Oct','Ko','Mo','Go','To');
	$Unit=0;
	while ($Size/pow(1024, $Unit)>1024) $Unit++;
	return round($Size/pow(1024, $Unit), $Unit).' '.$UnitArray[$Unit];
}
if($_POST['send'] == 'true')
{
echo 'toto';
	$img = "../../pics/CloseX.png";
	if (!empty($_FILES))
	{
		if (!empty($_FILES['file']))
		{
			if (!$_FILES['file']['error'])
			{
//				if (FileTypeApprover($_FILES['file']['name']))
//				{
					$DestFile = $_GET['dest'].'/'.$_FILES['file']['name'];
					if (move_uploaded_file($_FILES['file']['tmp_name'], $DestFile))
					{
						$title = $DestFile.' > Complet ('.SizeConvert(filesize ($DestFile)).')';
						$img = "../../pics/Download.png";
						$ok="parent.document.getElementById('send'+parent.f).value = 'false';";
					}
					else $title = 'Une erreur s´est produite sur '.$DestFile." - ".'Verifier les droits d´écriture de '.' '.$_GET['dest'];
//				}
//				else $title = 'Ce type de fichier ne vous est pas autorisé à l´upload.';
			}
			else $title = 'Erreur'.$_FILES['file']['error'].', fichier non reçu'." : ".$_FILES['file']['name'];
		}
		else $title = 'Aucun fichier uploadé';
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
	<link type="text/css" rel="stylesheet" href="style.css"/>
<span class='center'><?php echo $_GET['dest'];?></span>
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
			<?php echo 'Ajouter un fichier';?>
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
var dest = "<?php echo $_GET['dest'];?>";
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
		document.getElementById('waitFile').innerHTML += '<IMG id="file'+(i-1)+'" num="'+(i-1)+'" onclick="toggle('+(i-1)+');" value="'+ptrThis.value+'" src="../../pics/Upload.png" title="<?php echo 'Deposer des fichiers vers ce repertoire.';?>"/> - '+ptrThis.value+'<br>';
	}
	document.getElementById('action').innerHTML = '<button onclick="jsUpload();"><?php echo 'Envoyer maintenant !';?></button><button onclick="location.href=location.href;"><?php echo 'Effacer tout';?></button>';
}
function toggle (num)
{
	sendPtr=document.getElementById('send'+num);
	if (sendPtr.value=="true")
	{
		sendPtr.value = false;
		document.getElementById('file'+num).src="../../pics/Sup.png";
	}
	else
	{
		sendPtr.value = true;
		document.getElementById('file'+num).src="../../pics/Upload.png";
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
		document.getElementById('file'+(f)).src="../../pics/Loading.gif";
		document.getElementById('form'+f).submit();
	}
	else
	{
		document.getElementById('progress1').style.width="100%";
		document.getElementById('box').innerHTML = "100%";
		f=1;
	}
}</script>
</html>
