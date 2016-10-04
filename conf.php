<?php
$database_host="localhost";
$database='lcms2_vandenboschschool2016';
$database_user='root';
$database_pass='21882';

if (!$do_cms_load) {
    include('maatwerk.php');
    require('lcms2/client_functions.php');

    lcms_start();

    if (!empty($DATA['rss']) && !empty($DATA['b']))
        generate_rss();
}
?>
