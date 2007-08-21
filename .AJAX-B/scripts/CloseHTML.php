		</div>

<div id="Menu" class="Movable">
	<div id="MDragZone" class="Dragable"><span class="titre"></span></div>
	<div id="MBoxContent">
		<div onclick="_new();ID('Menu').style.display = 'none';"><IMG src="./.AJAX-B/icones/New.png"/><span><?php echo $ABS[15];?></span></div>
		<div onclick="_cut();ID('Menu').style.display = 'none';"><IMG src="./.AJAX-B/icones/Cut.png"/><span><?php echo $ABS[16];?></span><span class="shortkey">Ctrl+X</span></div>
		<div onclick="_copy();ID('Menu').style.display = 'none';"><IMG src="./.AJAX-B/icones/Copy.png"/><span><?php echo $ABS[17];?></span><span class="shortkey">Ctrl+C</span></div>
		<div onclick="_paste();ID('Menu').style.display = 'none';"><IMG src="./.AJAX-B/icones/Paste.png"/><span><?php echo $ABS[18];?></span><span class="shortkey">Ctrl+V</span></div>
		<div onclick="_rename();ID('Menu').style.display = 'none';"><IMG src="./.AJAX-B/icones/Ren.png"/><span><?php echo $ABS[19];?></span><span class="shortkey">F2</span></div>
		<div onclick="ID('Menu').style.display = 'none';_multiRename();"><IMG src="./.AJAX-B/icones/Ren.png"/><span><?php echo $ABS[20];?></span><span class="shortkey">Shift+F2</span></div>
		<div onclick="_remove();ID('Menu').style.display = 'none';"><IMG src="./.AJAX-B/icones/Sup.png"/><span><?php echo $ABS[21];?></span><span class="shortkey">Suppr</span></div>
		<div onmouseover="ID('Mzipper').style.visibility='visible';" onmouseout="ID('Mzipper').style.visibility='hidden';"><IMG src="./.AJAX-B/icones/Download.png" title="Forcer le Telechargement"/><span><?php echo $ABS[22];?></span><span class="subMenu">»
			<ul id="Mzipper">
				<div onclick="_download('no');ID('Menu').style.display = 'none';"><IMG src="./.AJAX-B/icones/type-unknown.png"/><?php echo $ABS[23];?></div>
				<div onclick="_download('zip');ID('Menu').style.display = 'none';" title="<?php echo $ABS[205];?>*.ZIP"><IMG src="./.AJAX-B/icones/type-zip.png"/>ZIP</div>
				<div onclick="_download('tar');ID('Menu').style.display = 'none';" title="<?php echo $ABS[205];?>*.TAR"><IMG src="./.AJAX-B/icones/type-tar.png"/>TAR</div>
				<div onclick="_download('gzip');ID('Menu').style.display = 'none';" title="<?php echo $ABS[205];?>*.TAR.GZIP"><IMG src="./.AJAX-B/icones/type-gz.png"/>TAR.GZIP</div>
				<div onclick="_download('bzip2');ID('Menu').style.display = 'none';" title="<?php echo $ABS[205];?>*.TAR.BZIP2"><IMG src="./.AJAX-B/icones/type-bz2.png"/>TAR.BZIP2</div>
			</ul></span>
		</div>
		<div onclick="_upload();ID('Menu').style.display = 'none';"><IMG src="./.AJAX-B/icones/Upload.png"/><span><?php echo $ABS[24];?></span></div>
		<div onclick="_enter ();ID('Menu').style.display = 'none';"><IMG src="./.AJAX-B/icones/Edit.png"/><span><?php echo $ABS[25];?></span><span class="shortkey">Enter</span></div>
		<div onclick="_properties();ID('Menu').style.display = 'none';"><IMG src="./.AJAX-B/icones/Infos.png"/><span><?php echo $ABS[26];?></span></div>
	</div>
</div>

<div id="CpMvSlide"></div>

<div id="SlideLet">
	<div onclick="_cut_paste();ID('SlideLet').style.display = 'none';"><IMG src="./.AJAX-B/icones/Cut.png"/><span><?php echo $ABS[27];?></span></div>
	<div onclick="_copy_paste();ID('SlideLet').style.display = 'none';"><IMG src="./.AJAX-B/icones/Copy.png"/><span><?php echo $ABS[28];?></span></div>
</div>

<div id="Sel"></div>

		<input type="text" name="renOne" id="renOne"/>

<form METHOD='get' name="matchform" action="" enctype='multipart/form-data'>
	<div id="Box" class="Movable">
		<div id="DragZone" class="Dragable">
			<span class="titre"></span>
				<IMG class="close" onclick="ID('Box').style.display = 'none';" src='./.AJAX-B/icones/CloseX.png' />
		</div>
		<div id="BoxContent">
		<?php echo $ABS[29];?>
		</div>
	</div>
</form>
	<a class="bottomright" href="http://ajaxbrowser.free.fr/Docs/contact.php"><?php echo $ABS[30];?></a>
	</body>
</html>