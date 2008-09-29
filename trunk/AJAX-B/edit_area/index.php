<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>EditArea Test</title>
<script language="javascript" type="text/javascript" src="<?php echo INSTAL_DIR; ?>/scripts/AJAX.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo INSTAL_DIR; ?>/scripts/UTF8Base64.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo INSTAL_DIR; ?>/edit_area/edit_area.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo INSTAL_DIR; ?>/edit_area/edit_area_loader.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo INSTAL_DIR; ?>/edit_area/edit_area_functions.js"></script>
<script language="javascript" type="text/javascript">
	ABS900='erreur !';
	function SaveMe (Data64)
	{
		RQT.get
		(ServActPage,
			{
				parameters:'mode=request&cpsave='+view+'&data64='+Data64,
				onEnd:'top.document.title=base64.decode(view)+" => Last Saved : "+request.responseText;'
			}
		);
	}
</script>
<script language="javascript" type="text/javascript">
	editAreaLoader.init({
	 id : "textarea_1"		// textarea id
	,syntax: "php"			// syntax to be uses for highgliting
	,start_highlight: true		// to display with highlight mode on start-up
        ,language: "en"
        ,allow_resize: "no"
        ,allow_toggle: false
        ,browsers: "all"
        ,toolbar: "save, |, search, go_to_line, fullscreen, |, undo, redo, |, select_font, syntax_selection, |, change_smooth_selection, highlight, reset_highlight, |, help"
	,syntax_selection_allow: "css,html,js,php,python,vb,xml,c,cpp,sql,basic,pas,brainfuck"
// 	,show_line_colors: false
//         ,is_multi_files: false
//         ,min_width: 400
//         ,min_height: 400
        ,plugins: "charmap"
//         ,display: "onload"
//         ,begin_toolbar: ""
//         ,end_toolbar: ""
//         ,font_size: 10
//         ,font_family: "monospace"
//         ,gecko_spellcheck: false
//         ,max_undo: 20
//         ,fullscreen: true
//         ,is_editable: true
//         ,replace_tab_by_spaces: false
//         ,debug:false

//         ,load_callback: ""
        ,save_callback: "SaveMe (base64.encode(document.getElementById('textarea_1').value));"
//         ,change_callback: ""
//         ,submit_callback: ""
        ,EA_init_callback: "ea=document.getElementById('textarea_1');ea.value = base64.decode(ea.value);ea.style.display='block';"
//         ,EA_delete_callback: ""
//         ,EA_toggle_on_callback: ""
//         ,EA_toggle_off_callback: ""
//         ,EA_load_callback: ""
//         ,EA_unload_callback: ""
//         ,EA_file_switch_on_callback: ""
//         ,EA_file_switch_off_callback: ""
//         ,EA_file_close_callback: ""
});
</script>
</head>
<body>
<form method="post">
	<textarea id="textarea_1" name="content" style="height: 100%; width: 100%; display: none;"><?php echo encode64(file_get_contents($file)); ?></textarea>

</form>
</body>
</html>

