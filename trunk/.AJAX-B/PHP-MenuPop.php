<?
/**-------------------------------------------------
 | AJAX-Browser  -  by Alban LOPEZ
 | Copyright (c) 2006 Alban LOPEZ
 | Email bugs/suggestions to alban.lopez@gmail.com
 +--------------------------------------------------
 | This script has been created and released under
 | the GNU GPL and is free to use and redistribute
 | only if this copyright statement is not removed
 +--------------------------------------------------*/
?>
<form name="setting" id="setting" METHOD='post' action="" enctype='multipart/form-data'>
	<div id="MAI">
		<div class="TitleBar center" onmousedown="divOnMouseDown(event,this);">
			<span class="onglet">
				<IMG onclick="PopBox('infos='+UrlFormat(SelFile));" src='./.AJAX-Ico/Infos.png' title='Propriete'/>
			</span>
			<span class="titre"></span>
			<span class="close">
				<IMG onclick="this.parentNode.parentNode.parentNode.style.display='none';SelFile = false;" src='./.AJAX-Ico/CloseX.png' /><!--DispInf=false-->
			</span>
		</div>
		<div style="display:none;font-size:9px;" id="Onglet" onclick="document.getElementById ('MAI').style.display = 'none';SelFile = false;"></div>
		<div style="display:block;" id="act">
<?
	foreach ($MENU_LST as $key => $class)
		if ($_SESSION['level'] >= $class->level)
			echo "<div class='action' onclick=\"".$class->lnk."\" title=\"".$class->info."\"><IMG src=\"".$class->img."\"/>".$key."</div>\n";
?>
		</div>
	</div>
	<div id="MPOP">
		<div class="TitleBar center" onmousedown="divOnMouseDown(event,this);">
			<span class="titre"></span>
			<span class="close">
				<IMG onclick="this.parentNode.parentNode.parentNode.style.display='none';" src='./.AJAX-Ico/CloseX.png' />
			</span>
		</div>
		<div id='PopTxt' class='PopTxt'></div>
	</div>
</form>
<div id="mover"></div>
<?
	if ($_SESSION['level'] >= $MOVE->level || $_SESSION['level'] >= $COPY->level)
	{
		echo "<div id='CpMv'>\n";
		if ($_SESSION['level'] >= $MOVE->level)
			echo "	<div class='action' title=\"".$MOVE->info."\"><IMG src=\"".$MOVE->img."\"/>Deplacer</div>\n";
		if ($_SESSION['level'] >= $COPY->level)
			echo "	<div class='action' title=\"".$COPY->info."\"><IMG src=\"".$COPY->img."\"/>Copier</div>\n";
	}
?>
	<div class='action'><IMG src="./.AJAX-Ico/CloseX.png"/>Annuler</div>
</div>
<div id="FindFilter">
	<form METHOD='get' name="matchform" action="" enctype='multipart/form-data'>
		<input name='match' id='matchFilter'>
	</form>
</div>
<div id="zipper">
<?	if (function_exists('gzwrite')) { ?>
	<div class='action' title="Telechargement de la selection au format *.ZIP" onclick="Lst=OneOrSelect();NewWin=window.open(GET_add('format=zip&download='+UrlFormat (Lst.join('%;'))), 'download','top=0,left=0,width=100,height=20');flux('Download :',Lst.join('\n'));NewWin.setTimeout('close()',60000);this.parentNode.style.visibility='hidden';"><IMG src="./.AJAX-Ico/type-zip.png"/>ZIP</div>
<? } else { ?>
	<div class='action' title="Telechargement de la selection au format *.ZIP" onclick="alert('ZLIB() => Impossible! Vous devriez intaller la bibliothèque ZLIB')"><IMG src="./.AJAX-Ico/type-zip.png"/>ZIP</div>
<? } ?>
	<div class='action' title="Telechargement de la selection au format *.TAR" onclick="Lst=OneOrSelect();NewWin=window.open(GET_add('format=tar&download='+UrlFormat (Lst.join('%;'))), 'download','top=0,left=0,width=100,height=20');flux('Download :',Lst.join('\n'));NewWin.setTimeout('close()',60000);this.parentNode.style.visibility='hidden';"><IMG src="./.AJAX-Ico/type-tar.png"/>TAR</div>
<?	if (function_exists('gzwrite')) { ?>
	<div class='action' title="Telechargement de la selection au format *.GZIP" onclick="Lst=OneOrSelect();NewWin=window.open(GET_add('format=gzip&download='+UrlFormat (Lst.join('%;'))), 'download','top=0,left=0,width=100,height=20');flux('Download :',Lst.join('\n'));NewWin.setTimeout('close()',60000);this.parentNode.style.visibility='hidden';"><IMG src="./.AJAX-Ico/type-gz.png"/>TAR.GZIP</div>
<? } else { ?>
	<div class='action' title="Telechargement de la selection au format *.GZIP" onclick="alert('ZLIB() => Impossible! Vous devriez intaller la bibliothèque ZLIB')"><IMG src="./.AJAX-Ico/type-gz.png"/>TAR.GZIP</div>
<? }
	if (function_exists('bzwrite')) { ?>
	<div class='action' title="Telechargement de la selection au format *.BZIP2" onclick="Lst=OneOrSelect();NewWin=window.open(GET_add('format=bzip2&download='+UrlFormat (Lst.join('%;'))), 'download','top=0,left=0,width=100,height=20');flux('Download :',Lst.join('\n'));NewWin.setTimeout('close()',60000);this.parentNode.style.visibility='hidden';"><IMG src="./.AJAX-Ico/type-bz2.png"/>TAR.BZIP2</div>
<? } else { ?>
	<div class='action' title="Telechargement de la selection au format *.BZIP2" onclick="alert('BZIP2() => Impossible! Vous devriez intaller la bibliothèque BZIP2')"><IMG src="./.AJAX-Ico/type-bz2.png"/>TAR.BZIP2</div>
<? } ?>
	<div class='action' onclick="this.parentNode.style.visibility='hidden';"><IMG src="./.AJAX-Ico/CloseX.png"/>Annuler</div>
</div>