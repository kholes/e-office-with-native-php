<?php
	$c=$_GET['c'];
?>
<script>
$(document).ready(function(){
	$('#cari').keypress(function(e){
		if(e.keyCode==13){
			cari();
		}
	});
});
function cari(){
	window.location='<?php echo $link;?>&m=dtbrg&c='+$('#cari').val();
	$('#cari').focus();
}
</script>
<div class="p-head">
	<div class="p-head-c">
			<div id="right"><input type="text" name="cari" id="cari" style="width:60%" value="<?php echo $_GET['cari']; ?>">&nbsp;<input type="button" id="btcari" value="Cari" class="btn" />
			</div>
			<div id="left">
	<ul class="dropmenu">
	<li><a href="#">Menu</a>
		<ul>
			<div class="mn"><b></b>
									<li><a href="<?php echo $link; ?>&m=fbrg">Registrasi Barang  </a></li>
									<li><a href="<?php echo $link; ?>&m=fcode">Cetak Barcode</a></li>
			</div>
		</ul>
	</li>
	<li><a href="#">Transaksi</a>
		<ul>
			<div class="mn"><b></b>
									<li><a href="<?php echo $link; ?>&m=fbrgm">Transaksi Belanja </a></li>
									<li><a href="<?php echo $link; ?>&m=fbrgk">Transaksi Barang Keluar </a></li>
			</div>
		</ul>
	</li>
	<!--
	<li><a href="#">Data</a>
		<ul>
			<div class="mn"><b></b>
									<li><a href="<?php echo $link; ?>&m=dtbrm">Belanja Barang </a></li>
									<li><a href="<?php echo $link; ?>&m=dtbrk">Pemakaian Barang</a></li>
									<li><a href="<?php echo $link; ?>&m=dtbrg">Stok Barang </a></li>
			</div>
		</ul>
	</li>
	-->
	<li><a href="#">Laporan</a>
		<ul>
			<div class="mn"><b></b>
									<li><a href="<?php echo $link; ?>&m=rbrgm">Laporan Belanja Barang </a></li>
									<li><a href="<?php echo $link; ?>&m=rbrgk">Laporan Barang Keluar </a></li>
									<li><a href="<?php echo $link; ?>&m=rsto">Laporan Stok Opname</a></li>
			</div>
		</ul>
	</li>
</ul>			</div>
		</div>
	</div>
