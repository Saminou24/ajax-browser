<?php
function snippets_latest_pro()
{
$label = _('Buy <em>Pro</em>!');
return <<<PRO
<div id='dl-pro' class='dwld' title='Last Pro version'>
  <a href='/misc/downloads/latest.pro'>
  <span class='dwl'>
    <span>
      <img src='/images/dl-pro.png' alt='' />{$label}
    </span>
  </span>
  </a>
</div>
PRO;
}

function snippets_latest_free()
{
$label = _('Get <em>Free</em>');
return <<<FREE
<div id='dl-free' class='dwld' title='Last Free version'>
  <a href='/misc/downloads/latest.free'>
  <span class='dwl'>
    <span>
      <img src='/images/dl-free.png' alt='' />{$label}
    </span>
  </span>
  </a>
</div>
FREE;
}

function snippets_donate()
{
$label = _('Donation');
$donation = _('Donation&thinsp;!');
return <<<DON
<h3 class='h'>{$label}</h3>
<form class='donation' action='https://www.paypal.com/cgi-bin/webscr' method='post'>
  <fieldset>
    <input type='hidden' name='cmd' value='_s-xclick' />
    <input type='hidden' name='encrypted' value='-----BEGIN PKCS7-----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-----END PKCS7-----' />
    <div>
    <button type='submit' name='submit' title='paypal'>
      <span class='dwl'>
        <span>
          <img src='/images/money_euro.png' alt='' />
          {$donation}
        </span>
      </span>
    </div>
    </button>
  </fieldset>
</form>
DON;
}

function yes()
{
  return "<img src='/images/yes.png' alt='"._("Yes")."' title='"._("Yes")."' />";
}
function no()
{
  return "<strong><img src='/images/no.png' alt='"._("No")."' title='"._("No")."' /></strong>";
}

?>