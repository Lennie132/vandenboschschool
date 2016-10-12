<?php
$config = array(
  'tabelnaam' => $tabelnaam,
  'group_id' => $DATA['group'],
  'order' => 'a.gewicht ASC', // bv: RAND()
  'artikel_id' => 0,
  'limit_links' => 0,
  'where' => ''
);

/* Artikelen ophalen */
smart_include_css('css/style.less');

$art_arr = get_artikelen_arr($config['tabelnaam'], $config['group_id'], $config['order'], $config['artikel_id'], $config['limit_links'], $config['where']);
//print_pre($art_arr);
if (!empty($art_arr)) {

  foreach ($art_arr as $key => $artikel) {
    $img = get_art_file_path($artikel['afbeelding'], $artikel['artikel_id']);
    $icon = get_art_file_path($artikel['icon'], $artikel['artikel_id']);

    switch ($artikel['blok_grootte']) {
      case '1':
      $height = 'block--small';
      $col = 'col-lg-2 col-md-4 col-sm-6 col-xs-12';
      break;
      case '2':
      $height = 'block--large';
      $col = 'col-lg-4 col-md-6 col-sm-6 col-xs-12';
      break;

      default:
      $height = 'block--small';
      $col = 'col-lg-2 col-md-4 col-sm-6 col-xs-12';
      break;
    }
    switch ($artikel['blok_soort']) {
      // Tekst (Optioneel: Icon)
      case '1':
      $classes_block = 'block--style-1';
      $clases_content = '';
      break;
      // Afbeelding en tekst
      case '2':
      $classes_block = 'block--style-2';
      $clases_content = '';
      break;
      // Afbeelding en transparant tekst
      case '3':
      $classes_block = 'block--style-3';
      $clases_content = 'block__content--transparant';
      break;

      default:
      $classes_block = 'block--style-1';
      $clases_content = '';
      break;
    }

?>
<div class="block grid-item <?= $col; ?> ">
  <div class="block__wrapper <?= $classes_block; ?> <?= $height; ?> <?= $artikel['blok_kleur']; ?>">

    <?php if ($img != '') { ?>
      <a href="<?= link::c($artikel['link']); ?>">
        <div class="block__image" style="background-image: url('<?php echo lcms::resize($img, 800, 800, '', 80); ?>');"></div>
      </a>
      <?php
    } ?>

    <div class="block__content <?= $classes_content; ?>">
      <a href="<?= link::c($artikel['link']); ?>">
        <?php if ($artikel['icon_toon'] == 1 && $icon != '') { ?>
          <img class="block__icon" src="<?php echo lcms::resize($icon, 60, 60, '', 80); ?>" title="<?= $artikel['titel']; ?>">
          <?php
        } ?>
        <?php if ($artikel['titel_toon'] == 1 && $artikel['titel'] != '') { ?>
          <h2 class="block__title"><?= $artikel['titel']; ?></h2>
          <?php
        } ?>
      </a>

      <?php if ($artikel['tekst_toon'] == 1 && $artikel['tekst'] != '') { ?>
        <div class="block__text">
          <?= $artikel['tekst']; ?>
        </div>
        <?php
      } ?>

      <?php if ($artikel['module_toon'] == 1 && $artikel['module'] != '') { ?>
        <div class="block__module">
          <?php include  $artikel['module']; ?>
        </div>
        <?php
      } ?>

      <?php if ($artikel['link_toon'] == 1 && $artikel['link_naam'] != '') { ?>
        <a
        class="block__link <?= ($artikel['link_toon_scheidinglijn'] == 1) ? 'block__link--border-top' : '' ?>"
        href="<?= link::c($artikel['link']); ?>"
        ><?= $artikel['link_naam']; ?><span class="icon-chevron_right"></span>
      </a>
      <?php
    } ?>
  </div>
</div>
</div>

<?php }
}
 ?>
