<script type="text/javascript" src="js/autocomplete.js"></script>		
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
		$("#suplayer").autocomplete("ajaxtemp.php", {
			selectFirst: true
		});
	});
	function getDetail(idt,id,kode,nama,harga_beli,qty,jumlah,diskon){
		window.location="?p=<?php echo encrypt_url('barangmasukcount');?>&idt="+idt+"&id="+id+"&kode="+kode+"&nama="+nama+"&harga_beli="+harga_beli+"&qty="+qty+"&jumlah="+jumlah+"&diskon="+diskon;		
	}
	$(document).ready(function(){
		$("#simpan").click(function(){
			if($('#nota').val()==''){alert("No.Nota tidak boleh kosong"); $('#nota').focus();return;}
			$.ajax({
				type: 'POST',
				url: 'ajaxtemp.php',
				data: 'req=trxHead&id='+$("#id").val()+'&tanggal='+$('#tanggal').val()+'&nota='+$('#nota').val()+'&suplayer='+$('#suplayer').val()+'&diskon='+$('#diskon').val()+'&total='+$('#total').val(),
				cache: false,
				success: function(res){
					clearPage();
				}
			});
		});
	});
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
				url: 'ajaxtemp.php',
				data: 'req=getTempIn&id=<?php echo $trx; ?>',
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
<?php
include "class/trxinput.cls.php";
$trx=new Trxinput();
?>
<body>
	<div class="p-menu"><?php include "menu.php"; ?></div>
		<div class="p-head">
			<div class="p-head-c">
				<div id="right">
					Input barcode &raquo;
					<input type="text" name="barcode" id="barcode">
				</div>
				<div id="left">
					<?php include 'barangmasukmenu.php'; ?>
				</div>
			</div>
		</div>		
	<div class="p-wrapper">
		<div class="head-tr">
			TRANSAKSI NO :	<?php echo kode('dtbarangmasuk',$logid);?>			
				<div style="float:right;">				
				<input type="button" name="simpan" id="simpan" value="Simpan">
				<input type="button" name="batal" id="batal" value="Batal">
				</div>	
				<div class="c"></div>	
		</div>
			<form method="post" action="<?php echo $link; ?>" enctype="multipart/form-data">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="23%">NO. TRANSAKSI </td>
					<td width="19%" align="right">
					<input type="text" name="id" id="id" value="<?php echo kode('dtbarangmasuk',$logid);?>" readonly="">					</td>
					<td width="11%">&nbsp;</td>
					<td width="23%">JUMLAH BELANJA </td>
					<td width="24%" align="right"><input type="text" name="total" id="total" readonly="" align="right" value="<?php echo $trx->tempTotal(); ?>" ></td>
				  </tr>
				  <tr>
					<td>TANGGAL</td>
					<td align="right"><input type="text" class="tanggal" name="tanggal" id="tanggal" value="<?php echo $date->format('d-m-Y'); ?>"  onClick="return showCalendar('tanggal', 'dd-mm-y')"/></td>
					<td>&nbsp;</td>
					<td>DISKON</td>
					<td align="right"><input type="text" name="diskon" id="diskon" value="<?php echo $trx->tempDiskon(); ?>"></td>
				  </tr>
				  <tr>
					<td>NO.NOTA</td>
					<td align="right"><input type="text" name="nota" id="nota"></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">&nbsp;</td>
				  </tr>
				  <tr>
					<td>TOKO / SUPLAYER</td>
					<td align="right"><input type="text" name="suplayer" id="suplayer"></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">&nbsp;</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td align="right">&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">&nbsp;</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td align="right">&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">&nbsp;</td>
				  </tr>
				</table>
			</form>
			<div id="p-main">
				<span id="infItem"></span>
			</div>
	</div>
</body>
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