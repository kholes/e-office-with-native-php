<script>
	function cariData(){
		var key=document.getElementById('key').value;
		$.ajax({
			type:'post',
			url:'ajaxtemp.php',
			data:'req=caridata&key='+key+'',
			cache:false,
			success:function(data){
				$('#contentref').html(data);
			}
		});
	}
	function viewData(){
		$.ajax({
			type:'post',
			url:'ajaxtemp.php',
			data:'req=viewdata',
			cache:false,
			success:function(data){
				$('#contentref').html(data);
				$('#key').focus();
			}
		});
	}
	function sendData(id){
		var act='<?php echo $_GET['act']; ?>';
		if (act=='upd'){
			window.location='?p=<?php echo encrypt_url('barangmasukcount'); ?>&act=upd&idt=<?php echo $_GET['idt']; ?>&id='+id;						
		}else{
			window.location='?p=<?php echo encrypt_url('barangmasukcount'); ?>&id='+id;	
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
					<?php include 'barangmasukmenu.php'; ?>
				</div>
			</div>
		</div>		
	<div class="p-wrapper">
		<div class="head-tr">
			TRANSAKSI NO :	<?php echo kode('dtbarangmasuk',$logid);?>			
		</div>
			<div id="p-main">
				<div class="c"></div>
				<div id="contentref"></div>
			</div>	
			<div id="p-status">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="15%"></td>
					<td width="17%"><div class="total"></div></td>
					 <td width="12%" align="right" colspan="3">
					 <a href="?p=<?php echo encrypt_url('dtbarang');?>">TAMBAH DATA BARANG</a>
					 </td>
				  </tr>
				</table>
			</div>
		</div>
	</body>
	<script>
	function setfocus(){$('#key').focus();}
	document.onkeydown = function(e){setfocus();}
	</script>
