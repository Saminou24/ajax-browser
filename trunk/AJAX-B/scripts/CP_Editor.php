<html>
	<head>
		<meta content="text/html; charset=UTF-8" http-equiv="content-type">
		<title>CodePress <?php echo $file;?></title>
	</head>
	<script type="text/javascript" src="<?php echo $InstallDir; ?>codepress/codepress.js" ></script>
<script type="text/javascript">
function ManageKeyboardEvent (event)
{
	event.stopPropagation();
	if ((event.charCode==115 || event.charCode==19) && event.ctrlKey)
	alert ('CTRL+S');
	return false;
}
</script>
<style type="text/css">
body {
	position: absolute;
	width:100%;
	height:100%;
	border:0px;
	padding:0px;
	margin:0px;
	font-family:sans-serif;
/* 	overflow:visible; */
}/**/
textarea {
	width:100%;
	height:100%;
	overflow:auto;}
span {position:absolute;top:1px;}
#Msave {right:2px;text-align:right;cursor:pointer;}
#Mcolor {right:25px;text-align:right;cursor:pointer;}
.menu{
	right:-15px;
	position:absolute;
	display:none;
	border:solid 1px gray;
	padding:0px;
	margin:0px;
	background-color:rgb(240,240,240);
}
.menu tr {padding:0px;margin:0px;}
.menu tr:hover { background-color:rgb(220,220,220);}
</style>
	<body onkeypress="ManageKeyboardEvent(event);">
<?php
foreach (glob ($InstallDir.'codepress/languages/*.css') as $key=>$val)
{
	$lst_mod[] = '
<tr onclick="CP.edit(CP.value, \''.pathinfo($val, PATHINFO_FILENAME).'\'); document.getElementById(\'CP_cp\').style.display=\'none\';">
	<td>
		'.pathinfo($val, PATHINFO_FILENAME).'
	</td>
</tr>';
}
?>
<span id="Mcolor" onmouseover="this.childNodes[3].style.display='block';" onmouseout="this.childNodes[3].style.display='none';">
	<img src="<?php echo $InstallDir; ?>icones/MiniMenu.png">
	<table id="colorlst" class="menu">
	<?php echo implode ("\n",$lst_mod); ?>
	</table>
</span>
<span id="Msave" onclick="alert(CP.getCode());">
	<img src="<?php echo $InstallDir; ?>icones/Download.png">
</span>
<textarea id="CP" class="codepress php <?php echo $cp_mode;?>" wrap="off">
<?php echo file_get_contents($file);?>
</textarea>