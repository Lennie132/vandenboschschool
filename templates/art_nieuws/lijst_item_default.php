<div class="news-item col-xs-12">
  <div class="row">
    <div class="col-xs-12">
      <a class="news-item__read-more" href="<?= link::c($DATA['page'])->artikel_groep($nieuwsitem['page'])->artikel_id($nieuwsitem['artikel_id']); ?>" title="<?= $nieuwsitem['Titel']; ?>">
        <h2 class="news-item__title"><?= $nieuwsitem['Titel']; ?></h2>
      </a>
    </div>
  </div>
  <div class="row">
    <div class="<?= trim($img != '' ? 'col-md-9 col-sm-8' : 'col-xs-12'); ?> ">
      <p class="news-item__date">Geplaatst op: <?= $newDate; ?></p>
      <p><?= $nieuwsitem['Inleiding']; ?> <a class="news-item__read-more" href="<?= link::c($DATA['page'])->artikel_groep($nieuwsitem['page'])->artikel_id($nieuwsitem['artikel_id']); ?>" title="<?= $nieuwsitem['Titel']; ?>">Lees meer<span class="icon-chevron_right"></span></a>
      </p>
      
    </div>
    <?php
      if (trim($img != '')) {
        ?>
        <div class="col-md-3 col-sm-4">
          <img class="news-item__image" src="<?= lcms::resize($img, 300, 300, '', 80); ?>" class="img-responsive" alt="<?= $nieuwsitem['Titel']; ?>" />
        </div>
        <?php
      }
    ?>
  </div>
  <hr>
</div>