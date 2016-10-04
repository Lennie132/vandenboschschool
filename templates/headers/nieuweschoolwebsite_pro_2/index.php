<?php
lcms_client_script::add_header_css('/css/header.less');
lcms_client_script::add_header_css('/css/menu.less');
?>

<header>
    <div class="header-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-3">
                    <?= lcms::Logo()->getHTML(); ?>
                </div>
                <div class="col-md-7">
                    <?php // lcms::Menu()->setNiveausDiep(2)->setClass('main-nav list-unstyled')->getHTML(); ?>
					<?= get_menu(0, '', 'main-nav list-unstyled'); ?>
                </div>
            </div>
        </div>
    </div>
</header>