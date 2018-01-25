<?php
	include "class/trxinput.cls.php";
	$trx=new Trxinput();
	?>
	<script>
		$(document).ready(function(){
			$("#simpan").click(function(){
				window.location="?p=<?php echo encrypt_url('barangkeluarhead'); ?>";
			});
		});
		$(document).ready(function(){
			$("#batal").click(function(){
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
			});
		});
		$(document).ready(function(){
			$("#barcode").change(function(){
				$.ajax({
					type: 'POST',
					url: 'ajaxtemp.php',
					data: 'req=cekStokOut&kode='+$("#barcode").val(),
					cache: false,
					success: function(res){
						cekStok(res);
					}
				});		
			});
		});
		function cekStok(res){
			if(res > 0){
				addItem(res);
			}else{
				alert("Stok barang  tidak tersedia.");
				$("#barcode").val('');
				return;
			}
		}
		function addItem(stok){
			var kode=$("#barcode").val();
			var qty = prompt("Masukan jumlah barang.", "1");
			if(qty!=null){
				if (parseInt(qty) > parseInt(stok)) {
					alert("Jumlah stok tidak cukup");
					$("#barcode").val('');
					return;
				}else{
					$.ajax({
						type:'post',
						url:'ajaxtemp.php',
						data:'req=addItemOut&kode='+kode+'&qty='+qty,
						cache :false,
						success:function (data){
							window.location="?p=<?php echo encrypt_url('barangkeluar'); ?>";
						}
					});
				}
			}else{
				$("#barcode").val('');
				return;
			}	
		}
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
	</script>
	<body>
		<div class="p-menu"><?php include "menu.php"; ?></div>
		<div class="p-head">
			<div class="p-head-c">
				<div id="right">
					Input barcode &raquo;
					<input type="text" name="barcode" id="barcode">
				</div>
				<div id="left">
					<?php include 'barangkeluarmenu.php'; ?>
				</div>
			</div>
		</div>	
		<div class="p-wrapper">
			<div id="p-main" style="margin-top:-40px">
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
	<script>
		function setfocus(){$('#barcode').focus();}
		document.onkeydown = function(e){setfocus();}
	</script>
