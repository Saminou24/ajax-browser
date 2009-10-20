<?php require_once 'download.phpc'; ?>

<h1><?php echo _('Download'); ?></h1>
<div id='site' class='page'>
  <div id='download'>
    <h3 id='pro'><?php echo _('<em>Pro</em> version'); ?></h3>
    <div id='dwl-pro'>
        <?php echo snippets_latest_pro(); ?>
        <p><?php echo _("The <em>Pro</em> version offer <strong>more features</strong> than the free one (see <a href='?p=Features#comparison'>versions comparison</a>). However, its use and redistribution are limited under copyright laws. All pro versions are listed below (newest first)&thinsp;:"); ?></p>
      <dl class='mark inl'>
        <?php echo downloadable_list('pro'); ?>
      </dl>
    </div>

    <h3 id='free'><?php echo _('<em>Free</em> version'); ?></h3>
    <div id='dwl-free'>
      <?php echo snippets_latest_free(); ?>
      <p><?php echo _("The <em>free</em> version keep main features as shown on the <a href='?p=Features#comparison'>versions comparison</a> table. You can use and redistribute it under the GNU GPL licence. All <em>free</em> versions are listed below (newest first)&thinsp;:"); ?></p>
      <dl class='mark inl'>
        <?php echo downloadable_list('free'); ?>
      </dl>

    </div>

    <h3 id='icons'><?php echo _('Icons set'); ?></h3>
    <div id='dwl-icons'>
      <dl class='mark inl'>
        <?php echo downloadable_list('icons'); ?>
      </dl>
    </div>

    <h3 id='languages'><?php echo _('Languages pack'); ?></h3>
    <div id='dwl-lang'>
      <dl class='flt mark inl'>
        <?php echo downloadable_list('languages'); ?>
      </dl>
    </div>

  </div>
</div>