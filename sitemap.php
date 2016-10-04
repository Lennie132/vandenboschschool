<?php
header("Content-type: text/xml");
require('conf.php');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php
	spitURLS();
?>
</urlset>
<?php
function spitURLS($level=0){
	$urls = sql::get_data_arr("SELECT * FROM schone_url_tabel WHERE verlopen=0 ORDER BY lang,schone_url,`created`");
	$arr = array();
	$pars = array('page','nieuwsitem','group','artikel_id','bestelpagina','whg','wg','whart','wart','wabo','alfabet');
	
	/** hieronder filteren we even de dubbele urls eruit die dezelfde pagina inlaad. Dus a.h.v. de parameters alleen de recentste behouden. **/
	foreach($urls as $k=>$url){
		$tmp = array_intersect_key($url,array_flip($pars));//even alleen de relevante paramaters filteren
		$arr[md5(serialize($tmp))] = $url;
	}
	foreach ($arr AS $item){
		?>
		<url>
				<loc><?php echo lcms::thisconfig('url_home').'/'. $item['schone_url']; ?></loc>
			<lastmod><?php echo date('Y-m-d');?></lastmod>
			<changefreq>monthly</changefreq>
			<priority>0.8</priority>
		</url> 
		<?
		//spitURLS($item['pagina_id']);
	}
}
?>