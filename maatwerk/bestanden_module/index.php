<?php
  //print_pre($DATA);
  include_once 'maatwerk/bestanden_module/bestandenmodule.class.php';

  $useLogin = !get_variabele('voor_bezoekers');
  $bestanden_module = new bestandenmodule(6, $DATA['group'], $useLogin);

  if ($bestanden_module->checkLogin()) {
    if (isset($DATA['gebruikersnaam']) && isset($DATA['wachtwoord'])) {

      if (!$bestanden_module->doLogin($DATA['gebruikersnaam'], $DATA['wachtwoord'])) {
        //Login incorrect
        echo '<div class="alert alert-warning">Foutmelding: Login incorrect</div>';
      }
    }
  }
  $files_limit = 18;
  $folders = $bestanden_module->getFolders();
  $files = $bestanden_module->getFiles($files_limit);

  if (isset($DATA['file']) && $DATA['file'] > 0) {
    $melding = $bestanden_module->downloadFile($DATA['file']); // Bestand downloaden
    print_pre($melding);
    if ($melding != '') {
      echo $melding;
    }
  }
?>

<div class="files-wrapper">

  <?php
    if ($bestanden_module->checkLogin()) {

      if ($DATA['group'] != "") {
        ?>
        <div class="row">
          <div class="col-xs-12">
            <?= lcms::Breadcrums()->setHomepage(get_absolute_parent($DATA['page']))->getHtml(); ?>
          </div>
        </div>
        <?php
      }

      if (is_array($folders) && count($folders) > 0) {
        ?>
        <div class="row">
          <div class="col-xs-12">
            <h2>Mappen</h2>
          </div>

          <div class="isotope-wrapper isotope-folders col-xs-12">
            <?php foreach ($folders as $folder) { ?>
              <div class="isotope isotope--folder">
                <a class="isotope__link-wrapper" href="<?= link::v('page_bestandenmodule')->artikel_groep($folder['group_id']); ?>" title="Open map" style="background: url('maatwerk/bestanden_module/img/tile-overlay.png') <?= '#' . $folder['groepartikelen']['kleur']['DATA'] ?>">
                  <span class="isotope__name"><?= $folder['group_name']; ?></span>
                  <label class="isotope__label visible-lg">open</label>
                </a>
              </div>
            <?php }
            ?>
          </div>
        </div>
        <?php
      }

      if (is_array($files) && count($files) > 0) {
        ?>

        <div class="row">
          <div class="col-xs-12">
            <h2>Bestanden</h2>
          </div>
          <div class="isotope-wrapper isotope-files col-xs-12">
            <?php
            foreach ($files as $file) {
              //print_pre($file);
              $link = link::v('page_bestandenmodule')->artikel_groep($file['group_id'])->extra('file=' . $file['artikel_id'])->return_absolute(true);
              $filepath = get_art_file_path($file['bestand'], $file['artikel_id'], 0, true);
              $fileInfo = pathinfo($filepath);
              $icon = bestandenmodule::getFileIcon($fileInfo['extension']);

              ?>
              <div class="isotope isotope--file">
                <a class="isotope__link-wrapper" href="<?= $link; ?>" title="Download bestand" style="background-image: url('maatwerk/bestanden_module/img/<?= $icon; ?>') , url('maatwerk/bestanden_module/img/tile-overlay.png');">
                  <span class="isotope__name"><?= $file['titel']; ?></span>
                  <label class="isotope__label visible-lg">download</label>
                </a>
              </div>
              <?php
            }
            ?>
          </div>
        </div>
        <?php
      }
      if (!(is_array($files) && count($files) > 0) && !(is_array($folders) && count($folders) > 0)) {
        ?>
        <div class="alert alert-info text-center">Deze map is leeg.</div>
        <?php
      }
      ?>



      <?php
      if ($bestanden_module->getFilesCount() > $files_limit && $files_limit > 0) {
        ?>
        <div class="paginatie">
          <?php
          echo limit_links(false, true);
          clear_limit();
          ?>
        </div>
        <?php
      }
      ?>



      <?php
    } else {
      ?>
      <div class="alert alert-warning text-center">Om gebruik te maken van dit platform dient u ingelogd te zijn.</div>
      <?php
    }
  ?>
</div>
