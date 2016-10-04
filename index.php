<?php
require('conf.php');
lcms::init();
include_once('functions.php');

/**
 * We laden de maintemplate in die gekozen is in het CMS.
 * In de maintemplate worden de hoofd css/js bestanden ingeladen en bepaald dus het responsive grid en bootstrap versie.
 * Deze html is te vinden in:
 * -  /templates/main/(de gekozen main template)/index.php
 * De maintemplate laad vervolgens de header/content/footer in. Deze templates zijn respectievelijk te vinden in:
 * -  /templates/headers/(de gekozen header template)/index.php
 * -  /templates/paginas/(de gekozen template van de huidige pagina)/index.php
 * -  /templates/footers/(de gekozen footer template)/index.php
 */
lcms::Template()->load();