<?php
/** Hier eventeel nog een sfeerbeeld of kruimels o.i.d. inladen **/
$sfeer = get_sfeerafbeelding($DATA['page'], 1);

/** Hier wordt het grid met de content ingelezen **/
echo $this->buildHTMLgrid($DATA['page']);

/** Individuele content inlezen **/
//echo lcms::Template()->getSectieContent($DATA['page'], '<id van sectie>');