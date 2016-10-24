<?php
  if ($DATA['page'] == get_variabele('page_fotoalbum')) {
    //--- Groepen ophalen
    $groepen_arr = get_artikel_groepen_arr($DATA['group'], 'g.gewicht ASC');

    if ($DATA['group'] != "") {
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="gallery-breadcrumbs">
            <?= lcms::Breadcrums()->setHomepage(get_absolute_parent($DATA['page']))->getHtml(); ?>
          </div>
        </div>
      </div>
    <?php }
    ?>

    <div class="row">
      <div class="gallery-groups">

        <?php
        $tel = 1;
        foreach ($groepen_arr as $groep) {
          //Afbeelding ophalen voor groep-afbeelding
          $config = array(
              'tabelnaam' => $tabelnaam,
              'group_id' => $groep['group_id'],
              'order' => 'a.gewicht ASC', // bv: RAND()
              'artikel_id' => 0,
              'limit_links' => 0,
              'where' => '',
              'module' => 0,
          );
          $art_arr = get_artikelen_arr($config['tabelnaam'], $config['group_id'], $config['order'], $config['artikel_id'], $config['limit_links'], $config['where']);
          $images = get_art_multi_files($art_arr[0]['afbeeldingen'], $art_arr[0]['artikel_id'], $DATA['m']);
          $subgroepen_arr = get_artikel_groepen_arr($groep['group_id']);

          if (!empty($art_arr) || !empty($subgroepen_arr)) {
            $class = "";
            if (trim($images[1]['path']) != '') {
              $src = $images[1]['path'];
            } else {
              $src = "img/default-fotoalbum-no-preview.jpg";
              $class = "gallery-item__preview--no-image";
            }
            ?>

            <div class="gallery-group col-sm-6 col-md-4">

              <div class="gallery-item__preview <?= $class; ?>">
                <a href="<?= maak_link($DATA['page'], '', '', $groep['group_id']) ?>" title="<?= $groep['group_name'] ?>">
                  <img src="<?= lcms::resize($src, 480, 320, '480x320', 80); ?>" class="img-responsive" alt="<?= $groep['group_name'] ?>">
                  <div class="gallery-item__overlay">
                    <span class="gallery-item__icon icon-images"></span>
                  </div>
                </a>
              </div>

              <a class="gallery-group__link" href="<?= maak_link($DATA['page'], '', '', $groep['group_id']) ?>" title="<?= $groep['group_name'] ?>">
                <h2 class="gallery-group__title"><?= $groep['group_name'] ?></h2>
              </a>

            </div>
            <?php if ($tel % 3 == 0) {
              ?>
              <div class="clearfix hidden-xs hidden-sm"></div>
              <?php
            }
            if ($tel % 2 == 0) {
              ?>
              <div class="clearfix hidden-xs hidden-md hidden-lg"></div>
              <?php
            }
            $tel++;
            ?>

            <?php
          }
        }
        ?>

      </div>
    </div>
  <?php } ?>