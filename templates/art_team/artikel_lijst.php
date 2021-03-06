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
smart_include_js('main.js');

/* if ($DATA['page'] == get_variabele('page_home')) {
$limiet = 7;
} else {
$limiet = 0;
} */

$art_arr = get_artikelen_arr($config['tabelnaam'], $config['group_id'], $config['order'], $config['artikel_id'], $limiet, $config['where']);
//print_pre($art_arr);
if (!empty($art_arr)) {  ?>
  <div class="team">
    <div class="row">
      <?php
      foreach ($art_arr AS $artikel) {
        //Afbeelding pad opvragen
        $afbeelding = get_art_file_path($artikel['afbeelding'], $artikel['artikel_id']);
        if ($afbeelding === "") {
          $afbeelding = "img/default-member-image.jpg";
        }
        //Hier module inhoud:
        ?>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
          <!-- Team Member -->
          <div class="team-member" style="background-image:url('<?= lcms::resize($afbeelding, 300, null, "300x300"); ?>');">
            <div class="team-member__overflow team-member--has-animation" data-animation="fade-in" data-delay="300">
              <div class="team-member__info">
                <a class="team-member__link-wrapper" href="<?= link::c($DATA['page'])->artikel_groep($artikel['page'])->artikel_id($artikel['artikel_id']); ?>" title="<?= $artikel['naam']; ?>">
                  <h4 class="team-member__name"><?= $artikel["naam"]; ?></h4>
                  <p class="team-member__function"><?= $artikel["functie"]; ?></p>
                </a>
                <p class="team-member__description"><?= $artikel["omschrijving"]; ?></p>
                <?php if ($artikel['email'] != '') { ?>
                  <a class="team-member__email" href="mailto:<?= $artikel['email']; ?>" title="<?= $artikel['email']; ?>"><span class="icon-email"></span><?= $artikel['email']; ?></a>
                  <br/>
                  <?php } ?>
                    <br/>
                    <a class="team-member__link" href="<?= link::c($DATA['page'])->artikel_groep($artikel['page'])->artikel_id($artikel['artikel_id']); ?>" title="<?= get_vertaling('lees_meer'); ?>">
                      <?= get_vertaling('lees_meer'); ?><span class="icon-chevron_right"></span>
                    </a>
                  </div>
                </div>
              </div>
              <!--/Team Member -->
            </div>
            <?php } ?>
          </div>
        </div>
        <?php
      } ?>
