/*
 * CodePress regular expressions for PHP syntax highlighting
 * By J. Nick Koston
 */

syntax = [ // PHP
	/(&lt;[^!\?]*?&gt;)/g,'<b>$1</b>', // all tags
	/(&lt;style.*?&gt;)(.*?)(&lt;\/style&gt;)/g,'<em>$1</em><em>$2</em><em>$3</em>', // style tags
	/(&lt;script.*?&gt;)(.*?)(&lt;\/script&gt;)/g,'<u>$1</u><u>$2</u><u>$3</u>', // script tags
	/\"(.*?)(\"|<br>|<\/P>)/g,'<s>\"$1$2</s>', // strings double quote
	/\'(.*?)(\'|<br>|<\/P>)/g,'<s>\'$1$2</s>', // strings single quote
	/(&lt;\?)/g,'<strong>$1', // <?.*
	/(\?&gt;)/g,'$1</strong>', // .*?>
	/(&lt;\?php|&lt;\?=|&lt;\?|\?&gt;)/g,'<cite>$1</cite>', // php tags		
	/(\$[\w\.]*)/g,'<var>$1</var>', // vars
	/(false|true|and|or|xor|__FILE__|exception|__LINE__|array|as|break|case|class|const|continue|declare|default|die|do|echo|else|elseif|empty|enddeclare|endfor|endforeach|endif|endswitch|endwhile|eval|exit|extends|for|foreach|function|global|if|include|include_once|isset|list|new|print|require|require_once|return|static|switch|unset|use|var|while|__FUNCTION__|__CLASS__|__METHOD__|final|php_user_filter|interface|implements|extends|public|private|protected|abstract|clone|try|catch|throw|this)([ \.\"\'\{\(;&<])/g,'<ins>$1</ins>$2', // reserved words
	/([^:])\/\/(.*?)(<br|<\/P)/g,'$1<i>//$2</i>$3', // php comments
	/\/\*(.*?)\*\//g,'<i>/*$1*/</i>', // php comments
	/(&lt;!--.*?--&gt.)/g,'<big>$1</big>' // html comments 
];

CodePress.initialize();

