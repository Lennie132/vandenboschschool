<?php
/** Hier eventeel nog een sfeerbeeld of kruimels o.i.d. inladen **/
$sfeer = get_sfeerafbeelding($DATA['page'], 1);

/** Hier wordt het grid met de content ingelezen **/
//echo $this->buildHTMLgrid($DATA['page']);

/** Individuele content inlezen **/
//echo lcms::Template()->getSectieContent($DATA['page'], '<id van sectie>');
?>
<div class="grid-item col-md-8 col-xs-12 content">
  <?php if (trim($sfeer) != '') {
    ?>
    <div class="content__sfeerbeeld" style="background-image: url('<?= lcms::resize($sfeer, 1250, 500, '', 80); ?>');">
      <div class="content__titel-wrapper content__titel-wrapper--overlay">
        <h1 class="content__titel"><?php echo get_pagina_title($pageid) ?></h1>
      </div>
    </div>
    <?php
  } else {
    ?>
    <div class="content__titel-wrapper">
      <h1 class="content__titel"><?php echo get_pagina_title($pageid) ?></h1>
    </div>
    <?php
  }
  ?>

  <div class="content__main">
    <div class="row">
      <div class="col-md-6">
        <?php
        /** Hier wordt het linker deel ingelezen * */
        echo lcms::Template()->getSectieContent($DATA['page'], 'links');
        ?>
      </div>
      <div class="col-md-6">
        <?php
        /** Hier wordt het rechter deel ingelezen * */
        echo lcms::Template()->getSectieContent($DATA['page'], 'rechts');
        ?>
      </div>
    </div>

  </div>
  <!-- Roze bar onderin -->
  <div class="content__bottom-bar"></div>
</div>