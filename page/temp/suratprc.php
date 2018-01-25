<?php
session_start();
include "../../lib/lib.php";
include "../../class/surat.cls.php";
include "../../class/dtklasifikasi.cls.php";
include "../../class/dtkode.cls.php";
include "../../class/user.cls.php";
$db=new Db();
$db->conDb();
$user=new User();
$surat=new Surat();
$klas=new Dtklasifikasi();
$kode=new Dtkode();
$logid=decrypt_url($_SESSION['id_user']);
$iduser=$user->getField('id_user',$logid);
if($logid != $iduser or $logid=='' or $iduser==''){
	header("location:../../index.php");
}else{
	$req=$_POST['req'];
	switch($req){
		case 'saveDisposisi':
			print_r($_POST);
			$data=array('id'=>$_POST['id'],'pejabat_dis'=>$logid,'disposisi'=>$_POST['dis'],'tanggal'=>$date->format('Y-m-d'),'catatan'=>$_POST['catatan'],'bataswaktu'=>tgl_ind_to_eng($_POST['bataswaktu']),'status'=>'dis');
			$dis=$surat->disposisi($data);
		break;
		case 'getKodeSurat':
			$kode=$_POST['kode'];
			$klas=$_POST['klas'];
			$thn=$date->format('Y');
			$bln=$date->format('m');
			$nourut=urutauto('dtsuratkeluar',$date->format('Y'));
			$nosurat=$noindex.'/'.$nourut.'/'.$bag.'-'.$thn;
			$data=array('0'=>$nosurat);
			json_encode($data);
		break;
	}
}
?>
