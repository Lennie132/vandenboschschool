<?php
  smart_include_css('css/style.less');
  smart_include_css('css/style.css');
  smart_include_js('main.js');

  $config = array(
      'tabelnaam' => 'art_fotoalbum',
      'group_id' => $DATA['group'],
      'order' => 'a.gewicht ASC', // bv: RAND()
      'artikel_id' => 0,
      'limit_links' => 0,
      'where' => '',
      'module' => 0,
  );

//--- Groepen ophalen
  $art_arr = get_artikelen_arr($config['tabelnaam'], $config['group_id'], $config['order'], $config['artikel_id'], $config['limit_links'], $config['where']);

  if (!empty($art_arr)) {
    ?>
    <section class="mod_fotoalbum">
      <div class="gallery-wrapper">
        <?php
        if ($DATA['page'] == get_variabele('page_home')) {
          foreach ($art_arr as $artikel) {
            $img = get_art_file_path($artikel['hoofdafbeelding'], $artikel['artikel_id']);
            if (trim($img) != '') {
              ?>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="row">
                  <div class="fotos-wrapper">
                    <figure>
                      <img class="img-responsive" src="<?= lcms::resize($img, 481, 400, '481x400'); ?>" title="<?= $artikel['titel']; ?>" alt="<?= $artikel['titel']; ?>">
                    </figure>
                  </div>
                </div>
              </div>
              <?php
            }
          }
        } else {
          ?>
          <div class="row">
            <div class="col-xs-12">
              <h2 class="gallery-wrapper__title"><?= get_vertaling('fotoalbums'); ?></h2>
            </div>
          </div>
          <div class="row">
            <?php
            $cfHelper = 1;
            foreach ($art_arr as $artikel) {

              $img = get_art_file_path($artikel['hoofdafbeelding'], $artikel['artikel_id']);
              if ($img == '') {
                $img = 'img/default-fotoalbum-placeholder.png';
              }

              if (trim($img) != '') {
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                  <div class="gallery-item">
                    <a href="<?= $DATA['page'] == get_variabele('page_fotoalbum') ? link::c($DATA['page'])->artikel_groep($DATA['group'])->artikel_id($artikel['artikel_id']) : link::c($DATA['page'])->artikel_id($artikel['artikel_id']); ?>" title="<?= $artikel['titel']; ?>">
                      <img class="img-responsive" src="<?= lcms::resize($img, 320, 213, '320x213', 80); ?>" alt="<?= $artikel['titel']; ?>" />
                      <div class="image-overlay">
                        <span class="icon icon-link"></span>
                      </div>
                    </a>
                    <div class="gallery-title">
                      <?= $artikel['titel']; ?>
                    </div>
                  </div>
                </div>
                <?php
              }
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
          <?php
        }
        ?>

      </div>
    </section>

    <?php
  }

  $DATA['group'] = '';
?>
  