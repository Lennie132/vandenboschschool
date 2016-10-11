<?php
smart_include('functions.php');
smart_include_css('css/style.less');
smart_include_css('css/style.css');
smart_include_js('main.js');

if ($DATA['month'] == 'next') {
  $_SESSION['agenda_offset'] = (double) $_SESSION['agenda_offset'] + 1;
} elseif ($DATA['month'] == 'prev') {
  $_SESSION['agenda_offset'] = (double) $_SESSION['agenda_offset'] - 1;
} elseif ($DATA['month'] == 'today') {
  $_SESSION['agenda_offset'] = 0;
}
$offset = (double) $_SESSION['agenda_offset'];

$date = new DateTime(date('Y-m-1')); //de eerste van deze maand
if ($offset < 0) {
  $date->sub(new DateInterval('P' . (int) abs($offset) . 'M'));
} else {
  $date->add(new DateInterval('P' . (int) abs($offset) . 'M'));
}
$date_end = new DateTime($date->format('Y-m-d'));
$date_end->add(new DateInterval('P3M')); //na drie maanden stoppen.

$where = " AND ((t.Startdatum BETWEEN '" . $date->format('Y-m-d') . "' AND '" . $date_end->format('Y-m-d') . "') ";
$where.= " OR (t.Einddatum BETWEEN '" . $date->format('Y-m-d') . "' AND '" . $date_end->format('Y-m-d') . "')) ";

$config = array(
  'tabelnaam' => $tabelnaam,
  'group_id' => '*',
  'order' => 'a.gewicht ASC', // bv: RAND()
  'artikel_id' => 0,
  'limit_links' => 0,
  'where' => $where
);

$art_arr = get_artikelen_arr($config['tabelnaam'], $config['group_id'], $config['order'], $config['artikel_id'], $config['limit_links'], $config['where']);
//print_pre($art_arr);
if (!empty($art_arr)) {
  foreach ($art_arr as $key => $artikel) {
    //        print_pre($artikel);
    //$artikel['kleur'] = 'yellow';
    $d1 = new DateTime($artikel['Startdatum']);
    $d2 = new DateTime($artikel['Einddatum']);
    $data[$d1->format('Y-m-d')][] = $artikel;
    while ((double) $d1->diff($d2)->format("%R%a") > 0) { //voor het geval het agendaitem meer dagen bestrijkt.
      $d1->add(new DateInterval("P1D"));
      if ((double) $date_end->diff($d1)->format("%R%a") >= 0) {
        //we zijn voorbij de calender periode van 3 maanden.
        break 1;
      }
      $data[$d1->format('Y-m-d')][] = $artikel;
    }
    $xsData[] = $artikel;
  }
}
?>

<div class="calendar-wrapper">
  <?php
  $msg = msg::getMessage(false);
  if ($msg != '') {
    echo '<div class="alert">' . $msg . '</div>';
  }
  ?>
  <div class="calender-tools">
    <div class="row">
      <div class="col-xs-12">
        <a class="switch prev" href="<?= link::c($DATA['page'])->extra("month=prev"); ?>" title="Vorige">
          <span class="icon-arrow_back"></span>
        </a>
        <a class="submit" href="<?= link::c($DATA['page'])->extra("month=today"); ?>" title="Naar vandaag">
          Vandaag
        </a>
        <a class="switch next" href="<?= link::c($DATA['page'])->extra("month=next"); ?>" title="Volgende">
          <span class="icon-arrow_forward"></span>
        </a>
      </div>
    </div>
  </div>
  <div class="table-wrapper">
    <div class="row">
      <?php $interval = new DateInterval('P1M'); ?>
      <div class="col-xs-12">
        <h3><?= maandnaam((int) $date->format('m')) . ' - ' . $date->format('Y') ?></h3>
        <?= toon_maand_raster($date, $data, $INGELOGED); ?>
      </div>
      <?php $date->add($interval); ?>

    </div>
  </div>

  <div class="row">
    <div class="visible-xs col-xs-12" style="text-align:left;">
      <div class="responsive-calendar">
        <?php
        if (!empty($xsData)) {
          foreach ($xsData as $data) {
            $beginDate = date("d-m-Y", strtotime($data['Startdatum']));
            $eindDate = date("d-m-Y", strtotime($data['Einddatum']));
            ?>
            <div class="mini-link">
              <p class="responsive-date"><?php echo $beginDate . ' - ' . $eindDate; ?></p>
              <a href="<?php echo link::c($DATA['page'])->artikel_groep($data['group_id'])->artikel_id($data['artikel_id']) ?>">
                <?php
                echo $data['Titel'] . '<br/>';
                ?>
              </a>
            </div>

            <?php
          }
        }
        ?>
      </div>
    </div>
  </div>
</div>
<?php
$DATA['group'] = '';
?>
