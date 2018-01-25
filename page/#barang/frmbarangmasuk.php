	<script type="text/javascript" src="js/autocomplete.js"></script>		
	<script>
		$(document).ready(function(){
			setfocus();
			$("#simpan").click(function(){
				$.ajax({
					type: 'POST',
					url: '<?php echo $trxinprc;?>',
					data: 'req=cekTemp',
					cache: false,
					success: function(data){
						if(data<1){
							alert('Item barang masih kosong.');return;
						}else{
							window.location="<?php echo $link;?>&m=ftrxin";
						}
					}
				});					
			});
		});
		$(document).ready(function(){
			$("#batal").click(function(){
				$.ajax({
					type: 'POST',
					url: '<?php echo $trxinprc;?>',
					data: 'req=clearTemp',
					cache: false,
					success: function(res){
						$('#infItem').html(res);
						window.location="<?php echo $link;?>&m=fbrgm";
					}
				});		
			});
		});
		$(document).ready(function(){
			$("#barcode").change(function(){
				window.location='<?php echo $link;?>&m=fcon&barcode='+$("#barcode").val()+'';	
			});
		});
		$(document).ready(function(){
			$.ajax({
				type: 'POST',
				url: '<?php echo $trxinprc;?>',
				data: 'req=getTemp',
				cache: false,
				success: function(res){
					$('#infItem').html(res);
				}
			});		
		});
		function getDetail(idt,id,kode,nama,harga_beli,qty,jumlah,diskon){
			window.location="<?php echo $link;?>&act=upd&m=fcon&idt="+idt+"&id="+id+"&kode="+kode+"&nama="+nama+"&harga_beli="+harga_beli+"&qty="+qty+"&jumlah="+jumlah+"&diskon="+diskon;		
		}
		function ref(){
			window.location='<?php echo $link;?>&m=dtrefin';
		}
	</script>
<div class="p-wrapper">
	<div class="content">
		<div style="border-bottom:1px solid #ccc;"></div>
		<h3 id="label-form">
			<ul>
				<li><a>TRANSAKSI</a></li>
				<li class="active">BELANJA BARANG</li>
			</ul>
		</h3>
		<div class="c10"></div>
	  <div style="background:#ccc; padding:5px 5px;">
			<input type="button" name="ref" value="Cari" onclick="ref();">
			<input type="text" name="barcode" id="barcode" style="width:200px;">
		</div>
		<div id="infItem"></div>
		<div class="head_content" style="box-shadow:none;" >
			<input type="button" name="simpan" id="simpan" value="Simpan">
			<input type="button" name="batal" id="batal" value="Batal">
		</div>	
	</div>
</div>
<script>
		function setfocus(){$('#barcode').focus();}
		document.onkeydown = function(e){setfocus();}
</script>
