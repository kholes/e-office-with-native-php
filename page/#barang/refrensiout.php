<script>
	function cariData(){
		var key=document.getElementById('key').value;
		$.ajax({
			type:'post',
			url:'<?php echo $trxoutprc;?>',
			data:'req=caridata&key='+key+'',
			cache:false,
			success:function(data){
				$('#contentref').html(data);
			}
		});
	}
	$(document).ready(function(){
		$.ajax({
			type:'post',
			url:'<?php echo $trxoutprc;?>',
			data:'req=viewStokOut',
			cache:false,
			success:function(data){
				$('#contentref').html(data);
				$('#key').focus();
			}
		});
		$('#key').keypress(function(){
			cariData();
		});
		$('#key').keyup(function(){
			cariData();
		});
	});
	function sendData(id){
		var qty = prompt("Masukan Jumlah Barang", "1");
		if (qty != null) {
			$.ajax({
				type:'post',
				url:'<?php echo $trxoutprc;?>',
				data:'req=addItemOut&id='+id+'&qty='+qty,
				cache :false,
				success:function (data){
					window.location="<?php echo $link;?>&m=fbrgk";
				}
			});	
		}				
	}
</script>
<div class="p-wrapper">
	<div class="content">
		<div style="border-bottom:1px solid #ccc;"></div>
		<h3 id="label-form">
			<ul>
				<li><a>DATA STOK BARANG</a></li>
				<li class="active"><?php echo $val;?></li>
			</ul>
		</h3>
		<div class="c10"></div>
		<div style="background:#ccc; padding:5px 5px;">
			<input type="button" name="key" value="Cari" onclick="cariData();">
			<input type="text" class="cri" name="key" id="key" onKeyPress="cariData();" style="width:200px;">
		</div>
		<div class="c10"></div>
		<div id="contentref" style="display:block; height:300px; overflow:auto;"></div>
		<div class="head_content" style="box-shadow:none;" >&nbsp;
		<input type="button" name="kembai" id="kembali" value="Kembali" style="float:right" onclick="history.back();">
		<div style="clear:both;"></div>
	</div>
</div>

<script>
	function setfocus(){$('#key').focus();}
	document.onkeydown = function(e){setfocus();}
</script>
