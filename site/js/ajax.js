// http://barney.gonzaga.edu/~amoore1/php/addEvent/
// addEvent and removeEvent, designed by Aaron Moore
function addEvent(element, listener, handler)
{
	//if the system is not set up, set it up, and
	// store any outside script's event registration in the first handler slot
	if(typeof element[listener] != 'function' ||
	typeof element[listener + '_num'] == 'undefined'){
		element[listener + '_num'] = 0;
		if(typeof element[listener] == 'function'){
			element[listener + 0] = element[listener];
			element[listener + '_num']++;
		}
		element[listener] = function(e){
			var r = true;
			e = (e) ? e : window.event;
			for(var i = 0; i < element[listener + '_num']; i++)
				if(element[listener + i](e) === false) r = false;
			return r;
		}
	}
	//if handler is not already stored, assign it
	for(var i = 0; i < element[listener + '_num']; i++)
		if(element[listener + i] == handler) return;
	element[listener + element[listener + '_num']] = handler;
	element[listener + '_num']++;
}
function removeEvent(element, listener, handler)
{
	//if the system is not set up, or there are no handlers to remove, exit
	if(typeof element[listener] != 'function' ||
	typeof element[listener + '_num'] == 'undefined' ||
	element[listener + '_num'] == 0) return;
	//loop through handlers,
	//  if target handler is reached, begin overwriting each
	//  handler with the handler in front of it until one before the last
	var found = false;
	for(var i = 0; i < element[listener + '_num']; i++){
		if(!found)
			found = element[listener + i] == handler;
		if(found && (i+1) < element[listener + '_num'])
			element[listener + i] = element[listener + (i+1)];
	}
	//if handler was found, decrement the handler count
	if(found)
		element[listener + '_num']--;
}

// ================================================================================
// Dean Edwards/Matthias Miller/John Resig
// patch to `onload` event
// ================================================================================
function init() {
	// quit if this function has already been called
	if (arguments.callee.done) return;

	// flag this function so we don't do the same thing twice
	arguments.callee.done = true;

	// kill the timer
	if (_timer) clearInterval(_timer);

	// ##################### AJOUT D'ÉVÉNEMENTS #####################
	// ##############################################################
	events();
	// ##############################################################
	// ##############################################################

};

/* for Mozilla/Opera9 */
if (document.addEventListener) {
	document.addEventListener("DOMContentLoaded", init, false);
}

/* for Internet Explorer */
/*@cc_on @*/
/*@if (@_win32)
	document.write("<script id=__ie_onload defer src=javascript:void(0)><\/script>");
	var script = document.getElementById("__ie_onload");
	script.onreadystatechange = function() {
		if (this.readyState == "complete") {
			init(); // call the onload handler
		}
	};
/*@end @*/

/* for Safari */
if (/WebKit/i.test(navigator.userAgent)) { // sniff
	var _timer = setInterval(function() {
		if (/loaded|complete/.test(document.readyState)) {
			init(); // call the onload handler
		}
	}, 10);
}

/* for other browsers */
window.onload = init;

// ================================================================================
// ================================================================================


function GetXmlHttpObject()
{
	var xmlHttp;

	try
	{ // Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	} catch (e)
	{ // Internet Explorer
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e)
		{
			try
			{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e)
			{
				alert("This game require Javascript to be enable and AJAX support!");
				return false;
			}
		}
	}
	return xmlHttp;
}


function select_color(element,dropon)
{
	flag = document.getElementById(element);
	selector = document.getElementById(dropon);
	for (var i=0; i<selector.length; i++)
	{
		if (selector.options[i].value==flag.id)
		{
// 			alert(flag.id+'+'+selector.options[i].value);
			selector.selectedIndex = i;
			selector.className='cl-'+flag.id;
		}
	}
}

function check_game()
{// check that all pegs have been put/choose
	for (var i=0; i<4; i++)
	{
		selector = document.getElementById('p'+i);
		//alert(selector.id+':'+selector.selectedIndex);
		if (selector.selectedIndex == 0)
		{
// 			alert("[en] All pegs should be set.\n"+
// 						"[fr] Tous les pions doivent être choisi.");
			return false;
		}
	}
}

function grab_pegs()
{
	var pegs = '';
	var color = ['', 'r', 'y', 'g', 'b', 'o', 'w', 'p', 'f'];
	for (var i=0; i<4; i++)
	{
		selector = document.getElementById('p'+i);
		pegs += 'p'+i+'='+color[selector.selectedIndex]+'&';
	}
	//alert(pegs);
	return pegs;
}

function AJAX_play()
{
	var script = 'game-ajax.php';
	var PROTOCOL=window.location.protocol
	var HOST=window.location.host
	var PATHNAME=window.location.pathname

	url=PROTOCOL+'//'+HOST+PATHNAME+script+'?'+grab_pegs();
	//alert(url);

	// Get the XMLHttpRequest object (it's browser dependant)
	xmlHttp = GetXmlHttpObject();
	xmlHttp.onreadystatechange=stateChanged;

	// do send the query
	xmlHttp.open('GET',url,true);
	xmlHttp.send(null);
	// 0	The request is not initialized
	// 1	The request has been set up
	// 2	The request has been sent
	// 3	The request is in process
	// 4	The request is complete
	function stateChanged()
	{
		if(xmlHttp.readyState==0)
		{// 0	The request is not initialized
// 			alert('The request is not initialized');
		}
		if(xmlHttp.readyState==1)
		{// 1	The request has been set up
// 			alert('The request has been set up');
		}
		if(xmlHttp.readyState==2)
		{// 2	The request has been sent
// 			alert('The request has been sent');
		}
		if(xmlHttp.readyState==3)
		{// 3	The request is in process
// 			alert('The request is in process');
		}
		if(xmlHttp.readyState==4)
		{// 4	The request is complete
			var HttpNode = xmlHttp.responseText;
			//alert(HttpNode);
			document.getElementById('gui').innerHTML=xmlHttp.responseText;
			events();//update binding !!!
		}
	}
	return false;
}

function lock4AJAX()
{
	return false;
}

function events()
{
	// allow drag'n'drop to choose the color
	adddragndrop();

	// style
	document.getElementById('howto').style.display = 'block';
	document.getElementById('flag').style.display = 'block';
	// prevent submit if the row is incomplete
	game_form = document.getElementById('guess');
	addEvent(game_form, 'onsubmit', check_game);

	// AJAX
	addEvent(game_form, 'onsubmit', AJAX_play);
	addEvent(game_form, 'onsubmit', lock4AJAX);

}






