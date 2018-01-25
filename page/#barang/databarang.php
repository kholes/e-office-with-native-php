<?php
if(isset($c)){$data=$dtbarang->getLike($c,$s,$i);}else{$data=$dtbarang->getAll($s,$i);}
if ($data!=array()){
if($i=='0'){$i='1';}elseif($i=='1'){$i='0';}elseif($i==''){$i='0';}
?>
<script>
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
		<div class="c10"></div>
		<form name="MyForm" method="post" action="page/barang/prnbarcode.php">
			<div style="display:block; height:350px; overflow:auto; padding-bottom:5px;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
				<th width="3%">NO</th>
				<th width="6%" align="left"><a href="<?php echo $link;?>&m=dtbrg&s=barcode&i=<?php echo $i;?>">KODE</a></th>
				<th width="24%" align="left"><a href="<?php echo $link;?>&m=dtbrg&s=kategori&i=<?php echo $i;?>"> ID/</a><a href="<?php echo $link;?>&m=dtbrg&s=kategori&i=<?php echo $i;?>">KATEGORI</a></th>
				<th width="18%" align="left"><a href="<?php echo $link;?>&m=dtbrg&s=nama&i=<?php echo $i;?>">NAMA</a></th>
				<th width="13%" align="left"><a href="<?php echo $link;?>&m=dtbrg&s=merek&i=<?php echo $i;?>">MEREK</a></th>
				<th width="8%"><a href="<?php echo $link;?>&m=dtbrg&s=satuan&i=<?php echo $i;?>">SATUAN</a></th>
				<th width="8%" align="right"><a href="<?php echo $link;?>&m=dtbrg&s=satuan&i=<?php echo $i;?>">HARGA </a></th>
				<th width="5%" align="left"><a href="<?php echo $link;?>&m=dtbrg&s=stok&i=<?php echo $i;?>">STOK</a></th>
				<th width="4%" align="left"><a href="<?php echo $link;?>&m=dtbrg&s=minstok&i=<?php echo $i;?>">MIN</a></th>
				<th width="4%">&nbsp;</th>
				<th width="4%">&nbsp;</th>
				<th width="3%" align="left"><input type="checkbox" id="sel" onclick="cek();" /></th>
				<?php
				if ($data!=0){
					foreach($data as $row){	  	
				?>
				<tr onMouseOver="this.style.color='red';cursor.poniter='normal';" onmouseout="this.style.color='#333';">
				<td width="3%" align="center"><?php echo $c=$c+1;?></td>
				<td width="6%" align="left"><?php if($row['barcode']!=''){echo $row['barcode'];}else{echo $row['id'];};?></td>
				<td width="24%" align="left"><?php echo $row['kategori']."/".$dtkategori->getField('kategori',$row['kategori']); ?></td>
				<td width="18%"><?php echo $row['nama']; ?></td>
				<td width="13%"><?php echo $dtmerek->getField('merek',$row['merek']); ?></td>
				<td width="8%" align="left"><?php echo $dtsatuan->getField('satuan',$row['satuan']); ?></td>
				<td width="8%" align="right"><?php echo format_angka($row['harga_beli']); ?></td>
				<td width="5%" align="center"><?php echo $row['stok']; ?></td>
				<td width="4%" align="left"><?php echo $row['minstok']; ?></td>
				<td width="4%">
					<a onclick="viewDetail('<?php echo $row['id'];?>');"><img src="img/edit.png" title="Edit Form"  style="margin-bottom:-5px;"/></a>	</td>
				<td width="4%"><a onclick="deleteItem('<?php echo $row['id'];?>');"><img src="img/hapus.png" title="Hapus Data"  style="margin-bottom:-5px;"/></a></td>
				<td width="3%"><input type="checkbox" id="pilih[]" name="pilih[]" value="<?php echo $row['id'];?>" /></td>
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