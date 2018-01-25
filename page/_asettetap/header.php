<script>
$(document).ready(function(){
	$('#cari').keypress(function(e){
		if(e.keyCode==13){
			cari();
		}
	});
});
function cari(){
	var c =$('#cari').val();
	if(c.length<8){alert ('ID Aset tidak valid, MIN 8 Karakter.');return;}
	window.location='<?php echo $link;?>&m=daset&id='+$('#cari').val();
}
</script>
<div class="p-head">
	<div class="p-head-c">
			<div id="right"><input type="text" name="cari" id="cari" value="<?php echo $_GET['id']; ?>" style="width:200px;">&nbsp;<input type="button" id="btcari" value="Cari" class="btn" onclick="cari();" />
			</div>
	  <div id="left">
	<ul class="dropmenu">
	<li><a href="#">Menu</a>
		<ul>
			<div class="mn"><b></b>
				<li><a href="<?php echo $link; ?>&m=fper">PERAWATAN ASET</a></li>
				<li><a href="<?php echo $link; ?>&m=fkiba">REGISTRASI ASET KIB A</a></li>
				<li><a href="<?php echo $link; ?>&m=fkibb">REGISTRASI ASET KIB B</a></li>
				<li><a href="<?php echo $link; ?>&m=fkibc">REGISTRASI ASET KIB C</a></li>
				<li><a href="<?php echo $link; ?>&m=fkibe">REGISTRASI ASET KIB E</a></li>
				<!--<li><a href="<?php echo $link; ?>&m=fkir">BUAT K I R</a></li>-->
			</div>
		</ul>
	</li>
	<li><a href="#">Data</a>
		<ul>
			<div class="mn"><b></b>
				<li><a href="<?php echo $link; ?>&m=repper">DATA PERAWATAN</a></li>
				<li><a href="<?php echo $link; ?>&m=repkiba"> KIB A</a></li>
				<li><a href="<?php echo $link; ?>&amp;m=repkibb"> KIB B</a></li>
				<li><a href="<?php echo $link; ?>&amp;m=repkibc"> KIB C</a></li>
				<li><a href="<?php echo $link; ?>&amp;m=repkibe"> KIB E</a></li>
			</div>
		</ul>
	</li>
	<li><a href="#">Laporan</a>
		<ul>
			<div class="mn"><b></b>
				<li><a href="<?php echo $link; ?>&amp;m=repmain"> PERAWATAN</a></li>
				<!--<li><a href="<?php echo $link; ?>&amp;m=rhis">HISTORY PERAWATAN</a></li>-->
			</div>
		</ul>
	</li>
</ul>
</div>
</div>
</div>
