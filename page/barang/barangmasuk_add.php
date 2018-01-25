<?php
$barcode=$_GET['barcode'];
$act=$_GET['act'];
if(isset($barcode)){
	$idb=$dtbarang->getCode('id',$barcode);
	if($idb!=''){
		$id=$idb;
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
			$qty='1';
			$jumlah='0';
			$detail='getTempIn';
			$linkView='';
		}
	}else{
		header("location:$link&m=barangmasukform");
	}
}
if(isset($_GET['id'])){
	$id=$_GET['id'];
	if(isset($act)){
		$harga_beli=$_GET['harga_beli'];
		$diskon=$_GET['diskon'];
		$qty=$_GET['qty'];
		$jumlah=$_GET['jumlah'];
	}else{
		$harga_beli=$dtbarang->getField('harga_beli',$id);
		$diskon='0';
		$qty='1';
		$jumlah='0';
	}
}
?>
<script type="text/javascript" src="js/my.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
<script>
$(document).ready(function(){
	$('#qty').focus();
});
var harga=$('#harga_beli').val().replace(/\./g, '');
var jumlah=$('#jumlah').val().replace(/\./g, '');
var diskon=$('#diskon').val().replace(/\./g, '');

function updTemp(){
	$.ajax({
		type:'post',
		url:'<?php echo $barangmasukprc;?>',
		data:'req=updTemp&idt='+$('#idt').val()+'&id='+$('#id').val()+'&harga_beli='+harga+'&qty='+qty+'&jumlah='+jumlah+'&diskon='+diskon,
		cache :false,
		success:function (data){
			window.location="<?php echo $link; ?>&m=barangmasukform";
		}
	});		
}
function addTemp(){
	$.ajax({
		type:'post',
		url:'<?php echo $barangmasukprc;?>',
		data:'req=addTemp&idt='+$('#idt').val()+'&id='+$('#id').val()+'&kode='+$('#kode').val()+'&nama='+$('#nama').val()+'&harga_beli='+harga+'&qty='+$('#qty').val()+'&jumlah='+jumlah+'&diskon='+diskon,
		cache :false,
		success:function (data){
			window.location="<?php echo $link; ?>&m=barangmasukform";
		}
	});	
}
function delTemp(){
	$.ajax({
		type:'post',
		url:'<?php echo $barangmasukprc;?>',
		data:'req=delTemp&idt='+$('#idt').val()+'&id='+$('#id').val(),
		cache :false,
		success:function (data){
			window.location="<?php echo $link; ?>&m=barangmasukform";
		}
	});	
}
</script>
<div class="p-wrapper">
	<div class="content">
		<div id="label-form">
			<a onclick="history.back();"><li class="fa fa-undo icon-small" style="float:right"></li></a>
			<li class="fa fa-plus">   <label>TAMBAH BARANG</label></li>
		</div>
		<div class="c"></div>
		<div style="background:#ccc; padding:5px 5px 0px 5px;">
		<form method="post">
		<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-left:15px;">
			<tr>
				<td width="14%"><label>Kode Barang</label></td>
				<td width="28%">
					<input type="hidden" name="id" id="id" value="<?php echo $dtbarang->getField('id',$id);?>" />
									  
					<input type="text" name="kode" id="kode" class="pasif" value="<?php echo $dtbarang->getField('barcode',$id);?>" readonly="" />				</td>
				<td width="13%">&nbsp;</td>
				<td width="14%"><label>Nama Barang</label></td>
				<td width="31%" align="right">
					<input type="text" name="nama" id="nama" value="<?php echo $dtbarang->getField('nama',$id);?>" class="pasif" readonly="" />
					<input type="hidden" name="harga_jual" id="harga_jual" value="<?php echo $dtbarang->getField('harga_jual',$id);?>" />				</td>
				<td>&nbsp;</td>
			</tr>
                <tr>
                <td><label>Harga Beli </label></td>
                <td><input type="text" name="harga_beli" id="harga_beli" value="<?php echo $harga_beli;?>" /></td>
                <td>&nbsp;</td>
                <td><label>Qty</label></td>
            	<td align="right"><input type="text" name="qty" id="qty" value="<?php echo $qty;?>" /></td>
				<td>
                <input name="tambah" id="tambah2" type="button" value="Tambah" onclick="addTemp();" />
                </td>
            </tr>
			<tr>
                <td><label>Diskon</label></td>
                <td><input type="text" name="diskon" id="diskon" value="<?php echo $diskon;?>" /></td>
                <td>&nbsp;</td>
                <td><label>Jumlah</label></td>
                <td align="right"><input type="text" name="jumlah" id="jumlah" readonly="" style=" text-align:right; border:none; background:none;font-size:18px; font-weight:bold; color:#D70000;" />
				  <input type="hidden" id="idt" value="<?php echo kode('dtbarangmasuk',$logid);?>">				</td>
				<td>&nbsp;</td>
        	</tr>
  		</table>
		</form>	
		</div>
		<div class="head_content" style="box-shadow:none;" >
		  <input name="ubah" id="tambah" type="button" value="Ubah" onClick="updTemp();" />
		  <input name="hapus" id="hapus" type="button" value="Hapus" onClick="delTemp();" />
		</div>	
</div>
</div>

<script>
$('#diskon, #qty, #harga_beli').keypress(function(e){
	var e=window.event || e
	var keyunicode=e.charCode || e.keyCode
	return (keyunicode>=48 && keyunicode<=57 || keyunicode==8 || keyunicode==46)? true:false
});
// memformat angka ribuan
function formatAngka(angka) {
 if (typeof(angka) != 'string') angka = angka.toString();
 var reg = new RegExp('([0-9]+)([0-9]{3})');
 while(reg.test(angka)) angka = angka.replace(reg, '$1.$2');
 return angka;
}
var harga = <?php echo $harga_beli;?>,
diskon=<?php echo $diskon;?>,
qty = <?php echo $qty;?>,
jumlah = <?php echo $jumlah;?>;
jumlah = qty * harga - diskon;
$('#jumlah').val(formatAngka(jumlah));
$('#harga_beli').val(formatAngka(harga));


$('#qty').val(formatAngka(qty));
$('#qty').keypress(function(e){ 
	var c = e.keyCode || e.charCode;
});
$('#qty').keyup(function(e){ 
	var jum = $(this).val();
	qty = new Number(jum);
	jumlah = qty * harga - diskon;
	$('#jumlah').val(formatAngka(jumlah));
});


$('#harga_beli').keypress(function(e){
	var c = e.keyCode || e.charCode; 
	switch (c) {  
		case 8: case 9: case 27: case 13: return; case 65: if (e.ctrlKey === true) return; 
	} 
	if (c < 48 || c > 57) e.preventDefault();
});
$('#harga_beli').keyup(function(){ 
	var hrg = $(this).val().replace(/\./g, '');
	harga = new Number(hrg);
	$(this).val(formatAngka(hrg));
	jumlah = qty * harga - diskon;
	$('#jumlah').val(formatAngka(jumlah));
});
$('#diskon').val(formatAngka(diskon));
$('#diskon').keypress(function(e) { 
	var c = e.keyCode || e.charCode; 
	switch (c) {  
		case 8: case 9: case 27: case 13: return; case 65: if (e.ctrlKey === true) return; 
	} 
	if (c < 48 || c > 57) e.preventDefault();
});
$('#diskon').keyup(function() { 
	var dis = $(this).val().replace(/\./g, '');
	diskon = new Number(dis);
	$(this).val(formatAngka(dis));
	jumlah = qty * harga - diskon;
	$('#jumlah').val(formatAngka(jumlah));
 // set kembalian, validasi
});
</script>