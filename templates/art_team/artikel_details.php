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

smart_include_css('css/style.less');

$artikel = get_artikelen_arr($config['tabelnaam'], $config['group_id'], $config['order'], $DATA['artikel_id']);
//print_pre($artikel, $DATA);

if (!empty($artikel)) {
    $img = get_art_file_path($artikel['afbeelding']['DATA'], $DATA['artikel_id']);
    ?>
    <div class="team-member--detail">
        <div class="row">
            <div class="col-xs-12">
                <div class="team-member__link">
                    <a href="<?= link::v('page_team'); ?>"><span class="icon-chevron_left"></span><?= get_vertaling('terug'); ?></a>
                </div>
            </div>
        </div>
        <br/>
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
                <h2 class="team-member__name"><?= $artikel['naam']['DATA']; ?></h2>
                <p class="team-member__function"><?= $artikel['functie']['DATA']; ?></p>
                <?php if ($artikel['email']['DATA'] != '') { ?>
                    <p><a class="team-member__email" href="mailto:<?= $artikel['email']['DATA']; ?>"><span class="icon-email"></span><?= $artikel['email']['DATA']; ?></a></p>
                <?php } ?>
                <?php if ($artikel['telefoon']['DATA'] != '') { ?>
                    <p><a class="team-member__telefoon" href="tel:<?= $artikel['telefoon']['DATA']; ?>"><span class="icon-phone"></span><?= $artikel['telefoon']['DATA']; ?></a></p>
                <?php } ?>
                <br/>
                <p class="team-member__description"><?= $artikel['omschrijving']['DATA']; ?></p>
            </div>
        </div>
    </div>
    <?php
}
