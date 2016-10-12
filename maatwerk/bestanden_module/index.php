<?php
$bezoekerLogin = get_variabele('voor_bezoekers');

include_once 'maatwerk/bestanden_module/bestandenmodule.class.php';
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

if (isset($DATA['file']) && $DATA['file'] > 0) {
  bestandenmodule::downloadFile($DATA['file']); // Bestand downloaden
}

if (isset($DATA['loguit'])) {
  unset($_SESSION['LCMS']);
}
?>

<div class="tilecontainer">

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

      <?php
      if (is_array($themas) && count($themas) > 0) {
        ?>
        <h2>Mappen</h2>
        <div class="row">
          <div class="isotope-folders">
            <?php
            foreach ($themas as $thema) {
              ?>
              <!-- Tegel -->
              <div class="isotope-folder">
                <a href="<?= link::v('page_bestandenmodule')->artikel_groep($thema['group_id']); ?>" class="tile text-center" style="background: url('maatwerk/bestanden_module/img/tile-overlay.png') <?= '#' . $thema['groepartikelen']['kleur']['DATA'] ?>">

                  <span class="tile-name"><?= $thema['group_name']; ?></span>
                </a>
              </div>
              <!-- Einde tegel -->
              <?php
            } ?>
          </div>
        </div>
        <?php
      }

      if (is_array($files) && count($files) > 0) { ?>
        <h2>Bestanden</h2>
        <div class="row">
          <div class="isotope-files">
            <?php
            foreach ($files as $file) {
              //print_pre($file);
              $link = link::v('page_bestandenmodule')->artikel_groep($file['group_id'])->extra('file=' . $file['artikel_id'])->return_absolute(true);
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
              //print_pre($link, $file['bestand']);
              ?>
              <div class="isotope-file">
                <a class="tile text-center file" href="<?= $link; ?>" style="background-image: url('maatwerk/bestanden_module/img/icons/<?= $icon; ?>') , url('maatwerk/bestanden_module/img/tile-overlay.png');">
                  <span class="tile-name"><?= $file['titel']; ?></span>

                  <label class="visible-lg download-file">Download bestand</label>
                </a>
              </div>
              <?php
            }
            ?>
          </div>
        </div>
        <?php
      } ?>


      <!-- <div class="paginatie">
        <?php
        if (count($files) > 0 && $limit > 0) {
          echo limit_links(false, true);
          clear_limit();
        }
        ?>
      </div> -->


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
