<script>
	$(document).ready(function(){
		$.ajax({
			type:'post',
			url:'<?php echo $trxinprc;?>',
			data:'req=viewdata',
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
	function cariData(){
		var key=document.getElementById('key').value;
		$.ajax({
			type:'post',
			url:'<?php echo $trxinprc;?>',
			data:'req=caridata&key='+key+'',
			cache:false,
			success:function(data){
				$('#contentref').html(data);
			}
		});
	}
	function sendData(id){
		var act='<?php echo $_GET['act']; ?>';
		if (act=='upd'){
			window.location='<?php echo $link; ?>&m=fcount&idt=<?php echo $_GET['idt']; ?>&id='+id;						
		}else{
			window.location='<?php echo $link; ?>&m=fcon&id='+id;	
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
</div>
<script>
	function setfocus(){$('#key').focus();}
	document.onkeydown = function(e){setfocus();}
</script>
