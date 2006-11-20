/*
 * CodePress regular expressions for JavaScript syntax highlighting
 */
 
syntax = [ // JavaScript
	/([\"\'])(.*?)([\"\']|<br>|<\/P>)/g,'<s>$1$2$3</s>', // strings
	/(break|continue|do|for|new|this|void|case|default|else|function|return|typeof|while|if|label|switch|var|with|catch|boolean|int|try|false|throws|null|true|goto)([ \.\"\'\{\(\);,&<])/g,'<b>$1</b>$2', // reserved words
	/(alert|isNaN|parent|Array|parseFloat|parseInt|blur|clearTimeout|prompt|prototype|close|confirm|length|Date|location|scroll|Math|document|element|name|self|elements|setTimeout|navigator|status| String|escape|Number|submit|eval|Object|event|onblur|focus|onerror|onfocus|top|onload|toString|onunload|unescape|open|opener|valueOf|window)([ \.\"\'\{\(\);,&<])/g,'<u>$1</u>$2', // special words
	/([\(\){}])/g,'<em>$1</em>', // special chars;
	/([^:]|^)\/\/(.*?)(<br>|<\/P>)/g,'$1<i>//$2</i>$3', // comments //
	/(\/\*)(.*?)\*\//g,'<i>$1$2*/</i>' // comments /* */
];

CodePress.initialize();

