<?php
switch($level){
	case 'KSI':$status='0';break;
	case 'KTU':$status='0';break;
	case 'KKR':$status='1';break;
	case 'STG':$status='2';break;
}
?>
<div class="p-head">
	<div class="p-head-c">
		<div id="left">
			<ul class="dropmenu">
			<li><a href="#">Menu</a>
				<ul>
					<div class="mn"><b></b>
						<li><a href="<?php echo $link; ?>&m=fp">Buat Pengajuan Barang</a></li>
					</div>
				</ul>
			</li>
			<li><a href="#">Pengajuan <span id="infpengajuan_head_star"></span></a>
				<ul>
					<div class="mn"><b></b>
					<li>
						<a href="<?php echo $link; ?>&m=dp&sts=<?php echo $status;?>">Pengajuan baru<span id="infpengajuan_head_new"></span></a>
					</li>
					<li><a href="<?php echo $link; ?>&m=dp&get=all">Data pengajuan barang</a></li>
					</div>
				</ul>
			</li>
			</ul>			
		</div>
	</div>
</div>












