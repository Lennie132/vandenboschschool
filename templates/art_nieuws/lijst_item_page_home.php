<div class="news-item__wrapper--home col-xs-12">
  <a class="news-item__read-more" href="<?= link::v('page_nieuws')->artikel_groep($nieuwsitem['page'])->artikel_id($nieuwsitem['artikel_id']); ?>">
    <h3 class="news-item__title"><?= $nieuwsitem['Titel']; ?></h3>
  </a>
  <div class="news-item__intro">
    <p class="news-item__paragraph"><?= $nieuwsitem['Inleiding']; ?></p>
    <a class="news-item__read-more" href="<?= link::v('page_nieuws')->artikel_groep($nieuwsitem['page'])->artikel_id($nieuwsitem['artikel_id']); ?>" title="<?= $nieuwsitem['Titel']; ?>">
      Lees meer<span class="icon-chevron_right"></span>
    </a>
  </div>
</div>