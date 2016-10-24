<?php smart_include_css("404/404.less"); ?>
<div class="grid-item col-md-8 col-xs-12 content">

  <div class="content__titel-wrapper">
    <h1 class="content__titel">Foutmelding</h1>
  </div>

  <div class="content__main">
    <div class="error404__wrapper">
      <div class="row">

        <div class="col-lg-5">
          <div class="error404__code">
            404
          </div>
        </div>

        <div class="col-lg-7">
          <div class="error404__info">
            <h3>Pagina niet gevonden:</h3>
            <?php if (strtolower(Taal::get_current()) == 'nl') { ?>
                <p>
                  Sorry, de pagina die u zoekt, is mogelijk verwijderd, de naam ervan is gewijzigd of is tijdelijk niet beschikbaar.
                  Controleer de URL en pas deze aan, of neem contact op met de eigenaar van de site.
                </p>
              <?php } else { ?>
                <p>
                  Sorry, the page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
                  Check the URL and change it, or contact the owner of the site.
                </p>
              <?php } ?>												

            <script type="text/javascript">
              var GOOG_FIXURL_LANG = '<?= strtolower(Taal::get_current()); ?>';
              var GOOG_FIXURL_SITE = '<?= lcms::thisconfig('url_home'); ?>';
            </script>
            <script type="text/javascript"
                    src="http://linkhelp.clients.google.com/tbproxy/lh/wm/fixurl.js">
            </script>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="content__bottom-bar"></div>
</div>