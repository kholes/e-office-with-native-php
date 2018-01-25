<?php
if(isset($c)){$data=$dtbarang->getLike($c,$s,$i);}else{$data=$dtbarang->getAll($s,$i);}
if ($data!=array()){
if($i=='0'){$i='1';}elseif($i=='1'){$i='0';}elseif($i==''){$i='0';}
?>
<script>
function viewDetail(id){
	window.location='<?php echo $link;?>&m=barangform&act='+id;
}
</script>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>

<div class="p-wrapper">
	<div class="content">
		<div id="label-form">
			<li class="fa fa-book">   <label>DATA BARANG</label></li>
			<a href="<?php echo $link;?>"><li class="fa fa-times icon-small" style="float:right"></li></a>
		</div>
		<div class="c"></div>
		<form name="MyForm" method="post" action="page/barang/prnbarcode.php">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
				<th width="4%">NO</th>
				<th width="19%" align="left"><a href="<?php echo $link;?>&m=databarang&s=kategori&i=<?php echo $i;?>"> ID/</a><a href="<?php echo $link;?>&m=databarang&s=kategori&i=<?php echo $i;?>">KATEGORI</a></th>
				<th width="29%" align="left"><a href="<?php echo $link;?>&m=databarang&s=nama&i=<?php echo $i;?>">NAMA</a></th>
				<th width="16%" align="left"><a href="<?php echo $link;?>&m=databarang&s=merek&i=<?php echo $i;?>">MEREK</a></th>
				<th width="9%"><a href="<?php echo $link;?>&m=databarang&s=satuan&i=<?php echo $i;?>">SATUAN</a></th>
				<th width="8%" align="right"><a href="<?php echo $link;?>&m=databarang&s=satuan&i=<?php echo $i;?>">HARGA </a></th>
				<th width="5%">STOK</th>
				<th width="3%">&nbsp;</th>
				<th width="2%">&nbsp;</th>
				<th width="5%" align="left"><input type="checkbox" id="sel" onclick="cek();" /></th>
			</table>
			<div style="display:block; height:350px; overflow:auto; padding-bottom:5px;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
				<?php
				if ($data!=0){
					foreach($data as $row){	  	
				?>
				<tr style="border-bottom:1px solid #999" onMouseOver="this.style.color='red';cursor.poniter='normal';" onmouseout="this.style.color='#333';">
				<td width="2%" align="center"><?php echo $c=$c+1;?></td>
				<td width="21%" align="left"><?php echo $row['kategori']."/".$dtkategori->getField('kategori',$row['kategori']); ?></td>
				<td width="29%"><?php echo $row['nama']; ?></td>
				<td width="16%"><?php echo $dtmerek->getField('merek',$row['merek']); ?></td>
				<td width="9%" align="center"><?php echo $dtsatuan->getField('satuan',$row['satuan']); ?></td>
				<td width="9%" align="right"><?php echo format_angka($row['harga_beli']); ?></td>
				<td width="4%" align="center">
				  <span class="style1">
				  <?php 
				echo $barangmasuk->get_all_trx($row['id'])-$barangkeluar->get_all_trx($row['id']);
				?>
				  </span>				</td>
				<td width="3%" align="center">
					<a onclick="viewDetail('<?php echo $row['id'];?>');">
						<li class="fa fa-pencil-square-o icon-small"></li>
				  </a>				</td>
				<td width="3%" align="center">
					<a onclick="deleteItem('<?php echo $row['id'];?>');">
						<li class="fa fa-trash-o icon-small"></li>
				  </a>				</td>
				<td width="4%"><input type="checkbox" id="pilih[]" name="pilih[]" value="<?php echo $row['id'];?>" /></td>
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
		<input type="button" name="kembai" id="kembali" value="Kembali" style="float:right" onclick="history.back();">
		<div style="clear:both;"></div>
</div></div>