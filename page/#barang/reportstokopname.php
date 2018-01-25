<?php
if(isset($_GET['cari'])){
	$mtgl=$_GET['mtgl'];
	$htgl=$_GET['htgl'];
}else{
	$mtgl=$date->format('d-m-Y');;
	$htgl=$date->format('d-m-Y');;
}
$r=array('mtgl'=>tgl_ind_to_eng($mtgl),'htgl'=>tgl_ind_to_eng($htgl));
$data=$dtbarang->getStokopname($r,$s,$i);
?>
<script>
$(document).ready(function(){
	$('#cek').click(function(){
		window.location='<?php echo $link;?>&m=rsto&cari&mtgl='+$('#mtgl').val()+'&htgl='+$('#htgl').val()+'';
	});
});
function viewDetail(id){
	window.location='<?php echo $link;?>&m=fbrg&act='+id;
}
</script>
<div class="p-wrapper">
	<div class="content">
		<div style="border-bottom:1px solid #ccc;"></div>
		<h3 id="label-form">
			<ul>
				<li><a>DATA BARANG</a></li>
				<li class="active"><?php echo $val;?></li>
			</ul>
		</h3>
		<div class="c5"></div>
		<div style="background:#ccc; padding:5px 5px;">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td width="7%"><label>Tanggal </label></td>
			  <td width="17%"><input type="text" class="mtgl" name="mtgl" id="mtgl" value="<?php echo $mtgl;?>"  onclick="return showCalendar('mtgl', 'dd-mm-y')"/></td>
			  <td width="2%"><label>s/d</label></td>
			  <td width="17%"><input type="text" class="htgl" name="htgl" id="htgl" value="<?php echo $htgl; ?>"  onclick="return showCalendar('htgl', 'dd-mm-y')"/></td>
			  <td width="57%" align="left"><input type="button" name="cari" id="cek" value="Cek" /></td>
			</tr>
		  </table>
	</div>
<?php
if ($data!=array()){
	if($i=='0'){$i='1';}elseif($i=='1'){$i='0';}elseif($i==''){$i='0';}
?>

		<form name="MyForm" method="post" action="page/barang/prnbarcode.php">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
				<th width="4%">NO</th>
				<th width="24%" align="left"><a href="<?php echo $link;?>&m=dtbrg&s=nama&i=<?php echo $i;?>">NAMA</a></th>
				<th width="7%"><a href="<?php echo $link;?>&m=dtbrg&s=satuan&i=<?php echo $i;?>">SATUAN</a></th>
				<th width="5%" align="left"><a href="<?php echo $link;?>&m=dtbrg&s=stok&i=<?php echo $i;?>">STOK</a></th>
			</table>
			<div style="display:block; height:350px; overflow:auto; padding-bottom:5px;">
			<table>
				<?php
				if ($data!=0){
					foreach($data as $row){	  	
					?>
						<tr onMouseOver="this.style.color='#ff0000';this.style.cursor='pointer';" onmouseout="this.style.color='#000';">
							<td width="4%" align="center"><?php echo $c=$c+1;?></td>
							<td width="24%"><?php echo $row['nama']; ?></td>
							<td width="7%" align="center"><?php echo $dtsatuan->getField('satuan',$row['satuan']); ?></td>
							<td width="5%" align="center"><?php echo $row['stok']; ?></td>
						</tr>
					<?php
					}
				}	  
				?>
			</table>
			</div>
		</form>
<?php
}else{ 
	echo "<p class='pesan'>Data barang tidak ditemukan.</p>"; 
}
?>
		<div class="head_content" style="box-shadow:none;" >&nbsp;
		<input type="button" name="cetak" id="cetak" value="Cetak" onClick="prev_barang('<?php echo $_GET['s'];?>','<?php echo $_GET['i'];?>');">
		<input type="button" name="kembai" id="kembali" value="Kembali" style="float:right" onclick="history.back();">
		<div style="clear:both;"></div>
	</div>
</div>
