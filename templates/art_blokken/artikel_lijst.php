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

    switch ($artikel['grootte_blok']) {
      case '1':
      $width = 'col-lg-2 col-md-4 col-sm-6 col-xs-12';
      $height = 'block--small';
      break;
      case '2':
      $col = 'col-lg-2 col-md-4 col-sm-6 col-xs-12';
      $height = 'block--middle';
      break;
      case '3':
      $col = 'col-lg-4 col-md-6 col-sm-6 col-xs-12';
      $height = 'block--large';
      break;
      default:
      $col = 'col-lg-2 col-md-4 col-sm-6 col-xs-12';
      $height = 'block--middle';
      break;
    }

    switch ($artikel['kleur_blok']) {
      case 'blauw':
      $colour = 'block--blue';
      break;
      case 'roze':
      $colour = 'block--pink';
      break;
      case 'turquoise':
      $colour = 'block--turquoise';
      break;
      default:
      $colour = 'block--blue';
      break;
    }

    switch ($artikel['soort']) {
      case 1:
      // Afbeelding en tekst
      ?>
      <div class="block grid-item <?= $col; ?> ">
        <a class="block__link-wrapper" href="<?php link::c($artikel['link']); ?>">
          <div class="block__wrapper block--style-1 <?= $height; ?> <?= $colour; ?>">
            <?php if ($img != '') { ?>
              <div class="block__image" style="background-image: url('<?php echo lcms::resize($img, 800, 800, '', 80); ?>');"></div>
              <?php } ?>
            </a>
            <div class="block__content">
              <div class="block__introduction">
                <?= $artikel['tekst']; ?>
              </div>
            </div>
          </div>

        </div>
        <?php
        break;


        case 2:
        // Icon en tekst
        ?>
        <div class="block grid-item <?= $col; ?> ">
          <div class="block__wrapper block--style-2 <?= $height; ?> block--white">
            <div class="block__content">

              <a class="block__link-wrapper" href="<?= link::c($artikel['link']); ?>">
                <?php if ($icon != '') { ?>
                  <img class="block__icon" src="<?php echo lcms::resize($icon, 60, 60, '', 80); ?>" title="<?= $artikel['titel']; ?>">
                  <?php } ?>
                  <h2 class="block__title"><?= $artikel['titel']; ?></h2>
                </a>

                <?php if ($artikel['module_invoegen'] != '') {
                  include  $artikel['module_invoegen'];
                } else { ?>
                  <p class="block__introduction"><?= $artikel['tekst']; ?></p>
                  <?php } ?>
                  <a class="block__link" href="<?= link::c($artikel['link']); ?>"><?= $artikel['link_naam']; ?><span class="icon-chevron_right"></span></a>
                </div>
              </div>


            </div>
            <?php
            break;


            case 3:
            // Afbeelding en transparant tekst
            ?>
            <div class="block grid-item <?= $col; ?> ">
              <div class="block__wrapper block--style-3 <?= $height; ?> <?= $colour; ?>">
                <a class="block__link-wrapper" href="<?php link::c($artikel['link']); ?>">
                  <div class="block__image" style="background-image: url('<?php echo lcms::resize($img, 800, 800, '', 80); ?>');"></div>
                </a>
                <div class="block__content">
                  <div class="block__title">
                    <?= $artikel['tekst']; ?>
                  </div>
                  <?php if ($artikel['link_naam'] != '') { ?>
                    <div class="block__link">
                      <a href="<?php link::c($artikel['link']); ?>"><?= $artikel['link_naam']; ?><span class="icon-chevron_right"></span></a>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <?php
              break;


              case 4:
              // Tekst
              ?>
              <div class="block grid-item <?= $col; ?> ">

                <div class="block__wrapper block--style-4 <?= $height; ?> <?= $colour; ?>">
                  <div class="block__content">
                    <a class="block__title" href="<?php link::c($artikel['link']); ?>">
                        <?= $artikel['titel']; ?>
                    </a>
                    <p class="block__introduction">
                      <?= $artikel['tekst']; ?>
                    </p>
                    <?php if ($artikel['link_naam'] != '') { ?>
                    <a class="block__link" href="<?php link::c($artikel['link']); ?>">
                      <?= $artikel['link_naam']; ?><span class="icon-chevron_right"></span>
                    </a>
                    <?php } ?>
                  </div>
                </div>

              </div>
              <?php
              break;

              default:
              break;
            }
          }
        }
        ?>
