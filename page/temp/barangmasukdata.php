<?php
$toko=$_GET['cari'];
if (isset($toko)){
	include "../lib/lib.php";
	$db=new Db();
	$db->conDb();
	$sql=mysql_query("SELECT id FROM dtbarangmasuk WHERE id LIKE '%$toko%' ORDER BY id");
	if($sql){
		while($row=mysql_fetch_row($sql)){
			echo $row[0]."\n";
		}
	}
}else{
	include "class/trxinput.cls.php";
	include "class/dttoko.cls.php";
	$trx=new Trxinput();
	$toko=new Dttoko();
	$id=$_GET['id'];
	$act=$_GET['act'];
?>
<script type="text/javascript" src="js/autocomplete.js"></script>		
<script>
	$(document).ready(function(){
		var act='<?php echo $act;?>';
		if(act=='detail'){getHeadDetail('<?php echo $id;?>');}else{getHeadData();}
	});	
	$(document).ready(function(){
		$("#suplayer").autocomplete("ajaxtemp.php", {
			selectFirst: true
		});
	});

	$(document).ready(function(){
		$('#id').keydown(function(){ 
			$.ajax({
				type: 'post',
				url: 'ajaxtemp.php',
				data: 'req=getHead&id='+$('#id').val(),
				cache: false,
				success: function(res){
					$('#inf-head').html(res);
				}
			});
		});
	});
	$(document).ready(function(){
		$.ajax({
			type: 'POST',
			url: 'ajaxtemp.php',
			data: 'req=getDetailIn&idt=<?php echo $_GET['id']; ?>',
			cache: false,
			success: function(res){
				$('#infItem').html(res);
			}
		});		
	});

	function updateTrx(){
		$.ajax({
			type: 'POST',
			url: 'ajaxtemp.php',
			data: 'req=updateTrx&id='+$('#id').val()+'&tanggal='+$('#tanggal').val()+'&nota='+$('#nota').val()+'&suplayer='+$('#suplayer').val()+'&total='+$('#total').val()+'&diskon='+$('#diskon').val()+'',
			cache: false,
			success: function(res){
				location.reload();
			}
		});					
	}
	function getHeadData(){
		$.ajax({
			type: 'POST',
			url: 'ajaxtemp.php',
			data: 'req=getHead&id='+$('#id').val(),
			cache: false,
			success: function(res){
				$('#inf-head').html(res);
			}
		});		
	}
	function getHeadDetail(id){
		$.ajax({
			type: 'POST',
			url: 'ajaxtemp.php',
			data: 'req=getDetailHead&id='+id,
			cache: false,
			success: function(res){
				$('#inf-head').html(res);
			}
		});				
	}
	function getHead(id){
		window.location='?p=<?php echo encrypt_url('barangmasukdata'); ?>&act=detail&id='+id;
	}
	function getDetail(idt,id,kode,nama,harga_beli,qty,jumlah,diskon){
		window.location="?p=<?php echo encrypt_url('barangmasukcount');?>&act=upd&idt="+idt+"&id="+id+"&kode="+kode+"&nama="+nama+"&harga_beli="+harga_beli+"&qty="+qty+"&jumlah="+jumlah+"&diskon="+diskon;		
	}
	function r(){
		window.location='?p=<?php echo encrypt_url('refrensi'); ?>&act=upd&idt=<?php echo $_GET['id'];?>';
	}	
	/*
	$(document).ready(function(){
		$("#id").autocomplete("page/barangmasukdata.php", {
			selectFirst: true
		});
	});
	*/
</script>

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
		</div>
			<form method="post" action="<?php echo $link; ?>" enctype="multipart/form-data">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="23%">NO. TRANSAKSI </td>
					<td width="19%" align="right"><input type="text" name="id" id="id" value="<?php echo $id; ?>"></td>
					<td width="11%">&nbsp;</td>
					<td width="23%">TOTAL BELANJA </td>
					<td width="24%" align="right"><input type="text" name="total" id="total" readonly="" align="right" value="<?php echo $trx->getTotal($id); ?>" ></td>
				  </tr>
				  <tr>
					<td>TANGGAL</td>
					<td align="right"><input type="text" class="tanggal" name="tanggal" id="tanggal"  onClick="return showCalendar('tanggal', 'dd-mm-y')"  value="<?php echo tgl_eng_to_ind($trx->getHeadField('tanggal',$id)); ?>"/></td>
					<td>&nbsp;</td>
					<td>DISKON</td>
					<td align="right"><input type="text" name="diskon" id="diskon" value="<?php echo $trx->getDiskon($id); ?>"></td>
				  </tr>
				  <tr>
					<td>NO.NOTA</td>
					<td align="right"><input type="text" name="nota" id="nota"  value="<?php echo $trx->getHeadField('nota',$id); ?>"></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">&nbsp;</td>
				  </tr>
				  <tr>
					<td>SUPLAYER</td>
					<td align="right"><input type="text" name="suplayer" id="suplayer" value="<?php echo $trx->getHeadField('suplayer',$id).'.'.$toko->getField('nama',$trx->getHeadField('suplayer',$id)); ?>"></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">					</td>
				  </tr>
				  <tr>
					<td colspan="4" align="left">&nbsp;
					</td>
					<td align="right">
					</td>
				  </tr>
				  <tr>
					<td colspan="4" align="left"><input type="button" name="ubah" id="ubah" value="Ubah" onClick="updateTrx();"></td>
					<td align="right">
						<input type="button" name="ref" id="ref" value="Tambah Barang" onClick="r();">
						<input name="batal" id="batal" type="button" value="Batal" onClick="self.history.back();" />					
					</td>
				  </tr>
				</table>
			</form>
			<div id="p-main">
				<span id="infItem"></span>
				<span id="inf-head"></span>
			</div>
	</div>
</body>
<?php
}
?>