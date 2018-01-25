<script type="text/javascript" src="js/autocomplete.js"></script>		
<script>
	$(document).ready(function(){
		$.ajax({
			type:'post',
			url:'ajaxtemp.php',
			data:'req=viewOrderData&idt=<?php echo $_GET['idt']; ?>',
			cache :false,
			success:function (data){
				$('#infDetailOrder').html(data);	
			}
		});				
	});
	$(document).ready(function(){
		$.ajax({
			type:'post',
			url:'ajaxtemp.php',
			data:'req=viewDetailKirim&idt=<?php echo $_GET['idt']; ?>',
			cache :false,
			success:function (data){
				$('#infDetailKirim').html(data);	
			}
		});				
	});
	$(document).ready(function(){
		$("#barcode").change(function(){
			$.ajax({
				type:'post',
				url:'ajaxtemp.php',
				data:'req=getItemOut&idt=<?php echo $_GET['idt']; ?>&barcode='+$('#barcode').val(),
				cache :false,
				success:function (data){
					$('#infDetailOrder').html(data);	
				}
			});				
		});
	});
	function viewItem(id){
		$.ajax({
			type: 'POST',
			url: 'ajaxtemp.php',
			data: 'req=getItem&id='+id+'',
			success: function(res){
				$('#infItem'+id).fadeIn('slow').html(res);
			}
		});		
	}
	function viewHide(id){
		$('#infItem'+id).fadeOut('slow');
	}
	function orderHide(id){
		$('#orderID'+id).fadeOut('slow');
	}
	function addTemp(idt,id,kode,nama,harga,qty,diskon,keterangan){
		var jum;
		jumlah=parseInt(harga)*parseInt(qty);
		$.ajax({
			type:'post',
			url:'ajaxtemp.php',
			data:'req=addTemp&idt='+idt+'&id='+id+'&kode='+kode+'&nama='+nama+'&harga='+harga+'&qty='+qty+'&jumlah='+jumlah+'&diskon='+diskon+'&keterangan='+keterangan,
			cache :false,
			success:function (data){
				$('#infDetailKirim').html(data);	
			}
		});		
	}
	function editQty(idt,id){
		var qty=document.getElementById('qty'+id).value;
		var ket=document.getElementById('ket'+id).value;
		$.ajax({
			type: 'POST',
			url: 'ajaxtemp.php',
			data: 'req=editQtyOut&idt='+idt+'&id='+id+'&qty='+qty+'&ket='+ket+'',
			cache :false,
			success: function(res){
				$('#infDetailKirim').html(res);	
			}
		});		
	}
	function delTemp(idt,id){
		$.ajax({
			type: 'POST',
			url: 'ajaxtemp.php',
			data: 'req=delTempOut&id='+id,
			cache :false,
			success: function(res){
				$('#infDetailKirim').html(res);	
			}
		});		
	}
	function simpan(){
		var id=$('#id').val();
		var tanggal=$('#tanggal').val();
		var pemohon=$('#pemohon').text();
		$.ajax({
			type: 'POST',
			url: 'ajaxtemp.php',
			data: 'req=addOut&id='+id+'&tanggal='+tanggal+'&pemohon='+pemohon,
			cache :false,
			success: function(res){
				window.location="?p=<?php echo encrypt_url('dtorder'); ?>";
			}
		});				
	}
	function printOrder(id){
		var ord=null;
		if (ord==null){
			ord=open('print/tandaterima.php?id='+id,'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1100,height=1600');
		}
	}
</script>
<body>
		<div class="p-menu"><?php include "menu.php"; ?></div>
		<div class="p-head">
			<div class="p-head-c">
				<div id="right">
					<input type="text" name="barcode" id="barcode">
				</div>
				<div id="left">
					<?php include 'dtordermenu.php'; ?>
				</div>
			</div>
		</div>		
	<div class="p-wrapper">
		<div id="p-main" style="margin-top:-40px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<th colspan="5" align="center"><h3>FORM TRANSAKSI PENGELUARAN BARANG </h3></th>
			<tr>
				<td width="15%" style="border:none">No. Transaksi </td>
				<td width="21%" style="border:none"><input readonly="" type="text" name="id" id="id" value="<?php echo kode('dtbarangkeluar',$logid);?>"></td>
				<td width="21%" style="border:none">Tanggal</td>
				<td width="19%" style="border:none"><input type="text" class="tanggal" name="tanggal" id="tanggal" value="<?php echo $date->format('d-m-Y'); ?>"  onClick="return showCalendar('tanggal', 'dd-mm-y')"/></td>
				<td width="24%" style="border:none" align="right">
				  <input type="button" name="simpan" id="simpan" value="Simpan" onClick="simpan();">
				</td>
			</tr>
		  </table>
			<table width="100%" cellpadding="0" cellspacing="0">
				    <th align="left">Detail  Permintaan Barang : <span id="pemohon"><?php echo $_GET['idt']; ?></span></th>
				      <th align="right">&nbsp;</th>
				  <tr>
					<td style="border:none;" colspan="2" align="right"><span id="infDetailOrder"></span></td>
				</tr>
				  <th align="left">Detail  Pengadaan Barang</th>
				  <th>&nbsp;</th>
				<tr>
					<td style="border:none;" colspan="2"><span id="infDetailKirim"></span></td>
				</tr>
			</table>
		</div>
	</div>
</body>