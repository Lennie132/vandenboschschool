<?php
smart_include_css('css/style.less');
smart_include_css('css/style.css');
smart_include_js('main.js');

$config = array(
    'tabelnaam' => $tabelnaam,
    'group_id' => $DATA['group'],
    'order' => 't.datum DESC', // bv: RAND()
    'artikel_id' => 0,
    'limit_links' => 10,
    'where' => ''
);

/* Artikelen ophalen */





$art_arr = get_artikelen_arr($config['tabelnaam'], $config['group_id'], $config['order'], $config['artikel_id'], $config['limit_links'], $config['where']);
//print_pre($art_arr);
//print_pre($DATA);
if (!empty($art_arr)) {
    ?>
    <div class="news-wrapper">
        <div class="row">
            <?php
            foreach ($art_arr as $key => $artikel) {
                $img = get_art_file_path($artikel['Afbeelding'], $artikel['artikel_id']);
                $oldDate = $artikel['Datum'];
                $newDate = date("d-m-Y", strtotime($oldDate));
                ?>
                <div class="col-xs-12">
                    <div class="newsitem">
                        <div class="row">
                            <div class="col-xs-12">
                                <h2><b><?= $artikel['Titel']; ?></b></h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="<?= trim($img != '' ? 'col-md-9 col-sm-8' : 'col-xs-12'); ?> ">
                                <p class="newsitem__date">Geplaatst op: <?= $newDate; ?></p>
                                <?= $artikel['Inleiding']; ?>
                                <a class="newsitem__read-more" href="<?= link::c($DATA['page'])->artikel_groep($artikel['page'])->artikel_id($artikel['artikel_id']); ?>" title="<?= $artikel['Titel']; ?>">
                                    Lees meer<span class="icon-chevron_right"></span>
                                </a>
                            </div>
                            <?php
                            if (trim($img != '')) {
                                ?>
                                <div class="col-md-3 col-sm-4">
                                    <img src="<?= lcms::resize($img, 300, 300, '', 80); ?>" class="img-responsive" alt="<?= $artikel['Titel']; ?>" />
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <hr>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php if (count($art_arr) > 10) { ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="pagination">
                        <?php
                        limit_links('', true);
                        clear_limit();
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php
}
?>
