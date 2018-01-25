<?php
if(isset($_GET['cari'])){
	$mtgl=$_GET['mtgl'];
	$htgl=$_GET['htgl'];
}else{
	$mtgl=$date->format('d-m-Y');;
	$htgl=$date->format('d-m-Y');;
}
?>
<script>
	function cetakrep(id){
		var repout=null;
		if (repout==null){
			repout=open('page/barang/barangkeluar_report_prn.php?mtgl='+$('#mtgl').val()+'&htgl='+$('#htgl').val(),'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1300,height=600');
		}
	}
	$(document).ready(function(){
		$('#cek').click(function(){
			window.location='<?php echo $link;?>&m=barangkeluarreport&cari&mtgl='+$('#mtgl').val()+'&htgl='+$('#htgl').val()+'';
		});
	});
	function viewDetail(id){
		$.ajax({
			type: 'POST',
			url: '<?php echo $barangkeluarprc;?>',
			data: 'req=getDetail&id='+id+'',
			success: function(res){
				$('#detail'+id).fadeIn('slow').html(res);
			}
		});		
	}
	function viewHide(id){
		$('#detail'+id).fadeOut('slow');
	}
	function prnOrder(id){
		var order=null;
		if (order==null){
			order=open('page/barang/barangkeluar_trx_prn.php?id='+id,'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=850,height=600');
		}
	}
</script>
<div class="p-wrapper">
	<div class="content">
		<div id="label-form">
			<li class="fa fa-file-text">   <label>LAPORAN BARANG KELUAR</label></li>
			<a href="<?php echo $link;?>"><li class="fa fa-times icon-small" style="float:right"></li></a>
		</div>
		<div class="c"></div>
		<div style="background:#ccc; padding:5px 5px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td width="6%"><label>Tanggal </label></td>
				<td width="17%">
				<input type="text" class="mtgl" name="mtgl" id="mtgl" value="<?php echo $mtgl;?>"  onClick="return showCalendar('mtgl', 'dd-mm-y')"/>
				</td>
			  <td width="2%" align="center"><label>s/d</label></td>
			  <td width="17%">
			  <input type="text" class="htgl" name="htgl" id="htgl" value="<?php echo $htgl; ?>"  onClick="return showCalendar('htgl', 'dd-mm-y')"/>
			  </td>
			  <td width="58%" align="left"><input type="button" name="cari" id="cek" value="Cek" />
			  </td>
			</tr>
		</table>
		</div>
<?php
$r=array('mtgl'=>tgl_ind_to_eng($mtgl),'htgl'=>tgl_ind_to_eng($htgl));
$data=$barangkeluar->getRekap($r,$s,$i);
if ($data!=array()){
	if($i=='0'){$i='1';}elseif($i=='1'){$i='0';}elseif($i==''){$i='0';}
?>
<style>
.btn{font-size:14px; color:#770000; font-weight:bold;}
.btn:hover{color:#FF0000;}
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
    <th width="3%" align="center">NO</th>
    <th width="15%" align="left" style="padding:7px 0 7px 10px;"><a href="<?php echo $link;?>&m=barangkeluarreport&cari&s=id&i=<?php echo $i;?>&mtgl=<?php echo $mtgl;?>&htgl=<?php echo $htgl;?>">NO. TRANSAKSI</a></th>
    <th width="19%" align="left" style="padding:7px 0 7px 10px;"><a href="<?php echo $link;?>&m=barangkeluarreport&cari&s=tanggal&i=<?php echo $i;?>&mtgl=<?php echo $mtgl;?>&htgl=<?php echo $htgl;?>">TANGGAL</a></th>
    <th width="56%" align="left" style="padding:7px 0 7px 10px;">PENGGUNA BARANG</th>
	<th width="7%">&nbsp;</th>
    <?php
	if ($data!=0){
		foreach($data as $row){	  	
	?>
	<tr onMouseOver="this.style.cursor='pointer';">
    <td width="3%" align="center"><?php echo $c=$c+1;?></td>
    <td onClick="viewDetail('<?php echo $row['id'];?>');" width="15%"><?php echo $row['id']; ?></td>
    <td onClick="viewDetail('<?php echo $row['id'];?>');" width="19%"><?php echo getTanggal($row['tanggal']); ?></td>
    <td onClick="viewDetail('<?php echo $row['id'];?>');" width="56%"><?php echo $pegawai->getField('bagian',$row['pemohon']); ?></td>
	<td align="right"><a onclick="prnOrder('<?php echo $row['id'];?>');"><li class="fa fa-print icon-small"></li></a></td>
  </tr>
  <tr>
  	<td style="border:none; padding:0; margin:0;">&nbsp;</td>
  	<td colspan="4" style="border:none; padding:0; margin:0;">
		<?php
			$id=$row['id'];
			$sql=$barangkeluar->getDetail($id);
			if($sql!=array()){
			?>
			<div class="pesan-detail"><b></b>
			<div id="conten-detail">
			<table width="99%" border="0" cellspacing="0" cellpadding="0" style="background:#DBDBDB; margin:5px;">
					<th width="5%">NO</th>
					<th width="13%" align="left">KODE</th>
					<th width="62%" align="left">NAMA BARANG </th>
					<th width="11%" align="center">JUMLAH</th>
					<th width="9%" align="left">SATUAN</th>
				    <?php
				foreach($sql as $row){	  	
				?>
				<tr onMouseOver="this.style.cursor='pointer';">
					<td width="5%" align="center"><?php echo $c=$c+1;?></td>
					<td width="13%" onClick="getDetail('<?php echo $row['idt'];?>','<?php echo $row['id'];?>','<?php echo $row['kode'];?>','<?php echo $row['nama'];?>','<?php echo $row['harga_beli'];?>','<?php echo $row['qty'];?>','<?php echo $row['jumlah'];?>','<?php echo $row['diskon'];?>');"><?php if($row['barcode']!=''){echo $row['barcode'];}else{echo $row['id'];};?></td>
					<td width="62%" onClick="getDetail('<?php echo $row['idt'];?>','<?php echo $row['id'];?>','<?php echo $row['kode'];?>','<?php echo $row['nama'];?>','<?php echo $row['harga_beli'];?>','<?php echo $row['qty'];?>','<?php echo $row['jumlah'];?>','<?php echo $row['diskon'];?>');"><?php echo $dtbarang->getField('nama',$row['id']); ?></td>
					<td width="11%" align="center" onClick="getDetail('<?php echo $row['idt'];?>','<?php echo $row['id'];?>','<?php echo $row['kode'];?>','<?php echo $row['nama'];?>','<?php echo $row['harga_beli'];?>','<?php echo $row['qty'];?>','<?php echo $row['jumlah'];?>','<?php echo $row['diskon'];?>');"><?php echo $row['qty']; ?></td>
					<td width="9%" onClick="getDetail('<?php echo $row['idt'];?>','<?php echo $row['id'];?>','<?php echo $row['kode'];?>','<?php echo $row['nama'];?>','<?php echo $row['harga_beli'];?>','<?php echo $row['qty'];?>','<?php echo $row['jumlah'];?>','<?php echo $row['diskon'];?>');">
						<?php echo $dtsatuan->getField('satuan',$dtbarang->getField('satuan',$row['id'])); ?>					</td>
				</tr>
				<?php
				}	  
				?>
			</table>
			</div>
		</div>
		<?php
		}
		?>
	</td>
  </tr>
	<?php
		}
	}	  
	?>
</table>
<?php
}else{ 
	echo "<p class='pesan'>Tidak ada transaksi.</p>"; 
}
?>
		<div class="head_content" style="box-shadow:none;" >&nbsp;
		<input type="button" name="cetak" id="cetak" value="Cetak" onClick="cetakrep();">
		<div style="clear:both;"></div>
</div>
</div>