<!doctype html>
<html class="no-js" lang="<?= Taal::get_current(); ?>">
    <head>
        <title><?php echo lcms::Metatags()->Title()->get(); ?></title>
		
        <base href="<?php echo get_base_href(); ?>/"/>
		
        <?php lcms::FaviconGenerator()->getHTML(); ?>
		
        <script src="//code.jquery.com/jquery-2.2.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?= lcms_client_script::get_main_template_path() ?>/js/jquery-2.2.0.min.js"><\/script>')</script> 
		
        <?php
        /** Webfonts inladen 	* */
        echo lcms::Template()->getWebFonts();
        /** de metatags e.d. * */
        echo get_meta_html();

        /** hier wordt alle CSS geplaatst (welke via de lcms_client_script::add_css(); functie wordt geladen) * */
        echo lcms_client_script::include_css();
		
        //JAVASCRTIPT WORDT ONDERAAN DE BODY GELADEN. 
        //Let op! Voor de beste prestatie kan je in je javascript bestanden nu de document ready functie laten vervallen 
        //omdat alle html element al ingeladen zijn als de javascript geladen wordt

        /** Hieronder defineren we een aantal less bestanden die aan ieder ander less bestand moeten worden toegevoegd * */
        /** Dit zijn variables en mixins die iedere less bestand kan gebruiken * */
        lcms_client_script::base_less('css/bootstrap/variables.less', false);
        lcms_client_script::base_less('css/bootstrap/mixins.less', false);
        //lcms_client_script::base_less('client/template/custom/css/variables.less');

        /** add_main_css is een shortcut naar het pad /templates/main/templatenaam/ * */
        lcms_client_script::add_main_less('css/bootstrap.less');
        lcms_client_script::add_main_less('css/main.less');
		// Icomoon fonts
        lcms_client_script::add_main_css('css/style.css');

        /** add_main_js is een shortcut naar het pad /templates/main/templatenaam/ * */
        lcms_client_script::add_main_js('js/modernizr-2.6.2.min.js');

        /** custom CSS inladen * */
        //lcms_client_script::add_less('client/template/custom/css/style.less', true);

        /** custom JS inladen * */
        //lcms_client_script::add_js('client/template/custom/js/plugins.js', true);
        //lcms_client_script::add_js('client/template/custom/js/main.js', true);

        /** Google analytics * */
        analytics_code();
        ?>
    </head>
    <body>
        <!--[if lt IE 9]>
                <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
		
        <?php
        lcms::Template()->getHeader();
        lcms::Template()->getContent();
        lcms::Template()->getFooter();

        echo lcms_client_script::include_js();
        ?>
    </body>
</html>