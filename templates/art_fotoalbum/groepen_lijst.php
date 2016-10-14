<?php
//--- Groepen ophalen
$order = 'g.gewicht ASC';
$groepen_arr = get_artikel_groepen_arr($DATA['group'], $order);

if ($DATA['group'] != "") { ?>
<div class="row">
  <div class="col-xs-12">
    <?php echo lcms::Breadcrums()->setHomepage(get_absolute_parent($DATA['page']))->getHtml(); ?>
  </div>
</div>
<?php
} ?>

<div class="row">
  <ul class="gallery-groups">

    <?php
    foreach ($groepen_arr as $groep) {
      //Afbeelding ophalen voor groep-afbeelding
      $config = array(
        'tabelnaam' => $tabelnaam,
        'group_id' => $groep['group_id'],
        'order' => 'a.gewicht ASC', // bv: RAND()
        'artikel_id' => 0,
        'limit_links' => 0,
        'where' => '',
        'module' => 0,
      );
      $art_arr = get_artikelen_arr($config['tabelnaam'], $config['group_id'], $config['order'], $config['artikel_id'], $config['limit_links'], $config['where']);
      $images = get_art_multi_files($art_arr[0]['afbeeldingen'], $art_arr[0]['artikel_id'], $DATA['m']);
      //print_pre($images);

      if (!empty($art_arr)) {
        if (trim($images[1]['path']) != '') {
          $src = lcms::resize($images[1]['path'], 480, 320, '480x320', 80);
        } else {
          $src = "img/no-preview.JPG";
        } ?>
        <li class="gallery-group col-md-4">
          <h2><a class="gallery-group__title" href="<?php echo maak_link($DATA['page'], '', '', $groep['group_id']) ?>" title="Back"><?php echo $groep['group_name'] ?></a></h2>
          <div class="gallery-item">
            <a class="fancybox" rel="<?= $art_arr[0]['group_id']; ?>" href="<?php echo maak_link($DATA['page'], '', '', $groep['group_id']) ?>" title="<?php echo $groep['group_name'] ?>">
              <img src="<?= $src; ?>" class="img-responsive" alt="<?php echo $groep['group_name'] ?>">
              <div class="gallery-item__overlay">
                <span class="gallery-item__icon icon-images"></span>
              </div>
            </a>
          </div>
        </li>

        <?php
      }
    } ?>

  </ul>
</div>
