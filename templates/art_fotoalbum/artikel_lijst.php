<?php
smart_include_css('css/style.less');
smart_include_css('css/style.css');
smart_include_js('main.js');

$config = array(
  'tabelnaam' => $tabelnaam,
  'group_id' => $DATA['group'],
  'order' => 'a.gewicht ASC', // bv: RAND()
  'artikel_id' => 0,
  'limit_links' => 0,
  'where' => '',
  'module' => 0,
);

//--- Artikelen ophalen van de groep
$art_arr = get_artikelen_arr($config['tabelnaam'], $config['group_id'], $config['order'], $config['artikel_id'], $config['limit_links'], $config['where']);

//--- Groepen voor groeps-titel ophalen
$groepennaam_arr = get_artikel_groepen_arr('', 'g.gewicht ASC');

if (!empty($art_arr)) {
  //--- Voeg albumtitel toe als groep gezet is
  if ($DATA['group'] != '' && $DATA['group'] > 0) { ?>
    <div class="row">
      <div class="col-xs-12">
        <h2 class="album">
          <?= $groepennaam_arr[$DATA['group']]['group_name']; ?>
        </h2>
      </div>
    </div>
    <?php
  } ?>

  <div class="row">
    <div class="gallery-items">


      <?php
      foreach ($art_arr as $artikel) {
        $images = get_art_multi_files($artikel['afbeeldingen'], $artikel['artikel_id'], $DATA['m']);
        //--- Afbeelding niet leeg
        foreach ($images as $key => $image) {
          if (trim($image['path']) != '') {
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
              <div class="gallery-item">
                <a class="fancybox" rel="<?= $artikel['group_id']; ?>" href="<?= $image['path']; ?>" title="<?= $artikel['titel']; ?>">
                  <img src="<?= lcms::resize($image['path'], 480, 320, '480x320', 80); ?>" class="img-responsive" alt="<?= $artikel['titel']; ?>">
                  <div class="gallery-item__overlay">
                    <span class="gallery-item__icon icon-search"></span>
                  </div>
                </a>
              </div>
            </div>
            <?php
          }
        }
      } ?>
    </div>
  </div>
  <?php
  //--- Clear groep
  $DATA['group'] = '';
}
