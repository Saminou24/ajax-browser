		</div>
<div id="Menu" class="Movable"><div id="MDragZone" class="Dragable"><span class="titre"></span></div><div id="MBoxContent"><?php if ($_SESSION['AJAX-B']['droits']['NEW']) {?><div onclick="_new();ID('Menu').style.display = 'none';"><IMG src="<?php echo INSTAL_DIR; ?>icones/New.png"/><span><?php echo $ABS[15];?></span></div><?php }?>
		<?php if ($_SESSION['AJAX-B']['droits']['MOVE']) {?><div onclick="_cut();ID('Menu').style.display = 'none';"><IMG src="<?php echo INSTAL_DIR; ?>icones/Cut.png"/><span><?php echo $ABS[16];?></span><span class="shortkey">Ctrl+X</span></div><?php }?>
		<?php if ($_SESSION['AJAX-B']['droits']['COPY']) {?><div onclick="_copy();ID('Menu').style.display = 'none';"><IMG src="<?php echo INSTAL_DIR; ?>icones/Copy.png"/><span><?php echo $ABS[17];?></span><span class="shortkey">Ctrl+C</span></div><?php }?>
		<?php if ($_SESSION['AJAX-B']['droits']['MOVE'] || $_SESSION['AJAX-B']['droits']['COPY']) {?><div onclick="_paste();ID('Menu').style.display = 'none';"><IMG src="<?php echo INSTAL_DIR; ?>icones/Paste.png"/><span><?php echo $ABS[18];?></span><span class="shortkey">Ctrl+V</span></div><?php }?>
		<?php if ($_SESSION['AJAX-B']['droits']['REN']) {?><div onclick="_rename();ID('Menu').style.display = 'none';"><IMG src="<?php echo INSTAL_DIR; ?>icones/Ren.png"/><span><?php echo $ABS[19];?></span><span class="shortkey">F2</span></div><?php }?>
		<?php if ($_SESSION['AJAX-B']['droits']['REN']) {?><div onclick="ID('Menu').style.display = 'none';_multiRename();"><IMG src="<?php echo INSTAL_DIR; ?>icones/Ren.png"/><span><?php echo $ABS[20];?></span><span class="shortkey">Shift+F2</span></div><?php }?>
		<?php if ($_SESSION['AJAX-B']['droits']['DEL']) {?><div onclick="_remove();ID('Menu').style.display = 'none';"><IMG src="<?php echo INSTAL_DIR; ?>icones/Sup.png"/><span><?php echo $ABS[21];?></span><span class="shortkey">Suppr</span></div><?php }?>
		<?php if ($_SESSION['AJAX-B']['droits']['DOWNLOAD']) {?><div onmouseover="ID('Mzipper').style.visibility='visible';" onmouseout="ID('Mzipper').style.visibility='hidden';"><IMG src="<?php echo INSTAL_DIR; ?>icones/Download.png" title="Forcer le Telechargement"/><span><?php echo $ABS[22];?></span><span class="subMenu">»
			<ul id="Mzipper">
				<div onclick="_download('no');ID('Menu').style.display = 'none';"><IMG src="<?php echo INSTAL_DIR; ?>icones/type-unknown.png"/><?php echo $ABS[23];?></div>
				<?php if (function_exists('zip_open')) {?>
					<div onmouseup="ID('Menu').style.display = 'none';_download('zip');" class='action' title="<?php echo $ABS[205];?>*.ZIP"><IMG src="<?php echo INSTAL_DIR; ?>icones/type-zip.png"/>ZIP</div><?php }?>
					<div onmouseup="ID('Menu').style.display = 'none';_download('tar');" class='action' title="<?php echo $ABS[205];?>*.TAR"><IMG src="<?php echo INSTAL_DIR; ?>icones/type-tar.png"/>TAR</div>
				<?php if (function_exists('gzencode')) {?>
					<div onmouseup="ID('Menu').style.display = 'none';_download('tar.gzip');" class='action' title="<?php echo $ABS[205];?>*.GZIP"><IMG src="<?php echo INSTAL_DIR; ?>icones/type-gzip.png"/>TAR.GZIP</div>
				<?php } if (function_exists('bzcompress')) {?>
					<div onmouseup="ID('Menu').style.display = 'none';_download('tar.bzip2');" class='action' title="<?php echo $ABS[205];?>*.BZIP2"><IMG src="<?php echo INSTAL_DIR; ?>icones/type-bzip2.png"/>TAR.BZIP2</div>
				<?php }?>
			</ul></span>
		</div><?php }?>
		<?php if ($_SESSION['AJAX-B']['droits']['UPLOAD']!='NO') {?><div onclick="_upload();ID('Menu').style.display = 'none';"><IMG src="<?php echo INSTAL_DIR; ?>icones/Upload.png"/><span><?php echo $ABS[24];?></span></div><?php }?>
		<div onclick="_enter();ID('Menu').style.display = 'none';"><IMG src="<?php echo INSTAL_DIR; ?>icones/Edit.png"/><span><?php echo $ABS[25];?></span><span class="shortkey">Enter</span></div>
		<?php if ($_SESSION['AJAX-B']['droits']['UNCOMPRESS']) {?><div onclick="_uncompress();ID('Menu').style.display = 'none';"><IMG src="<?php echo INSTAL_DIR; ?>icones/Uncompress.png"/><span><?php echo $ABS[36];?></span></div><?php }?>
		<div onclick="_properties();ID('Menu').style.display = 'none';"><IMG src="<?php echo INSTAL_DIR; ?>icones/Infos.png"/><span><?php echo $ABS[26];?></span></div>
	</div>
</div>
<div id="CpMvSlide"></div>
<div id="SlideLet">
	<?php if ($_SESSION['AJAX-B']['droits']['MOVE']) {?><div onclick="_cut_paste();ID('SlideLet').style.display = 'none';"><IMG src="<?php echo INSTAL_DIR; ?>icones/Cut.png"/><span><?php echo $ABS[27];?></span></div><?php }?>
	<?php if ($_SESSION['AJAX-B']['droits']['COPY']) {?><div onclick="_copy_paste();ID('SlideLet').style.display = 'none';"><IMG src="<?php echo INSTAL_DIR; ?>icones/Copy.png"/><span><?php echo $ABS[28];?></span></div><?php }?>
</div>
<!-- <div id="Sel"></div> -->
<input type="text" name="renOne" id="renOne"/>
<form METHOD='get' name="matchform" action="" enctype='multipart/form-data'><div id="Box" class="Movable"><div id="DragZone" class="Dragable"><span class="titre"></span><IMG class="close" onclick="ID('Box').style.display = 'none';" src='<?php echo INSTAL_DIR; ?>icones/CloseX.png' /></div><div id="BoxContent"><?php echo $ABS[29];?></div></div></form>
	</body>
</html>
<?php
if (isset($db))
{
	echo "<!--\nErrors resume :\n".$ErrrorMsg."\n-->";
	file_put_contents('./Debug.txt', "<!--\nErrors resume :\n".$ErrrorMsg."\n-->",FILE_APPEND);
}
?>