<?php
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

?>

