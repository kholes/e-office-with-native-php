<?php
session_start();
include "class/module.cls.php";
include "class/katmodule.cls.php";
$module=new Module();
$katmodule=new Katmodule();
$level=$user->getField('level',$logid);
$mod=$_SESSION['module'];
$hak=explode(',',$mod);
$q=sizeof($hak);
$min="?p=".encrypt_url('surat')."&m=min&sts=new";
//echo decrypt_url($_GET['p']);
?>
<link rel="stylesheet" type="text/css" href="css/menu.css" />
<script>
	$(document).ready(function(){
		$('#info-left').corner('round br tr 8px');
	});
	$(document).ready(function(){
		//check_news();
		getold_mail_in();
		getold_mail_int();
		
		getmailin_star();
		getmailint_star();

		getpengajuan_star();
		getold_pengajuan();
	});
	setInterval(function(){
		getmailin_star();
		getmailint_star();
		getpengajuan_star();
	}, 3600);
	function notice_mailin(id,jab,sts){
			var notice = '<div class="noticein">'
				+ '<div class="noticein-body">' 
				+ '<h3>Pesan baru.</h3>'
				+ '<p>Dari : '+jab+'</p>'
				+ '<p><a href="'+id+'" target="_blank">Klik disini untuk membuka.</a></p>'
				+ '</div>'
				+ '<div class="noticein-bottom">'
				+ '</div>'
				+ '</div>';			  
			$( notice ).purr({
				usingTransparentPNG: true,
				isSticky: true
			});		
			return false;
	}
	function notice_mailint(id,jab,sts){
			var notice = '<div class="noticeint">'
				+ '<div class="noticeint-body">' 
				+ '<h3>Pesan baru.</h3>'
				+ '<p>Dari : '+jab+'</p>'
				+ '<p><a href="'+id+'" target="_blank">Klik disini untuk membuka.</a></p>'
				+ '</div>'
				+ '<div class="noticeint-bottom">'
				+ '</div>'
				+ '</div>';			  
			$( notice ).purr({
				usingTransparentPNG: true,
				isSticky: true
			});		
			return false;
	}
	function notic_pengajuan(id,jab,sts){
			var notice = '<div class="noticepengajuan">'
				+ '<div class="noticepengajuan-body">' 
				+ '<h3>Pengajuan barang.</h3>'
				+ '<p>Dari : '+jab+'</p>'
				+ '<p><a href="<?php echo $link;?>&m=dp&id='+id+'">Klik disini untuk membuka.</a></p>'
				+ '</div>'
				+ '<div class="noticepengajuan-bottom">'
				+ '</div>'
				+ '</div>';			  
			$( notice ).purr({
				usingTransparentPNG: true,
				isSticky: true
			});		
			return false;
	}
	$('<audio id="chatAudio"><source src="sound/notify.ogg" type="audio/ogg"><source src="sound/notify.wav" type="audio/mpeg"><source src="sound/notify.wav" type="audio/wav"></audio>').appendTo('body');
</script>
<ul id="foo2">
	<li><a href='?p=<?php echo encrypt_url('home');?>'><img src="img/home-black.png" />Home </span></a></li>
	<?php
	for($i=0;$i<$q;$i++){
		$url=$module->getField('url',$hak[$i]);
		if($level!='ROT'){
			if($url=='surat'){
					?>
					<li>
							<input type="hidden" id="old_mail_int" style="width:10px;" />
							<input type="hidden" id="old_mail_in" style="width:10px;" />
							<a href='?p=<?php echo encrypt_url($module->getField('url',$hak[$i]));?>'>
							<span id="infmailin_star" class="inf"></span>
							<span id="infmailint_star" class="inf"></span>
							<img src='<?php echo $module->getField('icon',$hak[$i]);?>'><br>
							<?php echo $module->getField('nama',$hak[$i]);?>
						</a>
					</li>
					<?php
			
			}elseif($url=='pengajuan'){
					?>
					<li>
						<a href='?p=<?php echo encrypt_url($module->getField('url',$hak[$i]));?>'>
							<span id="starPengajuan" class="inf"></span>
							<img src='<?php echo $module->getField('icon',$hak[$i]);?>'><br>
							<?php echo $module->getField('nama',$hak[$i]);?>
							<input type="hidden" id="old_pengajuan" />
						</a>
					</li>
					<?php
			
			}elseif($url=='asettetap'){
					?>
					<li>
						<a href='?p=<?php echo encrypt_url($module->getField('url',$hak[$i]));?>'>
							<span id="infIn"></span>
							<img src='<?php echo $module->getField('icon',$hak[$i]);?>'><br>
							<?php echo $module->getField('nama',$hak[$i]);?>
						</a>
					</li>
					<?php
			
			}elseif($url=='barang'){
					?>
					<li>
						<a href='?p=<?php echo encrypt_url($module->getField('url',$hak[$i]));?>'>
							<span id="infBarang"></span>
							<img src='<?php echo $module->getField('icon',$hak[$i]);?>'><br>
							<?php echo $module->getField('nama',$hak[$i]);?>
						</a>
					</li>
					<?php
			
			}else{
					?>
					<li>
						<a href='?p=<?php echo encrypt_url($module->getField('url',$hak[$i]));?>'>
							<span id="infBarang"></span>
							<img src='<?php echo $module->getField('icon',$hak[$i]);?>'><br>
							<?php echo $module->getField('nama',$hak[$i]);?>
						</a>
					</li>
					<?php
			
			}
		}else{
			?>	
					<li>
						<a href='?p=<?php echo encrypt_url($module->getField('url',$hak[$i]));?>'>
							<img src='<?php echo $module->getField('icon',$hak[$i]);?>'><br>
							<?php echo $module->getField('nama',$hak[$i]);?>
						</a>
					</li>
			<?php
		}
	}
	?>
	<li><a href='?p=<?php echo encrypt_url('logout');?>'><img src="img/logout-black.png" />Keluar</a></li>
</ul>	
<div class='info-user'>
	<div style="margin-right:20px; text-align:center; color:#AA0000;">
		<img src="foto/blank.png" />
		<a onclick="menu_pop_show();"><p style="font-size:14px; font-weight:bold; margin:5px; color:#002B55"><?php echo $pegawai->getField('nama',$logid);?></p></a>
	</div>
</div>
