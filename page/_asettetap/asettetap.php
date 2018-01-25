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
		include 'repperawatan.php';
	break;
	case 'daset':
		include 'detailaset.php';
	break;
	case 'fkiba':
		include 'frmkiba.php';
	break;
	case 'fkibc':
		include 'frmkibc.php';
	break;
	case 'fkibb':
		include 'frmkibb.php';
	break;
	case 'fkibe':
		include 'frmkibe.php';
	break;
	case 'fper':
		include 'frmperawatan.php';
	break;
	case 'fkir':
		include 'frmkir.php';
	break;
	case 'fkupd':
		include 'frmkirupd.php';
	break;
	case 'repper':
		include 'repperawatan.php';
	break;
	case 'repkiba':
		include 'reportkiba.php';
	break;
	case 'repkibc':
		include 'reportkibc.php';
	break;
	case 'repkibe':
		include 'reportkibe.php';
	break;
	case 'repkibb':
		include 'reportkibb.php';
	break;
	case 'repkir':
		include 'kirhome.php';
	case 'repmain':
		include 'repmaintenance.php';
	break;
	case 'rhis':
		include 'rephistory.php';
	break;
}
?>
