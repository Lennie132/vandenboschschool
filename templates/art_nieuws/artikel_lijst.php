<?php
  smart_include_css('css/style.less');
  smart_include_css('css/style.css');
  smart_include_js('main.js');

  $config = array(
      'tabelnaam' => $tabelnaam,
      'group_id' => $DATA['group'],
      'order' => 't.datum DESC', // bv: RAND()
      'artikel_id' => 0,
      'limit_links' => 10,
      'where' => ''
  );
  
  if ($DATA['page'] != get_variabele('page_nieuws')) {
    $config['limit_links'] = 4;
  }
  

  /* Artikelen ophalen */
  $art_arr = get_artikelen_arr($config['tabelnaam'], $config['group_id'], $config['order'], $config['artikel_id'], $config['limit_links'], $config['where']);

  if (!empty($art_arr)) {
    ?>

    <?php if ($DATA['page'] != get_variabele('page_nieuws')) { ?>
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
        foreach ($art_arr as $key => $artikel) {
          $img = get_art_file_path($artikel['Afbeelding'], $artikel['artikel_id']);
          $oldDate = $artikel['Datum'];
          $newDate = date("d-m-Y", strtotime($oldDate));

          if ($DATA['page'] == get_variabele('page_nieuws')) {
            include dirname(__FILE__) . '/artikel_lijst_default.php';
          } else {

            include dirname(__FILE__) . '/artikel_lijst_small.php';
          }
          ?>

          <?php
          if ($tel % 2 == 0) {
            ?>
            <div class="clearfix hidden-xs hidden-sm"></div>
            <?php
          }
          $tel++;
          ?>
        <?php } ?>
      </div>
    </div>

    <?php if (count($art_arr) > 10) { ?>
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
    <?php } ?>

    <?php
  } else {
    ?>
    <div class="alert alert-info">Er zijn geen nieuwsberichten in deze groep.</div>
    <?php
  }
  //--- Clear groep
  $DATA['group'] = '';
?>
