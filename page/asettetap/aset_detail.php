<script>
	function prn(id){
		var prndetail=null;
		if (prndetail==null){
			prndetail=open('page/asettetap/aset_detail_prn.php?id='+id,'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1180,height=600');
		}
	}
</script>
<style>
.aset-list{ margin:7px;}
.aset-list h3{font-size:16px;}
.aset-list ul{ margin-left:18px; float:left;}
.aset-list ul li{min-width:250px; margin:5px; font-size:13px;float:left; color:#333}
.aset-list ul li .b{font-weight:bold;}
.aset-list th{ font-size:13px; background:#CACACA; font-weight:bold; text-align:left; padding:5px;}
.aset-list td{border-bottom:1px solid #999; padding:5px; vertical-align:top;}
</style>
<div class="prev"><img src="img/print-previw.png" onClick="prn('<?php echo $_GET['id'];?>');"></div>
<div class="p-wrapper">
	<div class="content">
		<div class="page-top">
			<h3>DETAIL ASET <?PHP echo $val;?></h3>
		</div>
		<div class="c10"></div>
		<?php
		$id=$_GET['id'];
		$kib=substr($id,0,4);
		switch($kib){
			case 'KIBA':
				$aset=$dtkiba;
				?>	
				<div class="aset-list">
					<h3>A. KATEGORI (A) TANAH / BANGUNAN</h3>
					<ul>
						<li class="b">1. KODE</li>
						<li><?php echo ": ".$aset->getField('kode',$id);?></li>
						<div class="c"></div>
						<li class="b">2. NO.REGISTER</li>
						<li><?php echo ": ".$aset->getField('register',$id);?></li>
						<div class="c"></div>
						<li class="b">3. NAMA ASET</li>
						<li><?php echo ": ".$aset->getField('nama',$id);?></li>
						<div class="c"></div>
						<li class="b">4. LUAS</li>
						<li><?php echo ": ".$aset->getField('luas',$id);?></li>
						<div class="c"></div>
						<li class="b">5. ALAMAT</li>
						<li><?php echo ": ".$aset->getField('alamat',$id);?></li>
						<div class="c"></div>
						<li class="b">6. THN BELI</li>
						<li><?php echo ": ".$aset->getField('tahun',$id);?></li>
						<div class="c"></div>
						<li class="b">7. PENGGUNAAN</li>
						<li><?php echo ": ".$aset->getField('penggunaan',$id);?></li>
						<div class="c"></div>
						<li class="b">8. NILAI / HARGA</li>
						<li><?php echo ": ".rupiah($aset->getField('harga',$id));?></li>
						<div class="c"></div>
						<li class="b">9. ASAL USUL PEROLEHAN</li>
						<li><?php echo ": ".$aset->getField('asalusul',$id);?></li>
						<div class="c"></div>
						<li class="b">10. KETERANGAN</li>
						<li><?php echo ": ".$aset->getField('keterangan',$id);?></li>
						<div class="c"></div>
					</ul>
					<ul>
						<li class="b">11. SERIFIKAT</li>
						<li><?php echo ": ".$aset->getField('hak_sertifikat',$id);?></li>
						<div class="c"></div>
						<li class="b">12. NO.SERTIFIKAT</li>
						<li><?php echo ": ".$aset->getField('no_sertifikat',$id);?></li>
						<div class="c"></div>
						<li class="b">13. TGL SERTIFIKAT</li>
						<li><?php echo ": ".$aset->getField('tgl_sertifikat',$id);?></li>
						<div class="c"></div>
						<li class="b">14. LOKASI ASET</li>
						<li><?php echo ": ".$aset->getField('lokasi',$id);?></li>
					</ul>
					<div class="c10"></div>
					<h3>B. RINCIAN PERAWATAN ASET</h3>
					<?php
					$data=$dtperawatan->get_where_item('id',$id);
					if($data==array()){
						echo "<h3 style='color:red;text-align:center;'>Data perawatan belum ada.</h3><br>";
					}else{		
					?>
					<ul>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<th width="3%" align="center">NO</th>
						<th width="12%" align="left">TANGGAL</th>
						<th width="20%" align="left">PERBAIKAN </th>
						<th width="25%" align="left">KETERANGAN</th>
						<th width="21%" align="left">SPAREPART</th>
						<th width="9%" style="text-align:right">HARGA</th>
						<th width="10%" align="center">STATUS</th>
						<?php
					  foreach($data as $row){
					  ?>
					  <tr>
						<td align="center"><?php echo $c=$c+1;?></td>
						<td><?php echo getTanggal($row['tanggal']);?></td>
						<td><?php echo $row['jenis'];?></td>
						<td align="left"><?php echo $row['keterangan'];?></td>
						<td align="left"><?php echo $row['sparepart'];?></td>
						<td align="right"><?php echo rupiah($row['harga']);?></td>
						<td align="center">
						<?php 
						switch ($row['status']){
							case 'B':echo 'Baik';break;
							case 'KB':echo 'Kurang Baik';break;
							case 'RB':echo 'Rusak Berat';break;
						}
						?>					
						</td>
					  </tr>
					  <?php 
					  }
					?>
					<th colspan="5">TOTAL BIAYA PERAWATAN</th>
					<th colspan="2" style="text-align:right"><?php echo rupiah($dtperawatan->getTotal('id',$id));?></th>
					</table>
					</ul>
					<div class="c10"></div>
				<?php
				}
			break;
			case 'KIBB':
				$aset=$dtkibb;
				?>
				<div class="aset-list">
					<h3>A. KATEGORI (B) PERALATAN DAN MESIN</h3>
					<ul>
						<li class="b">1. KODE</li>
						<li><?php echo ": ".$aset->getField('kode',$id);?></li>
						<div class="c"></div>
						<li class="b">2. NO.REGISTER</li>
						<li><?php echo ": ".$aset->getField('register',$id);?></li>
						<div class="c"></div>
						<li class="b">3. NAMA ASET</li>
						<li><?php echo ": ".$aset->getField('nama',$id);?></li>
						<div class="c"></div>
						<li class="b">4. MEREK / TYPE</li>
						<li><?php echo ": ".$aset->getField('merek',$id);?></li>
						<div class="c"></div>
						<li class="b">5. UKURAN</li>
						<li><?php echo ": ".$aset->getField('ukuran',$id);?></li>
						<div class="c"></div>
						<li class="b">6. THN.BELI</li>
						<li><?php echo ": ".$aset->getField('thn_beli',$id);?></li>
						<div class="c"></div>
						<li class="b">7. NILAI / HARGA</li>
						<li><?php echo ": ".rupiah($aset->getField('harga',$id));?></li>
						<div class="c"></div>
						<li class="b">8. ASAL USUL PEROLEHAN</li>
						<li><?php echo ": ".$aset->getField('asalusul',$id);?></li>
						<div class="c"></div>
						<li class="b">9. KETERANGAN</li>
						<li><?php echo ": ".$aset->getField('keterangan',$id);?></li>
						<div class="c"></div>
					</ul>
					<ul>
						<li class="b">10. NO.PABRIK</li>
						<li><?php echo ": ".$aset->getField('no_pabrik',$id);?></li>
						<div class="c"></div>
						<li class="b">11. NO.RANGKA</li>
						<li><?php echo ": ".$aset->getField('no_rangka',$id);?></li>
						<div class="c"></div>
						<li class="b">12. NO.MESIN</li>
						<li><?php echo ": ".$aset->getField('no_mesin',$id);?></li>
						<div class="c"></div>
						<li class="b">13. NO.POLISI</li>
						<li><?php echo ": ".$aset->getField('no_polisi',$id);?></li>
						<div class="c"></div>
						<li class="b">14. NO.BPKB</li>
						<li><?php echo ": ".$aset->getField('no_bpkb',$id);?></li>
						<div class="c"></div>
						<li class="b">15. KONDISI</li>
						<li><?php echo ": ";
						switch ($aset->getField('kondisi',$id)){
							case 'B':echo 'Baik';break;
							case 'KB':echo 'Kurang Baik';break;
							case 'RB':echo 'Rusak Berat';break;
						}
						?></li>
						<div class="c"></div>
						<li class="b">16. LOKASI</li>
						<li><?php echo ": ".$aset->getField('idkir',$id);?></li>
					</ul>
					<div class="c10"></div>
					<h3>B. RINCIAN PERAWATAN ASET</h3>
					<?php
					$data=$dtperawatan->get_where_item('id',$id);
					if($data==array()){
						echo "<h3 style='color:red;text-align:center;'>Data perawatan belum ada.</h3><br>";
					}else{		
					?>
					<ul>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<th width="3%" align="center">NO</th>
						<th width="12%" align="left">TANGGAL</th>
						<th width="20%" align="left">PERBAIKAN </th>
						<th width="25%" align="left">KETERANGAN</th>
						<th width="21%" align="left">SPAREPART</th>
						<th width="9%" style="text-align:right">HARGA</th>
						<th width="10%" align="center">STATUS</th>
						<?php
					  foreach($data as $row){
					  ?>
					  <tr>
						<td align="center"><?php echo $c=$c+1;?></td>
						<td><?php echo getTanggal($row['tanggal']);?></td>
						<td><?php echo $row['jenis'];?></td>
						<td align="left"><?php echo $row['keterangan'];?></td>
						<td align="left"><?php echo $row['sparepart'];?></td>
						<td align="right"><?php echo rupiah($row['harga']);?></td>
						<td align="center">
						<?php 
						switch ($row['status']){
							case 'B':echo 'Baik';break;
							case 'KB':echo 'Kurang Baik';break;
							case 'RB':echo 'Rusak Berat';break;
						}
						?>					
						</td>
					  </tr>
					  <?php 
					  }
					?>
					<th colspan="5">TOTAL BIAYA PERAWATAN</th>
					<th colspan="2" style="text-align:right"><?php echo rupiah($dtperawatan->getTotal('id',$id));?></th>
					</table>
					</ul>
					<div class="c10"></div>
				<?php
				}
			break;
			case 'KIBC':
				$aset=$dtkibc;
				?>
				<div class="aset-list">
					<h3>A. KATEGORI (C) BANGUNAN</h3>
					<ul>
						<li class="b">1. KODE</li>
						<li><?php echo ": ".$aset->getField('kode',$id);?></li>
						<div class="c"></div>
						<li class="b">2. NO.REGISTER</li>
						<li><?php echo ": ".$aset->getField('register',$id);?></li>
						<div class="c"></div>
						<li class="b">3. NAMA ASET</li>
						<li><?php echo ": ".$aset->getField('nama',$id);?></li>
						<div class="c"></div>
						<li class="b">4. THN BELI</li>
						<li><?php echo ": ".$aset->getField('thn_beli',$id);?></li>
						<div class="c"></div>
						<li class="b">5. NILAI / HARGA</li>
						<li><?php echo ": ".rupiah($aset->getField('harga',$id));?></li>
						<div class="c"></div>
						<li class="b">6. ASAL USUL PEROLEHAN</li>
						<li><?php echo ": ".$aset->getField('asalusul',$id);?></li>
						<div class="c"></div>
						<li class="b">7. KETERANGAN</li>
						<li><?php echo ": ".$aset->getField('keterangan',$id);?></li>
						<div class="c"></div>
					</ul>
					<ul>
						<li class="b">8. NOMOR</li>
						<li><?php echo ": ".$aset->getField('nomor',$id);?></li>
						<div class="c"></div>
						<li class="b">9. KODE TANAH</li>
						<li><?php echo ": ".$aset->getField('kode_tanah',$id);?></li>
						<div class="c"></div>
						<li class="b">10. LUAS TANAH</li>
						<li><?php echo ": ".$aset->getField('luas_tanah',$id);?></li>
						<div class="c"></div>
						<li class="b">11. LUAS LANTAI</li>
						<li><?php echo ": ".$aset->getField('luas_lantai',$id);?></li>
						<div class="c"></div>
						<li class="b">12. TINGKAT</li>
						<li><?php echo ": ".$aset->getField('tingkat',$id);?></li>
						<div class="c"></div>
						<li class="b">13. BETON</li>
						<li><?php echo ": ".$aset->getField('beton',$id);?></li>
						<div class="c"></div>
						<li class="b">14. KONDISI</li>
						<li><?php echo ": ";
						switch ($aset->getField('kondisi',$id)){
							case 'B':echo 'Baik';break;
							case 'KB':echo 'Kurang Baik';break;
							case 'RB':echo 'Rusak Berat';break;
						}
						?></li>
						<div class="c"></div>
						<li class="b">15. LOKASI</li>
						<li><?php echo ": ".$aset->getField('lokasi',$id);?></li>
						<div class="c"></div>
					</ul>
				    <div class="c10"></div>
					<h3>B. RINCIAN PERAWATAN ASET</h3>
					<?php
					$data=$dtperawatan->get_where_item('id',$id);
					if($data==array()){
						echo "<h3 style='color:red;text-align:center;'>Data perawatan belum ada.</h3><br>";
					}else{		
					?>
					<ul>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<th width="3%" align="center">NO</th>
						<th width="12%" align="left">TANGGAL</th>
						<th width="20%" align="left">PERBAIKAN </th>
						<th width="25%" align="left">KETERANGAN</th>
						<th width="21%" align="left">SPAREPART</th>
						<th width="9%" style="text-align:right">HARGA</th>
						<th width="10%" align="center">STATUS</th>
						<?php
					  foreach($data as $row){
					  ?>
					  <tr>
						<td align="center"><?php echo $c=$c+1;?></td>
						<td><?php echo getTanggal($row['tanggal']);?></td>
						<td><?php echo $row['jenis'];?></td>
						<td align="left"><?php echo $row['keterangan'];?></td>
						<td align="left"><?php echo $row['sparepart'];?></td>
						<td align="right"><?php echo rupiah($row['harga']);?></td>
						<td align="center">
						<?php 
						switch ($row['status']){
							case 'B':echo 'Baik';break;
							case 'KB':echo 'Kurang Baik';break;
							case 'RB':echo 'Rusak Berat';break;
						}
						?>					
						</td>
					  </tr>
					  <?php 
					  }
					?>
					<th colspan="5">TOTAL BIAYA PERAWATAN</th>
					<th colspan="2" style="text-align:right"><?php echo rupiah($dtperawatan->getTotal('id',$id));?></th>
					</table>
					</ul>
					<div class="c10"></div>
				<?php
				}
			break;
			case 'KIBE':
				$aset=$dtkibe;
				?>
				<div class="aset-list">
					<h3>A. KATEGORI (E) BUKU</h3>
					<ul>
						<li class="b">1. KODE</li>
						<li><?php echo ": ".$aset->getField('kode',$id);?></li>
						<div class="c"></div>
						<li class="b">2. NO.REGISTER</li>
						<li><?php echo ": ".$aset->getField('register',$id);?></li>
						<div class="c"></div>
						<li class="b">3. NAMA ASET</li>
						<li><?php echo ": ".$aset->getField('nama',$id);?></li>
						<div class="c"></div>
						<li class="b">4. JUDUL</li>
						<li><?php echo ": ".$aset->getField('judul',$id);?></li>
						<div class="c"></div>
						<li class="b">5. DAERAH</li>
						<li><?php echo ": ".$aset->getField('daerah',$id);?></li>
						<div class="c"></div>
						<li class="b">6. PENCIPTA</li>
						<li><?php echo ": ".$aset->getField('pencipta',$id);?></li>
						<div class="c"></div>
						<li class="b">7. THN CETAK</li>
						<li><?php echo ": ".$aset->getField('thn_cetak',$id);?></li>
						<div class="c"></div>
						<li class="b">8. NILAI / HARGA</li>
						<li><?php echo ": ".rupiah($aset->getField('harga',$id));?></li>
						<div class="c"></div>
						<li class="b">9. ASAL USUL PEROLEHAN</li>
						<li><?php echo ": ".$aset->getField('asalusul',$id);?></li>
						<div class="c"></div>
						<li class="b">10. KETERANGAN</li>
						<li><?php echo ": ".$aset->getField('keterangan',$id);?></li>
						<div class="c"></div>
					</ul>
					<ul>
						<li class="b">11. JENIS</li>
						<li><?php echo ": ".$aset->getField('jenis',$id);?></li>
						<div class="c"></div>
						<li class="b">12. SPESIFIKASI</li>
						<li><?php echo ": ".$aset->getField('spesifikasi',$id);?></li>
						<div class="c"></div>
						<li class="b">13. BAHAN</li>
						<li><?php echo ": ".$aset->getField('bahan',$id);?></li>
						<div class="c"></div>
						<li class="b">14. UKURAN</li>
						<li><?php echo ": ".$aset->getField('ukuran',$id);?></li>
						<div class="c"></div>
						<li class="b">15. RENOVASI</li>
						<li><?php echo ": ".$aset->getField('renovasi',$id);?></li>
						<div class="c"></div>
						<li class="b">14. KONDISI</li>
						<li><?php echo ": ";
						switch ($aset->getField('kondisi',$id)){
							case 'B':echo 'Baik';break;
							case 'KB':echo 'Kurang Baik';break;
							case 'RB':echo 'Rusak Berat';break;
						}
						?></li>
						<div class="c"></div>
						<li class="b">17. LOKASI ASET</li>
						<li><?php echo ": ".$aset->getField('idkir',$id);?></li>
						<div class="c"></div>
					</ul>
				    <div class="c10"></div>
					<h3>B. RINCIAN PERAWATAN ASET</h3>
					<?php
					$data=$dtperawatan->get_where_item('id',$id);
					if($data==array()){
						echo "<h3 style='color:red;text-align:center;'>Data perawatan belum ada.</h3><br>";
					}else{		
					?>
					<ul>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<th width="3%" align="center">NO</th>
						<th width="12%" align="left">TANGGAL</th>
						<th width="20%" align="left">PERBAIKAN </th>
						<th width="25%" align="left">KETERANGAN</th>
						<th width="21%" align="left">SPAREPART</th>
						<th width="9%" style="text-align:right">HARGA</th>
						<th width="10%" align="center">STATUS</th>
						<?php
					  foreach($data as $row){
					  ?>
					  <tr>
						<td align="center"><?php echo $c=$c+1;?></td>
						<td><?php echo getTanggal($row['tanggal']);?></td>
						<td><?php echo $row['jenis'];?></td>
						<td align="left"><?php echo $row['keterangan'];?></td>
						<td align="left"><?php echo $row['sparepart'];?></td>
						<td align="right"><?php echo rupiah($row['harga']);?></td>
						<td align="center">
						<?php 
						switch ($row['status']){
							case 'B':echo 'Baik';break;
							case 'KB':echo 'Kurang Baik';break;
							case 'RB':echo 'Rusak Berat';break;
						}
						?>					
						</td>
					  </tr>
					  <?php 
					  }
					?>
					<th colspan="5">TOTAL BIAYA PERAWATAN</th>
					<th colspan="2" style="text-align:right"><?php echo rupiah($dtperawatan->getTotal('id',$id));?></th>
					</table>
					</ul>
					<div class="c10"></div>
				<?php
				}
			break;
		}
		?>
	</div>
</div>
<div class="c10"></div>