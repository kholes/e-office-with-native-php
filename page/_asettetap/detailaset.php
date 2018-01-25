<script>
	function prn(id){
		var prndetail=null;
		if (prndetail==null){
			prndetail=open('page/asettetap/prndetailaset.php?id='+id,'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1180,height=600');
		}
	}
</script>
<div class="prev"><img src="img/print-previw.png" onClick="prn('<?php echo $_GET['id'];?>');"></div>
<div class="p-wrapper">
	<div class="content">
		<div style="border-bottom:1px solid #ccc;"></div>
		<h3 id="label-form">
			<ul>
				<li><a>DETAIL ASET</a></li>
				<li class="active"><?php echo $val;?></li>
			</ul>
		</h3>
		<div class="c10"></div>
		<?php
		$id=$_GET['id'];
		$kib=substr($id,0,4);
		switch($kib){
			case 'KIBA':
				$aset=$dtkiba;
				?>	
				<h3 align="center"><u>KATEGORI (A) TANAH / BANGUNAN</u></h3>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="form">
				  <tr>
					<td width="22%"><p style="font-weight:bold;">KODE</p></td>
					<td width="1%">:</td>
					<td width="35%"><?php echo $aset->getField('kode',$id);?></td>
					<td width="1%">&nbsp;</td>
					<td width="21%"><p style="font-weight:bold;">SERTIFIKAT</p></td>
					<td width="0%">:</td>
					<td width="20%"><?php echo $aset->getField('hak_sertifikat',$id);?></td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">NO.REGISTER</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('register',$id);?></td>
					<td>&nbsp;</td>
					<td><p style="font-weight:bold;">TGL.SERTIFIKAT</p></td>
					<td>:</td>
					<td><?php if($aset->getField('tgl_sertifikat',$id)!='0000-00-00'){echo getTanggal($aset->getField('tgl_sertifikat',$id));}else{echo '-';}?></td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">NAMA</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('nama',$id);?></td>
					<td>&nbsp;</td>
					<td><p style="font-weight:bold;">NO.SERTIFIKAT</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('no_sertifikat',$id);?></td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">LUAS</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('luas',$id);?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">ALAMAT</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('alamat',$id);?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">THN.BELI</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('tahun',$id);?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">PENGGUNAAN</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('penggunaan',$id);?></td>
					<td>&nbsp;</td>
					<td><p style="font-weight:bold;">LOKASI BARANG</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('idkir',$id);?></td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">NILAI / HARGA</p></td>
					<td>:</td>
					<td><?php echo rupiah($aset->getField('harga',$id));?></td>
					<td>&nbsp;</td>
					<td><p style="font-weight:bold;">TOTAL BIAYA PERAWATAN</p></td>
					<td>:</td>
					<td><?php echo rupiah($dtperawatan->getTotal('id',$id));?></td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">ASAL-USUL PEROLEHAN</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('asalusul',$id);?></td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">KETERANGAN</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('keterangan',$id);?></td>
				  </tr>
				</table>
				<h3 align="center"><u>RINCIAN PERAWATAN BARANG</u></h3>
				<?php
				$data=$dtperawatan->getItem('id',$id);
				if($data==array()){
					echo "<p align='center'>Data perawatan belum ada.</p>";
				}else{		
				?>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabel">
					<th width="3%" align="center">NO</th>
					<th width="12%">TANGGAL</th>
					<th width="18%">JENIS PERAWATAN </th>
					<th width="29%">KETERANGAN</th>
					<th width="18%">PENGGANTIAN SPAREPART </th>
					<th width="13%" align="center">HARGA</th>
					<th width="7%">STATUS</th>
				  <?php
				  foreach($data as $row){
				  ?>
				  <tr>
					<td align="center"><?php echo $c=$c+1;?></td>
					<td><?php echo getTanggal($row['tanggal']);?></td>
					<td><?php echo $row['jenis'];?></td>
					<td><?php echo $row['keterangan'];?></td>
					<td><?php echo $row['sparepart'];?></td>
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
				</table>
				<?php
				}
			break;
			case 'KIBB':
				$aset=$dtkibb;
				?>
				<h3 align="center"><u>KATEGORI (B) PERALATAN DAN MESIN</u></h3>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="form">
				  <tr>
					<td width="23%"><p style="font-weight:bold;">KODE</p></td>
					<td width="0%">:</td>
					<td width="27%"><?php echo $aset->getField('kode',$id);?></td>
					<td width="1%">&nbsp;</td>
					<td width="23%"><p style="font-weight:bold;">NO. PABRIK</p></td>
					<td width="0%">:</td>
					<td width="26%"><?php echo $aset->getField('no_pabrik',$id);?></td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">NO.REGISTER</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('register',$id);?></td>
					<td>&nbsp;</td>
					<td><p style="font-weight:bold;">NO. RANGKA</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('no_rangka',$id);?></td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">NAMA BARANG</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('nama',$id);?></td>
					<td>&nbsp;</td>
					<td><p style="font-weight:bold;">NO. MESIN</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('no_mesin',$id);?></td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">MEREK / TYPE</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('merek',$id);?></td>
					<td>&nbsp;</td>
					<td><p style="font-weight:bold;">NO. POLISI</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('no_polisi',$id);?></td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">UKURAN</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('ukuran',$id);?></td>
					<td>&nbsp;</td>
					<td><p style="font-weight:bold;">NO. BPKB</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('no_bpkb',$id);?></td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">BAHAN</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('bahan',$id);?></td>
					<td>&nbsp;</td>
					<td><p style="font-weight:bold;">KONDISI BARANG</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('kondisi',$id);?></td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">THN.BELI</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('thn_beli',$id);?></td>
					<td>&nbsp;</td>
					<td><p style="font-weight:bold;">LOKASI BARANG</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('idkir',$id);?></td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">NILAI / HARGA</p></td>
					<td>:</td>
					<td><?php echo rupiah($aset->getField('harga',$id));?></td>
					<td>&nbsp;</td>
					<td><p style="font-weight:bold;">TOTAL BIAYA PERAWATAN</p></td>
					<td>:</td>
					<td><?php echo rupiah($dtperawatan->getTotal('id',$id));?></td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">ASAL-USUL PEROLEHAN</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('asalusul',$id);?></td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">KETERANGAN</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('keterangan',$id);?></td>
				  </tr>
				</table>
				<h3 align="center"><u>RINCIAN PERAWATAN BARANG</u></h3>
				<?php
				$data=$dtperawatan->getItem('id',$id);
				if($data==array()){
					echo "<p align='center'>Data perawatan belum ada.</p>";
				}else{		
				?>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabel">
					<th width="3%" align="center">NO</th>
					<th width="12%">TANGGAL</th>
					<th width="18%">JENIS PERAWATAN </th>
					<th width="29%">KETERANGAN</th>
					<th width="18%">PENGGANTIAN SPAREPART </th>
					<th width="13%" align="center">HARGA</th>
					<th width="7%">STATUS</th>
				  <?php
				  foreach($data as $row){
				  ?>
				  <tr>
					<td align="center"><?php echo $c=$c+1;?></td>
					<td><?php echo getTanggal($row['tanggal']);?></td>
					<td><?php echo $row['jenis'];?></td>
					<td><?php echo $row['keterangan'];?></td>
					<td><?php echo $row['sparepart'];?></td>
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
				</table>
				<?php
				}
			break;
			case 'KIBE':
				$aset=$dtkibe;
				?>
				<h3 align="center"><u>KATEGORI (E) BUKU</u></h3>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="form">
				  <tr>
					<td width="23%"><p style="font-weight:bold;">KODE</p></td>
					<td width="0%">:</td>
					<td width="27%"><?php echo $aset->getField('kode',$id);?></td>
					<td width="1%">&nbsp;</td>
					<td width="23%"><p style="font-weight:bold;">JENIS</p></td>
					<td width="0%">:</td>
					<td width="26%"><?php echo $aset->getField('jenis',$id);?></td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">NO.REGISTER</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('register',$id);?></td>
					<td>&nbsp;</td>
					<td><p style="font-weight:bold;">SPESIFIKASI</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('spesifikasi',$id);?></td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">NAMA</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('nama',$id);?></td>
					<td>&nbsp;</td>
					<td><p style="font-weight:bold;">BAHAN</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('bahan',$id);?></td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">JUDUL</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('judul',$id);?></td>
					<td>&nbsp;</td>
					<td><p style="font-weight:bold;">UKURAN</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('ukuran',$id);?></td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">DAERAH</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('daerah',$id);?></td>
					<td>&nbsp;</td>
					<td><p style="font-weight:bold;">RENOVASI</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('renovasi',$id);?></td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">PENCIPTA</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('pencipta',$id);?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">THN.CETAK</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('thn_cetak',$id);?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">NILAI / HARGA</p></td>
					<td>:</td>
					<td><?php echo rupiah($aset->getField('harga',$id));?></td>
					<td>&nbsp;</td>
					<td><p style="font-weight:bold;">LOKASI BARANG</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('idkir',$id);?></td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">ASAL-USUL PEROLEHAN</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('asalusul',$id);?></td>
					<td>&nbsp;</td>
					<td><p style="font-weight:bold;">TOTAL BIAYA PERAWATAN</p></td>
					<td>:</td>
					<td><?php echo rupiah($dtperawatan->getTotal('id',$id));?></td>
				  </tr>
				  <tr>
					<td><p style="font-weight:bold;">KETERANGAN</p></td>
					<td>:</td>
					<td><?php echo $aset->getField('keterangan',$id);?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				</table>
				<h3 align="center"><u>RINCIAN PERAWATAN BARANG</u></h3>
				<?php
				$data=$dtperawatan->getItem('id',$id);
				if($data==array()){
					echo "<p align='center'>Data perawatan belum ada.</p>";
				}else{		
				?>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabel">
					<th width="3%" align="center">NO</th>
					<th width="12%">TANGGAL</th>
					<th width="18%">JENIS PERAWATAN </th>
					<th width="29%">KETERANGAN</th>
					<th width="18%">PENGGANTIAN SPAREPART </th>
					<th width="13%" align="center">HARGA</th>
					<th width="7%">STATUS</th>
				  <?php
				  foreach($data as $row){
				  ?>
				  <tr>
					<td align="center"><?php echo $c=$c+1;?></td>
					<td><?php echo getTanggal($row['tanggal']);?></td>
					<td><?php echo $row['jenis'];?></td>
					<td><?php echo $row['keterangan'];?></td>
					<td><?php echo $row['sparepart'];?></td>
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
				</table>
				<?php
				}
			break;
		}
		?>
	</div>
</div>
<div class="c10"></div>