	<script>
		$(document).ready(function(){
			$("#pegawai").autocomplete("page/surat/srcpegawai.php", {selectFirst: true});
		});
		$(document).ready(function(){
			$("#pegawai").focus();
		});
		$(document).ready(function(){
			$("#simpan").click(function(){
				addOut();	
			});
		});
		function addOut(){
			$.ajax({
				type: 'POST',
				url: '<?php echo $trxoutprc;?>',
				data: 'req=addOut&id='+$('#id').val()+'&pegawai='+$('#pegawai').val()+'&tanggal='+$('#tanggal').val()+'&total='+$('#total').val(),
				cache: false,
				success: function(res){
					$('#infItem').html(res);
					clearTemp();
				}
			});	
		}
		$(document).ready(function(){
			$("#batal").click(function(){
				clearTemp();
			});
		});
		$(document).ready(function(){
			$.ajax({
				type: 'POST',
				url: '<?php echo $trxoutprc;?>',
				data: 'req=getTempOut',
				cache: false,
				success: function(res){
					$('#infItem').html(res);
				}
			});		
		});
		$(document).ready(function(){
			$('#frmhead').slideDown();
		});
		function clearTemp(){
			$.ajax({
				type: 'POST',
				url: '<?php echo $trxoutprc;?>',
				data: 'req=clearTempOut',
				cache: false,
				success: function(res){
					$('#infItem').html(res);
					window.location="<?php echo $link; ?>&m=fbrgk";
				}
			});		
		}
	</script>
<div class="p-wrapper">
	<div class="content">
		<div style="border-bottom:1px solid #ccc;"></div>
		<h3 id="label-form">
			<ul>
				<li><a>TRANSAKSI</a></li>
				<li class="active">BARANG KELUAR</li>
			</ul>
		</h3>
		<div class="c5"></div>
		<div style="background:#ccc; padding:0 5px;">

				<table width="100%" border="0" cellspacing="0" cellpadding="0" id="thick-tbl">
				  <tr>
					<td width="15%" style="vertical-align:middle"><label>NAMA PEGAWAI</label></td>
					<td width="34%"><input type="text" name="pegawai" id="pegawai" /></td>
					<td width="16%"><input type="hidden" name="total" id="total" value="<?php echo $trxout->getTotalTemp();?>" /></td>
					<td width="11%" style="vertical-align:middle"><label>TANGGAL</label></td>
					<td width="24%"><input type="text" class="tanggal" name="tanggal" id="tanggal" value="<?php echo $date->format('d-m-Y'); ?>"  onclick="return showCalendar('tanggal', 'dd-mm-y')"/></td>
				  </tr>
				</table>
	  </div>
				<div class="c10"></div>
				<div id="infItem"></div>
	<div class="head_content" style="box-shadow:none;" >
		<input type="button" name="simpan" id="simpan" value="Simpan">
		<input type="button" name="batal" id="batal" value="Batal">
		<input type="button" name="kembali" value="Kembali" onclick="history.back();" style="float:right" />
	</div>
</div>
</div>