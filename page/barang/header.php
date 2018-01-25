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
	window.location='<?php echo $link;?>&m=databarang&c='+$('#cari').val();
	$('#cari').focus();
}
</script>
<div class="p-head">
	<div class="p-head-c">
			<div id="right"><input type="text" name="cari" id="cari" style="width:60%" value="<?php echo $_GET['cari']; ?>">&nbsp;<input type="button" id="btcari" value="Cari" class="btn" onclick="cari();" />
			</div>
			<div id="left">
	<ul class="dropmenu">
	<li><a href="#">Menu</a>
		<ul>
			<div class="mn"><b></b>
				<li><a href="<?php echo $link; ?>&m=barangform">Registrasi Barang  </a></li>
				<li><a href="<?php echo $link; ?>&m=barangmasukform">Transaksi Belanja </a></li>
				<li><a href="<?php echo $link; ?>&m=barangkeluarform">Transaksi Barang Keluar </a></li>
			</div>
		</ul>
	</li>
	<li><a href="#">Laporan</a>
		<ul>
			<div class="mn"><b></b>
				<li><a href="<?php echo $link; ?>&m=barangmasukreport">Laporan Belanja Barang </a></li>
				<li><a href="<?php echo $link; ?>&m=barangkeluarreport">Laporan Barang Keluar </a></li>
			</div>
		</ul>
	</li>
	<li><a href="#">Data Barang</a>
		<ul>
			<div class="mn"><b></b>
				<li><a href="<?php echo $link; ?>&m=barangdata">Data Barang</a></li>
				<li><a href="<?php echo $link; ?>&m=barangstockopname">Stock Opname</a></li>
			</div>
		</ul>
	</li>
	<li><a href="#">Barcode</a>
		<ul>
			<div class="mn"><b></b>
				<li><a href="<?php echo $link; ?>&m=barcodeform">Cetak Barcode</a></li>
			</div>
		</ul>
	</li>
</ul>			</div>
		</div>
	</div>
