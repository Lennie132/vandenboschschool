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


if (!empty($artikel)) {
    
   
    
} 
