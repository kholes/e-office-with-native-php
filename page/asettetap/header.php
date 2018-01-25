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
	window.location='<?php echo $link;?>&m=aset_detail&id='+$('#cari').val();
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
				<li><a href="<?php echo $link; ?>&m=kiba_frm">REGISTRASI ASET KIB A</a></li>
				<li><a href="<?php echo $link; ?>&m=kibb_frm">REGISTRASI ASET KIB B</a></li>
				<li><a href="<?php echo $link; ?>&m=kibc_frm">REGISTRASI ASET KIB C</a></li>
				<li><a href="<?php echo $link; ?>&m=kibe_frm">REGISTRASI ASET KIB E</a></li>
			</div>
		</ul>
	</li>
	<li><a href="#">Data</a>
		<ul>
			<div class="mn"><b></b>
				<li><a href="<?php echo $link; ?>&m=kiba_rep"> KIB A (TANAH)</a></li>
				<li><a href="<?php echo $link; ?>&m=kibb_rep"> KIB B (PERALATAN &amp; MESIN) </a></li>
				<li><a href="<?php echo $link; ?>&m=kibc_rep"> KIB C (GEDUNG &amp; BANGUNAN) </a></li>
				<li><a href="<?php echo $link; ?>&m=kibe_rep"> KIB E (BUKU) </a></li>
			</div>
		</ul>
	</li>
	<li><a href="#">Perawatan</a>
		<ul>
			<div class="mn"><b></b>
				<li><a href="<?php echo $link; ?>&m=per_frm">REGISTRASI PERAWATAN</a></li>
				<li><a href="<?php echo $link; ?>&amp;m=per_rep_item"> DETAIL PERAWATAN ASET </a></li>
				<!--<li><a href="<?php echo $link; ?>&amp;m=per_rep"> PERAWATAN</a></li>-->
				<!--<li><a href="<?php echo $link; ?>&amp;m=rhis">HISTORY PERAWATAN</a></li>-->
			</div>
		</ul>
	</li>
</ul>
</div>
</div>
</div>
