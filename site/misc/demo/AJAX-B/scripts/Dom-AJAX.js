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