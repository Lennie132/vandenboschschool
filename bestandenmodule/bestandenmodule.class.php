<?php

/**
 * Description of bestandenmodule
 *
 * @author Michael
 */
class bestandenmodule {

    public $result;
    private $artikelenObj;

    public function __construct($groep = '') {
        $this->artikelenObj = artikelen::get_artikel_groepen_arr($groep, 'g.gewicht ASC', 15);
        return;
    }

    public function getThemas() {
        return $this->artikelenObj;
    }

    public function getThemaFiles($themeID = 0,  $limit) {
        $files = artikelen::get_artikelen_arr('art_bestandenmodule', $themeID, 'a.gewicht ASC',0,$limit);
        return $files;
    }

    public function getThemaBackground($themaID = 0) {



        //Geen beeld gevuld voor de groep? Parent controleren
        $parentID = artikel_groep::get_parent($themaID);
        //$groepen = artikelen::get_artikel_groepen_arr($parentID);
        $children = $this->artikelenObj;




        $afbeelding = get_art_file_path($groepen[$themaID]['groepartikelen']['achtergrond_afbeelding']['DATA'], $groepen[$themaID]['groepartikel_id']);
        if (trim($afbeelding) == '') {
            $groepid = $themaID;
            while ($groepid > 0) {
                $groepid = artikel_groep::get_parent($groepid);

                if ($groepid > 0) {
                    $absolute_parent = $groepid;
                    $getParentID = artikel_groep::get_parent($groepid);
                    $groepenArrs = artikelen::get_artikel_groepen_arr($getParentID);
                    $afbeelding = get_art_file_path($groepenArrs[$groepid]['groepartikelen']['achtergrond_afbeelding']['DATA'], $groepenArrs[$groepid]['groepartikel_id']);
                    if (trim($afbeelding) != '')
                        break;
                }else {
                    break;
                }
            }
            if (trim($afbeelding) == '') {
//                $afbeelding = 'bestandenmodule/media/background.jpg';
            }
        }

        return $afbeelding;
    }

    public static function downloadFile($fileID) {
        $file = artikelen::get_artikelen_arr('art_bestandenmodule', '*', 'a.gewicht ASC', $fileID);
        $file = get_art_file_path($file['bestand']['DATA'], $fileID, 0, true);
        $loginObj = new bestandenmodule();
        if (!$loginObj->checkLogin()) {
            header('HTTP/1.1 401 Unauthorized');
            die('<pre>401 - Unauthorised. Log in om dit bestand te downloaden.</pre>');
        } elseif (file_exists($file)) {
			ob_clean();
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
        } else {
            die('Error: Bestand niet gevonden.');
        }
    }

    public function doLogin($username = '', $password = '') {
        $query = "SELECT * FROM `users` WHERE `user_name` = '" . mysql_real_escape_string($username) . "' && `user_pass` = '" . md5($password) . "'";
        $result = sql::get_data_arr($query);
        if (is_array($result) && count($result) > 0 && $result[0]['user_id'] > 0) {
            $_SESSION['LCMS']['lang'] = 'NL';
            $_SESSION['LCMS']['username'] = $result[0]['user_name'];
            $_SESSION['LCMS']['password'] = $result[0]['user_pass'];
            $_SESSION['LCMS']['user_full'] = $result[0]['user_full'];
        }
        return $result[0];
    }

    public function checkLogin() {
		$bezoekerLogin = get_variabele('voor_bezoekers');
        if (is_array($_SESSION['LCMS']) && count($_SESSION['LCMS']) > 0 || $bezoekerLogin == 'true') {
            return true;
        }
        return false;
    }

}

class bestandenmoduleHTML {

    public static function getTegelHTML($tegel) {
        global $DATA;
        $link = link::v('page_bestandenmodule')->artikel_groep($tegel['group_id']);

        ob_start();
        ?>

        <!-- Tegel -->
        <div class="isotope-item">
            <a href="<?php echo $link; ?>" class="tile text-center" style="background: url('bestandenmodule/media/tile-overlay.png') <?php echo '#'.$tegel['groepartikelen']['kleur']['DATA'] ?>">

                <span class="tile-name"><?php echo $tegel['group_name']; ?></span>
            </a>
        </div>
        <!-- Einde tegel -->

        <?php
        $html = ob_get_clean();
        ob_end_flush();
        return $html;
    }

    public static function getFileHTML($file = 0) {
		//print_pre($file);
        $link = link::v('page_bestandenmodule')->artikel_groep($file['group_id'])->extra('file=' . $file['artikel_id'])->return_absolute(true);
		//die($link);
		
        $filepath = get_art_file_path($file['bestand'], $file['artikel_id'], 0, true);
        $fileInfo = pathinfo($filepath);

        switch ($fileInfo['extension']) {
            case 'doc':
                $icon = 'word.png';
                break;
            case 'pdf':
                $icon = 'pdf.png';
                break;
            case 'txt':
                $icon = 'word.png';
                break;
            default:
                $icon = '';
                break;
        }
        ob_start();
		
		// Moet worden
		// http://www.nieuweschoolwebsite.nl/bestanden/artikelen/15//87_Huiswerk_voor_groep_3_TAAL.pdf
		
		// http://www.nieuweschoolwebsite.nl/verborgen/bestandenmodule/groep-3/taal?file=87
		
		//print_pre($link, $file['bestand']);
		
        ?>
        <div class="isotope-item">
            <a class="tile text-center file" href="<?php echo $link; ?>" style="background-image: url('bestandenmodule/media/icons/<?php echo $icon; ?>') , url('bestandenmodule/media/tile-overlay.png');">
                <span class="tile-name"><?php echo $file['titel']; ?></span>


                <label class="visible-lg download-file">Download bestand</label>

            </a>
        </div>
        <?php
        $html = ob_get_clean();
        ob_end_flush();
        return $html;
    }

}
