/*
 * CodePress regular expressions for HTML syntax highlighting
 */

syntax = [ // HTML
	/(&lt;[^!]*?&gt;)/g,'<b>$1</b>', // all tags
	/(&lt;style.*?&gt;)(.*?)(&lt;\/style&gt;)/g,'<em>$1</em><em>$2</em><em>$3</em>', // style tags
	/(&lt;script.*?&gt;)(.*?)(&lt;\/script&gt;)/g,'<u>$1</u><u>$2</u><u>$3</u>', // script tags
	/=(".*?")/g,'=<s>$1</s>', // atributes double quote
	/=('.*?')/g,'=<s>$1</s>', // atributes single quote
	/(&lt;!--.*?--&gt.)/g,'<i>$1</i>' // comments 
];

CodePress.initialize();

