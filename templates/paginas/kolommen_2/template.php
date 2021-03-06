<?php
  /** Hier eventeel nog een sfeerbeeld of kruimels o.i.d. inladen * */
  $sfeer = get_sfeerafbeelding($DATA['page'], 1);

  if (trim($sfeer) != '') {
    $src = $sfeer;
  } else {
    $src = 'img/default-sfeerbeeld.jpg';
  }

  /** Hier wordt het grid met de content ingelezen * */
//echo $this->buildHTMLgrid($DATA['page']);

  /** Individuele content inlezen * */
//echo lcms::Template()->getSectieContent($DATA['page'], '<id van sectie>');
?>
<div class="grid-item content col-md-8 col-xs-12">

  <div class="content__sfeerbeeld" style="background-image: url('<?= lcms::resize($src, 1250, 999, '', 80); ?>');">
    <div class="content__titel-wrapper content__titel-wrapper--overlay">
      <h1 class="content__titel"><?= get_pagina_title($pageid) ?></h1>
    </div>
  </div>

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
