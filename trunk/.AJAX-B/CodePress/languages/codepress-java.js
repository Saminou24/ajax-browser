/*
 * CodePress regular expressions for Java syntax highlighting
 */
 
syntax = [ // Java
	/([\"\'].*?[\"\'])/g,'<s>$1</s>', // strings
	/(\W|^)(abstract|continue|for|new|switch|assert|default|goto|package|synchronized|boolean|do|if|private|this|break|double|implements|protected|throw|byte|else|import|public|throws|case|enum|instanceof|return|transient|catch|extends|int|short|try|char|final|interface|static|void|class|finally|long|strictfp|volatile|const|float|native|super|while)(\b)/g,'$1<b>$2</b>$3', // reserved words
	/([^:]|^)\/\/(.*?)(<br>|<\/P>)/g,'$1<i>//$2</i>$3', // comments
	/\/\*(.*?)\*\//g,'<i>/*$1*/</i>' // comments
];

CodePress.initialize();

