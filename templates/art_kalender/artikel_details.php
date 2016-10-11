<?php
smart_include('functions.php');
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
    //$sDate = date_create($artikel['Startdatum']['DATA']);
    //$eDate = date_create($artikel['Einddatum']['DATA']);
    $oldSdate = date("j-n-Y", strtotime($artikel['Startdatum']['DATA']));
    $oldEdate = date("j-n-Y", strtotime($artikel['Einddatum']['DATA']));
    $newSdate = explode('-', $oldSdate);
    $newEdate = explode('-', $oldEdate);
    ?>
    <div class="calendar-item">
        <div class="row">
            <div class="col-xs-12">
                <h1><?php echo $artikel['Titel']['DATA']; ?></h1>
                <span class="icon-calendar icon-dates"></span>
                <div class="startdate"><b>Begindatum:</b> <?= $newSdate[0] . ' ' . maandnaam($newSdate[1]) . ' ' . $newSdate[2]; ?></div>
                <div class="enddate"><b>Einddatum:</b> <?= $newEdate[0] . ' ' . maandnaam($newEdate[1]) . ' ' . $newEdate[2]; ?></div>
                <div class=""><b>Begintijd:</b> <?= $artikel['Starttijd']['DATA'] ?></div>
                <div class=""><b>Eindtijd:</b> <?= $artikel['Eindtijd']['DATA'] ?></div>
                <div class="inner-item"><?php echo $artikel['Bericht']['DATA']; ?></div>
                <a href="<?php echo link::c($DATA['page']); ?>" class="back-link">
                    <span class="icon-chevron_left"></span>Terug naar kalender
                </a>
            </div>
        </div>
    </div>
    <?php
}
