<?php
  $groepen_arr = get_artikel_groepen_arr($DATA['group'], 'g.gewicht ASC');

  if (!empty($groepen_arr)) {
    ?>
    <div class="row">
      <div class="col-xs-12">
        <h2><?= get_vertaling('fotoalbums'); ?></h2>
      </div>
    </div>
    <div class="row">
      <?php
      $cfHelper = 1;
      foreach ($groepen_arr as $groep) {
        //--- Afbeelding ophalen
        $afbeelding = get_artikelen_arr('art_fotoalbum', $groep['group_id'], 'a.gewicht DESC', '', 1);
        if (trim($afbeelding[0]['hoofdafbeelding']) != '') {
          $img = get_art_file_path($afbeelding[0]['hoofdafbeelding'], $afbeelding[0]['artikel_id']);
        } else {
          $img = 'img/default-fotoalbum-placeholder.png';
        }
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <div class="gallery-wrapper">
            <div class="gallery-item">
              <a href="<?= link::c($DATA['page'])->artikel_groep($groep['group_id']); ?>" title="<?= $groep['group_name']; ?>">
                <img src="<?= lcms::resize($img, 320, 213, '320x213', 80); ?>" class="img-responsive" alt="<?= $artikel['titel']; ?>">
                <div class="image-overlay">
                  <span class="icon icon-link"></span>
                </div>
              </a>
              <div class="gallery-title">
                <?= $groep['group_name']; ?>
              </div>
            </div>
            <?php /*
              <a href="<?= link::c($DATA['page'])->artikel_groep($groep['group_id']); ?>">
              <?= $groep['group_name'] ?>
              </a>
             */ ?>
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
    <?php
  }
?>
