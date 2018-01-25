<?php
include "class/dtkiba.cls.php";
include "class/dtkibb.cls.php";
include "class/dtkibc.cls.php";
include "class/dtkibe.cls.php";
include "class/dtkir.cls.php";
include "class/dtperawatan.cls.php";
include "class/dttoko.cls.php";
$dtkiba=new Dtkiba();
$dtkibb=new Dtkibb();
$dtkibc=new Dtkibc();
$dtkibe=new Dtkibe();
$dtkir=new Dtkir();
$toko=new Dttoko();
$dtperawatan=new Dtperawatan();
$link='?p='.encrypt_url('asettetap');
?>
<link rel="stylesheet" type="text/css" href="css/aset.css"/>
<?php 
include "header.php"; 
$menu=$_GET['m'];
switch($menu){
	case '':
		include 'home_page.php';
	break;
	case 'aset_detail':
		include 'aset_detail.php';
	break;
	case 'kiba_frm':
		include 'kiba_form.php';
	break;
	case 'kiba_rep':
		include 'kiba_report.php';
	break;
	case 'kibb_frm':
		include 'kibb_form.php';
	break; 
	case 'kibb_rep':
		include 'kibb_report.php';
	break;
	case 'kibc_frm':
		include 'kibc_form.php';
	break;
	case 'kibc_rep':
		include 'kibc_report.php';
	break;
	case 'kibe_frm':
		include 'kibe_form.php';
	break;
	case 'kibe_rep':
		include 'kibe_report.php';
	break;

	case 'per_frm':
		include 'perawatan_form.php';
	break;	
	case 'per_detail':
		include 'perawatan_detail.php';
	break;	
	case 'per_rep':
		include 'perawatan_report.php';
	break;
	case 'per_rep_item':
		include 'perawatan_report_item.php';
	break;
}
?>
