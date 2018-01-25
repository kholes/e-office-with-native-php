<?php
include "class/dtbarang.cls.php";
$dtbarang=new Dtbarang();
$barcode=$_GET['barcode'];
if(isset($barcode)){
	$idb=$dtbarang->getCode('id',$barcode);
	if($idb!=''){
		$id=$idb;
		$act=$_GET['act'];
		$idt=$_GET['idt'];
		$dataid=array('idt'=>$idt,'id'=>$id);
		if(isset($act)){
			$harga_beli=$_GET['harga_beli'];
			$diskon=$_GET['diskon'];
			$qty=$_GET['qty'];
			$jumlah=$_GET['jumlah'];
			$detail='getDetailIn';
			$linkView='&act=upd';
		}else{
			$harga_beli=$dtbarang->getField('harga_beli',$id);
			$diskon='0';
			$qty='0';
			$jumlah='0';
			$detail='getTempIn';
			$linkView='';
		}
	}else{
		header("location:?p=".encrypt_url('barangmasuk')."");
	}
}else{
	$id=$_GET['id'];
	$act=$_GET['act'];
	$idt=$_GET['idt'];
	$dataid=array('idt'=>$idt,'id'=>$id);
	if(isset($act)){
		$harga_beli=$_GET['harga_beli'];
		$diskon=$_GET['diskon'];
		$qty=$_GET['qty'];
		$jumlah=$_GET['jumlah'];
		$detail='getDetailIn';
		$linkView='&act=upd';
	}else{
		$harga_beli=$_GET['harga_beli'];
		$diskon=$_GET['diskon'];
		$qty=$_GET['qty'];
		$jumlah=$_GET['jumlah'];
		$detail='getTempIn';
		$linkView='';
	}
}
?>
<script>
	$(document).ready(function(){ $('#harga_beli').focus(); });
	$(document).ready(function(){ 
		$('#batal').click(function(){
			self.history.back();
		});
	});
	$(document).ready(function(){
		$('#qty,#diskon').keydown(function(){
			var qty=parseInt($('#qty').val());
			var hrg=parseInt($('#harga_beli').val());
			var dis=parseInt($('#diskon').val());
			jum=((qty)*(hrg)-dis);
			$('#jumlah').val(jum);
		});
	});

	function btn(act){
		switch(act){
			case 'addItemupd':
				addItemUpd();
			break;
			case 'editItemupd':
				editItemUpd();
			break;
			case 'hapusItemupd':
				hapusItemUpd();			
			break;
			case 'addItem':
				addItem();
			break;
			case 'editItem':
				editItem();
			break;
			case 'hapusItem':
				hapusItem();			
			break;
		}
	}
	function addItemUpd(){
		$.ajax({
			type:'post',
			url:'ajaxtemp.php',
			data:'req=addItemUpd&idt=<?php echo $_GET['idt'];?>&id='+$('#id').val()+'&kode='+$('#kode').val()+'&nama='+$('#nama').val()+'&harga_beli='+$('#harga_beli').val()+'&qty='+$('#qty').val()+'&jumlah='+$('#jumlah').val()+'&diskon='+$('#diskon').val(),
			cache :false,
			success:function (data){
				window.location="?p=<?php echo encrypt_url('barangmasukdata'); ?>&act=detail&id=<?php echo $_GET['idt'];?>";
			}
		});		
	}
	function addItem(){
		$.ajax({
			type:'post',
			url:'ajaxtemp.php',
			data:'req=addItemIn&idt=<?php echo kode('dtbarangmasuk',$logid);?>&id='+$('#id').val()+'&kode='+$('#kode').val()+'&nama='+$('#nama').val()+'&harga_beli='+$('#harga_beli').val()+'&qty='+$('#qty').val()+'&jumlah='+$('#jumlah').val()+'&diskon='+$('#diskon').val(),
			cache :false,
			success:function (data){
				window.location="?p=<?php echo encrypt_url('barangmasuk'); ?>";
			}
		});	
	}
	function hapusItem(){
		$.ajax({
			type:'post',
			url:'ajaxtemp.php',
			data:'req=hapusItemIn&idt='+$('#idt').val()+'&id='+$('#id').val()+'&qty='+$('#qty').val(),
			cache :false,
			success:function (data){
				window.location="?p=<?php echo encrypt_url('barangmasuk'); ?>";
			}
		});			
	}
	function hapusItemUpd(){
		$.ajax({
			type:'post',
			url:'ajaxtemp.php',
			data:'req=hapusItemUpd&idt='+$('#idt').val()+'&id='+$('#id').val()+'&qty='+$('#qty').val(),
			cache :false,
			success:function (data){
				window.location="?p=<?php echo encrypt_url('barangmasukdata'); ?>&act=detail&id=<?php echo $_GET['idt'];?>";
			}
		});			
	}
	function getDetail(idt,id,kode,nama,harga_beli,qty,jumlah,diskon){
		window.location="?p=<?php echo encrypt_url('barangmasukcount');?><?php echo $linkView; ?>&idt="+idt+"&id="+id+"&kode="+kode+"&nama="+nama+"&harga_beli="+harga_beli+"&qty="+qty+"&jumlah="+jumlah+"&diskon="+diskon;		
	}
	function editItem(){
		$.ajax({
			type:'post',
			url:'ajaxtemp.php',
			data:'req=editItemIn&idt='+$('#idt').val()+'&id='+$('#id').val()+'&harga_beli='+$('#harga_beli').val()+'&qty='+$('#qty').val()+'&jumlah='+$('#jumlah').val()+'&diskon='+$('#diskon').val(),
			cache :false,
			success:function (data){
				window.location="?p=<?php echo encrypt_url('barangmasuk'); ?>";
			}
		});		
	}
	function editItemUpd(){
		$.ajax({
			type:'post',
			url:'ajaxtemp.php',
			data:'req=editItemUpd&idt='+$('#idt').val()+'&id='+$('#id').val()+'&harga_beli='+$('#harga_beli').val()+'&qty='+$('#qty').val()+'&jumlah='+$('#jumlah').val()+'&diskon='+$('#diskon').val(),
			cache :false,
			success:function (data){
				window.location="?p=<?php echo encrypt_url('barangmasukdata'); ?>&act=detail&id=<?php echo $_GET['idt'];?>";
			}
		});		
	}
	
		$(document).ready(function(){
			$.ajax({
				type: 'POST',
				url: 'ajaxtemp.php',
				data: 'req=<?php echo $detail; ?>&idt=<?php echo $_GET['idt']; ?>',
				cache: false,
				success: function(res){
					$('#infItem').html(res);
				}
			});		
		});

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
		</div>
			<form method="post">
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="14%" class="label">Kode Barang </td>
                  <td width="28%">
						<input type="hidden" name="id" id="id" value="<?php echo $dtbarang->getField('id',$id);?>" />
						<input type="hidden" name="idt" id="idt" value="<?php echo $_GET['idt'];?>" />				  
                 	    <input type="text" name="kode" id="kode" value="<?php echo $dtbarang->getField('barcode',$id);?>" readonly="" />				  </td>
                  <td width="13%">&nbsp;</td>
                  <td width="14%">Harga Beli </td>
                  <td width="31%" align="right"><input type="hidden" name="harga_jual" id="harga_jual" value="<?php echo $dtbarang->getField('harga_jual',$id);?>" />
                  <input type="text" name="harga_beli" id="harga_beli" value="<?php echo $harga_beli;?>" /></td>
                </tr>
                <tr>
                  <td>Nama Barang </td>
                  <td><input type="text" name="nama" id="nama" value="<?php echo $dtbarang->getField('nama',$id);?>" /></td>
                  <td>&nbsp;</td>
                  <td>Qty</td>
                  <td align="right"><input type="text" name="qty" id="qty" value="<?php echo $qty;?>" /></td>
                </tr>
                <tr>
                  <td>Diskon</td>
                  <td><input type="text" name="diskon" id="diskon" value="<?php echo $diskon;?>" /></td>
                  <td>&nbsp;</td>
                  <td>Jumlah</td>
                  <td align="right"><input type="text" name="jumlah" id="jumlah" value="<?php echo $jumlah;?>" /></td>
                </tr>
                <tr>
                  <td colspan="5">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="4"><input name="ubah" id="ubah" type="button" value="Ubah" onClick="btn('editItem<?php echo $act; ?>');" />                  
				  <input name="hapus" id="hapus" type="button" value="Hapus" onClick="btn('hapusItem<?php echo $act; ?>');" />                  </td>
				  <td align="right">
				  	<input name="tambah" id="tambah" type="button" value="Tambah" onClick="btn('addItem<?php echo $act; ?>');" />
				  	<input name="batal" id="batal" type="button" value="Batal" />				  </td>
                </tr>
              </table>
			</form>		
			<div id="p-main">
				<span id="infItem"></span>
			</div>
	</div>
</body>
<script>
	$('#harga_beli').keydown(function(e){
		if(e.keyCode==13){
			if($('#harga_beli').val()=="" | $('#harga_beli').val()=="0"){
				$('#harga_beli').focus();
			}else{
				$('#qty').focus();
			} 
		}
	});
	$('#qty').keydown(function(e){
		if(e.keyCode==13){
			if($('#qty').val()=="" | $('#qty').val()=="0"){
				$('#qty').focus();
			}else{

			} 
		}
	});
	$('#diskon').keydown(function(e){
		if(e.keyCode==13){
			var dis=parseInt($('#diskon').val());
			var jum=parseInt($('#jumlah').val());
			var gjum=(jum-dis);
			$('#jumlah').val(gjum);
		}
	});
</script>
