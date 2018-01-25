<script>
	$(document).ready(function(){
		infpengajuan_head_new();
		$("a.media").media({
			width:100+'%', 
			height:1000,
		});
		$('#cari').focus();
	});
	setInterval(function(){
		infpengajuan_head_new();
	}, 3600);
</script>
<div class="p-head">
	<div class="p-head-c">
	<div id="left">
		<ul class="dropmenu">
			<li><a href="#">Pengajuan <span id="infpengajuan_head_star"></span></a>
				<ul>
					<div class="mn"><b></b>
					<li>
						<a href="<?php echo $link; ?>&m=dp">Pengajuan baru <span id="infpengajuan_head_new"></span></a>
					</li>
					<li><a href="<?php echo $link; ?>&m=fp">Pengajuan diterima</a></li>
					</div>
				</ul>
			</li>
		</ul>			
	</div>
    </div>
</div>