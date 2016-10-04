<?php
$config = array(
    'tabelnaam' => $tabelnaam,
    'group_id' => $DATA['group'],
    'order' => 'a.gewicht ASC', // bv: RAND()
    'artikel_id' => 0,
    'limit_links' => 0,
    'where' => ''
);

/* Artikelen ophalen */
smart_include_css('css/style.less');




$art_arr = get_artikelen_arr($config['tabelnaam'], $config['group_id'], $config['order'], $config['artikel_id'], $config['limit_links'], $config['where']);
//print_pre($art_arr);
if (!empty($art_arr)) {
    ?>
    <div class="">
        <?php
        foreach ($art_arr as $key => $artikel) {
            ?>
            <div class="">
			
			</div>
            <?php
        }
        ?>
    </div>
    <?php
}
?>