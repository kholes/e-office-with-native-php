<script>
	$(document).ready(function(){ 
		$('#nota').focus();
	});
	$(document).ready(function(){
		$.ajax({
			type: 'POST',
			url: 'ajaxtemp.php',
			data: 'req=getHead',
			cache: false,
			success: function(res){
				$('#inf-head').html(res);
			}
		});		
	});
	$(document).ready(function(){
		$("#suplayer").autocomplete("page/barang/srcsuplayer.php", {
			selectFirst: true
		});
	});
$(document).ready(function(){
	$("#simpan").click(function(){
		if($('#nota').val()==''){alert("No.Nota tidak boleh kosong"); $('#nota').focus();return;}
		$.ajax({
			type: 'POST',
			url: '<?php echo $barangmasukprc;?>',
			data: 'req=trxHead&id='+$("#id").val()+'&tanggal='+$('#tanggal').val()+'&nota='+$('#nota').val()+'&suplayer='+$('#suplayer').val()+'&diskon='+$('#diskon').val()+'&total='+$('#total').val(),
			cache: false,
			success: function(res){
				window.location="<?php echo $link;?>&m=barangmasukform";
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
				window.location="<?php echo $link;?>&m=fbrgm";
			}
		});		
	});
});
		function getDetail(idt,id,kode,nama,harga_beli,qty,jumlah,diskon){
			window.location="<?php echo $link;?>&act=upd&m=barangmasukadd&idt="+idt+"&id="+id+"&kode="+kode+"&nama="+nama+"&harga_beli="+harga_beli+"&qty="+qty+"&jumlah="+jumlah+"&diskon="+diskon;		
		}
	function editData(){
		if($('#nota').val()==''){alert("No.Nota tidak boleh kosong"); $('#nota').focus();return;}
		$.ajax({
			type: 'POST',
			url: 'ajaxtemp.php',
			data: 'req=trxHeadEdit&id='+$("#id").val()+'&tanggal='+$('#tanggal').val()+'&nota='+$('#nota').val()+'&suplayer='+$('#suplayer').val()+'&diskon='+$('#diskon').val(),
			cache: false,
			success: function(res){
				window.location="?p=<?php echo encrypt_url('barangmasuk'); ?>";
			}
		});
	}
	function getHead(id,tanggal,nota,suplayer,diskon){
		$('#id').val(id);$('#tanggal').val(tanggal);$('#nota').val(nota);$('#suplayer').val(suplayer);$('#diskon').val(diskon);
		$('#btn').val("Edit");
	}
		$(document).ready(function(){
			$.ajax({
				type: 'POST',
				url: '<?php echo $barangmasukprc;?>',
				data: 'req=getTemp',
				cache: false,
				success: function(res){
					$('#infItem').html(res);
				}
			});		
		});
		function addTrx(){
			$.ajax({
				type: 'POST',
				url: 'ajaxtemp.php',
				data: 'req=addTrxDetail&idt=<?php echo $trx; ?>',
				cache: false,
				success: function(res){
					window.location='?p=<?php echo encrypt_url('barangmasuk'); ?>';	
					clearPage();
				}
			});					
		}
		function clearPage(){
			$.ajax({
				type: 'POST',
				url: 'ajaxtemp.php',
				data: 'req=clearTemp',
				cache: false,
				success: function(res){
					window.location="?p=<?php echo encrypt_url('barangmasuk'); ?>";			
					$('#infItem').html(res);
				}
			});				
		}

</script>
<div class="p-wrapper">
	<div class="content">
		<div id="label-form">
			<li class="fa fa-pencil-square-o">   <label>TRANSAKSI BELANJA BARANG </label></li>
			<a onclick="history.back();"><li class="fa fa-undo icon-small" style="float:right"></li></a>
		</div>
		<div class="c"></div>
		<form method="post" action="<?php echo $link; ?>" enctype="multipart/form-data">
		<div style="background:#ccc; padding:0 5px;">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" id="thick-tbl">
				  <tr>
					<td width="15%">NO.NOTA</td>
					<td width="35%" align="left"><input type="text" name="nota" id="nota">
				    <input type="hidden" name="total" id="total" value="<?php echo $barangmasuk->getTotalTemp();?>"></td>
					<td width="2%">&nbsp;</td>
					<td width="22%">NO. TRANSAKSI </td>
					<td width="26%" align="left"><input type="text" name="id" id="id" value="<?php echo kode('dtbarangmasuk',$logid);?>" readonly=""></td>
				  </tr>
				  <tr>
					<td>TOKO / SUPLAYER</td>
					<td align="left"><input type="text" name="suplayer" id="suplayer"></td>
					<td>&nbsp;</td>
					<td>TANGGAL</td>
					<td align="left"><input type="text" class="tanggal" name="tanggal" id="tanggal" value="<?php echo $date->format('d-m-Y'); ?>"  onClick="return showCalendar('tanggal', 'dd-mm-y')"/></td>
				  </tr>
				</table>
				</div>
			</form>
		<div class="c10"></div>
		<div id="infItem"></div>
		<div class="head_content" style="box-shadow:none;" >
		<input type="button" name="simpan" id="simpan" value="Simpan">
	  </div>	
</div>
</div>
<script>
	$('#id').click(function(){$('#nota').focus();});
	$('#tanggal').click(function(){$('#nota').focus();});
	$('#nota').change(function(){$('#suplayer').focus();});
	$('#nota').keydown(function(e){
		if(e.keyCode==13){
			if($('#nota').val()==""){
				$('#nota').focus();
			}else{
				$('#suplayer').focus();
			} 
		}
	});
	$('#suplayer').keydown(function(e){
		if(e.keyCode==13){
			if($('#suplayer').val()==""){
				$('#suplayer').focus();
			}else{
				$('#simpan').focus();
			} 
		}
	});
</script>