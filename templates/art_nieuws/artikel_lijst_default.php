<div class="news-item col-xs-12">
  <div class="row">
    <div class="col-xs-12">
      <h2 class="news-item__title"><?= $artikel['Titel']; ?></h2>
    </div>
  </div>
  <div class="row">
    <div class="<?= trim($img != '' ? 'col-md-9 col-sm-8' : 'col-xs-12'); ?> ">
      <p class="news-item__date">Geplaatst op: <?= $newDate; ?></p>
      <p><?= $artikel['Inleiding']; ?></p>
      <a class="news-item__read-more" href="<?= link::c($DATA['page'])->artikel_groep($artikel['page'])->artikel_id($artikel['artikel_id']); ?>" title="<?= $artikel['Titel']; ?>">Lees meer<span class="icon-chevron_right"></span>
      </a>
    </div>
    <?php
      if (trim($img != '')) {
        ?>
        <div class="col-md-3 col-sm-4">
          <img class="news-item__image" src="<?= lcms::resize($img, 300, 300, '', 80); ?>" class="img-responsive" alt="<?= $artikel['Titel']; ?>" />
        </div>
        <?php
      }
    ?>
  </div>
  <hr>
</div>