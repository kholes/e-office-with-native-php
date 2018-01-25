<?php
include "class/surat.cls.php";
include "class/suratkeluar.cls.php";
include "class/jabatan.cls.php";
include "class/dtklasifikasi.cls.php";
include "class/dtkode.cls.php";
$surat=new Surat();
$suratkeluar=new Suratkeluar();
$jabatan=new Jabatan();
$peg=new Pegawai();
$klas=new Dtklasifikasi();
$kode=new Dtkode();
$id=$_GET['ide'];
$ids=$_GET['id'];
$link='?p='.encrypt_url('entrisurat');
$linkdata='page/entrisuratdata.php';
if(isset($ide)){$btn='Edit';}else{$btn='Simpan';}
$logid=decrypt_url($_SESSION['id_user']);
$loglevel=$user->getField('level',$logid);
$sts=$_GET['sts'];
$get=$_GET['get'];
?>
<script>
	$(document).ready(function(){
		$.ajax({
			type:'post',
			url:'<?php echo $linkdata; ?>',
			data:'btn&sts=<?php echo $sts; ?>',
			cache :false,
			success:function (data){
				$('#inf-data').html(data);
			}
		});
	});
	$(function(){  
		$('<audio id="chatAudio"><source src="sound/notify.ogg" type="audio/ogg"><source src="sound/notify.wav" type="audio/mpeg"><source src="sound/notify.wav" type="audio/wav"></audio>').appendTo('body');
	});
	/*
	setInterval(blinker, 1000); //Runs every second
	function blinker() {
		var num=document.getElementById('infRem').innerHTML;
		if(num!=0){
			$('.blink_me').fadeTo('slow', 0.3, function(){
				$(this).css('background-image', 'url(img/warning.png)');
			}).fadeTo('slow', 2, function(){
				$(this).css('background-image', 'url(img/warning.png)');
			});			
		}else{
			$('.blink_me').fadeIn(500);
		}
	}
	*/
	/*
	setInterval(blink, 1000); //Runs every second
	function blink() {
		var num=document.getElementById('infRem').innerHTML;
		if(num!=0){
			$('.blink').fadeTo('slow', 0.3, function(){
				$(this).css('color', '#ff0000');
			}).fadeTo('slow', 1, function(){
				$(this).css('color', '#fff');
			});			
		}else{
			$('.blink').fadeIn(500);
		}
	}
	*/
</script>
<body>
<?php
switch($loglevel){
	case 'KKR':
		include 'suratkkr.php';
	break;
	case 'KTU':
		include 'suratkkr.php';	
	break;
	case 'SKR':
		include 'suratskr.php';	
	break;
	case 'KSI':
		include 'suratksi.php';	
	break;
}
?>
</body>
