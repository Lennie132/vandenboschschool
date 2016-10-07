<?php
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
//print_pre($artikel, $DATA);

if (!empty($artikel)) {
    $img = get_art_file_path($artikel['afbeelding']['DATA'], $DATA['artikel_id']);
    ?>
    <div class="detail-persoon">
        <div class="row">
            <div class="col-xs-12">
                <div class="teruglink">
                    <a href="<?= link::v('page_team'); ?>"><span class="swm-pijl-links"></span> <?= get_vertaling('terug'); ?></a>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            if (trim($artikel['afbeelding']['DATA'] != '')) {
                ?>
                <div class="col-md-3 col-sm-4">
                    <img src="<?= lcms::resize($img, 500, 500, '', 80); ?>" class="img-responsive" alt="<?= $artikel['naam']['DATA']; ?>" />
                </div>
                <?php
            }
            ?>
            <div class="<?= trim($artikel['afbeelding']['DATA'] != '') ? 'col-md-9 col-sm-8' : 'col-xs-12'; ?>">
                <h2><?= $artikel['naam']['DATA']; ?></h2>
                <p class="team-function"><?= $artikel['functie']['DATA']; ?></p>
                <?php if ($artikel['email']['DATA'] != '') { ?>
                    <p><a href="mailto:<?= $artikel['email']['DATA']; ?>"><span class="swm-email"></span>&nbsp;<?= $artikel['email']['DATA']; ?></a></p>
                <?php } ?>
                <?php if ($artikel['telefoon']['DATA'] != '') { ?>
                    <p><a href="tel:<?= $artikel['telefoon']['DATA']; ?>"><span class="swm-telefoon"></span>&nbsp;<?= $artikel['telefoon']['DATA']; ?></a></p>
                <?php } ?>
                <br/>
                <p><?= $artikel['omschrijving']['DATA']; ?></p>
            </div>
        </div>
    </div>
    <?php
}
