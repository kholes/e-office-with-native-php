	<script type="text/javascript" src="js/autocomplete.js"></script>		
	<script>
		$(document).ready(function(){
			setfocus();
			$("#simpan").click(function(){
				$.ajax({
					type: 'POST',
					url: '<?php echo $barangmasukprc;?>',
					data: 'req=cekTemp',
					cache: false,
					success: function(data){
						if(data<1){
							alert('Item barang masih kosong.');return;
						}else{
							window.location="<?php echo $link;?>&m=barangmasuktrx";
						}
					}
				});					
			});
			$("#batal").click(function(){
				$.ajax({
					type: 'POST',
					url: '<?php echo $barangmasukprc;?>',
					data: 'req=clearTemp',
					cache: false,
					success: function(res){
						$('#infItem').html(res);
						window.location="<?php echo $link;?>";
					}
				});		
			});
			$("#barcode").change(function(){
				window.location='<?php echo $link;?>&m=barangmasukadd&barcode='+$("#barcode").val()+'';	
			});
		});
		function get_temp(){
			$.ajax({
				type: 'POST',
				url: '<?php echo $barangmasukprc;?>',
				data: 'req=getTemp',
				cache: false,
				success: function(res){
					$('#infItem').html(res);
				}
			});		
		}
		function getDetail(idt,id,kode,nama,harga_beli,qty,jumlah,diskon){
			window.location="<?php echo $link;?>&act=upd&m=barangmasukadd&idt="+idt+"&id="+id+"&kode="+kode+"&nama="+nama+"&harga_beli="+harga_beli+"&qty="+qty+"&jumlah="+jumlah+"&diskon="+diskon;		
		}
		function ref(){
			window.location='<?php echo $link;?>&m=barangmasukref';
		}
		get_temp();
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
