<?
// FRENCH i18n
// @ symbol indicate that the following part is an HTML attribute
$GLOBALS['i18n:file'] = array(
// PAGE FILE
  'file:home' => 'acceuil',
  'file:features' => 'fonctionnalités',
  'file:screenshots' => 'aperçu',
  'file:demo' => 'démo',
  'file:download' => 'téléchargement',
  'file:faq' => 'faq',
  'file:documentation' => 'documentation',
  'file:forum' => 'forum',
  'file:contact' => 'contact',
  'file:team' => 'équipe',
  '' => ''
);
$GLOBALS['i18n'] = array(
// HTML header
  'htmllang' => 'fr',
  'htmlkeywords' => 'AJAXbrowser, AJAX-browser, AJAX, javascript, PHP, explorateur, dossiers, fichiers, gestionnaire de fichiers, domaine, galerie, arborescence, miniature, outil d&#039;administration',
  'htmldesc' => 'AJAX-Browser est un gestionnaire de fichier par protocole HTTP ; écrit entièrement en PHP/AJAX il vous permettra de gérer vos fichier disatant sans nécessiter un client FTP. C&#039;est un projet sous licence LGPL.',
  'title' => 'AJAX-browser',

// MENU
	'menulang' => 'Liste des Langues',
	'menuheader' => 'Menu de navigation',
  'menu.a:home' => 'Acceuil',
  'menu.a:home@title' => 'Description succinte du projet',
  'menu.a:features' => 'Fonctionnalités',
  'menu.a:features@title' => 'Liste des fonctionnalités.',
  'menu.a:screenshots' => 'Aperçu',
  'menu.a:screenshots@title' => 'Captures d&#039;écran.',
  'menu.a:demo' => 'Démo',
  'menu.a:demo@title' => 'Tester en ligne (version Pro).',
  'menu.a:download' => 'Téléchargement',
  'menu.a:download@title' => 'Version Gratuite, payante et versions antérieures.',
  'menu.a:FAQ' => 'FAQ',
  'menu.a:FAQ@title' => 'Foire Aux Questions.',
  'menu.a:doc' => 'Documentation',
  'menu.a:doc@title' => 'Aide à l&#039;installation et utilisation.',
  'menu.a:forum' => 'Forum',
  'menu.a:forum@title' => 'Forum francophones ou anglophones.',
  'menu.a:contact' => 'Contact',
  'menu.a:contact@title' => 'Si vous avait besoin d&#039;autre chose.',
  'menu.a:team' => 'Équipe',
  'menu.a:team@title' => 'Participants aux projet.',
  '' => '',

// INDEX
  'logo.div@title' => 'Page d&#039;acceuil',
  'logo.a@alt' => 'Allez à la page d&#039;aceuil',
  'logo.a' => 'acceuil',
  'switchlang' => 'changer la langue',
  'skip2content' => 'allez au contenu principal',

// FOOTER
  'footer.h2-last' => 'Pied de page',
  'footer.ARR' => ' – Tous droits réservés.',
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
	'home.h2-1' => 'Présentation',
	'home.h3-1' => 'À propos',
  'home.about' =><<<ABOUT
Le projet AJAX-Browser a commencé en 2006 comme en tant que script pour gérer mes fichiers distants. À cette époque je travail à la fois sur Windows® et Linux, j'avais donc besoin d'une applications multi-plateforme. Comme les clients <abbr title='File Transfer Protol'>FTP</abbr> n'étaient soit pas assez conviviaux, soit pas absent sur l'un des deux systèmes, j'ai décidé de créé ce projet en m'appuyant sur la portabilité et la popularité des navigateurs Web.
ABOUT
,
  'home.h3-2' => 'Description',
  'home.desc' => <<<DESC
<p>Le projet est écrit en <acronym title='Asyncronous Javascript And XML'>AJAX</acronym> et <acronym title='PHP: Hypertext Preprocessor'>PHP</acronym>, qui sont toutes deux des technologies très répandues dans les navigateurs web moderne et sur les serveurs web. De plus, <acronym title='PHP: Hypertext Preprocessor'>PHP</acronym> rend l'application <em>facile à installer </em> et <acronym title='Asyncronous Javascript And XML'>AJAX</acronym> permet une réactivité et une <strong>utilisation intuitive</strong>.</p>
You will find the following features like on your <abbr title='Operating System'>OS</abbr> browser&thinsp;:
<ul>
	<li>Gestion des fichiers (glisser-déposer, sélection avancée, couper/copier/coller, etc.)&thinsp;;</li>
	<li>Pose de filigrane sur les images (<span lang='en'>watermark</span>)&thinsp;;</li>
	<li>Édition en ligne de fichiers, avec coloration syntaxique (<abbr title='confer' lang='la'>cf</abbr>. <a href='http://codepress.org/'>Codepress</a>)&thinsp;;</li>
	<li>Compression et extraction en ligne (<abbr title='confer' lang='la'>cf</abbr>. <a href='?p=documentation.easyarchive'>EasyArchive</a>)&thinsp;;</li>
	<li>Envoi et téléchargement (archive)&thinsp;;</li>
	<li>Gestion avancée des droits (de type UNIX)&thinsp;;</li>
	<li>Journal d'activité (<span lang='en'>log</span>)&thinsp;;</li>
	<li>Support de thèmes et personalisation&thinsp;;</li>
	<li>Support des locales (<abbr title='Localisation'>i10n</abbr> and ) multilingues (<abbr title='Internationalization' lang='en'>i18n</abbr>).</li>
</ul>
voir la <a href='?p={$GLOBALS['i18n:file']['file:features']}'>liste complète des fonctionnalités</a>.
DESC
  ,
  'home.h3-3' => 'Téléchargement rapide',
  'home.download' => 'Télécharger la dernière version',
  'home.h3-4' => 'News',
  'home.h3-5' => 'Faire un don',
  'home.donation' => 'Aider ce projet&thinsp;!',
  '' => '',
  '' => '',
  '' => '',

	// NEWS
		'news.todo' => 'Aucun système de news installé.',
		'' => '',
		'' => '',
		'' => '',
		'' => '',
		'' => '',
		'' => '',

// FEATURES
  'features.h1' => 'Fiste des fonctionnalités',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// SCREENSHOTS
  'screenshots.h1' => 'Captures d\'écran',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// DEMO
  'demo.h1' => 'Démonstration en ligne',
  'demo.info' => 'Remarquer que la démo en ligne est <em>basée sur la version Pro</em>.',
  'demo.h2-1' => 'Mode <em>arborescence</em>',
  'demo.h2-2' => 'Mode <em>aperçu</em>',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// DOWNLOAD
  'get.h1' => 'Téléchargement',
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

// FAQ
  'faq.h1' => 'Foire Aux Questions',
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
  'team.h1' => 'Équipe',
  'team_member_role' => 'Rôle',
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