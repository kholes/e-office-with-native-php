
<?php
//$th = "#94C3A5";   // warna abu-abu
$warnaGenap = "#D2EFDD";   // warna abu-abu
$warnaGanjil = "#ECF9F1";  // warna putih
function viewStok($sql){
	include "class/dtsatuan.cls.php";
	$sat=new Dtsatuan();
	if($sql!=array()){
	?>	
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<th width="143" align="left">Kode Barang</th>
			<th width="367" align="left">Nama Barang</th>
			<th width="139">Satuan</th>
			<th width="102">Jumlah Stok </th>
			<th width="81">Pengajuan</th>
			<th width="74">Diterima</th>
			<th width="77">Diproses</th>
			<?php 
			foreach ($sql as $row){
			?>
		  <tr>
			<td><?php echo $row['barcode'];?></td>
			<td><?php echo $row['nama'];?></td>
			<td align="center"><?php echo $sat->getField('satuan',$row['satuan']);?></td>
			<td align="center"><?php echo $row['stok'];?></td>
			<td align="center">
			<?php 
				$sqs=mysql_query("select sum(dtpermohonanitem.qty) as qty from dtpermohonan, dtpermohonanitem where dtpermohonan.id=dtpermohonanitem.idt and dtpermohonan.status='pesan' and dtpermohonanitem.id='{$row['id']}'");
				$rst=mysql_fetch_row($sqs);
				if($rst[0]>0){
					echo $rst[0];
				}else{
					echo '0';
				}
			?>
			</td>
			<td align="center">
			<?php 
				$sqs=mysql_query("select sum(dtpermohonanitem.qty) as qty from dtpermohonan, dtpermohonanitem where dtpermohonan.id=dtpermohonanitem.idt and dtpermohonan.status='terima' and dtpermohonanitem.id='{$row['id']}'");
				$rst=mysql_fetch_row($sqs);
				if($rst[0]>0){
					echo $rst[0];
				}else{
					echo '0';
				}
			?>
			</td>
			<td align="center"><?php 
				$sqs=mysql_query("select sum(dtpermohonanitem.qty) as qty from dtpermohonan, dtpermohonanitem where dtpermohonan.id=dtpermohonanitem.idt and dtpermohonan.status='kirim' and dtpermohonanitem.id='{$row['id']}'");
				$rst=mysql_fetch_row($sqs);
				if($rst[0]>0){
					echo $rst[0];
				}else{
					echo '0';
				}
			?></td>
		  </tr>
		<?php
		}
		?>
	</table>
<?php
	}else{
		echo "<p class='pesan'>Data barang tidak ada dalam daftar.</p>";
	}
}
?>
<?php
function viewOrder($sql){
	include "class/pegawai.cls.php";
	include "class/jabatan.cls.php";
	$peg=new Pegawai();
	$jab=new Jabatan();
	$user=new User();
	$warnaGenap = "#D2EFDD";   // warna abu-abu
	$warnaGanjil = "#ECF9F1";  // warna putih

	if($sql==array()){
		echo "<p class='pesan'>Belum ada pengajuan barang.</p>";
	}else{
	?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<th width="26%" align="left">TANGGAL PENGAJUAN </th>
				<th width="24%" align="left">NAMA PEMOHON </th>
				<th width="25%" align="left">NIP</th>
				<th width="25%" align="left">JABATAN</th>
			<?php
			foreach ($sql as $row){
			?>
			<tr onMouseOver="this.style.color='#666';this.style.cursor='pointer';" onClick="viewItem('<?php echo $row['id'];?>');" class="sub" id="orderID<?php echo $row['id'];?>" onmouseout="this.style.color='#000';">
				<td width="26%" style="padding:5px;"><?php echo getTanggal($row['tgl_prmohonan']);?></td>
				<td width="24%" style="padding:5px;"><?php echo $peg->getField('nama',$row['pemohon']);?></td>
				<td width="25%" style="padding:5px;"><?php echo $peg->getField('nip',$row['pemohon']);?></td>
				<td width="25%" style="padding:5px;"><?php echo $jab->getField('jabatan',$user->getField('level',$row['pemohon']));?></td>
			</tr>
			<tr>
				<td colspan="6" align="left" style="border:none;">
					<span id="infItem<?php echo $row['id'];?>"></span>
					<span id="infEdit<?php echo $row['id'];?>"></span>
					<span id="load<?php echo $row['id'];?>"></span>
				</td>
			</tr>
			<?php $counter ++; } ?>
		</table>
	<?php
	}
}
function viewOrderProses($sts,$sql){
	include "class/pegawai.cls.php";
	include "class/jabatan.cls.php";
	$peg=new Pegawai();
	$jab=new Jabatan();
	$user=new User();
	$warnaGenap = "#D2EFDD";   // warna abu-abu
	$warnaGanjil = "#ECF9F1";  // warna putih

	if($sql==array()){
		echo "<p class='pesan'>Belum ada pengajuan barang.</p>";
	}else{
	?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <th width="10%" align="left">NO. PENGAJUAN </th>
				    <th width="16%" align="left">TANGGAL PENGAJUAN </th>
				<th width="18%" align="left">TANGGAL PENGESAHAN </th>
				<th width="26%" align="left">NAMA PEMOHON</th>
				<th width="5%" align="left">NIP</th>
				<th width="18%" align="left">JABATAN</th>
				<th width="7%" align="left">STATUS</th>
			<?php
			foreach ($sql as $row){
			?>
			<tr onMouseOver="this.style.color='#666';this.style.cursor='pointer';" onClick="viewItem('<?php echo $row['id'];?>');" class="sub" id="orderID<?php echo $row['id'];?>" onmouseout="this.style.color='#000';">
				<td width="10%" style="padding:5px;"><?php echo $row['id'];?></td>
				<td width="16%" style="padding:5px;"><?php echo getTanggal($row['tgl_prmohonan']);?></td>
				<td width="18%" style="padding:5px;"><?php echo getTanggal($row['tgl_terima']);?></td>
				<td width="26%" style="padding:5px;"><?php echo $peg->getField('nama',$row['pemohon']);?></td>
				<td width="5%" style="padding:5px;"><?php echo $peg->getField('nip',$row['pemohon']);?></td>
				<td width="18%" style="padding:5px;"><?php echo $jab->getField('jabatan',$user->getField('level',$row['pemohon']));?></td>
			  <td width="7%" style="padding:5px;"><p class="sts"><?php echo $row['status'];?></p></td>
			</tr>
			<tr>
				<td colspan="6" align="left" style="border:none;">
					<span id="infItem<?php echo $row['id'];?>"></span>
					<span id="infEdit<?php echo $row['id'];?>"></span>
					<span id="load<?php echo $row['id'];?>"></span>
				</td>
			</tr>
			<?php $counter ++; } ?>
		</table>
	<?php
	}
}
function viewPrcOrder($sql){
	include "class/pegawai.cls.php";
	include "class/jabatan.cls.php";
	$peg=new Pegawai();
	$jab=new Jabatan();
	$user=new User();
	$warnaGenap = "#D2EFDD";   // warna abu-abu
	$warnaGanjil = "#ECF9F1";  // warna putih
	if($sql==array()){
		echo "<p class='pesan'>Data order kosong.</p>";
	}else{
		foreach($sql as $sts)
		switch($sts['status']){
			case 'terima':
				$bgc='#666';
			break;
			case 'proses':
				$bgc='#F93706';
			break;
			case 'kirim':
				$bgc='#ccc';
			break;
		}
	?>
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr bgcolor="<?php echo $bgc;?>">
				<td width="13%" align="left">NO.PENGAJUAN</td>
				<td width="18%" align="left">TGL.PENGAJUAN</td>
				<td width="21%" align="left">NAMA / PEMOHON</td>
				<td width="5%" align="left">NIP</td>
				<td width="8%" align="left">JABATAN</td>
				<td width="15%" align="left">TGL.PENGESAHAN</td>
				<td width="20%" align="left">OLEH</td>
			</tr>
		<?php
		foreach ($sql as $row){
		?>
			<tr onMouseOver="this.style.color='#666';this.style.cursor='pointer';" onClick="viewItem('<?php echo $row['id'];?>');" class="sub" id="orderID<?php echo $row['id'];?>" onmouseout="this.style.color='#000';">
			<td width="13%" style="padding:5px;"><?php echo $row['id'];?></td>
			<td width="18%" style="padding:5px;"><?php echo getTanggal($row['tgl_prmohonan']);?></td>
			<td width="21%"><?php echo $peg->getField('nama',$row['pemohon']);?></td>
			<td width="5%"><?php echo $peg->getField('nip',$row['pemohon']);?></td>
			<td width="8%"><?php echo $jab->getField('jabatan',$user->getField('level',$row['pemohon']));?></td>
			<td width="15%" style="padding:5px;"><?php echo getTanggal($row['tgl_terima']);?></td>
			<td width="20%"><?php echo $peg->getField('nama',$row['pengesahan']).'<br>'.$jab->getField('jabatan',$peg->getField('jabatan',$row['pengesahan']));?></td>
		</tr>
		<tr>
			<td colspan="7" align="left" style="border:none;">
				<span id="infItem<?php echo $row['id'];?>"></span>
				<span id="infEdit<?php echo $row['id'];?>"></span>
				<span id="load<?php echo $row['id'];?>"></span>
			</td>
		</tr>
		<?php $counter ++; } ?>
	</table>
	<?php
	}
}
function viewPrcOrderKrm($sql){
	include "class/pegawai.cls.php";
	include "class/jabatan.cls.php";
	$peg=new Pegawai();
	$jab=new Jabatan();
	$user=new User();
	$warnaGenap = "#D2EFDD";   // warna abu-abu
	$warnaGanjil = "#ECF9F1";  // warna putih
	if($sql==array()){
		echo "<p class='pesan'>Data order kosong.</p>";
	}else{
		foreach($sql as $sts)
		switch($sts['status']){
			case 'terima':
				$bgc='#666';
			break;
			case 'proses':
				$bgc='#F93706';
			break;
			case 'kirim':
				$bgc='#ccc';
			break;
		}
	?>
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr bgcolor="<?php echo $bgc;?>">
				<td width="13%" align="left">NO.PENGAJUAN</td>
				<td width="18%" align="left">TGL.PENGAJUAN</td>
				<td width="21%" align="left">NAMA / PEMOHON</td>
				<td width="5%" align="left">NIP</td>
				<td width="8%" align="left">JABATAN</td>
				<td width="15%" align="left">TGL.PENGESAHAN</td>
				<td width="20%" align="left">OLEH</td>
			</tr>
		<?php
		foreach ($sql as $row){
		?>
			<tr onMouseOver="this.style.color='#666';this.style.cursor='pointer';" class="sub" id="orderID<?php echo $row['id'];?>" onmouseout="this.style.color='#000';">
			<td width="13%" style="padding:5px;"><?php echo $row['id'];?></td>
			<td width="18%" style="padding:5px;"><?php echo getTanggal($row['tgl_prmohonan']);?></td>
			<td width="21%"><?php echo $peg->getField('nama',$row['pemohon']);?></td>
			<td width="5%"><?php echo $peg->getField('nip',$row['pemohon']);?></td>
			<td width="8%"><?php echo $jab->getField('jabatan',$user->getField('level',$row['pemohon']));?></td>
			<td width="15%" style="padding:5px;"><?php echo getTanggal($row['tgl_terima']);?></td>
			<td width="20%"><?php echo $peg->getField('nama',$row['pengesahan']).'<br>'.$jab->getField('jabatan',$peg->getField('jabatan',$row['pengesahan']));?></td>
		</tr>
		<tr>
			<td colspan="7" align="left" style="border:none;">
				<span id="infItem<?php echo $row['id'];?>"></span>
				<span id="infEdit<?php echo $row['id'];?>"></span>
				<span id="load<?php echo $row['id'];?>"></span>
			</td>
		</tr>
		<?php $counter ++; } ?>
	</table>
	<?php
	}
}
function viewDetailReq($sql,$id){
	include "class/dtsatuan.cls.php";
	include "class/pegawai.cls.php";
	include "class/jabatan.cls.php";
	$brg=new Dtbarang();
	$sat=new Dtsatuan();
	$req=new Permohonan();
	$peg=new Pegawai();
	if($sql!=array()){
	?>
		<div class="sub-head"><h3 id="close"><a onclick="viewHide('<?php echo $id; ?>');">X</a></h3><h3 id="judul">DETAIL PENGAJUAN BARANG OLEH : <?php echo $peg->getField('nama',$req->getPemohon('pemohon',$id));?></h3><div class="c"></div></div>		
		<div class='sub-detail'>		
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<th width="490">Nama Barang </th>
			<th width="168">Jumlah Permintaan </th>
			<th width="73" align="center">Satuan</th>
			<th width="220" align="left">Keterangan</th>
			<th>&nbsp;</th>
				<?php
				foreach($sql as $row){	  	
				?>
				<tr>
					<td width="490"><?php echo $row['nama']; ?></td>
			  	  	<td width="168" >
				  	<input type="text" size="4" value="<?php echo $row['qty']; ?>" id="qty<?php echo $row['idt'].$row['id']; ?>"/>
			  	  </td>
					<td align="center">
					<?php echo $sat->getField('satuan',$brg->getField('satuan',$row['id'])); ?>
					</td>
					<td width="220">
						<input type="text" id="ket<?php echo $row['idt'].$row['id']; ?>" value="<?php echo $row['keterangan']; ?>" />
		  	  	  </td>
					<td width="32" align="right"><a onclick="editQty('<?php echo $row['idt']; ?>','<?php echo $row['id']; ?>');">Edit</a></td>
				</tr>
				<?php
				}	  
				?>
			</table>
			</div>
			<input type="button" onClick="approveOreder('<?php echo $id; ?>');" value="terima" align="right" />
	<?php
	}
}

function viewItem($sql){
	if($sql!=array()){
	?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<th width="3%">No</th>
				<th width="12%" align="left">Kode</th>
				<th width="41%" align="left">Nama barang </th>
				<th width="12%" align="right">Harga beli </th>
				<th width="6%" align="center">Qty</th>
				<th width="14%" align="right">Jumlah</th>
				<th width="12%" align="right">Diskon</th>
				<?php
					foreach($sql as $row){	  	
				?>
		<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="getDetail('<?php echo $row['idt'];?>','<?php echo $row['id'];?>','<?php echo $row['kode'];?>','<?php echo $row['nama'];?>','<?php echo $row['harga_beli'];?>','<?php echo $row['qty'];?>','<?php echo $row['jumlah'];?>','<?php echo $row['diskon'];?>');" onMouseOut="this.style.background='#fff';">
			<td width="3%" align="center"><?php echo $c=$c+1;?></td>
			<td width="12%"><?php echo $row['kode']; ?></td>
			<td width="41%"><?php echo $row['nama']; ?></td>
			<td width="12%" align="right"><?php echo format_angka($row['harga_beli']); ?></td>
			<td width="6%" align="center"><?php echo $row['qty']; ?></td>
			<td width="14%" align="right"><?php echo format_angka($row['jumlah']); ?></td>
			<td width="12%" align="right"><?php echo format_angka($row['diskon']); ?></td>
		</tr>
		<?php
		}	  
		?>
	</table>
	<?php
	}else{
		echo "<p class='pesan'></p>";
	}
}
function viewItemOut($sql){
	if($sql!=array()){
	?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" id="tbl">
				<th width="3%">No</th>
				<th width="12%" align="left">Kode</th>
				<th width="41%" align="left">Nama barang </th>
				<th width="12%" align="right">Harga beli </th>
				<th width="6%" align="center">Qty</th>
				<th width="14%" align="right">Jumlah</th>
				<th width="12%" align="right">Diskon</th>
				<?php
					foreach($sql as $row){	  	
				?>
		<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="upQty('<?php echo $row['id'];?>');" onMouseOut="this.style.background='#fff';">
			<td width="3%" align="center"><?php echo $c=$c+1;?></td>
			<td width="12%"><?php echo $row['kode']; ?></td>
			<td width="41%"><?php echo $row['nama']; ?></td>
			<td width="12%" align="right"><?php echo format_angka($row['harga_beli']); ?></td>
			<td width="6%" align="center"><?php echo $row['qty']; ?></td>
			<td width="14%" align="right"><?php echo format_angka($row['jumlah']); ?></td>
			<td width="12%" align="right"><?php echo format_angka($row['diskon']); ?></td>
		</tr>
		<?php
		}	  
		?>
	</table>
	<?php
	}else{
		echo "<p class='pesan'></p>";
	}
}
function viewItemReq($sql){
	if($sql!=array()){
	?>
	<div class="head">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">  
			<th width="4%">NO</th>
			<th width="28%" align="left">KODE BARANG </th>
			<th width="60%" align="left">NAMA BARANG </th>
			<th width="8%" align="center">JUMLAH</th>
		</table>	
	</div>
	<div class="data">
		<table width="100%" cellpadding="0" cellspacing="0">
			<?php
			foreach($sql as $row){	  	
			?>
			<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="getIdt('<?php echo $row['idt'];?>','<?php echo $row['id'];?>','<?php echo $row['kode'];?>','<?php echo $row['nama'];?>','<?php echo $row['qty'];?>');" onMouseOut="this.style.background='#fff';">
				<td width="4%" align="center"><?php echo $c=$c+1;?></td>
				<td width="28%"><?php echo $row['kode']; ?></td>
				<td width="60%"><?php echo $row['nama']; ?></td>
				<td width="8%" align="center"><?php echo $row['qty']; ?></td>
			</tr>
			<?php
			}	  
			?>
		</table>
	</div>
	<?php
	}
}
function cariBarang($sql){
	include "class/dtmerek.cls.php";
	include "class/dtsatuan.cls.php";
	$merek=new Dtmerek();
	$satuan=new Dtsatuan();
	if($sql!=array()){
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<th width="16%" align="left">KODE BARANG</th>
		<th width="19%" align="left">NAMA BARANG</th>
		<th width="26%" align="left">MEREK</th>
		<th width="25%" align="left">JUMLAH STOK</th>
		<th width="14%" align="center">SATUAN</th>
			<?php
			foreach($sql as $row){
			?>
		<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="sendData('<?php echo $row['id'];?>');"  onMouseOut="this.style.background='#fff';">

				<td width="30%"><?php echo $row['barcode'];?></td>
				<td width="30%"><?php echo $row['nama'];?></td>
				<td width="17%"><?php echo $merek->getField('merek',$row['merek']);?></td>
				<td width="12%" align="center"><?php echo $row['stok'];?></td>
				<td width="18%" align="center"><?php echo $satuan->getField('satuan',$row['satuan']);?></td>
	  </tr>
			<?php
			}
			?>
</table>
			<?php

	}else{
		echo "<p class='pesan'>Data tidak ditemukan...</p>";
	}
}
function viewHistory($sql){
	if ($sql!=array()){
	?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <th width="4%">NO</th>
		  <th width="17%" align="left">TANGGAL</th>
		  <th width="18%" align="left">JENIS</th>
		  <th width="17%" align="left">SPAREPART</th>
		  <th width="14%" align="right">HARGA</th>
		  <th width="10%" align="left">STATUS</th>
		  <th width="20%">&nbsp;</th>
	  <?php
	  	foreach($sql as $row){	  	
	  ?>
	  <tr bgcolor="<?php echo $warna; ?>">
		<td width="4%" align="center"><?php echo $c=$c+1;?></td>
		<td width="17%"><?php echo $row['tanggal']; ?></td>
		<td width="18%"><?php echo $row['jenis']; ?></td>
		<td width="17%" align="left"><?php echo $row['sparepart']; ?></td>
		<td width="14%" align="right"><?php echo $row['harga']; ?></td>
		<td width="10%"><?php echo $row['status']; ?></td>
		<td width="20%" align="right"><a class="edit" href="?p=<?php echo encrypt_url('asettetaphis'); ?>&ide=<?php echo $row['id'];?>"><img src="img/edit.png" /></a><a onClick="hapus('<?php echo $row['id'];?>');"><img src="img/hapus.png" /></a>		</td>
	  </tr>
	  <?php
	  	}
	  ?>
	</table>
	<?php
	}else{
		echo "<p class='pesan'>Belum ada catatan perubahan..</p>";
	}
}
function viewHead($sql){
	include "class/dttoko.cls.php";
	$toko=new Dttoko();
	if($sql==array()){
		echo "<p class='pesan'>Data masih kosong.</p>";
	}else{
?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<th width="13%" align="left">NO.TRANSAKSI</td>
		<th width="17%" align="left">TANGGAL</td>
		<th width="22%" align="left">NO.NOTA / INVOICE</td>
		<th width="27%" align="left">TOKO / SUPPLAYER</td>
		<th width="8%" align="right">DISKON</td>
		<th width="13%" align="right">TOTAL</td>
	  <?php
	  foreach($sql as $row){
	  ?>
		<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="getHead('<?php echo $row['id'];?>');" onMouseOut="this.style.background='#fff';">
		<td><?php echo $row['id'];?></td>
		<td><?php echo getTanggal($row['tanggal']);?></td>
		<td><?php echo $row['nota'];?></td>
		<td><?php echo $toko->getField('nama',$row['suplayer']);?></td>
		<td align="right"><?php echo format_angka($row['diskon']);?></td>
		<td align="right"><?php echo format_angka($row['total']);?></td>
	  </tr>
	  <?php
	  }
	  ?>
	</table>
<?php
	}
}
function viewTempPermohonan($sql){
	if($sql!=array()){
	?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<th width="18%" align="left">KODE BARANG 
				</td>			</th>
			<th width="44%" align="left">NAMA
				</td>			</th>
			<th width="6%" align="center">JUMLAH</th>
			<th width="32%" align="left">&nbsp;</th>
			<?php
			foreach($sql as $row){
			?>
		  <tr onmouseover="this.style.background='#ccc';this.style.cursor='pointer';" onclick="getHead('<?php echo $row['id'];?>');" onmouseout="this.style.background='#fff';">
			<td><?php echo $row['barcode'];?></td>
			<td><?php echo $row['nama'];?></td>
			<td><input type="text" size="2" class="qty" name="qty" id="qty<?php echo $row['id'];?>" value="<?php echo $row['qty'];?>" onchange="upQty('<?php echo $row['id'];?>');" style="border:none; text-align:center;" /></td>
			<td>&nbsp;</td>
		  </tr>
		  <?php
			  }
			  ?>
		</table>	
	<?php
	}else{
		echo "<p class='pesan'>Data barang masih kosong.</p>";
	}
}
function viewDataPermohonan($sql){
	include "class/jabatan.cls.php";
	$jab=new Jabatan();
	if($sql!=array()){
	?>
	<table width="100%" cellpadding="0" cellspacing="0">
		<th align="left">TGL.PENGAJUAN</th>
		<th align="left">TUJUAN</th>
		<th align="center">STATUS</th>
		<th align="left">TGL.PENGESAHAN</th>
      <?php
			foreach ($sql as $row){
			?>
      <tr onmouseover="this.style.color='#666';this.style.cursor='pointer';" onclick="viewItem('<?php echo $row['id'];?>');" class="sub" id="orderID<?php echo $row['id'];?>" bgcolor="<?php echo $warna;?>" onmouseout="this.style.color='#000';">
        <td width="26%" style="padding:5px;"><?php echo getTanggal($row['tgl_prmohonan']);?></td>
        <td width="44%" style="padding:5px;"><?php echo $jab->getField('jabatan',$row['pejabat']);?></td>
        <td width="5%" style="padding:5px;">
		<?php 
		$sts=$row['status'];
		switch ($sts){
			case 'pesan':
				$bgcolor='#EF3636';
			break;
			case 'terima':
				$bgcolor='#132486';			
			break;
			case 'proses':
				$bgcolor='#6CDBB3';
			break;
			case 'kirim':
				$bgcolor='#0F724E';
			break;
		}
		echo "<p style='background:$bgcolor; padding:5px; text-transform:uppercase; font-weight:bold;' align='center'>$sts</p>";
		?>		</td>
        <td width="25%" style="padding:5px;"><?php echo getTanggal($row['tgl_terima']);?></td>
      </tr>
      <tr>
        <td colspan="6" align="left" style="border:none;">
			<span id="infItem<?php echo $row['id'];?>"></span>
			</td>
      </tr>
      <?php $counter ++; } ?>
    </table>
	<?php
	}else{
		echo "<p class='pesan'>Belum ada pengajuan barang.</p>";
	}
}
function viewDetailPermohonan($sql){
	include "class/dtsatuan.cls.php";
	include "class/jabatan.cls.php";
	$brg=new Dtbarang();
	$jab=new Jabatan();
	$satu=new Dtsatuan();
	if($sql!=array()){
	?>
	<table width="100%" cellpadding="0" cellspacing="0">
      <?php
			foreach ($sql as $row){
			?>
      <tr onmouseover="this.style.color='#666';this.style.cursor='pointer';" onclick="addTemp('<?php echo $row['idt'];?>','<?php echo $row['id'];?>','<?php echo $row['barcode'];?>','<?php echo $row['nama'];?>','<?php echo $row['harga_beli'];?>','<?php echo $row['qty'];?>','<?php echo $row['diskon'];?>','<?php echo $row['keterangan'];?>');" class="sub" id="orderID<?php echo $row['id'];?>" bgcolor="<?php echo $warna;?>" onmouseout="this.style.color='#000';">
        <td width="26%" style="padding:5px;"><?php echo $row['barcode'];?></td>
        <td width="26%" style="padding:5px;"><?php echo $row['nama'];?></td>
        <td width="8%" style="padding:5px;" align="center"><?php echo $row['qty'];?></td>
		<td width="16%" align="center"><?php echo $satu->getField('satuan',$brg->getField('satuan',$row['id']));?></td>
        <td width="24%" style="padding:5px;"><?php echo $row['keterangan'];?></td>
      </tr>
      <tr>
        <td colspan="6" align="left" style="border:none;">
			<span id="infItem<?php echo $row['id'];?>"></span>
			</td>
      </tr>
      <?php $counter ++; } ?>
    </table>
	<?php
	}else{
		echo "<p class='pesan'>Data barang masih kosong.</p>";
	}
}
function viewTempKeluar($sql){
	include "class/dtsatuan.cls.php";
	include "class/jabatan.cls.php";
	$brg=new Dtbarang();
	$jab=new Jabatan();
	$satu=new Dtsatuan();
	if($sql!=array()){
	?>
	<table width="100%" cellpadding="0" cellspacing="0">
      <?php
			foreach ($sql as $row){
			?>
      <tr onmouseover="this.style.color='#666';this.style.cursor='pointer';" onclick="addItem('<?php echo $row['id'];?>');" class="sub" id="orderID<?php echo $row['id'];?>" bgcolor="<?php echo $warna;?>" onmouseout="this.style.color='#000';">
        <td width="20%" style="padding:5px;"><?php echo $row['kode'];?></td>
        <td width="32%" style="padding:5px;"><?php echo $row['nama'];?></td>
        <td width="2%" style="padding:5px;" align="center"><input type="text" name="qty" width="10" id="qty<?php echo $row['id'];?>" value="<?php echo $row['qty'];?>" /></td>
		<td width="6%" align="center"><?php echo $satu->getField('satuan',$brg->getField('satuan',$row['id']));?></td>
        <td width="20%" style="padding:5px;"><input type="text" name="ket" id="ket<?php echo $row['id'];?>" value="<?php echo $row['keterangan'];?>" /></td>
        <td width="20%" style="padding:5px;">
			<a onclick="editQty('<?php echo $row['idt']; ?>','<?php echo $row['id']; ?>');">Edit</a> | 
			<a onclick="delTemp('<?php echo $row['idt']; ?>','<?php echo $row['id']; ?>');">Hapus</a>
		</td>
      </tr>
      <tr>
        <td colspan="6" align="left" style="border:none;">
			<span id="infItem<?php echo $row['id'];?>"></span>
			</td>
      </tr>
      <?php $counter ++; } ?>
    </table>
	<?php
	}else{
		echo "<p class='pesan'>Data barang masih kosong.</p>";
	}
}
function viewItemPermohonan($sql,$id){
	include "class/dtsatuan.cls.php";
	$brg=new Dtbarang();
	$sat=new Dtsatuan();
	if($sql==array()){
		echo "<p class='pesan'>Tidak ada permintaan barang.</p>";
	}else{
	?>
		<div class="sub-head"><h3 id="close"><a onclick="viewHide('<?php echo $id; ?>');">X</a></h3><h3 id="judul">DETAIL PENGAJUAN BARANG</h3><div class="c"></div></div>
		<div class='sub-detail'>		
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<th width="13%">Kode</th>
			<th width="47%">Nama Barang </th>
			<th width="17%">Jumlah Permintaan</th>
			<th width="17%">Satuan</th>
			<th width="23%">Keterangan</th>
	<?php
		foreach($sql as $row){
	?>
		  <tr>
			<td><?php echo $row['barcode'];?></td>
			<td><?php echo $row['nama'];?></td>
			<td align="center"><?php echo $row['qty'];?></td>
			<td><?php echo $sat->getField('satuan',$brg->getField('satuan',$row['id']));?></td>
			<td><?php echo $row['keterangan'];?></td>
		  </tr>
		<?php
		}
		?>
		</table>
		</div>
		<?php
	}
}
function detail($ids){
	include "class/surat.cls.php";
	include "class/pegawai.cls.php";
	$surat=new Surat();
	$user=new User();
	$peg=new Pegawai();
	?>
	<div id="form-dis">
		<table width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td valign="top" style="border:none;" class="detail">Disposisi</td>
				<td class="list-ksi detail" style="border:none;">
				<ul>
					<?php 
					$ksi=$user->getWhere('level','KSI');
					foreach($ksi as $row){
						echo "<li><input type='checkbox' value='".$row['id_user']."' class='ksi' /> ".$peg->getField('nama',$row['id_user'])."</li>";
					}
					?>
				</ul>
				</td>
			</tr>
			<tr>
				<td valign="top" style="border:none;" class="detail">Catatan</td>
				<td style="border:none;" class="detail"><textarea name="catatan" id="catatan"></textarea></td>
			</tr>
			<tr>
				<td valign="top" colspan="2" align="right" style="border:none;" class="detail">
				<input type="button" name="simpan" onclick="disposisi('<?php echo $ids; ?>');" value="Disposisi" />
				<input type="button" name="batal" value="Batal"  onclick="viewHide('<?php echo $ids; ?>');" />
				</td>
			</tr>
		</table>
			
	</div>
<?php 
}

?>

