<script>
	function cariData(){
		var key=document.getElementById('key').value;
		$.ajax({
			type:'post',
			url:'<?php echo $barangkeluarprc;?>',
			data:'req=caridata&key='+key+'',
			cache:false,
			success:function(data){
				$('#contentref').html(data);
			}
		});
	}
	function sendData(id){
		var stok=$('#stok'+id).val();
		if(stok<1){alert ("Stok barang kosong!");return;}
		var qty = prompt("Masukan Jumlah Barang", "1");
		if(parseInt(qty) >= parseInt(stok)){alert("Permintaan anda "+qty+", terlalu banyak, jumlah stok "+stok+" tidak cukup!");return;}
		if (qty != null) {
			$.ajax({
				type:'post',
				url:'<?php echo $barangkeluarprc;?>',
				data:'req=addItemOut&id='+id+'&qty='+qty,
				cache :false,
				success:function (data){
					window.location="<?php echo $link;?>&m=barangkeluarform";
				}
			});	
		}				
	}
</script>
<div class="p-wrapper">
	<div class="content">
		<div id="label-form">
			<li class="fa fa-folder-open">   <label>DATA BARANG</label></li>
			<a onclick="history.back();"><li class="fa fa-times icon-small" style="float:right"></li></a>
			<li style="float:right;"><input type="text" class="cri" name="key" id="key" onKeyPress="cariData();" style="width:200px;"></li>
		</div>
		<div class="c"></div>
		<div id="contentref"></div>
	</div>
</div>

<script>
	cariData();
	function setfocus(){$('#key').focus();}
	document.onkeydown = function(e){setfocus();}
</script>
