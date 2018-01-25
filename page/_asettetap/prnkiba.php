<?php
include '../../lib/barcode.php';
include '../../lib/lib.php';
include '../../class/dtkiba.cls.php';
$db=new Db();
$db->conDb();
$dtkiba=new Dtkiba();
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
<h1 align="center">KARTU INVENTARIS BARANG (KIB) A </h1>
<h2 align="center">TANAH DAN BANGUNAN </h2>
<br />
<div class="c10"></div>
<br />
<?php
$data=$dtkiba->getAll();
if($data!=array()){
?>
<table width="100%" cellpadding="0" cellspacing="0" id="tbl">
	<tr>
		<td rowspan="3" style="border:1px solid #333; background:#aaa; font-weight:bold;">No.</td>
		<td rowspan="3" style="border:1px solid #333; background:#aaa; font-weight:bold;">Jenis / Nama Barang</td>
		<td colspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Nomor</td>
		<td rowspan="3" style="border:1px solid #333; background:#aaa; font-weight:bold;">Luas (M2)</td>
		<td rowspan="3" style="border:1px solid #333; background:#aaa; font-weight:bold;">Tahun</td>
		<td rowspan="3" style="border:1px solid #333; background:#aaa; font-weight:bold;">Letak/Alamat</td>
		<td colspan="3" style="border:1px solid #333; background:#aaa; font-weight:bold;">Status Tanah</td>
		<td rowspan="3" style="border:1px solid #333; background:#aaa; font-weight:bold;">Penggunaan</td>
		<td rowspan="3" style="border:1px solid #333; background:#aaa; font-weight:bold;">Asal-usul</td>
		<td rowspan="3" style="border:1px solid #333; background:#aaa; font-weight:bold;">Harga (Rp.)</td>
		<td rowspan="3" style="border:1px solid #333; background:#aaa; font-weight:bold;">Keterangan</td> 
	</tr>
	<tr>
		<td rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Kode Barang</td>
		<td rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Register</td>
		<td rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Hak</td>
		<td colspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Sertifikat</td>
	</tr>
	<tr>
		<td style="border:1px solid #333; background:#aaa; font-weight:bold;">Tanggal</td>
		<td style="border:1px solid #333; background:#aaa; font-weight:bold;">Nomor</td>
	</tr>
	<?php 
	foreach($data as $row){
	?>
	<tr>
		<td style="border:1px solid #333;"><?php echo $c=$c+1;?></td>
		<td style="border:1px solid #333;"><?php echo $row['nama'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['kode'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['register'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['luas'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['tahun'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['alamat'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['hak_sertifikat'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['tgl_sertifikat'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['no_sertifikat'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['penggunaan'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['asalusul'];?></td>
		<td style="border:1px solid #333;" align="right"><?php echo format_angka($row['harga']);?></td>
		<td style="border:1px solid #333;"><?php echo $row['keterangan'];?></td>
	</tr>
	<?php
	}
	?>
	<tr>
		<td colspan="12">T O T A L &nbsp;&nbsp;&nbsp;N I L A I &nbsp;&nbsp;&nbsp;A S E T</td>
		<td colspan="3"><?php echo rupiah($dtkiba->getTotal());?></td>
	</tr>		
</table>
<div class="c10"></div>
<table width="100%" cellpadding="0" cellspacing="0" id="tbl">
	<tr>
		<td width="17%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Total nilai intra comptable</td>
		<td width="12%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">: <?php echo rupiah($dtkiba->getTotal());?></td>
		<td width="44%" rowspan="2" align="center" style="border:1px solid #333; background:#aaa; font-weight:bold;"><?php echo terbilang($dtkiba->getTotal());?></td>
		<td width="15%" style="border:1px solid #333; background:#aaa; font-weight:bold;">Total nilai</td>
		<td width="12%" style="border:1px solid #333; background:#aaa; font-weight:bold;">: <?php echo rupiah($dtkiba->getTotal());?></td>
	</tr>
	<tr>
		<td style="border:1px solid #333; background:#aaa; font-weight:bold;">Total nilai</td>
		<td style="border:1px solid #333; background:#aaa; font-weight:bold;">: <?php echo rupiah($dtkiba->getTotal());?></td>
	</tr>
</table>
<?php
}
?>
</div>






</div>
<div id="menu"><a onClick="window.print();"><img src="../../img/print.png"></a></div>