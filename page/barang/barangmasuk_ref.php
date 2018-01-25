<script>
	function cariData(){
		$.ajax({
			type:'post',
			url:'<?php echo $barangmasukprc;?>',
			data:'req=caridata&key='+$('#key').val()+'',
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
			window.location='<?php echo $link; ?>&m=barangmasukadd&id='+id;	
		}
	}
</script>
<div class="p-wrapper">
	<div class="content">
		<div id="label-form">
			<li class="fa fa-folder-open">   <label>DATA STOK BARANG</label></li>
			<a onclick="history.back();"><li class="fa fa-times icon-small" style="float:right"></li></a>
			<li style="float:right;"><input type="text" class="cri" name="key" id="key" onKeyPress="cariData();" style="width:200px;"></li>
		</div>
		<div class="c5"></div>
		<div id="contentref"></div>
	</div>	
</div>
<script>
	cariData();
	function setfocus(){$('#key').focus();}
	document.onkeydown = function(e){setfocus();}
</script>
