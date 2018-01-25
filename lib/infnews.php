<?php
session_start();
include "lib.php";
include "../class/news.cls.php";
include "../class/user.cls.php";
include "../class/pegawai.cls.php";
$db=new Db();
$db->conDb();
$news=new News();
$user=new User();
$pegawai=new Pegawai();
$logid=decrypt_url($_SESSION['id_user']);
$level=$user->getField('level',$logid);
$req=$_POST['req'];
switch($req){
//=================Call & Cek notifikasi================
	case 'getmailin_star':
		$in=$news->getmenu_star_in($logid);	
		if($in>0){
			$star="<img src='img/warning-star.png' style='width:10px'/>";
			$jum=$in;
		}else{
			$jum="0";
		}			
		$data=array("0"=>$jum,"1"=>$star);
		echo json_encode($data);
	break;
	case 'getnoticein':
		$sql=mysql_query("select * from dtmail_in where mto='$logid' order by tanggal DESC limit 1");
		while($row=mysql_fetch_assoc($sql)){
			$mto=$pegawai->getField('jabatan',$row['mfrom']);
			$n=array('0'=>$row['mail_file01'],'1'=>$mto,'2'=>$row['mail_status']);
			echo json_encode($n);		 
		}
	break;
	case 'getold_mail_in':
		echo $news->getold_mail_in($logid);			
	break;

//========= Cek Jumlah surat masuk untuk menu header===============//
	case 'getmailint_star':
		$int=$news->getmenu_star_int($logid);	
		if($int>0){
			$star="<img src='img/warning-star.png' style='width:10px'/>";
			$jum=$int;
		}else{
			$jum="0";
		}			
		$data=array("0"=>$jum,"1"=>$star);
		echo json_encode($data);
	break;
	case 'getnoticeint':
		$sql=mysql_query("select * from dtmail_int where mto='$logid' order by tanggal DESC limit 1");
		while($row=mysql_fetch_assoc($sql)){
			$mto=$pegawai->getField('jabatan',$row['mfrom']);
			$n=array('0'=>$row['file01'],'1'=>$mto,'2'=>$row['mail_status']);
			echo json_encode($n);		 
		}
	break;
	case 'getold_mail_int':
		echo $news->getold_mail_int($logid);			
	break;

//========= Cek Jumlah surat masuk untuk menu header===============//
	case 'getmout':
		if($news->getmout($logid)){
			echo "<span class='count_news'>".$news->getmout($logid)."</span>";
		}			
	break;
//========= SURAT INTERNAL CEK JUMLAH SURAT ===============//
	case 'getint_head_in':
		if($news->getint_head_in($logid)){
			echo "<span class='count_news'>".$news->getint_head_in($logid)."</span>";
		}			
	break;
	case 'getint_head_out':
		if($news->getint_head_out($logid)){
			echo "<span class='count_news'>".$news->getint_head_out($logid)."</span>";
		}			
	break;
//========= NOTIFIKASI PENGAJUAN BARANG ===============//
	case 'getpengajuan_star':
		$pengajuan=$news->getmenu_star_pengajuan($level);	
		if($pengajuan>0){
			$star="<img src='img/warning-star.png' style='width:10px'/>";
			$jum=$pengajuan;
			$data=array("0"=>$jum,"1"=>$star);
			echo json_encode($data);
		}		
	break;
	case 'getold_pengajuan':
		echo $news->getold_pengajuan($level);			
	break;
	case 'getnotice_pengajuan':
		switch($level){
			case'KTU':$sts='0';break;
			case'KKR':$sts='1';break;
			case'STB':$sts='2';break;
		}
		 $sql=mysql_query("select * from dtpengajuan where status='$sts' order by tgl_pengajuan DESC limit 1");
		 while($row=mysql_fetch_assoc($sql)){
		 	$pemohon=$pegawai->getField('jabatan',$row['pemohon']);
			$n=array('0'=>$row['id'],'1'=>$pemohon,'2'=>$row['status']);
			echo json_encode($n);		 
		 }
	break;
}
?>
