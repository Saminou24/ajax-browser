/**-------------------------------------------------
 | AJAX-Browser  -  by Alban LOPEZ
 | Copyright (c) 2006 Alban LOPEZ
 | Email bugs/suggestions to alban.lopez@gmail.com
 +--------------------------------------------------
 | This script has been created and released under
 | the GNU GPL and is free to use and redistribute
 | only if this copyright statement is not removed
 +--------------------------------------------------*/

function SDGCG(ptr,childNode)		// SBGC    to    Select BackGround Color Gallerie
{
	if (ptr.checked==true)
		ptr.parentNode.style.backgroundColor="rgb(220,230,255)";
	else
		ptr.parentNode.style.backgroundColor="";
}
function ASDG (xhr_obj)			// ASDG    to    Answer SubDir to Gallerie
{
	var SubLst = xhr_obj.responseText.replace(/%2F/g,'/').split("\n");
	var File = new Array(), Infos, f = 0;
	for (i=0; SubLst[i]; i++)
	{
		Infos = SubLst[i].split("\t");
		File[f++] = "<div id='"+Infos[0]+Infos[1]+"' title='"+unescape(Infos[1])+"' onmousedown='MCE(this,event);' ondblclick='OpenClick(this);'>\n\t<table><td>";
		if (Infos[1].charAt(Infos[1].length-1)=="/")		// Nous somme face a un dossier
			File[f++] = "<img src='./.AJAX-Ico/type-folder..png' />";
		else							// ici nous somme face a une a un fichier "normal"
			File[f++] = "<img src='./.AJAX-Ico/"+FileIco (Infos[1])+".png' />";
		File[f++] = "<br /><p class='name'>"+unescape(basename(Infos[1]))+"</p></td></table>\n\t<input onchange='SDGCG(this);' type='checkbox' name='Lst[]' value='"+Infos[0]+Infos[1]+"'/>\n";
		File[f++] = "<span class='menu'><span class='info'>";
		File[f++] = "<span class='menuClicker' onclick=\"ShowMenuMAI (this.parentNode.parentNode.parentNode.id, event);\"></span>\n";
		File[f++] = "<span class='infoClicker' onclick=\"PopBox('infos='+UrlFormat(this.parentNode.parentNode.parentNode.id));\"></span>\n";
		File[f++] = "</span>\n</span>\n";
		File[f++] = "</div>\n";
	}
	return File.join('');
}
function ReloadDir (id)
{
	document.location = document.location;
}
function OCG (PageRequest)		// OCG     to    Open or Close Gallerie
{
	var xhr_gal = null;
	PtrGal = ID ("Gal");
	if (window.XMLHttpRequest) // Firefox
	{
		xhr_gal = new XMLHttpRequest();
		xhr_gal.open ("GET", GET_add(PageRequest), true);
		xhr_gal.send(null);
		xhr_gal.onreadystatechange = function ()
		{
			if (xhr_gal.readyState == 4 && xhr_gal.status == 200)
			{
				PtrGal.innerHTML = PtrGal.innerHTML + '\n' + ASDG(xhr_gal);
				window.setTimeout("GetMini();",100); //
				flux("LoadDir :",xhr_gal.responseText);
			}
		};
	}
	else XMLHttpRequestERROR()
}
function GetMini ()			// recherche toute les vignette d'image pour charger les miniature
{
	var mini=0, filetype;
	PtrGal = ID("Gal");
	while (PtrGal.childNodes[mini])
	{
		if (PtrGal.childNodes[mini].nodeName=="DIV")
		{
			var ext = (PtrGal.childNodes[mini].id).split(".");
			ext = ext[ext.length-1].toLowerCase();
			if (ext=="png" || ext=="ico" || ext=="jpg" || ext=="jpeg" || ext=="gif")
				ThisMini(PtrGal.childNodes[mini].id);
		}
		mini = mini+1;
	}
}
function ThisMini(url)			// charge la miniature de cette image
{
	var xhr_img;
	if (window.XMLHttpRequest) // Firefox
	{
		ID(url).childNodes[1].childNodes[0].childNodes[0].childNodes[0].innerHTML = "<IMG src=./.AJAX-Ico/spinner.gif />";
		xhr_img = new XMLHttpRequest();
		xhr_img.open ("GET", GET_add("getmini="+ UrlFormat (url)), true);
		xhr_img.send(null);
		xhr_img.onreadystatechange = function ()
		{
			if (xhr_img.readyState == 4 && xhr_img.status == 200)
			{
				ID(url).childNodes[1].childNodes[0].childNodes[0].childNodes[0].innerHTML = "<img src='"+xhr_img.responseText+"'/>";
				flux("GetMini :",xhr_img.responseText);
			}
		};
	}
	else XMLHttpRequestERROR()
}