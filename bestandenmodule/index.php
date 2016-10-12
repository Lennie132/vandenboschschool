<?php
//chdir('../');
//include('functions.php');

$bezoekerLogin = get_variabele('voor_bezoekers');

include_once 'bestandenmodule/bestandenmodule.class.php';
$bestandenObj = new bestandenmodule($DATA['group']);


$sfeerbeeld = $bestandenObj->getThemaBackground($DATA['group']);

if ($bezoekerLogin == 'false') {
	if (isset($DATA['gebruikersnaam']) && isset($DATA['wachtwoord'])) {

		if (!$bestandenObj->doLogin($DATA['gebruikersnaam'], $DATA['wachtwoord'])) {
			//Login incorrect
			echo '<div class="alert alert-warning">Foutmelding: Login incorrect</div>';
		}
	}
}
$limit = 20;
$themas = $bestandenObj->getThemas();
$files = $bestandenObj->getThemaFiles($DATA['group'], $limit);

if (isset($DATA['file']) && $DATA['file'] > 0)
    bestandenmodule::downloadFile($DATA['file']); // Bestand downloaden

if (isset($DATA['loguit'])) {
    unset($_SESSION['LCMS']);
}
?>





<div style="background-image: url('<?php echo $sfeerbeeld; ?>')" class="wrapper">

    <div class="container tilecontainer">

        <?php
        if ($bestandenObj->checkLogin() || $bezoekerLogin == 'true') {
            ?>
            <div class="tiles">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="kruimels">
                            <?php
                            echo kruimel_links_paginas(true, true);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="isotope center-block">

                        <?php
                        if (is_array($themas) && count($themas) > 0) {
                            foreach ($themas as $thema) {
                                echo bestandenmoduleHTML::getTegelHTML($thema);
                            }
                        }


                        if (is_array($files) && count($files) > 0) {
                            foreach ($files as $file) {
                                echo bestandenmoduleHTML::getFileHTML($file);
                            }
                        }
                        ?>

                    </div>


                    <div class="paginatie">
                        <?php
                        if (count($files) > 0 && $limit > 0) {
                            echo limit_links(false, true);
                            clear_limit();
                        }
                        ?>
                    </div>

                </div>
            </div>

            <?php
            if (isset($DATA['group']) && $DATA['group'] > 0) {
                $link = link::v('page_bestandenmodule')->artikel_groep(artikel_groep::get_parent($DATA['group']));
                ?>
                <a class="go-back" href="<?php echo $link; ?>"><span class="swm-pijl-links"></span> Vorige pagina</a>
                <?php
            }
            ?>

            <?php
        } else {
            ?>   
            <!--<div class="iso-item">-->
            <div class="alert alert-warning text-center">Om gebruik te maken van dit platform dient u ingelogd te zijn.</div>
            <!--</div>-->
            <?php
        }
        ?>
    </div>

</div>