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

//--- Groepen ophalen
$groepen_arr = get_artikel_groepen_arr('', 'g.gewicht ASC');

$art_arr = get_artikelen_arr($config['tabelnaam'], $config['group_id'], $config['order'], $config['artikel_id'], $config['limit_links'], $config['where']);
if (!empty($art_arr)) {
    ?>
    <div class="gallery-wrapper">

        <?php
        //--- Voeg albumtitel toe als groep gezet is
        if ($DATA['group'] != '' && $DATA['group'] > 0) {
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="album">
                        <?= $groepen_arr[$DATA['group']]['group_name']; ?>
                    </h2>
                </div>
            </div>
            <?php
        }
        ?>

        <div class="row">
            <?php
            foreach ($art_arr as $artikel) {
                $img = get_art_file_path($artikel['afbeelding'], $artikel['artikel_id']);
                //--- Afbeelding niet leeg
                if (trim($img) != '') {
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="gallery-item">
                            <a class="fancybox" rel="<?= $artikel['group_id']; ?>" href="<?= $img; ?>" title="<?= $artikel['titel']; ?>">
                                <img src="<?= lcms::resize($img, 480, 320, '480x320', 80); ?>" class="img-responsive" alt="<?= $artikel['titel']; ?>">
                                <div class="image-overlay">
                                    <span class="icon icon-search"></span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <?php
    //--- Clear groep
    $DATA['group'] = '';
} 