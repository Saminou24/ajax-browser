<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>EditArea Test</title>
<script language="javascript" type="text/javascript" src="<?php echo INSTAL_DIR; ?>/edit_area/edit_area.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo INSTAL_DIR; ?>/edit_area/edit_area_loader.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo INSTAL_DIR; ?>/edit_area/edit_area_functions.js"></script>
<script language="javascript" type="text/javascript">
	ABS900='erreur !';
	var ServActPage = ((top.location.href.split("?"))[0]);
	lstGet = location.search.slice(1,window.location.search.length).split("&");
		for(i=0;lstGet[i];i++)
			eval((lstGet[i].split("="))[0]+"='"+(lstGet[i].split("="))[1]+"';");
	var RQT=
	{
		xmlDoc : Object,
		get : function(url, options)
		{
			var parameters = options.parameters || false;
			var method = options.method || 'post';
			var async = options.async || true;
			var onStart = options.onStart || false;
			var onEnd = options.onEnd || false;
			var onError = options.onError || 'alert("'+ABS900+'");';
			var request;

			if(window.XMLHttpRequest)   // tous les naviguateurs W3C
				{ request = new XMLHttpRequest();}
			else if (window.ActiveXObject)   // Internet Explorer
				{ request = new ActiveXObject("Microsoft.XMLHTTP");}
			else
			{
				alert('AJAX is not avaible.');
				request = false;
				return false;
			}

			if(onStart) eval(onStart);
			request.open(method, url + (method=='get'&&parameters ? '?'+parameters : ''), async);
			request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			request.onreadystatechange = function()
			{
				if (request.readyState == 4)
				{
					if (request.status == 200)
					{
						xmlDoc = request.responseText;
						if(onEnd) eval(onEnd);
						return true;
					}
					else
					{
						if(onError) eval(onError);
						return false;
					}
				}
			};
			request.send(method=='post' ? parameters : null);
		}
	};
	function SaveMe (Data64)
	{
		RQT.get
		(ServActPage,
			{
				parameters:'mode=request&easave='+view+'&data64='+Data64,
				onEnd:'top.document.title=base64.decode(view)+" => Last Saved : "+request.responseText;'
			}
		);
	}
</script>
<script language="javascript" type="text/javascript">
	var base64 = {
	// 	_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=", // standard base64 encoding
		_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@^~", // my personal base64 encoding method
		encode : function (input)
		{
			var output = "";
			var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
			var i = 0;
			input = base64._utf8_encode(input);
			while (i < input.length)
			{
				chr1 = input.charCodeAt(i++);
				chr2 = input.charCodeAt(i++);
				chr3 = input.charCodeAt(i++);
				enc1 = chr1 >> 2;
				enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
				enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
				enc4 = chr3 & 63;
				if (isNaN(chr2))
				{
					enc3 = enc4 = 64;
				}
				else if (isNaN(chr3))
				{
					enc4 = 64;
				}
				output = output +
				this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
				this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);
			}
			return output;
		},
		decode : function (input)
		{
			var output = "";
			var chr1, chr2, chr3;
			var enc1, enc2, enc3, enc4;
			var i = 0;
			input = input.replace(/[^A-Za-z0-9\@\^\~]/g, "");
			while (i < input.length)
			{
				enc1 = this._keyStr.indexOf(input.charAt(i++));
				enc2 = this._keyStr.indexOf(input.charAt(i++));
				enc3 = this._keyStr.indexOf(input.charAt(i++));
				enc4 = this._keyStr.indexOf(input.charAt(i++));
				chr1 = (enc1 << 2) | (enc2 >> 4);
				chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
				chr3 = ((enc3 & 3) << 6) | enc4;
				output = output + String.fromCharCode(chr1);
				if (enc3 != 64)
				{
					output = output + String.fromCharCode(chr2);
				}
				if (enc4 != 64)
				{
					output = output + String.fromCharCode(chr3);
				}
			}
			output = base64._utf8_decode(output);
			return output;
		},
		_utf8_encode : function (string) {
			string = string.replace(/\r\n/g,"\n");
			var utftext = "";
			for (var n = 0; n < string.length; n++)
			{
				var c = string.charCodeAt(n);
				if (c < 128)
				{
					utftext += String.fromCharCode(c);
				}
				else if((c > 127) && (c < 2048))
				{
					utftext += String.fromCharCode((c >> 6) | 192);
					utftext += String.fromCharCode((c & 63) | 128);
				}
				else
				{
					utftext += String.fromCharCode((c >> 12) | 224);
					utftext += String.fromCharCode(((c >> 6) & 63) | 128);
					utftext += String.fromCharCode((c & 63) | 128);
				}
			}
			return utftext;
		},
		_utf8_decode : function (utftext)
		{
			var string = "";
			var i = 0;
			var c = c1 = c2 = 0;
			while ( i < utftext.length )
			{
				c = utftext.charCodeAt(i);
				if (c < 128)
				{
					string += String.fromCharCode(c);
					i++;
				}
				else if((c > 191) && (c < 224))
				{
					c2 = utftext.charCodeAt(i+1);
					string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
					i += 2;
				}
				else
				{
					c2 = utftext.charCodeAt(i+1);
					c3 = utftext.charCodeAt(i+2);
					string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
					i += 3;
				}
			}
			return string;
		}
	}
</script>
<script language="javascript" type="text/javascript">
	editAreaLoader.init({
	 id : "textarea_1"		// textarea id
	,syntax: "php"			// syntax to be uses for highgliting
	,start_highlight: true		// to display with highlight mode on start-up
        ,language: "en"
        ,fullscreen: true
        ,allow_resize: "no"
        ,allow_toggle: false
        ,browsers: "all"
        ,toolbar: "save, |, search, go_to_line, |, undo, redo, |, select_font, syntax_selection, |, change_smooth_selection, highlight, reset_highlight, |, help"
	,syntax_selection_allow: "css,html,js,php,python,vb,xml,c,cpp,sql,basic,pas,brainfuck"
	,show_line_colors: true
//         ,is_multi_files: false
//         ,min_width: 400
//         ,min_height: 400
//         ,plugins: ""
//         ,display: "onload"
//         ,begin_toolbar: ""
//         ,end_toolbar: ""
//         ,font_size: 10
//         ,font_family: "monospace"
//         ,gecko_spellcheck: false
//         ,max_undo: 20
//         ,is_editable: true
//         ,replace_tab_by_spaces: false
//         ,debug:false

//         ,load_callback: ""
        ,save_callback: "SaveMe (base64.encode(document.getElementById('textarea_1').value));"
//         ,change_callback: ""
//         ,submit_callback: ""
        ,EA_init_callback: "edit=document.getElementById('textarea_1');edit.value = base64.decode(edit.value);edit.style.display='block';"
//         ,EA_delete_callback: ""
//         ,EA_toggle_on_callback: ""
//         ,EA_toggle_off_callback: ""
//         ,EA_load_callback: ""
//         ,EA_unload_callback: ""
//         ,EA_file_switch_on_callback: ""
//         ,EA_file_switch_off_callback: ""
//         ,EA_file_close_callback: ""
});
// editAreaLoader.setValue("textarea_1", editAreaLoader.getValue("textarea_1"));
</script>
</head>
<body>
<form method="post">
	<textarea id="textarea_1" name="content" style="height: 100%; width: 100%; display: none"><?php echo encode64(file_get_contents($file)); ?></textarea>

</form>
</body>
</html>

