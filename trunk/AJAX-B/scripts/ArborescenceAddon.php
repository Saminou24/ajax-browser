<script type="text/javascript">
	model = "<?php echo str_replace(array('"',"\n"), array('\"','\n'), $modelArbs); ?>";
	ID('All').oncontextmenu=function (event) { event.stopPropagation();return false; }; // block le click droit sous firefox
	LoadLst = new Array("<?php echo decode64($racine64);?>");
// 	LoadLstUsed = false;
function RequestLoad(dir64, force)
{
	if (!(ptr64 = ID(dir64)) || !is_dir(base64.decode(dir64))) return false;
	force = force ? true : false;
	ptr = ptr64.childNodes[0].childNodes[0].childNodes[0].lastChild;
	if (ptr.src.indexOf("DirPlus.png")!=-1 || force==true)
	{
		ptr.src = ptr.src.replace("DirPlus.png", "Loading.gif");
		RQT.get
		(ServActPage, // on joint la page en cour
			{
				parameters:'mode=request&sublstof='+dir64+'&match='+match,
				onEnd:'OpenDir("'+dir64+'", request.responseText.split("\\n"))'
			}
		);
	}
	else
	{
		ptr.src = ptr.src.replace( "DirMoin.png", "Loading.gif");
		ptr64.childNodes[1].style.display = "none";
		ptr.src = ptr.src.replace("Loading.gif", "DirPlus.png");
	}
	_esc ();
}
function OpenDir (dir64, array)
{
	var i, Include='', IndentImg='',LstIndent='';
	IndentImg =(Open_Dir= ID(dir64)).childNodes[0].childNodes[0].childNodes[0];
	for (i=0;i<IndentImg.childNodes.length-1;i++)
	{
		LstIndent += "<IMG src='"+IndentImg.childNodes[i].src+"' />";
	}
	if (IndentImg.lastChild.src.indexOf("End")!=-1)
	{
		LstIndent += "<IMG src='"+InstallDir+"icones/Vide.png' />";
	}
	else
	{
		LstIndent += "<IMG src='"+InstallDir+"icones/Next.png' />";
	}
	for (i=1;i<array.length;i++)
	{
		Include += AddItem (base64.decode(dir64), array[i],LstIndent, (i==array.length-1)?"End":"");
	}
	Open_Dir.childNodes[1].innerHTML = Include;
	Open_Dir.childNodes[1].style.display = "block";
	IndentImg.lastChild.src = IndentImg.lastChild.src.replace("Loading.gif", "DirMoin.png");
	window.setTimeout("loadDirSize()",1000);
}
function loadDirSize()
{
<?php
	if ($_SESSION['AJAX-B']['droits']['DIRSIZE']) {
?>
	var item;
	if (LoadLst.length>0)
	{
		while (item == (item = LoadLst.shift()));
		item64 = base64.encode(item);
		if (is_dir(item) && ID(item64))
		{
			loadimg = "<IMG src='"+InstallDir+"icones/Loading2.gif'/>";
			RQT.get (ServActPage, // on joint la page en cour
				{
					onStart:'ID("'+item64+'").childNodes[0].childNodes[1].childNodes[0].innerHTML="'+loadimg+'";',
					parameters:'mode=request&size='+item64+'&match='+match,
					onEnd:'ptr=ID("'+item64+'").childNodes[0].childNodes[1].childNodes[0];ptr.setAttribute("title",SizeOctal(request.responseText)+"Oct(s)");ptr.innerHTML=SizeConvert (request.responseText);loadDirSize();',
					onError:'alert("'+item+'");LoadLst.push("'+item+'")!");loadDirSize();'
				}
			);
		}
		else
		{
			loadDirSize();
		}
	}
	else
	{
		window.setTimeout("loadDirSize()",2*<?php echo $_SESSION['AJAX-B']['mini_intervale']; ?>);
	}

<?php 
	}
?>
}
function AddItem (dir, element, LstIndent, end)
{
	var item=element.split("\t");
	item[0] = base64.decode(item[0]);
	Item = model.replace(/%item%/g, item[0]);
	Item = Item.replace(/%item64%/g, base64.encode(dir+item[0]));
	Item = Item.replace(/%icone%/g,FileIco(item[0]));
	Item = Item.replace(/%IndOffset%/g, LstIndent);
	Item = Item.replace(/%ArbImg%/g, '<IMG '+(is_dir(item[0])?'class="curshand" ':'')+'src="'+InstallDir+'icones/'+end+(is_dir(item[0])?'DirPlus':'File')+'.png" onclick="RequestLoad(\''+base64.encode(dir+item[0])+'\');"/>');
	Item = Item.replace(/%content%/g, is_dir(item[0])?item[9]+' Dossier(s), '+item[10]+' Fichier(s)':(item[9]?'[X='+item[9]+'px, Y='+item[10]+'px]':''));
	Item = Item.replace(/%real_size%/g, SizeOctal(item[1]));
	Item = Item.replace(/%size%/g, SizeConvert (item[1]));
	Item = Item.replace(/%type%/g, item[2]);
	Item = Item.replace(/%real_date%/g, item[3]);
	Item = Item.replace(/%date%/g, item[3].substr (0,8));
	Item = Item.replace(/%uidname%/g, item[5]);
	Item = Item.replace(/%uid%/g, item[6]);
	Item = Item.replace(/%gidname%/g, item[7]);
	Item = Item.replace(/%gid%/g, item[8]);
	Item = Item.replace(/%droits%/g, item[4]);
	Item = Item.replace(/%link%/g, is_dir(dir+item[0])?location.search.replace(racine64, base64.encode(dir+item[0])):'?mode=request&view='+base64.encode(dir+item[0]));
	if (is_dir(item[0]))
	{
		LoadLst.unshift(dir+item[0]);
	}
	return Item;
}
function findItem64 (ptr)
{
	while (!ptr.id || ptr.nodeName!='DIV' || ptr.className!="DivGroup")
	{
		ptr = ptr.parentNode;
		if (ptr.nodeName=='BODY' || ptr.onclick) return false;
	}
	return ptr;
}
function ChangeBG (ptr, statut)
{
	if (!ptr) return null;
	else if (statut)
	{
		ptr.childNodes[0].style.backgroundColor="rgb(220,230,255)";
		ptr.childNodes[1].style.backgroundColor="rgb(236,246,255)";
	}
	else
	{
		ptr.childNodes[0].style.backgroundColor="";
		ptr.childNodes[1].style.backgroundColor="";
	}
	return ptr.childNodes[1];
}
function innerICOs (ptr)
{
	str = '';
	SelectLst.forEach(
		function(element, index, array)
		{if (index<9) str += '<div class="c'+(index)+'">'+ID(element).childNodes[0].childNodes[0].childNodes[1].innerHTML+'</div>';} );
	return str;
}
</script>
<style type="text/css">
.DivGroup {width:100%;}
.DivGroup img {vertical-align:middle;padding:0px;margin:0px;}
	div.This {width:100%;height:18px;vertical-align:middle;}
	div.This:hover {background-color:rgb(230,250,210);}
		.left{float:left;}
			.IndentImg {margin:0px;padding:0px;}
			.IcoName {margin:0px;padding:0px;margin-left:-3px;}
			.curshand, .IcoName img {cursor:pointer;}
			.Name {margin-left:2px;padding:0px;}
			
		.right {position:absolute;right:0px;background:url(/.AJAX-B/icones/Commande.png) no-repeat 0 0;}
		.right div {float:left;padding:0px;}
			div.RowOverTaille {width:60px;}
			div.RowOverTaille:hover {background:url(/.AJAX-B/icones/GetSize.png) no-repeat center;cursor:pointer;}
			div.RowTaille {width:60px;}
			div.RowMIME {width:70px;}
			div.RowDate {width:53px;}
			div.RowDroits {width:65px;}
	.Content {display:none;width:100%;}
.this img, #All div {vertical-align:middle;}
.right div {vertical-align:bottom;}
.c1 {-moz-opacity:0.8;}
.c2 {-moz-opacity:0.7;}
.c3 {-moz-opacity:0.6;}
.c4 {-moz-opacity:0.5;}
.c5 {-moz-opacity:0.4;}
.c6 {-moz-opacity:0.3;}
.c7 {-moz-opacity:0.2;}
.c8 {-moz-opacity:0.1;}
</style>