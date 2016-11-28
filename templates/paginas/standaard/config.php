<?php
$TEMPLATE = new PageTemplate(dirname(__FILE__));
$TEMPLATE->setDefault(true); 					//is dit de default template?
//$TEMPLATE->setName('Een template naam');		//standaard wordt de template vernoemd naar de map waar deze in zit. Maar je kan dat overschrijven.		

if($TEMPLATE->loadGrid('grid.php')){ //Indien grid bestand aanwezig dan inladen, anders de template configuren met onderstaande methode.	
	//default colomn defineren en eventueel autoblokken configureren.
	
}else{
	/*
	//Content sectie aan de template toevoegen.
	$sectie = new PageSectie('content');
	$sectie->setTitle("Inhoud");
	$sectie->setDefault(true);
	$sectie->setPosition("left",66);
	//$sectie->setLast(); // hiermee geef je aan waar de clearfix omheen getrokken moet worden
	//$sectie->addAutoBlock('html',array('html'=>'Voer hier je eigen html tekst in.')); //een automatische HTML block toevoegen, met alvast een beetje tekst erin
	//$sectie->addAutoBlock('artikelen',array('module_id'=>1,'map'=>1)); //automatisch een artikelen block toevoegen die aan de juiste module en groep gekoppeld is.
	$TEMPLATE->addSectie($sectie);


	//De sidebar sectie aan de template toevoegen.
	$sectie = new PageSectie('sidebar');
	$sectie->setTitle("Sidebar");
	$sectie->setPosition("right",33);
	$TEMPLATE->addSectie($sectie);
	*/
}
