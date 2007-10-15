var SelectLst = new Array();
var PtrItem, dragFiles, Dest;
function ManageAllEvent(event)
{
	PtrItem = findItem64(event.target);
	ID('Menu').style.display = 'none';
	document.onmousemove = null;
	if (PtrItem)
	{
		if(event.type=='mouseup')
		{
			(ptrSel = ID('CpMvSlide')).style.display = 'none';
			ptrSel.innerHTML = '';
			(ptrm = ID('SlideLet')).style.display = 'none';
			if (dragFiles && dragFiles!=PtrItem.id)
			{
				dragFiles = false;
				ptrm.style.top = event.pageY-2;
				ptrm.style.left = event.pageX-2;
				ptrm.style.display = 'block';
			}
			else
                        {
				return new ManageMouseEvent (event);
                        }
		}
		else if (event.type=='mousedown')// && (SelectLst.length==0 || dragFiles==PtrItem))
		{
			if (SelectLst.indexOf(PtrItem.id)!=-1)
			{
				dragFiles = PtrItem.id;
				ptrSel = ID('CpMvSlide');
				ptrSel.innerHTML = innerICOs();
				Drag.init(ptrSel, ptrSel);
				ptrSel.style.top = event.pageY+2;
				ptrSel.style.left = event.pageX+2;
				ptrSel.style.display = 'block';
				document.onmousemove = function (event)
				{
					ptrSel.style.top = event.pageY+2;
					ptrSel.style.left = event.pageX+2;
				};
			}
		}
	}
	else 
        {
            return false;
        }
}
function ManageMouseEvent (event)
{
	event.stopPropagation();
	dragFiles = false;
	if ((event.button===0 || event.button==1) && event.shiftKey && SelectLst.length>0)
	{// SHIFT select
		tmp = new Array(decode64(SelectLst[SelectLst.length-1]), decode64(PtrItem.id));
		if (is_dir(tmp[0]) != is_dir(tmp[1]))
		{
			if (is_dir(tmp[0]))
                        {
				limitSel = tmp;
                        }
			else
                        {
				limitSel = new Array(tmp[1], tmp[0]);
                        }
		}
		else
                {
			limitSel = tmp.sort();
                }
		limitSel = Array(ID(encode64(limitSel[0])), ID(encode64(limitSel[1])));
		nextPtr = limitSel[0];
		while (nextPtr.id != limitSel[1].id)
		{
			if (SelectLst.indexOf(nextPtr.id)==-1)
			{
				ChangeBG (nextPtr, true);
				SelectLst.push(nextPtr.id);
			}
			if (nextPtr.nextSibling===null || nextPtr.nextSibling.nextSibling===null) { break;}
			nextPtr = nextPtr.nextSibling.nextSibling;
		}
		if (SelectLst.indexOf(nextPtr.id)==-1)
		{
			ChangeBG (nextPtr, true);
			SelectLst.push(nextPtr.id);
		}
	}
	else if ((event.button===0 || event.button==1) && event.ctrlKey)
	{// Add by CTRL select
		if (SelectLst.indexOf(PtrItem.id)!=-1)
		{
			ChangeBG (PtrItem, false);
			SelectLst.splice(SelectLst.indexOf(PtrItem.id),1);
		}
		else
		{
			ChangeBG (PtrItem, true);
			SelectLst.push(PtrItem.id);
		}
	}
	else if (event.button===0 || event.button==1)
	{// InitSel
		UnSelectAll ();
		ChangeBG (PtrItem, true);
		SelectLst.push(PtrItem.id);
	}
	else if (event.button==2) // Menu click droit
		{ return _rightClick (event);}
	return false;
}
function ManageKeyboardEvent (event)
{
	event.stopPropagation();
	if (event.keyCode==13 && ID('renOne').style.display=='block') // ENTER
		{_sendRen ();}
	else if (event.keyCode==13) // ENTER
		{_enter ();}
	else if (event.keyCode==27) // ESC
		{_esc ();}
	else if (event.keyCode==113 && event.shiftKey) // MULTI_RENOMER
		{_multiRename ();}
	else if (event.keyCode==113) // RENOMER
		{_rename ();}
	else if ((event.charCode==120 || event.charCode==24) && event.ctrlKey) // COUPER
		{_cut ();}
	else if ((event.charCode==99 || event.charCode==3) && event.ctrlKey) // COPIER
		{_copy();}
	else if ((event.charCode==118 || event.charCode==22) && event.ctrlKey) // COLLER
		{_paste();}
	else if ((event.keyCode==46 || event.keyCode==127) && event.charCode===0) // SUPPRIMER
		{_remove ();}
	return false;
}
function _view (item64)
{
	PtrWindow = window.open(ServActPage+"?mode=request&view="+item64, "view_"+item64,"menubar,toolbar,location,resizable,scrollbars,status");
	if (PtrWindow === null) {alert (ABS907);}
	PtrWindow.focus();
}
function _esc ()
{
	UnSelectAll ();
	RQT.get
	(ServActPage,
		{
			parameters:'mode=request&noitems=',
			onEnd:false
		}
	);
	ID('Menu').style.display = 'none';
	ID('Box').style.display = 'none';
	ID('SlideLet').style.display = 'none';
	ID('CpMvSlide').style.display = 'none';
	ID('renOne').style.display = 'none';
	dragFiles = false;
	document.onmousemove = null;
}
function _enter ()
{
	SelectLst.forEach(function(element, index, array)
	{
		if (is_dir(decode64(element)))
			{RequestLoad(element);}
		else
			{_view (element);}
	});
	UnSelectAll ();
}
function _uncompress()
{
	if (SelectLst.length==1)
	{
		highlight ();
		RQT.get
		(ServActPage,
			{
				parameters:'mode=request&uncompress='+SelectLst[0],
				onEnd:'if (ID(request.responseText)) RequestLoad(request.responseText,true);'
			}
		);
	}
}
function _new ()
{
	dest = decode64(getDest());
	newitem = prompt(dest+"\n"+ABS908+"\n("+ABS909+"):\n", "New/");
	RQT.get
	(ServActPage,
		{
			parameters:'mode=request&newitem='+encode64( dest + newitem),
			onEnd:'if (ID(dest)) RequestLoad("'+encode64(dest)+'",true);'
		}
	);
}
function _multiRename ()
{
	mask = prompt (ABS910+"\n"+ABS911+" :\n*	=> "+ABS912+"\n~	=> "+ABS913+"\n#	=> "+ABS914+"\n!	=> "+ABS915+"\n"+ABS916+" : ~ - * (#)!\n./MyDir/MyFile.EXT >> ./MyDir/MyDir - MyFile (1)","~ - *.tmp");
	RQT.get
	(ServActPage,
		{
			parameters:'mode=request&mask='+encode64(mask)+'&renitems='+SelectLst.join(','),
			onEnd:'UnSelectAll();request.responseText.split(",").forEach(function(element, index, array){RequestLoad(element,true);});'
		}
	);
}
function _rename ()
{
	if (SelectLst.length==1)
	{
		ptrRen = ID("renOne");
		baliseName = ID(SelectLst[0]).childNodes[1].childNodes[1].childNodes[3].childNodes[3];
		ptrRen.style.top = (baliseName.offsetTop)+"px";
		ptrRen.style.left = baliseName.offsetLeft+"px";
		ptrRen.style.display = "block";
		ptrRen.defaultValue = SelectLst[0];
		ptrRen.value = basename(decode64(SelectLst[0]));
		ptrRen.focus();
	}
	else if (SelectLst.length>1) {_multiRename ();}
	dragFiles = false;
}
function _sendRen()
{
	ptrRen = ID("renOne");
	RQT.get
	(ServActPage,
		{
			parameters:'mode=request&renitem='+ptrRen.defaultValue+'&mask='+encode64(ptrRen.value),
			onEnd:'ID("renOne").style.display = "none";UnSelectAll();RequestLoad(request.responseText,true);'
		}
	);
}
function _copy ()
{
	if (SelectLst.length>0)
	{
		highlight ();
		RQT.get
		(ServActPage,
			{
				parameters:'mode=request&copyitems='+SelectLst.join(','),
				onEnd:false
			}
		);
	}
}
function _cut ()
{
	if (SelectLst.length>0)
	{
		highlight ();
		RQT.get
		(ServActPage,
			{
				parameters:'mode=request&moveitems='+SelectLst.join(','),
				onEnd:false
			}
		);
	}
}
function _copy_paste ()
{
	if (SelectLst.length>0)
	{
		highlight ();
		RQT.get
		(ServActPage,
			{
				parameters:'mode=request&dest='+dirDest(PtrItem.id)+'&copyitems='+SelectLst.join(','),
				onEnd:'UnSelectAll();request.responseText.split(",").forEach(function(element, index, array){RequestLoad(element,true);});'
			}
		);
	}
}
function _cut_paste ()
{
	if (SelectLst.length>0)
	{
		highlight ();
		RQT.get
		(ServActPage,
			{
				parameters:'mode=request&dest='+dirDest(PtrItem.id)+'&moveitems='+SelectLst.join(','),
				onEnd:'UnSelectAll();request.responseText.split(",").forEach(function(element, index, array){RequestLoad(element,true);});'
			}
		);
	}
}
function _paste()
{
	RQT.get
	(ServActPage,
		{
			parameters:'mode=request&pastedest='+getDest(),
			onEnd:'UnSelectAll();request.responseText.split(",").forEach(function(element, index, array){RequestLoad(element,true);});'
		}
	);
}
function _remove ()
{
	highlight ();
	strLst = Array();
	SelectLst.forEach(function(element, index, array) {this.push(basename(decode64(element)));}, strLst);
	if (SelectLst.length>0 && confirm (ABS917+"\n\n"+strLst.join('\n')))
	{
		RQT.get
		(ServActPage,
			{
				parameters:'mode=request&supitems='+SelectLst.join(','),
				onEnd:'UnSelectAll();request.responseText.split(",").forEach(function(element, index, array){ID(element).style.display="none"});'
			}
		);
	}
	dragFiles = false;
}
function _rightClick (event)
{
	ID('Box').style.display = 'none';
	dragFiles = false;
	ThisItem = PtrItem.id;
	ptr = ID('Menu');
	Drag.init(ID('MDragZone'), ptr);
	ptr.childNodes['1'].firstChild.innerHTML = basename(decode64(ThisItem));
	ptr.style.top = event.pageY;
	ptr.style.left = event.pageX;
	if (SelectLst.indexOf(ThisItem)==-1)
	{
		UnSelectAll ();
		SelectLst.push(ThisItem);
		ChangeBG (PtrItem, true);
	}
	ObjInnerView (ptr);
	return false;
}
function UnSelectAll ()
{
	dragFiles = false;
	SelectLst.forEach(function(element, index, array){if (ID(element))ChangeBG(ID(element), false)})
	SelectLst = new Array();
}
function _properties()
{
	if (SelectLst.length>0)
	{
		highlight ();
		ID('DragZone').childNodes[1].innerHTML='Propriete(s)';
		PopBox('mode=request&infos='+SelectLst.join(','),'OpenBox(request.responseText);');
	}
}
function _download(cmpMode)
{
	if (SelectLst.length>0)
	{
		highlight ();
		NewWin = window.open(ServActPage+'?mode=request&type='+cmpMode+'&download='+SelectLst.join(','), 'download','top=0,left=0,width=300,height=300');
		NewWin.setTimeout("close()",60000);
	}
}
function _upload()
{
	ID('DragZone').childNodes[1].innerHTML='Upload';
	ID('Box').style.display = 'block';
	Drag.init(ID('DragZone'), ID('Box'));
	ptrBC = ID('BoxContent');
	OpenBox ('<span class="button right" onclick="str=this.nextSibling.rows[0].innerHTML;this.nextSibling.insertRow(0).innerHTML=str;">'+ABS918+'</span><table id="Uploader" width="450px"><tr><td><iframe src="?mode=request&dest='+getDest()+'&upload=" width="400px" height="25px"></iframe></td></tr></table>');
}