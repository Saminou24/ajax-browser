<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>CodePress - Real Time Syntax Highlighting Editor written in JavaScript</title>
	<script type="text/javascript" src="<?php echo INSTAL_DIR; ?>codepress/codepress.js"></script>
	<style>
	body {
		color:#000;
		background-color:white;
		font:15px georgia, "Lucida Grande", "Lucida Sans Unicode", Arial, Helvetica, sans-serif;
		letter-spacing:0.01em;
	}
	html, body, textarea {
		position: absolute;
		width:100%;
		height:100%;
		padding:0px;
		margin:0px;
		border:0px;
		overflow: hidden;
	}
	iframe {
		position: absolute;
		width:100%;
		height:100%;
		padding:0px;
		margin:0px;
		border:0px;
		top:0px;
	}
	.top {
		position:absolute;
		width:100%;
		top:0px;
		float:right;
		text-align:right;
	}
	.right {padding-right:20px;}
	</style>
</head>
<body>
	<div class="top">
		<div class="right">
		<?php
			$lst = is_array($lst = glob (INSTAL_DIR.'codepress/languages/*.css'))?$lst:array();
			foreach ($lst as $key=>$val)
				echo '<button onclick="cp1.edit(cp1.value, \''.pathinfo($val, PATHINFO_FILENAME).'\');">'.pathinfo($val, PATHINFO_FILENAME).'</button>';
		?>
		</div>
	</div><!--< ?php echo pathinfo($file, PATHINFO_EXTENSION);?>-->
	<textarea id="cp1" class="codepress php">
	<?php
		echo encode64(file_get_contents($file));
	?>
	</textarea>
</body>
</html>
