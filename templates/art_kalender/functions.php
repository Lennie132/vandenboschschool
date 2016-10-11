<?php

function toon_maand_raster($date, $data = array(), $INGELOGED = false) {
    global $DATA, $thisconfig;

    $groepen_arr = get_artikel_groepen_arr('', 'g.gewicht ASC');
	
	if(empty($groepen_arr)){
        $groepen_arr[] = array('group_id' => 0);
    }
	
	
    //print_pre($groepen_arr);
    //nieuw date object waarvan we de datum op maandag gaan zetten.
    $start = clone $date;
    //de eerste van de maand valt op welke dag van de week?
    $dayoftheweek = $date->format('w');
    //zondag
    if ($dayoftheweek == 0) {
        //afgelopen maandag was 6 dagen geleden.
        $start->sub(new DateInterval('P6D'));
        //maandag, dus goed zo.
    } elseif ($dayoftheweek == 1) {
        //dinsdag t/m zaterdag
    } else {
        $start->sub(new DateInterval('P' . ($dayoftheweek - 1) . 'D'));
    }
    //interval van 1 dag.
    $interval = new DateInterval('P1D');
    $today = new DateTime(date("Y-m-d"));

    $html = '<table class="calender">';
    $html.= '<thead><tr><th title="Maandag">M</th>'
            . '<th title="Dinsdag">D</th>'
            . '<th title="Woensdag">W</th>'
            . '<th title="Donderdag">D</th>'
            . '<th title="Vrijdag">V</th>'
            . '<th title="Zaterdag">Z</th>'
            . '<th title="Zondag">Z</th></tr></thead>';
    $html.='<tbody>';
    //max 6 rijen
    for ($r = 0; $r < 6; $r++) {
        $html.='<tr>';
        //maandag t/m zondag
        for ($c = 0; $c < 7; $c++) {
            $class = '';
            $class.= ($start == $today ? 'today ' : '');
            $class.= ($start->format('m') != $date->format('m') ? 'disabled ' : '');

            $content = '';
            $dezedatum = $start->format('Y-m-d');
            if (isset($data[$dezedatum]) and is_array($data[$dezedatum])) {
                //er zijn agenda punten op deze dag.
                foreach ($groepen_arr as $groep) {
                    //print_pre($groep);

                    foreach ($data[$dezedatum] as $item) {
                        if ($groep['group_id'] == $item['group_id']) {
                            //print_pre($item['group_id']);
                            //print_pre($groep);

                            $tijd = array();
                            if ($item['Startdatum'] != '00:00' and $item['Startdatum'] != '') {
                                $tijd[] = $item['Startdatum'];
                            }
                            if ($item['Einddatum'] != '00:00' and $item['Einddatum'] != '') {
                                $tijd[] = $item['Einddatum'];
                            }
                            $content.='<a href="' . link::c($DATA['page'])->artikel_groep($item['group_id'])->artikel_id($item['artikel_id']) . '" style="text-decoration:none;">';
                            $kleur = $groep['groepartikelen']['Kleur']['DATA'] != '' ? 'background:'.$groep['groepartikelen']['Kleur']['DATA'] : '';
                            $content.='<div class="agenda-bullit" title="' . $item['Titel'] . '" style="'. $kleur .'"><div class="hidden-xs"> ' . $item['Titel'] . ' </div></div>';
                            $content.='</a>';
                            $tijd = implode(" - ", $tijd);
                            $edit = "";
                            //print_pre($item);
                        }
                    }
                }
            }
            $html.='<td class="' . $class . '">';
            $html.='<div class="dayheader clearfix">';
            $html.='<div class="day">' . $start->format("d") . '</div>';

            $html.='</div>';
            $html.=$content;
            $html.='</td>';
            //met 1 dag verhogen
            $start->add($interval);
        }
        $html.='</tr>';
        if ($start->format('m') > $date->format('m') or $start->format('Y') > $date->format('Y')) {
            //we zijn klaar met deze maand
            break 1;
        }
    }
    $html.='</tbody>';
    $html.='</table>';
    return $html;
}

?>
