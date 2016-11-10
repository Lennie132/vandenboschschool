<?php
  smart_include_css('css/style.less');
  smart_include_css('css/style.css');
  smart_include_js('main.js');


  $config = array(
      'tabelnaam' => $tabelnaam,
      'group_id' => $DATA['group'],
      'order' => 'a.gewicht ASC', // bv: RAND()
      'artikel_id' => $DATA['artikel_id'],
      'limit_links' => 0,
      'where' => '',
      'module' => 0,
      'class' => '',
      'afbeelding_veld' => 'Afbeelding',
      'album_veld' => 'Album',
      'bestand_veld' => 'Bestand'
  );

  $artikel = get_artikelen_arr($config['tabelnaam'], $config['group_id'], $config['order'], $DATA['artikel_id']);



  if (!empty($artikel)) {
    //print_pre($artikel);
    $images = get_art_multi_files($artikel['afbeeldingen']['DATA'], $DATA['artikel_id'], $DATA['m']);
    ?>
    <section class="mod_fotoalbum">
      <div class="gallery-wrapper">
          <?php if ($DATA['page'] != get_variabele('page_nieuws')) { ?>
            <div class="row">
          <div class="col-xs-12">
            <h2 class="gallery-wrapper__title"><?= get_vertaling('fotoalbums'); ?></h2>
          </div>
        </div>
  <?php } ?>
        
        <div class="row">
          <div class="col-xs-12 album-kruimel">
            <h3><a href="<?= link::c($DATA['page']); ?>"><?= get_vertaling('fotoalbum'); ?></a> - <?= $artikel['titel']['DATA']; ?></h3>
          </div>
        </div>
        <div class="row">
          <?php
          $cfHelper = 1;
          foreach ($images as $img) {
            $img = $img['path'];
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
              <div class="gallery-item">
                <a class="fancybox" rel="<?= $artikel['titel']['DATA']; ?>" href="<?= $img; ?>">
                  <img src="<?= $img != '' ? lcms::resize($img, 320, 213, '320x213', 80) : 'img/img_placeholder.png'; ?>" class="img-responsive" alt="<?= $artikel['titel']['DATA']; ?>">
                  <div class="image-overlay">
                    <span class="icon icon-search"></span>
                  </div>
                </a>
              </div>
            </div>
            <?php
            if ($cfHelper % 4 == 0) {
              ?><div class="clearfix visible-lg"></div><?php
            }
            if ($cfHelper % 3 == 0) {
              ?><div class="clearfix visible-md"></div><?php
            }
            if ($cfHelper % 2 == 0) {
              ?><div class="clearfix visible-sm"></div><?php
              }
              $cfHelper++;
            }
            ?>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <a href="<?= link::c($DATA['page']); ?>"><?= get_vertaling('terug_nieuws'); ?></a>
          </div>
        </div>
      </div>
    </section>
    <?php
  }
?>
