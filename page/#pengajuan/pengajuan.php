<?php
include "class/pengajuan.cls.php";
include "class/dtbarang.cls.php";
include "class/dtmerek.cls.php";
include "class/dtsatuan.cls.php";
include "class/jabatan.cls.php";
$pengajuan=new Pengajuan();
$jabatan=new Jabatan();
$pegawai=new Pegawai();
$dtbarang=new Dtbarang();
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
		include 'datapengajuan.php';
	break;
	case 'fp':
		include 'frmpengajuan.php';
	break;
	case 'fh':
		include 'frmhead.php';
	break;
	case 'ds':
		include 'datastok.php';
	break;
	case 'dp':
		include 'datapengajuan.php';
	break;
}
?>
