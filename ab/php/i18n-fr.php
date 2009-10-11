<?php // FRENCH i18n
// @ symbol indicate that the following part is an HTML attribute
$GLOBALS['i18n:file'] = array(
// PAGE FILE
  'home' => 'acceuil',
  'features' => 'fonctionnalitÃ©s',
  'gallery' => 'aperÃ§u',
  'demo' => 'dÃ©mo',
  'download' => 'tÃ©lÃ©chargement',
  'faq' => 'faq',
  'help' => 'aide',
  'documentation' => 'documentation',
  'forum' => 'forum',
  'contact' => 'contact',
  'team' => 'Ã©quipe',
  'admin' => 'administration',
  '' => ''
);
$GLOBALS['i18n'] = array(
// HTML header
  'htmllang' => 'fr',
  'htmlkeywords' => 'AJAXbrowser, AJAX-browser, AJAX, javascript, PHP, explorateur, dossiers, fichiers, gestionnaire de fichiers, domaine, galerie, arborescence, miniature, outil d&#039;administration',
  'htmldesc' => 'AJAX-Browser est un gestionnaire de fichier par protocole HTTP ; Ã©crit entiÃ¨rement en PHP/AJAX il vous permettra de gÃ©rer vos fichier disatant sans nÃ©cessiter un client FTP. C&#039;est un projet sous licence LGPL.',
  'title' => 'AJAX-browser',

// MENU
	'menulang' => 'Liste des Langues',
	'menuheader' => 'Menu de navigation',
  'menu.a:home' => 'Acceuil',
  'menu.a:home@title' => 'Description succinte du projet',
  'menu.a:features' => 'FonctionnalitÃ©s',
  'menu.a:features@title' => 'Liste des fonctionnalitÃ©s.',
  'menu.a:screenshots' => 'AperÃ§u',
  'menu.a:screenshots@title' => 'Captures d&#039;Ã©cran.',
  'menu.a:demo' => 'DÃ©mo',
  'menu.a:demo@title' => 'Tester en ligne (version Pro).',
  'menu.a:download' => 'TÃ©lÃ©chargement',
  'menu.a:download@title' => 'Version Gratuite, Pro et versions antÃ©rieures.',
  'menu.a:help' => 'Aide',
  'menu.a:help@title' => 'FAQ, Docs, Forum.',
  'menu.a:FAQ' => 'FAQ',
  'menu.a:FAQ@title' => 'Foire Aux Questions.',
  'menu.a:doc' => 'Documentation',
  'menu.a:doc@title' => 'Aide Ã  l&#039;installation et utilisation.',
  'menu.a:forum' => 'Forum',
  'menu.a:forum@title' => 'Forum francophones ou anglophones.',
  'menu.a:contact' => 'Contact',
  'menu.a:contact@title' => 'Si vous avait besoin d&#039;autre chose.',
  'menu.a:team' => 'Ãquipe',
  'menu.a:team@title' => 'Participants aux projet.',
  '' => '',

// INDEX
  'logo.div@title' => 'Page d&#039;acceuil',
  'logo.a@alt' => 'Allez Ã  la page d&#039;aceuil',
  'logo.a' => 'acceuil',
  'switchlang' => 'changer la langue',
  'skip2content' => 'allez au contenu principal',
  'index#login' => 'connexion',
  'index#login@title' => 'passer en mode administrateur',
  'index#logout' => '<em>dÃ©</em>connexion',
  'index#logout@title' => 'quitter le mode administrateur',

// FOOTER
  'footer.h2-last' => 'Pied de page',
  'footer.ARR' => ' â Tous droits rÃ©servÃ©s.',
	'CSS@alt' => 'Valid CSS 2.1',
  'CSS@title' => 'Valid CSS 2.1',
  'XHTML@alt' => 'Valid XHTML 1.0 Strict',
  'XHTML@title' => 'Valid XHTML 1.0 Strict',
  'WCAG@href' => 'http://fr.wikipedia.org/wiki/Accessibilit%E9_du_Web#Recommandations_pour_le_contenu',
  'WCAG@alt' => 'WCAG-AA',
  '' => '',
  '' => '',
  '' => '',

// HOMEPAGE
  'home.h1' => 'Page d\'Acceuil',
	'home.h2-1' => 'PrÃ©sentation',
	'home.h3-1' => 'Ã propos',
  'home.about' =><<<ABOUT
Le projet AJAX-Browser a commencÃ© en 2006 comme en tant que script pour gÃ©rer mes fichiers distants. Ã cette Ã©poque je travail Ã  la fois sur WindowsÂ® et Linux, j'avais donc besoin d'une <strong>applications multi-plateforme</strong>. Comme les clients <abbr title='File Transfer Protol'>FTP</abbr> n'Ã©taient soit pas assez conviviaux, soit pas absent sur l'un des deux systÃ¨mes, j'ai dÃ©cidÃ© de crÃ©Ã© ce projet en m'appuyant sur la <strong>portabilitÃ©</strong> et la <strong>popularitÃ©</strong> des navigateurs Web.
ABOUT
,
  'home#sample' => "<div id='sample'><a href='?p={$GLOBALS['i18n:file']['screenshots']}'><img src='./misc/screenshots/thumbs/00-samples.png' title='galerie des captures d'Ã©cran.' alt='voir les captures.' /></a></div>",
  'home.h3-2' => 'Description',
  'home.desc' => <<<DESC
<p>Le projet est Ã©crit en <abbr title='Asyncronous Javascript And XML'>AJAX</abbr> et <abbr title='PHP: Hypertext Preprocessor'>PHP</abbr>, qui sont toutes deux des technologies trÃ¨s rÃ©pandues dans les navigateurs web moderne et sur les serveurs web. De plus, <abbr title='PHP: Hypertext Preprocessor'>PHP</abbr> rends l'application <strong>facile Ã  installer </strong> et <abbr title='Asyncronous Javascript And XML'>AJAX</abbr> permet une rÃ©activitÃ© et une <strong>utilisation intuitive</strong>.</p>
Vous trouverez les fonctionnalitÃ©s suivantes, <em>similaires Ã  celle de l'explorateur de fichiers de votre <abbr title='Operating System'>OS</abbr>)</em>&thinsp;:
<ul>
	<li>Gestion des fichiers (glisser-dÃ©poser, sÃ©lection avancÃ©e, couper/copier/coller, etc.)&thinsp;;</li>
	<li>Pose de filigrane sur les images (<span lang='en'>watermark</span>)&thinsp;;</li>
	<li>Ãdition en ligne de fichiers, avec coloration syntaxique (<abbr title='confer' lang='la'>cf</abbr>. <a href='http://codepress.org/'>Codepress</a>)&thinsp;;</li>
	<li>Compression et extraction en ligne (<abbr title='confer' lang='la'>cf</abbr>. <a href='?p=documentation.easyarchive'>EasyArchive</a>)&thinsp;;</li>
	<li>Envois et tÃ©lÃ©chargements de fichiers sous formes d'archives&thinsp;;</li>
	<li>Gestion avancÃ©e des droits (de type UNIX)&thinsp;;</li>
	<li>Journal d'activitÃ© (<span lang='en'>log</span>)&thinsp;;</li>
	<li>Support de thÃ¨mes et personalisation&thinsp;;</li>
	<li>Support des locales (<abbr title='Localisation'>i10n</abbr> and ) multilingues (<abbr title='Internationalization' lang='en'>i18n</abbr>).</li>
</ul>
<p>Voir la <a href='?p={$GLOBALS['i18n:file']['features']}'>liste complÃ¨te des fonctionnalitÃ©s</a>.</p>
DESC
  ,
  'home.h3-3' => 'TÃ©lÃ©chargement rapide',
  'home.download' => '<a href=\'/misc/download/lastest\'>TÃ©lÃ©charger la <strong>derniÃ¨re version</strong></a>',
  'home.h3-4' => 'News',
  'home.h3-5' => 'Faire un don',
  'home.donation' => 'Donation&thinsp;!',
  '' => '',
  '' => '',
  '' => '',

	// NEWS
		'news.todo' => '<p>Aucun systÃ¨me de news installÃ©.</p>',
		'' => '',
		'' => '',
		'' => '',
		'' => '',
		'' => '',
		'' => '',

// FEATURES
  'features.h1' => 'Fiste des fonctionnalitÃ©s',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// SCREENSHOTS
  'screenshots.h1' => 'Captures d\'Ã©cran',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// DEMO
  'demo.h1' => 'DÃ©monstration en ligne',
  'demo.info' => 'Remarquer que la <strong>dÃ©mo en ligne est basÃ©e sur la version Pro</strong>.',
  'demo.h2-1' => 'Mode <em>arborescence</em>',
  'demo.h2-2' => 'Mode <em>aperÃ§u</em>',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// DOWNLOAD
  'get.h1' => 'TÃ©lÃ©chargement',
  'get.pro' => 'version <em>Pro</em>',
		'get.pro.latest' => '',
		'get.pro.older' => '',
  'get.free' => 'version <em>Gratuite</em>',
		'get.free.latest' => '',
		'get.free.older' => '',
  'get.lang' => 'Langues',
  'get.icons' => 'Jeu d&#039;icones',
	'' => '',
	'' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// HELP
  'help.h1' => 'Aide',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// FAQ
  'faq.h1' => "<abbr title='Foire Aux Questions'>FAQ</abbr>",
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// DOC
  'doc.h1' => 'Documentation',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// FORUM
  'forum.h1' => 'Forum',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// CONTACT
  'contact.h1' => 'Contacter nous',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// TEAM
  'team.h1' => 'Ãquipe',
  'team_member_role' => 'RÃ´le',
  'team_member_aka' => "alias",
  'team_member_country' => 'Pays',
  'team_member_mail' => 'E-mail',
  'team_member_website' => 'Site web',
  '' => '',
  '' => '',

//
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => ''

)
?>