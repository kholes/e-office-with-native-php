<script>
	function cariData(){
		var key=document.getElementById('key').value;
		$.ajax({
			type:'post',
			url:'ajaxtemp.php',
			data:'req=caridataOut&key='+key+'',
			cache:false,
			success:function(data){
				$('#contentref').html(data);
			}
		});
	}
	$(document).ready(function(){
		$.ajax({
			type:'post',
			url:'ajaxtemp.php',
			data:'req=viewStokOut',
			cache:false,
			success:function(data){
				$('#contentref').html(data);
				$('#key').focus();
			}
		});
	});
	function sendData(id){
		var qty = prompt("Masukan Jumlah Barang", "1");
		if (qty != null) {
			$.ajax({
				type:'post',
				url:'ajaxtemp.php',
				data:'req=addItemOut&id='+id+'&qty='+qty,
				cache :false,
				success:function (data){
					window.location="?p=<?php echo encrypt_url('barangkeluar'); ?>";
				}
			});	
		}				
	}
</script>
	<body onLoad="viewData();">
		<div class="p-menu"><?php include "menu.php"; ?></div>
		<div class="p-head">
			<div class="p-head-c">
				<div id="right">Cari &raquo;
					<input type="text" class="cri" name="key" id="key" onKeyPress="cariData();">
			  </div>
				<div id="left">
					<?php include 'barangkeluarmenu.php'; ?>
				</div>
			</div>
		</div>		
	<div class="p-wrapper">
		<div id="p-main">
			<div id="contentref"></div>
		</div>	
	</div>
	</body>
	<script>
	function setfocus(){$('#key').focus();}
	document.onkeydown = function(e){setfocus();}
	</script>
