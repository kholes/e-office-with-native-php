<script>
	$(document).ready(function(){
		$('.counter').corner('round bl br tl tr 8px');
	});
	$(document).ready(function(){
		$('#btcari').click(function(){
			var dtmail='<?php echo $_GET['m'];?>';
			switch(dtmail){
				case 'min':
					window.location='<?php echo $link; ?>&m='+dtmail+'&o=<?php echo $_GET['o'];?>&cari='+$('#cari').val();
				break;
				case 'min_out':
					window.location='<?php echo $link; ?>&m='+dtmail+'&cari='+$('#cari').val();
				break;
				case 'min_int':
					window.location='<?php echo $link; ?>&m='+dtmail+'&cari='+$('#cari').val();
				break;
				case 'min_int_out':
					window.location='<?php echo $link; ?>&m='+dtmail+'&cari='+$('#cari').val();
				break;
			}
		});
		$('#cari').keypress(function(e){
			if(e.keyCode==13){
				$('#btcari').click();
			}
		});
	});
	$(document).ready(function(){
		$('#cari').focus();
	});
</script>	
<?php
switch($_GET['m']){
	case 'min':
		$bg_min='#eee';
		$bg_min_out='none';
		$bg_min_int='none';
		$col_min='#FF5400';
		$col_min_out='#fff';
		$col_min_int='#fff';
	break;
	case 'min_out':
		$bg_min='#eee';
		$bg_min_out='none';
		$bg_min_int='none';
		$col_min='#FF5400';
		$col_min_out='#fff';
		$col_min_int='#fff';
	break;
	case 'min_int':
		$bg_min='none';
		$bg_min_out='none';
		$bg_min_int='#eee';
		$col_min='#fff';
		$col_min_out='#fff';
		$col_min_int='#FF5400';
	break;
	case 'min_int_out':
		$bg_min='none';
		$bg_min_out='none';
		$bg_min_int='#eee';
		$col_min='#fff';
		$col_min_out='#fff';
		$col_min_int='#FF5400';
	break;
	case 'mout':
		$bg_min='none';
		$bg_min_int='none';
		$bg_min_out='#eee';
		$col_min='#fff';
		$col_min_out='#FF5400';
		$col_min_int='#fff';
	break;
	case'':
		$bg_min='none';
		$bg_min_out='none';
		$bg_min_int='none';
		$col_min='#fff';
		$col_min_out='#fff';
		$col_min_int='#fff';
	break;
}
?>
<div class="p-head">
	<div class="p-head-c">
			<div id="right"><input type="text" name="cari" id="cari" style="width:60%" value="<?php echo $_GET['cari']; ?>">&nbsp;<input type="button" id="btcari" value="Cari" class="btn" />
			</div>
			<div id="left">
	<ul class="dropmenu">
	<li><a href="#">Menu</a>
		<ul>
			<div class="mn"><b></b>
				<li><a href="<?php echo $link;?>&m=fint">Surat Internal</a></li>
				<?php if($loglevel=='SKR'){?>
				<li><a href="<?php echo $link; ?>&m=fsuratmasuk">Registrasi Surat Masuk </a></li>
				<li><a href="<?php echo $link; ?>&m=fsuratkeluar">Registrasi Surat Keluar </a>
				<?php }?>
			</div>
		</ul>
	</li>
	<li style="background:<?php echo $bg_min_int;?>"><a style="color:<?php echo $col_min_int;?>">Surat Internal <span id="infmailint_head_star"></span></a>
		<ul>
			<div class="mn"><b></b>
				<li><a href="<?php echo $link; ?>&m=min_int">Surat Masuk<span id="infmailint_new"></span></a></li>
				<li><a href="<?php echo $link; ?>&m=min_int_out">Surat Keluar <span id="infint_head_out"></span></a></li>
				<?php if($loglevel=='SKR'){?>
				<li><a href="<?php echo $link; ?>&m=min_int&sts=app">Surat Disetujui <span class="infHead" id="infIntDis"></span></a></li>
				<?php } ?>
			</div>
		</ul>
	</li>
	<li style="background:<?php echo $bg_min;?>"><a style="color:<?php echo $col_min;?>">Surat External <span id="infmailin_head_star"></span></a>
		<ul>
			<div class="mn"><b></b>
				<li><a href="<?php echo $link; ?>&m=min">Surat Masuk <span id="infmailin_new"></span></a></li>
				<li><a href="<?php echo $link; ?>&m=min_out">Surat Keluar <span id="infmout"></span></a></li>
				<!--			
				<li><a href="<?php echo $link; ?>&m=min">Surat Disposisi <span id="infmin_head_dis"></span></a></li>
				<li><a href="<?php echo $link; ?>&m=min">Surat Proses <span id="infmin_head_prc"></span></a></li>
				<li><a href="<?php echo $link; ?>&m=min">Surat Berbatas <span id="infmin_head_rem"></span></a></li>
				-->
			</div>
		</ul>
	</li>
	<?php if($loglevel=='SKR'){?>
	<li style="background:<?php echo $bg_min_out;?>"><a style="color:<?php echo $col_min_out;?>" href="<?php echo $link; ?>&m=mout">Surat Keluar</a></li>
	<li><a href="#">Pengaturan</a>
		<ul>
			<div class="mn"><b></b>
				<li><a href="<?php echo $link; ?>&m=findex">Index Surat</a></li>
				<li><a href="<?php echo $link; ?>&m=fklasifikasi">Kode Klasifikasi</a></li>
			</div>
		</ul>
	</li>
	<li><a href="#">Cetak Laporan</a>
		<ul>
			<div class="mn"><b></b>
				<li><a href="<?php echo $link; ?>&m=lapsurat">Laporan Surat</a></li>
			</div>
		</ul>
	</li>
	<?php }?>
</ul>			
</div>
</div>
</div>
