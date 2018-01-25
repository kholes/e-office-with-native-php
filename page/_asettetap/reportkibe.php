<script>
	function viewDetailE(id){
		window.location='<?php echo $link; ?>&m=fkibe&id='+id;
	}
	function historyE(id){
		window.location='<?php echo $link; ?>&m=rhis&id='+id;
	}
	function prnE(){
		var prnbarkode=null;
		if (prnbarkode==null){
			prnbarkode=open('page/asettetap/prnkibe.php','page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1180,height=600');
		}
	}
	function prncodeE(){
		var pp = prompt("Masukan jumlah per-halaman, Maximum load 83 Code", "30");
		var prncode=null;
		if (prncode==null){
			prncode=open('page/asettetap/prncodee.php?pp='+pp,'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1180,height=600');
		}
	}
</script>
<div class="view-data">
<h1 align="center">KARTU INVENTARIS BARANG (KIB) E </h1>
<h2 align="center">BUKU</h2>
<?php
$data=$dtkibe->getAll();
if($data!=array()){
?>
<table width="100%" cellpadding="0" cellspacing="0" id="tbl">
	<tr>
		<td rowspan="2" class="th">No.</td>
		<td rowspan="2" class="th">ID Barang</td>
		<td rowspan="2" class="th">Nama Barang </td>
		<td colspan="2" class="th">Nomor</td>
		<td colspan="2" class="th">Buku/Perpustakaan</td>
		<td colspan="3" class="th">Barang Bercorak Kebudayaan </td>
		<td colspan="2" class="th">Hewan/Ternak dan Tumbuhan </td>
		<td rowspan="2" class="th">Aset Renovasi </td>
		<td rowspan="2" class="th">Jumlah</td>
		<td rowspan="2" class="th">Tahun Cetak</td>
		<td rowspan="2" class="th">Asal-usul Cara perolehan </td>
		<td rowspan="2" class="th">Harga (Rp.) </td>
		<td rowspan="2" class="th">Ket.</td>
	</tr>
	<tr>
		<td class="th">Kode Barang</td>
		<td class="th">Reg.</td>
		<td class="th">Judul/Pencipta</td>
		<td class="th">Spesifikasi</td>
		<td class="th">Asal daerah</td>
		<td class="th">Pencipta</td>
		<td class="th">Bahan</td>
		<td class="th">Jenis</td>
		<td class="th">Ukuran</td>
	</tr>
	<?php 
	foreach($data as $row){
		switch($row['kondisi']){
			case 'B':
				$bgr='white';
			break;
			case 'KB':
				$bgr='#FF7800';
			break;
			case 'RB':
				$bgr='#E60C0C';
			break;
		}
	?>
	<tr onMouseOver="this.style.color='#333';" onmouseout="this.style.color='#333';" onclick="viewDetail('<?php echo $row['id'];?>');" bgcolor="<?php echo $bgr;?>">
		<td><?php echo $ce=$ce+1;?></td>
		<td>
			<ul class="dropmenu">
				<li><a style="color:#000"><?php echo $row['id'];?></a>
					<ul>
						<div class="mn"><b></b>
								<li><a onClick="historyE('<?php echo $row['id']; ?>');">Riwayat Perawatan</a></li>
								<li><a onClick="viewDetailE('<?php echo $row['id'];?>');">Edit / Hapus</a></li>
						</div>
					</ul>
				</li>
			</ul>
		</td>
		<td><?php echo $row['nama'];?></td>
		<td><?php echo $row['kode'];?></td>
		<td><?php echo $row['register'];?></td>
		<td><?php echo $row['judul'];?></td>
		<td><?php echo $row['spesifikasi'];?></td>
		<td><?php echo $row['daerah'];?></td>
		<td><?php echo $row['pencipta'];?></td>
		<td><?php echo $row['bahan'];?></td>
		<td><?php echo $row['jenis'];?></td>
		<td><?php echo $row['ukuran'];?></td>
		<td><?php echo $row['renovasi'];?></td>
		<td><?php echo $row['jumlah'];?></td>
		<td><?php echo $row['thn_cetak'];?></td>
		<td><?php echo $row['asalusul'];?></td>
		<td align="center"><?php echo format_angka($row['harga']);?></td>
		<td><?php echo $row['keterangan'];?></td>
	</tr>
	<?php
	}
	?>
</table>
<div class="c10"></div>
<table width="100%" cellpadding="0" cellspacing="0" id="tbl">
	<tr>
		<td width="17%" rowspan="2" style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">Total nilai Intra comptable</td>
		<td width="12%" rowspan="2" style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">: <?php echo rupiah($dtkibe->getTotal());?></td>
		<td width="44%" rowspan="2" align="center" style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;"><?php echo terbilang($dtkibe->getTotal());?></td>
		<td width="15%" style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">Total nilai</td>
		<td width="12%" style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">: <?php echo rupiah($dtkibe->getTotal());?></td>
	</tr>
	<tr>
		<td style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">Total nilai</td>
		<td style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">: <?php echo rupiah($dtkibe->getTotal());?></td>
	</tr>
</table>
<div class="head_content" style="box-shadow:none;" >
<input type="button" name="prn" id="prn" onClick="prnE();" value="Cetak">
<input type="button" name="prn" id="prn" onClick="prncodeE();" value="Cetak Barcode">
</div>
<?php
}
?>
</div>
<script>
	function setfocus(){$('#cari').focus();}
	document.onkeydown = function(e){setfocus();}
</script>
