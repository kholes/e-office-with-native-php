<?php
include '../../lib/barcode.php';
include '../../lib/lib.php';
include '../../class/dtkibe.cls.php';
$db=new Db();
$db->conDb();
$dtkibe=new Dtkibe();
$encode="CODE128";
$height="50";
$scale="2";
$bgcolor="#FFFFFF";
$color="#000000";
$file="";
$type="PNG";
?>
<link rel="stylesheet" type="text/css" href="../../css/print.css">
<div style=" display:block; width:1250px; margin: auto;">
<h1 align="center">KARTU INVENTARIS BARANG (KIB) E </h1>
<h2 align="center">BUKU</h2>
<br />
<div class="c10"></div>
<br />
<?php
$data=$dtkibe->getAll();
if($data!=array()){
?>
<table width="100%" cellpadding="0" cellspacing="0" id="tbl">
	<tr>
		<td rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">No.</td>
		<td rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Nama Barang </td>
		<td colspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Nomor</td>
		<td colspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Buku/Perpustakaan</td>
		<td colspan="3" style="border:1px solid #333; background:#aaa; font-weight:bold;">Barang Bercorak Kebudayaan </td>
		<td colspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Hewan/Ternak dan Tumbuhan </td>
		<td rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Aset Renovasi </td>
		<td rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Jumlah</td>
		<td rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Tahun Cetak</td>
		<td rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Asal-usul Cara perolehan </td>
		<td rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Harga (Rp.) </td>
		<td rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Ket.</td>
	</tr>
	<tr>
		<td style="border:1px solid #333; background:#aaa; font-weight:bold;">Kode Barang</td>
		<td style="border:1px solid #333; background:#aaa; font-weight:bold;">Reg.</td>
		<td style="border:1px solid #333; background:#aaa; font-weight:bold;">Judul/Pencipta</td>
		<td style="border:1px solid #333; background:#aaa; font-weight:bold;">Spesifikasi</td>
		<td style="border:1px solid #333; background:#aaa; font-weight:bold;">Asal daerah</td>
		<td style="border:1px solid #333; background:#aaa; font-weight:bold;">Pencipta</td>
		<td style="border:1px solid #333; background:#aaa; font-weight:bold;">Bahan</td>
		<td style="border:1px solid #333; background:#aaa; font-weight:bold;">Jenis</td>
		<td style="border:1px solid #333; background:#aaa; font-weight:bold;">Ukuran</td>
	</tr>
	<?php 
	foreach($data as $row){
	?>
	<tr>
		<td style="border:1px solid #333;"><?php echo $c=$c+1;?></td>
		<td style="border:1px solid #333;"><?php echo $row['nama'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['kode'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['register'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['judul'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['spesifikasi'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['daerah'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['pencipta'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['bahan'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['jenis'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['ukuran'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['renovasi'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['jumlah'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['thn_cetak'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['asalusul'];?></td>
		<td style="border:1px solid #333;" align="center"><?php echo format_angka($row['harga']);?></td>
		<td style="border:1px solid #333;"><?php echo $row['keterangan'];?></td>
	</tr>
	<?php
	}
	?>
</table>
<div class="c10"></div>
<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Total nilai Intra comptable</td>
		<td width="12%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">: <?php echo rupiah($dtkibe->getTotal());?></td>
		<td width="44%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;" align="center"><?php echo terbilang($dtkibe->getTotal());?></td>
		<td width="15%" style="border:1px solid #333; background:#aaa; font-weight:bold;">Total nilai</td>
		<td width="12%" style="border:1px solid #333; background:#aaa; font-weight:bold;">: <?php echo rupiah($dtkibe->getTotal());?></td>
	</tr>
	<tr>
		<td style="border:1px solid #333; background:#aaa; font-weight:bold;">Total nilai</td>
		<td style="border:1px solid #333; background:#aaa; font-weight:bold;">: <?php echo rupiah($dtkibe->getTotal());?></td>
	</tr>
</table>
<?php
}
?>
</div>






</div>
<div id="menu"><a onClick="window.print();"><img src="../../img/print.png"></a></div>