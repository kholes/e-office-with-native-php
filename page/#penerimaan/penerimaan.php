<?php
include "class/pengajuan.cls.php";
include "class/dtbarang.cls.php";
include "class/dtmerek.cls.php";
include "class/dtsatuan.cls.php";
include "class/jabatan.cls.php";
$pengajuan=new Pengajuan();
$jabatan=new Jabatan();
$dtbarang=new Dtbarang();
$merek=new Dtmerek();
$satuan=new Dtsatuan();
$link='?p='.encrypt_url('penerimaan');
$linkdata='page/penerimaan/penerimaanprc.php';
$i=$_GET['i'];
$s=$_GET['s'];
if($s==''){$s='id';}

include "header.php";
$menu=$_GET['m'];
switch($menu){
	case '':
		include 'datapenerimaan.php';
	break;
	case 'dp':
		include 'datapenerimaan.php';
	break;
	case 'dp1':
		include 'datapenerimaan.php';
	break;
	case 'dp2':
		include 'datapenerimaan.php';
	break;
	case 'dp3':
		include 'datapenerimaan.php';
	break;
}
?>
