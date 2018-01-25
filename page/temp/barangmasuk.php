<?php
	include "class/trxinput.cls.php";
	$trx=new Trxinput();
	?>
	<script type="text/javascript" src="js/autocomplete.js"></script>		
	<script>
		$(document).ready(function(){
			$("#simpan").click(function(){
				window.location="?p=<?php echo encrypt_url('barangmasukhead'); ?>";
			});
		});
		$(document).ready(function(){
			$("#batal").click(function(){
				$.ajax({
					type: 'POST',
					url: 'ajaxtemp.php',
					data: 'req=clearTemp',
					cache: false,
					success: function(res){
						$('#infItem').html(res);
						window.location="?p=<?php echo encrypt_url('barangmasuk'); ?>";
					}
				});		
			});
		});
		$(document).ready(function(){
			$("#barcode").change(function(){
				window.location='?p=<?php echo encrypt_url('barangmasukcount'); ?>&barcode='+$("#barcode").val();	
			});
		});
		$(document).ready(function(){
			$.ajax({
				type: 'POST',
				url: 'ajaxtemp.php',
				data: 'req=getTempIn',
				cache: false,
				success: function(res){
					$('#infItem').html(res);
				}
			});		
		});
		function getDetail(idt,id,kode,nama,harga_beli,qty,jumlah,diskon){
			window.location="?p=<?php echo encrypt_url('barangmasukcount');?>&idt="+idt+"&id="+id+"&kode="+kode+"&nama="+nama+"&harga_beli="+harga_beli+"&qty="+qty+"&jumlah="+jumlah+"&diskon="+diskon;		
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
					<?php include 'barangmasukmenu.php'; ?>
				</div>
			</div>
		</div>		
		<div class="p-wrapper">
			<div id="p-main">
				<span id="infItem"></span>
			</div>
			<div class="head-tr">
				<p>TRANSAKSI NO :	<?php echo kode('dtbarangmasuk',$logid);?>	</p>		
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
