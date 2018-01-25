<?php
include "class/pengajuan.cls.php";
include "class/dtbarang.cls.php";
include "class/dtbarangmasuk.cls.php";
include "class/dtbarangkeluar.cls.php";
include "class/dtmerek.cls.php";
include "class/dtsatuan.cls.php";
include "class/jabatan.cls.php";
$pengajuan=new Pengajuan();
$jabatan=new Jabatan();
$pegawai=new Pegawai();
$dtbarang=new Dtbarang();
$barangmasuk=new Dtbarangmasuk();
$barangkeluar=new Dtbarangkeluar();
$merek=new Dtmerek();
$satuan=new Dtsatuan();
$link='?p='.encrypt_url('pengajuan');
$linkdata='page/pengajuan/pengajuanprc.php';
$i=$_GET['i'];
$s=$_GET['s'];
if($s==''){$s='id';}
include "header.php";
$menu=$_GET['m'];
switch($menu){
	case '':
		include 'home_page.php';
	break;
	case 'pengajuanform':
		include 'pengajuan_form.php';
	break;
	case 'pengajuantrx':
		include 'pengajuan_trx.php';
	break;
	case 'pengajuanref':
		include 'pengajuan_ref.php';
	break;
	case 'pengajuandata':
		include 'pengajuan_data.php';
	break;
}
?>
