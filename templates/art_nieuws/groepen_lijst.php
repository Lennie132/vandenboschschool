<?php
  smart_include_css('css/style.less');
  smart_include_css('css/style.css');
  if ($DATA['page'] == get_variabele('page_nieuws')) {
    //--- Groepen ophalen
    $groepen_arr = get_artikel_groepen_arr($DATA['group'], 'g.gewicht ASC');

    if ($DATA['group'] != "") {
      ?>
      <div class="row">
        <div class="news-breadcrumbs">
          <div class="col-xs-12"> 
            <?= lcms::Breadcrums()->setHomepage(get_absolute_parent($DATA['page']))->getHtml(); ?>
          </div>
        </div>
      </div>
    <?php }
    ?>

    <div class="row">
      <div class="news-groups">
        <div class="col-xs-12">
          <ul>
            <?php
            $tel = 1;
            foreach ($groepen_arr as $groep) {
              ?>
            
              <li class="news-group">
                <a class="news-group__link" href="<?= maak_link($DATA['page'], '', '', $groep['group_id']) ?>" title="<?= $groep['group_name'] ?>">
                  <?= $groep['group_name'] ?>
                </a>
              </li>

              <?php
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
  <?php } ?>