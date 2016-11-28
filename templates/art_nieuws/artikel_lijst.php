<?php
  smart_include_css('css/style.less');
  smart_include_js('main.js');

  $config = array(
      'tabelnaam' => 'art_nieuws',
      'group_id' => $DATA['group'],
      'order' => 't.datum DESC', // bv: RAND()
      'artikel_id' => 0,
      'limit_links' => 0,
      'where' => ''
  );

  if ($DATA['page'] == get_variabele('page_nieuws')) {
    $config['limit_links'] = 15;
    $config['group_id'] = array(42, 44);
  }
  if ($DATA['page'] == get_variabele('page_home')) {
    $config['limit_links'] = 3;
    $config['group_id'] = array(42, 44);
  }
  if ($DATA['page'] != get_variabele('page_nieuws') && $DATA['page'] != get_variabele('page_home')) {
    $config['limit_links'] = 4;
  }

  /* Artikelen ophalen */
  $news_arr = get_artikelen_arr($config['tabelnaam'], $config['group_id'], $config['order'], $config['artikel_id'], $config['limit_links'], $config['where']);
  $news_count = get_artikelen_arr($config['tabelnaam'], $config['group_id'], $config['order'], $config['artikel_id'], 0, $config['where']);

  if (!empty($news_arr)) {
    ?>

    <?php if ($DATA['page'] != get_variabele('page_nieuws') && $DATA['page'] != get_variabele('page_home')) { ?>
      <div class="row">
        <div class="news-groupname">
          <div class="col-xs-12">
            <h2><?= get_vertaling('nieuwsberichten'); ?></h2>
          </div>
        </div>
      </div>
    <?php } ?>

    <div class="row">
      <div class="news-items">
        <?php
        $tel = 1;
        foreach ($news_arr as $key => $nieuwsitem) {
          $img = get_art_file_path($nieuwsitem['Afbeelding'], $nieuwsitem['artikel_id']);
          $oldDate = $nieuwsitem['Datum'];
          $newDate = date("d-m-Y", strtotime($oldDate));

          if ($DATA['page'] == get_variabele('page_nieuws')) {
            if ($tel <= 3) {
              include dirname(__FILE__) . '/lijst_item_default.php';
            } else {
              include dirname(__FILE__) . '/lijst_item_small.php';
            }
          } elseif ($DATA['page'] == get_variabele('page_home')) {
            include dirname(__FILE__) . '/lijst_item_page_home.php';
          } else {
            include dirname(__FILE__) . '/lijst_item_page_group.php';
          }

          if ($tel % 2 == 0) {
            ?>
            <div class="clearfix hidden-xs hidden-sm"></div>
            <?php
          }
          $tel++;
        }
        ?>
      </div>
    </div>

    <?php
    if ($DATA['page'] != get_variabele('page_home')) {
        if (count($news_count) > $config['limit_links'] && $config['limit_links'] != 0) {
          ?>
          <div class="row">
            <div class="news-pagination">
              <div class="col-xs-12">
                <?php
                limit_links('', true);
                clear_limit();
                ?>
              </div>
            </div>
          </div>
          <?php
        }
    }
    ?>

    <?php
  } else {
    ?>
    <div class="alert alert-info">Er zijn geen nieuwsberichten in deze groep.</div>
    <?php
  }
  //--- Clear groep
  $DATA['group'] = '';
?>
