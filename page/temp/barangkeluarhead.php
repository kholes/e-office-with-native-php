<?php
	include "class/trxinput.cls.php";
	$trx=new Trxinput();
	?>
	<script type="text/javascript" src="js/autocomplete.js"></script>		
	<script>
		$(document).ready(function(){
			$("#pegawai").autocomplete("srcpegawai.php", {
				selectFirst: true
			});
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
				url: 'ajaxtemp.php',
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
				url: 'ajaxtemp.php',
				data: 'req=getTempOut',
				cache: false,
				success: function(res){
					$('#infItem').html(res);
				}
			});		
		});
		function upQty(id){
			var qty = prompt("Masukan Jumlah Barang", "1");
			if (qty != null) {
				$.ajax({
					type:'post',
					url:'ajaxtemp.php',
					data:'req=upQtyOut&id='+id+'&qty='+qty,
					cache :false,
					success:function (data){
						window.location="?p=<?php echo encrypt_url('barangkeluar'); ?>";
					}
				});	
			}				
		}
		$(document).ready(function(){
			$('#frmhead').slideDown();
		});
		function clearTemp(){
			$.ajax({
				type: 'POST',
				url: 'ajaxtemp.php',
				data: 'req=clearTempOut',
				cache: false,
				success: function(res){
					$('#infItem').html(res);
					window.location="?p=<?php echo encrypt_url('barangkeluar'); ?>";
				}
			});		
		}
	</script>
	<body>
		<div class="p-menu"><?php include "menu.php"; ?></div>
		<div class="p-head">
			<div class="p-head-c">
				<div id="right"></div>
				<div id="left">
					<?php include 'barangkeluarmenu.php'; ?>
				</div>
			</div>
		</div>		
		<div class="p-wrapper">
			<div id="p-frm">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<th colspan="5" align="center"><h3>FORM TRANSAKSI PENGELUARAN BARANG </h3></th>
						<tr>
							<td class="btn" colspan="2" >&nbsp;</td>
				  		</tr>
				  <tr>
					<td width="15%">No. Transaksi </td>
					<td width="21%"><input type="text" name="id" id="id" value="<?php echo kode('dtbarangkeluar',$logid);?>"></td>
					<td width="21%">&nbsp;</td>
					<td width="19%">Nama Pegawai </td>
					<td width="24%"><input type="text" name="pegawai" id="pegawai"></td>
				  </tr>
				  <tr>
					<td>Tanggal</td>
					<td><input type="text" class="tanggal" name="tanggal" id="tanggal" value="<?php echo $date->format('d-m-Y'); ?>"  onClick="return showCalendar('tanggal', 'dd-mm-y')"/></td>
					<td>&nbsp;</td>
					<td width="19%">Total </td>
					<td width="24%"><input type="text" name="total" id="total" value=""></td>
				  </tr>
						<tr>
							<td class="btn" colspan="2" >&nbsp;</td>
				  		</tr>
				</table>
			</div>
			<div id="p-main">
				<span id="infItem"></span>
			</div>
			<div class="head-tr">
				<p>TRANSAKSI BARANG KELUAR NO :	<?php echo kode('dtbarangkeluar',$logid);?>	</p>
				<div style="float:right;">				
				<input type="button" name="simpan" id="simpan" value="Simpan">
				<input type="button" name="batal" id="batal" value="Batal">
				</div>	
				<div class="c"></div>	
			</div>
		</div>
	</body>
