/*
 * CodePress regular expressions for CSS syntax highlighting
 */

syntax = [ // CSS
	/(.*?){(.*?)}/g,'<b>$1</b>{<u>$2</u>}', // tags, ids, classes, etc
	/([\w-]*?):([^\/])/g,'<em>$1</em>:$2', // keys
	/([\"\'].*?[\"\'])/g,'<s>$1</s>', // strings
	/\/\*(.*?)\*\//g,'<i>/*$1*/</i>', // comments
];

CodePress.initialize();

