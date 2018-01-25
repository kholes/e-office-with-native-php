	<script>
		$(document).ready(function(){
			$("#simpan").click(function(){
				$.ajax({
					type: 'POST',
					url: '<?php echo $linkdata;?>',
					data: 'req=cekTemp',
					cache: false,
					success: function(data){
						if(data<1){
							alert('Item barang masih kosong.');return;
						}else{
							window.location="<?php echo $link;?>&m=fh";
						}
					}
				});					
			});
		});
		$(document).ready(function(){
			$("#batal").click(function(){
				$.ajax({
					type: 'POST',
					url: '<?php echo $linkdata;?>',
					data: 'req=clearTemp',
					cache: false,
					success: function(res){
						$('#infTemp').html(res);
						window.location="<?php echo $link;?>&m=fp";
					}
				});		
			});
		});
		$(document).ready(function(){
			$("#barcode").change(function(){
				$.ajax({
					type: 'POST',
					url: '<?php echo $linkdata;?>',
					data: 'req=cekStokOut&kode='+$("#barcode").val(),
					cache: false,
					success: function(res){
						cekStok(res);
					}
				});		
			});
		});
		function delTemp(idt,id){
				$.ajax({
					type: 'POST',
					url: '<?php echo $linkdata;?>',
					data: 'req=delTemp&idt='+idt+'&id='+id,
					cache: false,
					success: function(res){
						location.reload(); 
					}
				});		
		}
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
						url:'<?php echo $linkdata;?>',
						data:'req=addItemOut&kode='+kode+'&qty='+qty,
						cache :false,
						success:function (data){
							window.location="<?php  echo $link;?>&m=fbrgk";
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
				url: '<?php echo $linkdata;?>',
				data: 'req=getTemp',
				cache: false,
				success: function(res){
					$('#infItem').html(res);
				}
			});		
		});
		function upQty(idt,id){
			var qty = prompt("Masukan Jumlah Barang", "1");
			if (qty != null) {
				$.ajax({
					type:'post',
					url:'<?php echo $linkdata;?>',
					data:'req=updateQtyTemp&idt='+idt+'&id='+id+'&qty='+qty,
					cache :false,
					success:function (data){
						location.reload();
					}
				});	
			}				
		}
		function ref(){
			window.location='<?php echo $link;?>&m=ds';
		}
	</script>
<div class="p-wrapper">
	<div class="content">
		<div style="border-bottom:1px solid #ccc;"></div>
		<h3 id="label-form">
			<ul>
				<li><a>PENGAJUAN</a></li>
				<li class="active"><?php echo $val;?></li>
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
