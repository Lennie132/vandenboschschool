<?php

$config = array(
  'tabelnaam' => 'art_nieuws',
  'group_id' => $DATA['group'],
  'order' => 't.datum DESC', // bv: RAND()
  'artikel_id' => 0,
  'limit_links' => 3,
  'where' => ''
);

/* Artikelen ophalen */

// Style van nieuws_lijst_home staat in main->main.less

$nieuws_arr = get_artikelen_arr($config['tabelnaam'], $config['group_id'], $config['order'], $config['artikel_id'], $config['limit_links'], $config['where']);
//print_pre($art_arr);
//print_pre($DATA);
if (!empty($nieuws_arr)) {
  foreach ($nieuws_arr as $key => $nieuwsitem) {
    $oldDate = $nieuwsitem['Datum'];
    $newDate = date("d-m", strtotime($oldDate));
    ?>

    <div class="newsitem__wrapper--home">
      <a class="newsitem__read-more" href="<?= link::v('page_nieuws')->artikel_groep($nieuwsitem['page'])->artikel_id($nieuwsitem['artikel_id']); ?>">
        <h3 class="newsitem__title"><?= $nieuwsitem['Titel']; ?></h3>
      </a>
      <div class="newsitem__intro">
        <p class="newsitem__paragraph"><?= $nieuwsitem['Inleiding']; ?></p>
        <a class="newsitem__read-more" href="<?= link::v('page_nieuws')->artikel_groep($nieuwsitem['page'])->artikel_id($nieuwsitem['artikel_id']); ?>" title="<?= $nieuwsitem['Titel']; ?>">
          Lees meer<span class="icon-chevron_right"></span>
        </a>
      </div>
    </div>

    <?php
  }
}
?>
