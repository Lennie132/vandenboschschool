<div class="news-item__wrapper--small col-xs-12">
  <h3 class="news-item__title"><?= $nieuwsitem['Titel']; ?></h3>
  <a class="news-item__read-more" href="<?= link::c($DATA['page'])->artikel_groep($nieuwsitem['page'])->artikel_id($nieuwsitem['artikel_id']); ?>" title="<?= $nieuwsitem['Titel']; ?>">Lees meer<span class="icon-chevron_right"></span></a>
</div>