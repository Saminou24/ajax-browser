<?php
// phpinfo();
// ALLOWED PAGES ! see toolbox.php
require_once 'toolbox.php';
require_once 'snippets.php';
require_once 'i18n.phpc';
lang();
// require_once 'i18n-'.lang().'.php';
require_once 'news.php';
require_once 'admin.phpc';
$backoffice = new admin();
// dump($_SERVER);
$_GLOBALS['BASE_URI'] = $_SERVER["REDIRECT_URL"].'';
// parse_query_string();

$page = include_page();
// var_dump($page);

?>
<?php require_once 'header.php'; ?>
<body class='bg1 bg2'>
  <div id='layout'>
    <div id='logo' title="<?php echo _('Home page'); ?>">
      <div id='skip'>
        <a href='#lang' class='h'><?php echo _('switch language'); ?></a>
        <a href='#content' class='h'><?php echo _('skip to main content'); ?></a>
      </div>
      <a href='?p=<?php echo _('home'); ?>'><img src='/images/logo.png' alt="<?php echo _('go to home page'); ?>"/></a>
    </div>
    <?php
      require_once 'menu.php';
      //dump($_SESSION);
      echo $backoffice->logged();
    ?>
    <br class='clear' />
    <div id='content'>
      <?php require_once $page['file']; ?>
    </div>

    <?php require_once 'footer.php'; ?>
  </div>
</body>
</html>