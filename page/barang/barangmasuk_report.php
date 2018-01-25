<script>
function cetakrepin(id){
	var repin=null;
	if (repin==null){
		repin=open('page/barang/barangmasuk_report_prn.php?mtgl='+$('#mtgl').val()+'&htgl='+$('#htgl').val(),'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1300,height=600');
	}
}
$(document).ready(function(){
	$('#cek').click(function(){
		window.location='<?php echo $link;?>&m=barangmasukreport&cari&mtgl='+$('#mtgl').val()+'&htgl='+$('#htgl').val()+'';
	});
	$('#detail'+id).hide();
});
function viewDetail(id){
	$.ajax({
		type: 'POST',
		url: '<?php echo $barangmasukprc;?>',
		data: 'req=getDetail&id='+id+'',
		success: function(res){
			$('#detail'+id).fadeIn('slow').html(res);
		}
	});		
}
function viewHide(id){
	$('#detail'+id).fadeOut('slow');
}
</script>
<?php
if(isset($_GET['cari'])){
	$mtgl=$_GET['mtgl'];
	$htgl=$_GET['htgl'];
}else{
	$mtgl=$date->format('d-m-Y');;
	$htgl=$date->format('d-m-Y');;
}
?>
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
				  <td width="7%"><label>Tanggal </label></td>
				  <td width="15%"><input type="text" class="mtgl" name="mtgl" id="mtgl" value="<?php echo $mtgl;?>"  onclick="return showCalendar('mtgl', 'dd-mm-y')"/></td>
				  <td width="4%" align="center"><label>s/d</label></td>
				  <td width="17%"><input type="text" class="htgl" name="htgl" id="htgl" value="<?php echo $htgl; ?>"  onclick="return showCalendar('htgl', 'dd-mm-y')"/></td>
				  <td width="57%" align="left"><input type="button" name="cari" id="cek" value="Cek" />
				  </td>
				</tr>
			</table>
		</div>
		<?php
		$r=array('mtgl'=>tgl_ind_to_eng($mtgl),'htgl'=>tgl_ind_to_eng($htgl));
		$data=$barangmasuk->getRekap($r,$s,$i);
		if ($data!=array()){
			if($i=='0'){$i='1';}elseif($i=='1'){$i='0';}elseif($i==''){$i='0';}
		?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
			<th width="14%" align="left"><a href="<?php echo $link;?>&m=barangmasukreport&cari&s=id&i=<?php echo $i;?>&mtgl=<?php echo $mtgl;?>&htgl=<?php echo $htgl;?>">NO. TRANSAKSI</a></th>
			<th width="9%" align="left"><a href="<?php echo $link;?>&m=barangmasukreport&cari&s=tanggal&i=<?php echo $i;?>&mtgl=<?php echo $mtgl;?>&htgl=<?php echo $htgl;?>">TANGGAL</a></th>
			<th width="11%" align="left"><a href="<?php echo $link;?>&m=barangmasukreport&cari&s=nota&i=<?php echo $i;?>&mtgl=<?php echo $mtgl;?>&htgl=<?php echo $htgl;?>">NO.NOTA</a></th>
			<th width="34%" align="left"><a href="<?php echo $link;?>&m=barangmasukreport&cari&s=suplayer&i=<?php echo $i;?>&mtgl=<?php echo $mtgl;?>&htgl=<?php echo $htgl;?>">TOKO / SUPLAYER</a></th>
			<th width="9%" align="center"><a href="<?php echo $link;?>&m=barangmasukreport&cari&s=total&i=<?php echo $i;?>&mtgl=<?php echo $mtgl;?>&htgl=<?php echo $htgl;?>">TOTAL (Rp) </a></th>
			<?php
			if ($data!=0){
				foreach($data as $row){	  	
			?>
			<tr onMouseOver="this.style.cursor='pointer';" onClick="viewDetail('<?php echo $row['id'];?>');">
			<td width="14%"><?php echo $row['id']; ?></td>
			<td width="9%"><?php echo getTanggal($row['tanggal']); ?></td>
			<td width="11%"><?php echo $row['nota']; ?></td>
			<td width="34%"><?php echo $toko->get_field('nama',$row['suplayer']); ?></td>
			<td width="9%" align="right"><?php echo format_angka($row['total']); ?></td>
		  </tr>
		  <tr>
			<td colspan="6" style="border:none; padding:0; margin:0;">
				<?php
				$id=$row['id'];
				$sql=$barangmasuk->getDetail($id);
				if($sql!=array($sql)){
				?>
				<div class="pesan-detail" style="margin-left:15px;"><b></b>
				<div id="conten-detail">
					<table width="99%" border="0" cellspacing="0" cellpadding="0" class="table" style="margin:auto">
						<th width="12%" align="left">Kode Barang</th>
						<th width="47%" align="left">Nama barang </th>
						<th width="12%" align="right">Harga beli </th>
						<th width="6%" align="center">Qty</th>
						<th width="8%" align="right">Diskon</th>
						<th width="12%" align="right">Jumlah</th>
					<?php
					foreach($sql as $row){	  	
					?>
					<tr onClick="getDetail('<?php echo $row['idt'];?>','<?php echo $row['id'];?>','<?php echo $row['kode'];?>','<?php echo $row['nama'];?>','<?php echo $row['harga_beli'];?>','<?php echo $row['qty'];?>','<?php echo $row['jumlah'];?>','<?php echo $row['diskon'];?>');">
						<td width="12%" style="vertical-align:middle"><?php echo $row['id']; ?></td>
						<td width="47%" style="vertical-align:middle"><?php echo $row['nama']; ?></td>
						<td width="12%" align="right" style="vertical-align:middle"><?php echo format_angka($row['harga_beli']); ?></td>
						<td width="6%" align="center" style="vertical-align:middle"><?php echo $row['qty']; ?></td>
						<td width="8%" align="right" style="vertical-align:middle"><?php echo format_angka($row['diskon']); ?></td>
						<td width="12%" align="right" style="vertical-align:middle"><?php echo format_angka($row['jumlah']); ?></td>
					</tr>
					<?php
					}	  
					?>
				</table>
				<?php
				}
				?>
			</td>
		  </tr>
			<?php
				}
			}	  
			?>
			<th colspan="4" align="center"><h3>Total</h3></th>
			<th align="right"><h3><?php echo format_angka($barangmasuk->getRekapTotal($r));?></h3></th>
		</table>
		<?php
		}
		?>
	<div class="head_content" style="box-shadow:none;" >&nbsp;
		<input type="button" name="cetak" id="cetak" value="Cetak" onClick="cetakrepin();">
		<div style="clear:both;"></div>
</div>
</div>