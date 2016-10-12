<?php

chdir('../');
include 'conf.php';
include('functions.php');


$moduleID = 15;
$groepen = artikelen::get_artikel_groepen_arr(0, 'g.gewicht ASC', $moduleID);

$addGroepen = array(
    'Teksten',
    'Opdrachten',
    'Schrijfopdrachten',
    'Opdrachten bij filmpjes',
    'Handige websites',
    'Webquests',
    'Portfolio',
    "Powerpoints & Prezis",
);

//print_pre($groepen);
if (is_array($groepen) && count($groepen) > 0) {
    foreach($groepen as $groep_id => $groep){
        $gewicht = 1;
        foreach($addGroepen as $groep){
            
            $addGroep = sql::save_data("INSERT INTO `artikel_groepen` SET  `module_id` = '".$moduleID."', `parent_id` = '".$groep_id."', `gewicht` = '".$gewicht."', `hide` = '0', `andere_groep` = '', `users` = ''");
            $newGroepID = sql::$last_insert_id;
            $addGroepTaal = sql::save_data("INSERT INTO `artikel_groeptalen` SET `group_id` = '".$newGroepID."', `lang` = 'NL', `group_name` = '".$groep."'");
            
            
            $gewicht++;
        }
    }
}
?>