<?php
include "class/dtmail_in.cls.php";
include "class/dtmail_in_out.cls.php";
include "class/dtsk.cls.php";
include "class/dtmail_int.cls.php";
include "class/dtmail_int_out.cls.php";
include "class/dtmail_out.cls.php";
//include "class/surat.cls.php";
include "class/suratkeluar.cls.php";
include "class/dtindex.cls.php";
include "class/dtklasifikasi.cls.php";
include "class/jabatan.cls.php";
//include "class/pegawai.cls.php";
$mail=new Mail();
$mail_out=new Mail_out();
$mailint=new Mailint();
$mailint_out=new Mailint_out();
$mailout=new Mailout();
//$surat=new Surat();
$sk=new Sk();
$klasifikasi=new Dtklasifikasi();
$jabatan=new Jabatan();
$pegawai=new Pegawai();
$suratkeluar=new Suratkeluar();
$index=new Dtindex();
$jabatan=new Jabatan();
$link='?p='.encrypt_url('surat');
$linkdata='page/surat/prc_mail.php';
$linksetting='page/surat/prc_setting.php';
$prcdata='page/surat/prc_data.php';
$logid=decrypt_url($_SESSION['id_user']);
$loglevel=$user->getField('level',$logid);
if(isset($ide)){$btn='Edit';}else{$btn='Simpan';}
$i=$_GET['i'];
$s=$_GET['s'];
if($s==''){$s='id';}
?>
<link rel="stylesheet" type="text/css" href="css/mail.css"/>
<script>
	$(document).ready(function(){
		$('.infHead').corner('round bl br tl tr 5px');
	});
	function viewHide(id){
		$('#detail'+id).slideUp('fast');
		location.reload();
	}
	function updateStatus(id){
		$.ajax({
			type:'post',url:'<?php echo $linkdata; ?>',data:'btn=updateStatus&id='+id,cache :false,success:function (data){
				window.location='<?php echo $link;?>';
			}
		});
	}
	function viewDetail(id,sts){
		$.ajax({
			type:'post',url:'<?php echo $linkdata; ?>',data:'btn=viewDetailIn&id='+id,cache :false,success:function (data){
				$('#detail'+id).show().html(data);
			}
		});
	}
	function viewDetail_out(id,sts){
		$.ajax({
			type:'post',url:'<?php echo $linkdata; ?>',data:'btn=viewDetailIn_out&id='+id,cache :false,success:function (data){
				$('#detail'+id).show().html(data);
			}
		});
	}
	function viewDetailOut(id,sts){
		$.ajax({
			type:'post',url:'<?php echo $linkdata; ?>',data:'btn=viewDetailOut&id='+id,cache :false,success:function (data){
				$('#detail'+id).show().html(data);
			}
		});
	}
	function viewDetailInt(id,sts){
		$.ajax({
			type:'post',url:'<?php echo $linkdata; ?>',data:'btn=viewDetailInt&id='+id+'&sts='+sts,cache :false,success:function (data){
				$('#detail'+id).show().html(data);
			}
		});
	}
	function viewDetailInt_out(id,sts){
		$.ajax({
			type:'post',url:'<?php echo $linkdata; ?>',data:'btn=viewDetailInt_out&id='+id+'&sts='+sts,cache :false,success:function (data){
				$('#detail'+id).show().html(data);
			}
		});
	}
	/*
	*/
	//PENANGANAN TOMBOL MENU KIRIM
	function registrasi_mail(id){
		window.location='<?php echo $link;?>&m=fsuratkeluar&id='+id;
	}
	function forward_mail_int(id,type){
		window.location='<?php echo $link;?>&m=fint&act=teruskan&id='+id;
	}
	function disposisi_mail(id){
		window.location='<?php echo $link;?>&m=dis&id='+id;
	}
	function forward_mailin(id){
		window.location='<?php echo $link;?>&m=ffwd&id='+id;
	}
	function reg_mail(id){
		window.location='<?php echo $link;?>&m=fsuratkeluar&act=reg&id='+id;
	}
	function replay_mail(id){
		window.location='<?php echo $link;?>&m=fint&act=replay&id='+id;
	}
	function saran_mail(id){
		window.location='<?php echo $link;?>&m=saran_mail&type=reg&id='+id;
	}
	function back_mail(id){
		window.location='<?php echo $link;?>&m=fint&act=kembalikan&id='+id;
	}
	function approved_mail(id){
		window.location='<?php echo $link;?>&m=fint&act=setujui&id='+id;
	}
	function forward_mailin(id){
		window.location='<?php echo $link;?>&m=ffwd&id='+id;
	}
	////////////////////////////////////////
	//TOMBOL EDIT 
	function edit_mail(id){
		window.location='<?php echo $link;?>&m=fsuratmasuk&act=edit&id='+id;
	}
	function edit_disposisi(id){
		window.location='<?php echo $link;?>&m=dis&act=edit&id='+id;
	}
	function edit_forward(id){
		window.location='<?php echo $link;?>&m=ffwd&act=edit&id='+id;
	}
	function edit_mail_out(id){
		window.location='<?php echo $link;?>&m=fsuratkeluar&act=edit&id='+id;
	}
	////////////////////////////
</script>
<?php include 'header.php';?>
<?php
	$menu=$_GET['m'];
	$max_time=60;
	switch($menu){
		case '':
			include 'dtmail_int.php';
		break;
		case 'min_int':
			include 'dtmail_int.php';
		break;
		case 'min_int_out':
			include 'dtmail_int_out.php';
		break;
		case 'min':
			include 'dtmail_inbox.php';
		break;
		case 'min_out':
			include 'dtmail_inbox_out.php';
		break;
		case 'mout':
			include 'dtmail_outbox.php';
		break;
		case 'saran_mail':
			include 'frmsaran.php';
		break;
		case 'ffwd':
			include 'frmforward.php';
		break;
		case 'fint':
			include 'frmsurat_int.php';
		break;
		case 'dis':
			include 'frmdisposisi.php';
		break;
		case 'fsuratmasuk':
			include 'frmsuratmasuk.php';
		break;
		case 'fsuratkeluar':
			include 'frmsuratkeluar.php';
		break;
		case 'fsk':
			include 'frmsk.php';
		break;
		case 'fdisposisi':
			include 'frmdisposisi.php';
		break;
		case 'fdraftsurat':
			include 'frmdraftsurat.php';
		break;
		//-------------------MENU SETING DATA----------------------//
		case 'findex':
			include 'frmindex.php';
		break;
		case 'fklasifikasi':
			include 'frmklasifikasi.php';
		break;
		//-------------------END SETING DATA----------------------//
		case 'ffwdint':
			include 'frmforwardint.php';
		break;
		case 'dtinbox':
			include 'inbox.php';
		break;
		case 'sk':
			include 'mailsk.php';
		break;
		case 'dtoutbox':
			include 'outbox.php';
		break;
		case 'lapsurat':
			include 'lapsurat.php';
		break;
		case 'disreport':
			include 'disreport.php';
		break;
	}
?>
