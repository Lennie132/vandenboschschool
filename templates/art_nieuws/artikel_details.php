<?php
  smart_include_css('css/style.less');
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
    $img = get_art_file_path($artikel['Afbeelding']['DATA'], $DATA['artikel_id']);
    $newDate = date("j-n-Y", strtotime($artikel['Datum']['DATA']));
    $date = explode('-', $newDate);
    ?>
    <div class="row">
      <div class="col-xs-12">
        <div class="news-detail">
          <a class="news-detail__back-link" href="<?= link::c($DATA['page']); ?>">
            <span class="icon-chevron_left"></span>Terug naar overzicht
          </a>
          <h2 class="news-detail__title"><?= $artikel['Titel']['DATA']; ?></h2>

          <p class="news-detail__date"><span class="icon-calendar"></span> <?= $date[0] . ' ' . maandnaam($date[1]) . ' ' . $date[2]; ?></p>

          <div class="row">
            <div class="<?= trim($img != '' ? 'col-md-8 col-sm-8 col-xs-12' : 'col-xs-12'); ?>">
              <p class="news-detail__paragraph"><?= $artikel['Bericht']['DATA']; ?></p>

            </div>
            <?php
            if (trim($img != '')) {
              ?>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <img class="news-detail__image" src="<?= lcms::resize($img, 300, 300, '', 80); ?>" class="img-responsive" alt="<?= $artikel['Titel']['DATA']; ?>" />
              </div>
              <?php
            }
            ?>
          </div>


        </div>
      </div>
    </div>
    <?php
  } 
