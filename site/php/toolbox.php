<?php
// ALLOWED PAGES !
$GLOBALS['i18n:file'] = array(
// PAGE FILE
  'home' => 'home',
  'features' => 'features',
  'gallery' => 'screenshots',
  'demo' => 'demo',
  'download' => 'download',
  'help' => 'help',
  'faq' => 'faq',
  'documentation' => 'documentation',
  'forum' => 'forum',
  'contact' => 'contact',
  'team' => 'team',
  'admin' => 'administration',
  '' => ''
);

// error_reporting(E_ALL);
// ini_set('display_errors', 'on');

function set_arg($key, $file = NULL, $line = NULL)
{// return FALSE if the requested $_REQUEST key doesn't exists
	if (isset($_REQUEST[$key])==TRUE)
	{
// 		return $_REQUEST[$key];
		return TRUE;
	} else {
// 		echo '>>> undef variable in <var class=\'e\'>'.basename($file).':'.$line.'</var><br/>';
		return FALSE;
	}
}


function here($file, $line)
{
	return basename($file).':'.$line.'<br/>';
}

function dump($var)
{
// 	echo '<br/>_____________________<pre>';
	echo '<blockquote><pre>';
		var_dump($var);
	echo '</pre></blockquote>';
// 	echo '</pre>^^^^^^^^^^^^^^^^^^^^^<br/>';
}

function glue($var)
{
	echo $var;
}


function array2select($name = 'unknown', $data = array('all' => 'â All â'), $select, $affich = TRUE)
{
	$result = "<select id='{$name}' name='{$name}'>";

	foreach ($data as $key => $value)
	{
		if ($key==$select)
		{
			$selected = "selected='selected'";
		} else {
			$selected = '';
		}
		$result .= "<option {$selected} value='{$value}'>{$key}</option>";
	}
	$result .= '</select>';
}

/*function br($varname) {
	global $$varname;
	var_dump($$varname);
	if (is_array($$varname)==TRUE)
	{
		echo $varname.':'; dump($$varname);
	} else
	{
		echo $varname.':'.$$varname;
	}
	echo '<br/>';
// 	echo $var.': '.$$var;
}*/
// $yourvariable = 'foobar';
// examplefunc('yourvariable');

function br($var = '')
{
	if (is_array($var)==TRUE)
	{
		echo dump($var);
	} else
	{
		echo $var;
	}
	echo '<br/>';
}


function google_finance($i, $j)
{
  return 1.25;
}

function currency($price)
{
  $current_currency = 'EUR';
  $currency = localeconv();
  $dest_currency = $currency['int_curr_symbol'];
  $out = "%.".$currency["frac_digits"]."n";
  $out = "%.0n";

  if ($current_currency == trim($dest_currency))
  {
    //dump($current_currency." == ".$dest_currency.$price);
    return money_format($out, $price);
  } else
  {
    require_once("GoogleCurrencyConvertor.phpc");
//     $gcc = new GoogleCurrencyConvertor($price, $current_currency, $dest_currency);

//     return money_format($out, round($gcc->getRate()));
      return $price;
  }
}

function urlizer($str)
{
  return htmlspecialchars($str, ENT_QUOTES);
}


function last_version()
{
  return '2.03-FAKE';
}

function is_locale($env, $me)
{
  if ($env==$me)
  {
    return "class='active'";
  } else
  {
    return '';
  }
}

function status($item)
{// add a CSS-class to the menu entry of the requested page
  //dump($_REQUEST['p']); dump($item);
  if (isset($_REQUEST['p'])==FALSE)
  {// aucune page demander = page d'acceuil
    if ($item==$GLOBALS['i18n:file']['home'])
    {
      return 'current ';
    }
  } else
  {// client ask a page
    if ($item==strtolower($_REQUEST['p']))
    {
      return 'current ';
    }
  }
}


function include_page()
{// we include the requested file if it's a valid one, else homepage

  // default page
  $key = 'home';
  $file = str_replace('', '', $key);

  if (isset($_REQUEST['p'])==TRUE)
  {
    $req = mb_strtolower($_REQUEST['p']); # some issue on capital character
//     dump($req);
    if (in_array($req, $GLOBALS['i18n:file'])==TRUE)
    {// the requested page is a valid file
      $key = array_search($req, $GLOBALS['i18n:file']);
      $file = str_replace('', '', $key);
    }
  }
//   dump($file);
  $page['file'] = $file.'.php';
  $page['title'] = ucfirst($GLOBALS['i18n:file'][$key]);

  return $page;
}
?>

