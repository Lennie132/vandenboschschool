<div class="news-item__wrapper--small col-md-6">

  <div class="row">
    <div class="<?= trim($img != '' ? 'col-sm-9 col-md-7' : 'col-xs-12'); ?> ">
      <a class="news-item__read-more" href="<?= link::v('page_nieuws')->artikel_groep($artikel['page'])->artikel_id($artikel['artikel_id']); ?>">
        <h3 class="news-item__title"><?= $artikel['Titel']; ?></h3>
      </a>
      <div class="news-item__intro">
        <p class="news-item__paragraph"><?= $artikel['Inleiding']; ?></p>
        <a class="news-item__read-more" href="<?= link::v('page_nieuws')->artikel_groep($artikel['page'])->artikel_id($artikel['artikel_id']); ?>" title="<?= $artikel['Titel']; ?>">
          Lees meer<span class="icon-chevron_right"></span>
        </a>
      </div>

    </div>
    <?php
      if (trim($img != '')) {
        ?>
        <div class="col-sm-3 col-md-5">
          <img class="news-item__image" src="<?= lcms::resize($img, 300, 300, '', 80); ?>" class="img-responsive" alt="<?= $artikel['Titel']; ?>" />
        </div>
        <?php
      }
    ?>
  </div>
</div>