	<script>
		$(document).ready(function(){
			setfocus();
			$("#simpan").click(function(){
				window.location="<?php echo $link;?>&m=barangkeluartrx";
			});
		});
		$(document).ready(function(){
			$("#batal").click(function(){
				$.ajax({
					type: 'POST',
					url: '<?php echo $barangkeluarprc;?>',
					data: 'req=clearTempOut',
					cache: false,
					success: function(res){
						$('#infItem').html(res);
						window.location="<?php echo $link;?>";
					}
				});		
			});
		});
		$(document).ready(function(){
			$("#barcode").change(function(){
				$.ajax({
					type: 'POST',
					url: '<?php echo $barangkeluarprc;?>',
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
		$(document).ready(function(){
			$.ajax({
				type: 'POST',
				url: '<?php echo $barangkeluarprc;?>',
				data: 'req=getTempOut',
				cache: false,
				success: function(res){
					$('#infItem').html(res);
				}
			});		
		});
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
						url:'<?php echo $barangkeluarprc;?>',
						data:'req=addItemOut&kode='+kode+'&qty='+qty,
						cache :false,
						success:function (data){
							window.location="<?php  echo $link;?>&m=barangkeluarform";
						}
					});
				}
			}else{
				$("#barcode").val('');
				return;
			}	
		}
		function delTemp(idt,id){
				$.ajax({
					type: 'POST',
					url: '<?php echo $barangkeluarprc;?>',
					data: 'req=delTemp&idt='+idt+'&id='+id,
					cache: false,
					success: function(res){
						location.reload(); 
					}
				});		
		}
		function upQty(id){
			var qty = prompt("Masukan Jumlah Barang", "1");
			if (qty != null) {
				$.ajax({
					type:'post',
					url:'<?php echo $barangkeluarprc;?>',
					data:'req=upQtyOut&id='+id+'&qty='+qty,
					cache :false,
					success:function (data){
						window.location="<?php echo $link; ?>&m=barangkeluarform";
					}
				});	
			}				
		}
	function ref(){
		window.location='<?php echo $link;?>&m=barangkeluarref';
	}
</script>	
<div class="p-wrapper">
	<div class="content">
		<div id="label-form">
			<li class="fa fa-folder">   <a onclick="ref();">TAMBAH DATA BARANG</a></li>
			<a id="batal"><li class="fa fa-times icon-small" style="float:right"></li></a>
			<li style="float:right;">
				<input type="text" name="barcode" id="barcode" style="width:200px;">
			</li>
		</div>
		<div class="c"></div>
		<div id="infItem" style="min-height:50px;"></div>
	  <div class="head_content" style="box-shadow:none;" >
			<input type="button" name="simpan" id="simpan" value="Simpan">
		</div>
	</div>
</div>
<script>
	function setfocus(){$('#barcode').focus();}
	document.onkeydown = function(e){setfocus();}
</script>
