<?php
	require("barcode.inc.php");

	$encode=$_REQUEST['encode'];
	$bar= new BARCODE();
	
	if($bar==false)
		die($bar->error());
	// OR $bar= new BARCODE("I2O5");

	$barnumber=$_REQUEST['bdata'];
	
	$bar->setSymblogy($encode);
	$bar->setHeight($_REQUEST['height']);
	//$bar->setFont("arial");
	$bar->setScale($_REQUEST['scale']);
	$bar->setHexColor($_REQUEST['color'],$_REQUEST['bgcolor']);

	/*$bar->setSymblogy("UPC-E");
	$bar->setHeight(50);
	$bar->setFont("arial");
	$bar->setScale(2);
	$bar->setHexColor("#000000","#FFFFFF");*/

	//OR
	//$bar->setColor(255,255,255)   RGB Color
	//$bar->setBGColor(0,0,0)   RGB Color

  	
	$return = $bar->genBarCode($barnumber,$_REQUEST['type'],$_REQUEST['file']);
	if($return==false)
		$bar->error(true);
	
?>