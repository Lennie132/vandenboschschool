<?php

$config = array(
  'tabelnaam' => 'art_kalender',
  'group_id' => '',
  'order' => 't.Startdatum ASC', // bv: RAND()
  'artikel_id' => '',
  'limit_links' => 3,
  'where' => ''
);

// Style van nieuws_lijst_home staat in main->main.less

$agenda_arr = get_artikelen_arr($config['tabelnaam'], $config['group_id'], $config['order'], $config['artikel_id'], $config['limit_links'], $config['where']);
if (!empty($agenda_arr)) {
  foreach ($agenda_arr as $key => $agendaitem) {
    $oldSdate = date("j-n-Y", strtotime($agendaitem['Startdatum']));
    $newSdate = explode('-', $oldSdate);
    ?>
    <div class="kalender-item--home">
      <a class="kalender-item__datum" href="<?= link::v('page_agenda')->artikel_groep($agendaitem['page'])->artikel_id($agendaitem['artikel_id']); ?>"><?= $newSdate[0] . ' ' . maandnaam($newSdate[1]) . ' ' . $newSdate[2]; ?></a>
      <p class="kalender-item__tijd"><?= $agendaitem['Starttijd']; ?> <?= get_vertaling('uur'); ?></p>
      <a class="kalender-item__titel" href="<?= link::v('page_agenda')->artikel_groep($agendaitem['page'])->artikel_id($agendaitem['artikel_id']); ?>"><?= $agendaitem['Titel']; ?></a>
    </div>
    <?php
    $DATA['group'] = '';
  }
}
?>
