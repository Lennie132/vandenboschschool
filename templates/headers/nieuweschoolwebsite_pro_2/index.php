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
  <!-- Hier wordt de standaard breedte voor masonry-grid beslist, zie LESS->.grid-sizer (NIET VERWIJDEREN) -->
  <div class="grid-sizer"></div>

  <!-- Standaard blok dat altijd linksboven staat -->
  <div class="main-block grid-item col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="main-block__wrapper">
      <div class="main-block__content">
        <div class="main-block__top-wrapper">
          <div class="main-block__phone-number">
            <img src="img/icon-telefoon.png" alt="icon-telefoon"/>
            <a href="tel:<?= get_variabele('telefoonnummer'); ?>"><?= get_variabele('telefoonnummer'); ?></a>
          </div>

          <div class="main-block__search pull-right">
            <form class="main-block__search-form" action="<?= link::v('page_zoekresultaten') ?>" method="get">
              <label class="main-block__search-icon" for="zoekopdracht"><img src="img/icon-zoek.png" alt="icon-zoek"/></label>
              <input class="main-block__search-input" type="text" id="zoekopdracht" name="zoekopdracht" placeholder="zoeken..."/>
              <button class="main-block__search-button" type="submit">zoek</button>
            </form>
          </div>
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
