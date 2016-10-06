<?php
lcms_client_script::add_header_css('/css/header.less');
lcms_client_script::add_header_css('/css/menu.less');
?>

<header>
    <div class="header-wrapper">
      <?php  //lcms::Menu()->setNiveausDiep(2)->setClass('main-nav list-unstyled')->getHTML(); ?>
      <?= get_menu(0, '', 'main-nav list-unstyled'); ?>
    </div>
</header>

<!-- Hier wordt masonry-grid geopend. Sluiting div staat in main->index.php -->
<div class="grid">

<!-- Standaard blok dat altijd linksboven staat -->
  <div class="main-block grid-item col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <div class="main-block__wrapper">
        <div class="main-block__content">
          <div class="main-block__phone-number">
            <img src="img/icon-telefoon.png" alt="icon-telefoon"/>
            <a href="tel:<?= get_variabele('telefoonnummer'); ?>"><?= get_variabele('telefoonnummer'); ?></a>
          </div>
          <div class="main-block__logo">
            <?php echo lcms::Logo()->setMaxSizes(999, 999)->getHTML();  ?>
          </div>
          <div class="main-block__footer">
            <?= lcms::Header()->getSectieContent('content') ?>
          </div>
        </div>
      </div>
  </div>
